import requests
import os
import pandas as pd
from bs4 import BeautifulSoup

GITHUB_ORG = "Lok-Jagruti-Kendra-University"
GITHUB_TOKEN = "my-ljku-artifacts-token"
HEADERS = {"Authorization": f"token {GITHUB_TOKEN}"}

print(pd.__version__)

def fetch_sonarcloud_score():
    """Fetch SonarCloud quality metrics."""
    url = "https://sonarcloud.io/api/measures/component"
    params = {
        "component": "Lok-Jagruti-Kendra-University_testai",  # Your SonarCloud project key
        "branch":"main",
        "metricKeys": "coverage,ncloc,vulnerabilities,bugs,code_smells, security_hotspots,duplicated_lines_density, cognitive_complexity,security_rating,sqale_rating, reliability_rating"
    }
    response = requests.get(url, params=params)
    # Debugging output
    
    print("Response Status Code:", response.status_code)
    print("Response Content:", response.text)  
    
    if response.status_code != 200:
        print("Error fetching data:", response.status_code)
        return None

    data = response.json()
    measures = data.get("component", {}).get("measures", [])

    # Extract metrics
    scores = {m["metric"]: m["value"] for m in measures}
    return scores
    
    if response.status_code == 200:
        data = response.json()
        measures = data.get("component", {}).get("measures", [])
        
        # Example: Extracting coverage score
        code_smells = next((m["value"] for m in measures if m["metric"] == "code_smells"), 0)
        return float(code_smells)
    
    return 0  # Default to 0 if request fails

def fetch_mlflow_score():
    """Fetch an example MLflow metric (dummy API, replace with real MLflow API)."""
    url = "http://mlflow-server.example.com/api/2.0/mlflow/metrics/get"
    params = {
        "run_id": "some-run-id",
        "metric_key": "accuracy"
    }
    response = requests.get(url)
    
    if response.status_code == 200:
        data = response.json()
        return float(data.get("metric", {}).get("value", 0)) * 100  # Convert to percentage
    return 0

def fetch_deepsource_score():
    """Fetch DeepSource score (Example API call, replace with actual API)."""
    url = "https://deepsource.io/api/v1/some_project/issues/statistics"
    headers = {"Authorization": "Token YOUR_DEEPSOURCE_API_KEY"}
    response = requests.get(url, headers=headers)
    
    if response.status_code == 200:
        data = response.json()
        return 100 - int(data.get("issue_count", 0))  # Assuming fewer issues = better score
    return 0

def aggregate_scores():
    """Aggregate scores from all sources."""
    #sonar_score = fetch_sonarcloud_score()
    mlflow_score = 30 #fetch_mlflow_score()
    deepsource_score = 30 #fetch_deepsource_score()
    return sonar_score
    overall_score = (sonar_score + mlflow_score + deepsource_score) / 3
    return {
        "SonarCloud": sonar_score,
        "MLflow": mlflow_score,
        "DeepSource": deepsource_score,
        "Overall Score": round(overall_score, 2)
    }


# SonarCloud Summary Page URL
SONARCLOUD_URL = "https://sonarcloud.io/summary/overall?id=Lok-Jagruti-Kendra-University_testai&branch=main"

def save_to_excel(data):
    if not data:
        print("No data to save")
        return
    df = pd.DataFrame([data])
    df.to_excel("sonarcloud_summary.xlsx", index=False)
    print("Saved to sonarcloud_summary.xlsx")

def get_repositories():
    url = f"https://api.github.com/orgs/{GITHUB_ORG}/repos"
    response = requests.get(url, headers=HEADERS)
    return [repo["name"] for repo in response.json()]

def get_latest_workflow_run(repo):
    url = f"https://api.github.com/repos/{GITHUB_ORG}/{repo}/actions/runs"
    response = requests.get(url, headers=HEADERS)
    runs = response.json().get("workflow_runs", [])
    return runs[0]["id"] if runs else None

def download_artifact(repo, run_id):
    url = f"https://api.github.com/repos/{GITHUB_ORG}/{repo}/actions/runs/{run_id}/artifacts"
    response = requests.get(url, headers=HEADERS)
    artifacts = response.json().get("artifacts", [])
    
    if artifacts:
        artifact_url = artifacts[0]["archive_download_url"]
        response = requests.get(artifact_url, headers=HEADERS)
        
        with open(f"artifacts/{repo}.zip", "wb") as file:
            file.write(response.content)
        print(f"Downloaded artifacts for {repo}")
    else:
        print(f"No artifacts found for {repo}")

if __name__ == "__main__":
    #summary_data = fetch_sonarcloud_summary()
    data = fetch_sonarcloud_score()
    save_to_excel(data)

    os.makedirs("artifacts", exist_ok=True)
    for repo in get_repositories():
        run_id = get_latest_workflow_run(repo)
        if run_id:
            download_artifact(repo, run_id)
    #scores = aggregate_scores()
    #print("Aggregated Scores:", scores)
