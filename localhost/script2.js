/*registrationForm.onsubmit = async (e) => {
    e.preventDefault();

    let response = await fetch('https://api.jotform.com/user/register', {
        method: 'POST',
        body: new FormData(registrationForm)
    });

    let result = await response.json();

    alert(result.message);
}

loginForm.onsubmit = async (e) => {
    e.preventDefault();

    let response = await fetch('https://api.jotform.com/user/login', {
        method: 'POST',
        body: new FormData(loginForm)
    });

    let result = await response.json();

    alert(result.message);
}*/