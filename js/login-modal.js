const openLogin = document.getElementById("openLogin");
const openRegister = document.getElementById("openRegister");
const closeLogin = document.getElementById("closeLogin");
const loginModal = document.getElementById("loginModal");

const pageLogin = document.getElementById("pageLogin");
const pageRegister = document.getElementById("pageRegister");

function showLoginPage() {
  loginModal.classList.add("is-open");
  pageLogin.classList.remove("hidden");
  pageRegister.classList.add("hidden");
}

function showRegisterPage() {
  loginModal.classList.add("is-open");
  pageLogin.classList.add("hidden");
  pageRegister.classList.remove("hidden");
}

if (openLogin) {
  openLogin.addEventListener("click", showLoginPage);
}

if (openRegister) {
  openRegister.addEventListener("click", showRegisterPage);
}

if (closeLogin) {
  closeLogin.addEventListener("click", function () {
    loginModal.classList.remove("is-open");
  });
}

if (loginModal) {
  loginModal.addEventListener("click", function (event) {
    if (event.target === loginModal) {
      loginModal.classList.remove("is-open");
    }
  });
}