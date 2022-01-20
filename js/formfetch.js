const loginUser = async () => {
  const response = await fetch(document.forms.login.action, {
    method: 'post',
    body: new FormData(document.forms.login),
  });
  if (response.ok) {
    const result = await response.json();
    document.forms.login.querySelectorAll('.error').forEach(element => {
      element.textContent = '';
    });
    if (result['status'] === 'error') {
      const errors = result['error'];
      for (const [key, value] of Object.entries(errors)) {
        document.forms.login.querySelector(`[name="${key}"]`).nextElementSibling.textContent = value;
      }
    } 
    else if (result['status'] === 'success') {
      document.forms.login.reset();
      document.querySelector('#openlogin').style.display='none';
      document.querySelector('.login_success').style.display='block';
    }
  }
}

const sendNewUser = async () => {
  const response = await fetch(document.forms.signup.action, {
    method: 'post',
    body: new FormData(document.forms.signup),
  });
  if (response.ok) {
    const result = await response.json();
    document.forms.signup.querySelectorAll('.error').forEach(element => {
      element.textContent = '';
    });
    if (result['status'] === 'error') {
      const errors = result['error'];
      for (const [key, value] of Object.entries(errors)) {
        document.forms.signup.querySelector(`[name="${key}"]`).nextElementSibling.textContent = value;
      }
    } else if (result['status'] === 'success') {
      document.forms.signup.reset();
      document.querySelector('#opensignup').style.display='none';
      document.querySelector('.signup_success').style.display='block';
    }
  }
}

function closeLogin() {
  document.forms.login.querySelectorAll('.error').forEach(element => {
    element.textContent = "";
  });
  document.forms.login.reset();
  document.querySelector('#openlogin').style.display='none';
}

function closeSignup() {
  document.forms.signup.querySelectorAll('.error').forEach(element => {
    element.textContent = '';
  });
  document.forms.signup.reset();
  document.querySelector('#opensignup').style.display='none';
}