document.addEventListener('DOMContentLoaded', function () {
  const loginButton = document.querySelector('.login .login-btn button');
  const linkButton = document.querySelector('.login .link-btn button');

  loginButton.addEventListener('mouseenter', function () {
    loginButton.style.backgroundColor = '#AD6A6C';
    loginButton.style.borderColor = '#AD6A6C';
    loginButton.style.color = '#fff';
    linkButton.style.backgroundColor = '#5D2E46';
    linkButton.style.borderColor = '#AD6A6C';
    linkButton.style.color = '#E8D6CB';
  });

  loginButton.addEventListener('mouseleave', function () {
    loginButton.style.backgroundColor = '#5D2E46';
    loginButton.style.borderColor = '#AD6A6C';
    loginButton.style.color = '#E8D6CB';
    linkButton.style.backgroundColor = '#AD6A6C';
    linkButton.style.borderColor = '#AD6A6C';
    linkButton.style.color = '#E8D6CB';
  });

  linkButton.addEventListener('mouseenter', function () {
    loginButton.style.backgroundColor = '#AD6A6C';
    loginButton.style.borderColor = '#AD6A6C';
    loginButton.style.color = '#E8D6CB';
    linkButton.style.backgroundColor = '#5D2E46';
    linkButton.style.borderColor = '#AD6A6C';
    linkButton.style.color = '#fff';
  });

  linkButton.addEventListener('mouseleave', function () {
    loginButton.style.backgroundColor = '#5D2E46';
    loginButton.style.borderColor = '#AD6A6C';
    loginButton.style.color = '#E8D6CB';
    linkButton.style.backgroundColor = '#AD6A6C';
    linkButton.style.borderColor = '#AD6A6C';
    linkButton.style.color = '#E8D6CB';
  });
});