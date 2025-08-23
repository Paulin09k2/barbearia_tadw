let currentPage = "home",
  isLoggedIn = false,
  isUserLoggedIn = false,
  currentAdminSection = "appointments",
  currentUser = null;

function showPage(page) {
  document.querySelectorAll(".page").forEach((p) => p.classList.add("hidden"));
  document.getElementById(page + "Page").classList.remove("hidden");
  document.getElementById(page + "Page").classList.add("fade-in");
  currentPage = page;
  document.getElementById("mobileMenu").classList.add("hidden");
}

function toggleMobileMenu() {
  document.getElementById("mobileMenu").classList.toggle("hidden");
}
function showLoginModal() {
  document.getElementById("loginModal").classList.remove("hidden");
}
function closeLoginModal() {
  document.getElementById("loginModal").classList.add("hidden");
}
function showUserLoginModal() {
  document.getElementById("userLoginModal").classList.remove("hidden");
}
function closeUserLoginModal() {
  document.getElementById("userLoginModal").classList.add("hidden");
}
function showSuccessMessage(message) {
  document.getElementById("successMessage").textContent = message;
  document.getElementById("successModal").classList.remove("hidden");
}
function closeSuccessModal() {
  document.getElementById("successModal").classList.add("hidden");
}

function login(event) {
  event.preventDefault();
  const username = document.getElementById("username").value;
  const password = document.getElementById("password").value;
  if (username === "admin" && password === "123456") {
    isLoggedIn = true;
    closeLoginModal();
    showAdminPanel();
    showSuccessMessage("Login realizado com sucesso!");
  } else {
    alert("Usuário ou senha incorretos!");
  }
}

function logout() {
  isLoggedIn = false;
  showPage("home");
}

function showAdminPanel() {
  if (!isLoggedIn) {
    showLoginModal();
    return;
  }
  document.querySelectorAll(".page").forEach((p) => p.classList.add("hidden"));
  document.getElementById("adminPanel").classList.remove("hidden");
  document.getElementById("adminPanel").classList.add("fade-in");
}

function showAdminSection(section) {
  document
    .querySelectorAll(".admin-section")
    .forEach((s) => s.classList.add("hidden"));
  document.getElementById(section + "Section").classList.remove("hidden");
  document.querySelectorAll(".admin-tab-btn").forEach((btn) => {
    btn.classList.remove("text-navy", "border-b-2", "border-navy");
    btn.classList.add("text-gray-600");
  });
  event.target.classList.remove("text-gray-600");
  event.target.classList.add("text-navy", "border-b-2", "border-navy");
  currentAdminSection = section;
}

function submitBooking(event) {
  event.preventDefault();
  showSuccessMessage(
    "Agendamento realizado com sucesso! Entraremos em contato para confirmar."
  );
  event.target.reset();
}

function submitContact(event) {
  event.preventDefault();
  showSuccessMessage("Mensagem enviada com sucesso! Responderemos em breve.");
  event.target.reset();
}

function addAppointment() {
  alert("Funcionalidade de adicionar agendamento em desenvolvimento");
}
function editAppointment(id) {
  alert("Editando agendamento #" + id);
}
function deleteAppointment(id) {
  if (confirm("Tem certeza que deseja excluir este agendamento?"))
    alert("Agendamento #" + id + " excluído");
}
function addService() {
  alert("Funcionalidade de adicionar serviço em desenvolvimento");
}

function showLoginTab(tab) {
  if (tab === "login") {
    document.getElementById("loginForm").classList.remove("hidden");
    document.getElementById("registerForm").classList.add("hidden");
    document
      .getElementById("loginTab")
      .classList.add("text-navy", "border-b-2", "border-navy");
    document.getElementById("loginTab").classList.remove("text-gray-600");
    document
      .getElementById("registerTab")
      .classList.remove("text-navy", "border-b-2", "border-navy");
    document.getElementById("registerTab").classList.add("text-gray-600");
  } else {
    document.getElementById("registerForm").classList.remove("hidden");
    document.getElementById("loginForm").classList.add("hidden");
    document
      .getElementById("registerTab")
      .classList.add("text-navy", "border-b-2", "border-navy");
    document.getElementById("registerTab").classList.remove("text-gray-600");
    document
      .getElementById("loginTab")
      .classList.remove("text-navy", "border-b-2", "border-navy");
    document.getElementById("loginTab").classList.add("text-gray-600");
  }
}

function userLogin(event) {
  event.preventDefault();
  const email = document.getElementById("userEmail").value;
  const password = document.getElementById("userPassword").value;
  if (email === "joao@email.com" && password === "123456") {
    isUserLoggedIn = true;
    currentUser = {
      name: "João da Silva",
      email: "joao@email.com",
      initials: "JD",
      points: 850,
    };
    closeUserLoginModal();
    updateUserInterface();
    showSuccessMessage("Login realizado com sucesso!");
  } else {
    alert("Email ou senha incorretos!");
  }
}

function userRegister(event) {
  event.preventDefault();
  showSuccessMessage(
    "Cadastro realizado com sucesso! Você já pode fazer login."
  );
  showLoginTab("login");
}

function userLogout() {
  isUserLoggedIn = false;
  currentUser = null;
  updateUserInterface();
  showPage("home");
  showSuccessMessage("Logout realizado com sucesso!");
}

function updateUserInterface() {
  const userSection = document.getElementById("userSection");
  const userProfileSection = document.getElementById("userProfileSection");
  if (isUserLoggedIn && currentUser) {
    userSection.classList.add("hidden");
    userProfileSection.classList.remove("hidden");
  } else {
    userSection.classList.remove("hidden");
    userProfileSection.classList.add("hidden");
  }
}

function editProfile() {
  alert("Funcionalidade de editar perfil em desenvolvimento");
}

function redeemReward(type) {
  if (type === "discount") {
    if (currentUser && currentUser.points >= 500) {
      showSuccessMessage(
        "Desconto de 20% resgatado com sucesso! Use o código: DESC20"
      );
      currentUser.points -= 500;
    } else {
      alert("Pontos insuficientes para resgatar esta recompensa");
    }
  } else if (type === "premium") {
    if (currentUser && currentUser.points >= 750) {
      showSuccessMessage(
        "Tratamento Premium resgatado! Entre em contato para agendar."
      );
      currentUser.points -= 750;
    } else {
      alert("Pontos insuficientes para resgatar esta recompensa");
    }
  }
}

document.addEventListener("DOMContentLoaded", function () {
  const dateInput = document.querySelector('input[type="date"]');
  if (dateInput) {
    const today = new Date().toISOString().split("T")[0];
    dateInput.setAttribute("min", today);
  }
});

(function () {
  function c() {
    var b = a.contentDocument || a.contentWindow.document;
    if (b) {
      var d = b.createElement("script");
      d.innerHTML =
        "window.__CF$cv$params={r:'9735ad2e4417034b',t:'MTc1NTkwMDM3Ny4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";
      b.getElementsByTagName("head")[0].appendChild(d);
    }
  }
  if (document.body) {
    var a = document.createElement("iframe");
    a.height = 1;
    a.width = 1;
    a.style.position = "absolute";
    a.style.top = 0;
    a.style.left = 0;
    a.style.border = "none";
    a.style.visibility = "hidden";
    document.body.appendChild(a);
    if ("loading" !== document.readyState) c();
    else if (window.addEventListener)
      document.addEventListener("DOMContentLoaded", c);
    else {
      var e = document.onreadystatechange || function () {};
      document.onreadystatechange = function (b) {
        e(b);
        "loading" !== document.readyState &&
          ((document.onreadystatechange = e), c());
      };
    }
  }
})();
