document.addEventListener("DOMContentLoaded", function () {
  const openLogin = document.getElementById("openLogin");
  const closeLogin = document.getElementById("closeLogin");
  const loginModal = document.getElementById("loginModal");

  if (!openLogin || !closeLogin || !loginModal) {
    return;
  }

  openLogin.addEventListener("click", function () {
    loginModal.classList.add("is-open");
  });

  closeLogin.addEventListener("click", function () {
    loginModal.classList.remove("is-open");
  });

  loginModal.addEventListener("click", function (event) {
    if (event.target === loginModal) {
      loginModal.classList.remove("is-open");
    }
  });
});