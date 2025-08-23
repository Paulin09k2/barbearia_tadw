function showPage(page) {
    document.querySelectorAll('.page').forEach(p => p.classList.add('hidden'));
    document.getElementById(page + 'Page').classList.remove('hidden');
}

function showUserLoginModal() {
    document.getElementById('userLoginModal').classList.remove('hidden');
    showLoginTab('login');
}
function closeUserLoginModal() {
    document.getElementById('userLoginModal').classList.add('hidden');
}
function showLoginTab(tab) {
    document.getElementById('loginForm').classList.toggle('hidden', tab !== 'login');
    document.getElementById('registerForm').classList.toggle('hidden', tab !== 'register');
    document.getElementById('loginTab').classList.toggle('border-navy', tab === 'login');
    document.getElementById('registerTab').classList.toggle('border-navy', tab === 'register');
}

function userLogin(event) {
    event.preventDefault();
    const email = document.getElementById('userEmail').value;
    const senha = document.getElementById('userPassword').value;

    fetch('login_cliente.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `email=${encodeURIComponent(email)}&senha=${encodeURIComponent(senha)}`
    })
    .then(res => res.json())
    .then(data => {
        showSuccess(data.mensagem);
        if (data.success) closeUserLoginModal();
    });
}

function userRegister(event) {
    event.preventDefault();
    const form = event.target;
    const nome = form.querySelector('input[placeholder="Digite seu nome completo"]').value;
    const email = form.querySelector('input[placeholder="Digite seu email"]').value;
    const telefone = form.querySelector('input[placeholder="Digite seu telefone"]').value;
    const senha = form.querySelector('input[placeholder="Digite sua senha"]').value;

    fetch('cadastrar_cliente.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `nome=${encodeURIComponent(nome)}&email=${encodeURIComponent(email)}&telefone=${encodeURIComponent(telefone)}&senha=${encodeURIComponent(senha)}`
    })
    .then(res => res.json())
    .then(data => {
        showSuccess(data.mensagem);
        if (data.success) {
            showLoginTab('login');
        }
    });
}

function showSuccess(msg) {
    document.getElementById('successMessage').innerText = msg;
    document.getElementById('successModal').classList.remove('hidden');
}
function closeSuccessModal() {
    document.getElementById('successModal').classList.add('hidden');
}
