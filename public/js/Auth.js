const button = document.getElementById('send');
const url_origin = document.getElementById('baseurl').value;
const token = document.getElementById('token').value;

button.addEventListener('click', async () => {
    const response = await login();
    if (response.pesan == 'login sukses') {
        alert('login sukses');
        localStorage.setItem('role', response.role);
        response.role === 2
            ? (window.location.href = `${url_origin}/admin`)
            : (window.location.href = `${url_origin}/home`);
    } else {
        alert('login gagal');
    }
});

async function login() {
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const response = await fetchLogin(email, password);
    return response;
}

async function fetchLogin(email, password) {
    const login = await fetch(`${url_origin}/loginnew`, {
        method: 'POST',
        body: JSON.stringify({ email: email, password: password }),
        headers: { 'Content-Type': 'application/json', 'X-CSRF-Token': token },
    });
    const result = await login.json();
    return result;
}
