document.addEventListener('DOMContentLoaded', function() {
  const loginForm = document.getElementById('loginForm');
  const registerForm = document.getElementById('registerForm');
  const showLoginLink = document.getElementById('showLoginLink');
  const showRegisterLink = document.getElementById('showRegisterLink');
  const modalTitle = document.getElementById('authModalLabel');

  function getUrlParam(parameter, defaultvalue){
    var urlparameter = defaultvalue;
    if(window.location.href.indexOf(parameter) > -1){
        urlparameter = getUrlVars()[parameter];
    }
    return urlparameter;
}

  function showLogin() {
      if (loginForm) loginForm.style.display = 'block';
      if (registerForm) registerForm.style.display = 'none';
      if (modalTitle) modalTitle.innerText = 'Вход в аккаунт';
  }

  function showRegister() {
      if (loginForm) loginForm.style.display = 'none';
      if (registerForm) registerForm.style.display = 'block';
      if (modalTitle) modalTitle.innerText = 'Регистрация';
  }

  if (showLoginLink) {
      showLoginLink.addEventListener('click', function(e) {
          e.preventDefault();
          showLogin();
      });
  }
  if (showRegisterLink) {
      showRegisterLink.addEventListener('click', function(e) {
          e.preventDefault();
          showRegister();
      });
  }
});