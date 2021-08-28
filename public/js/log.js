document.getElementById('logout').addEventListener('click', () => {
    localStorage.removeItem('role');
    window.location.href = '/logout';
});
