const errorDiv = document.getElementById('error');
const successDiv = document.getElementById('success');

document.userForm.onsubmit = async function (event) {
  event.preventDefault(event);
  const form = event.target;

  const formData = {}

  for (let element of form.elements) {
    if(element.name && element.value !== undefined) {
      formData[element.name] = element.value
    }
  }

  const options = {
    method: 'POST',
    redirect: 'follow',
    body: JSON.stringify({
      name: formData.name,
      email: formData.email,
      password: formData.password
    })
  };

  const password = formData.password
  const confirmPassword = formData.confirmPassword

  if(password === confirmPassword) {
    const response = await fetch(form.action, options)
    const json = await response.json()
  
    if(response.status == 201) {
      successDiv.innerHTML = `${json.message} Redirecting...`;
      successDiv.style.display = 'block';
      errorDiv.style.display = 'none';
  
      setTimeout(() => {
        
        window.location.href = response.headers.get('Location')
      }, 2000);
    } else {
      errorDiv.innerHTML = json.message;
      errorDiv.style.display = 'block';
    }
  } else {
    errorDiv.innerHTML = "Passwords must be a match.";
    errorDiv.style.display = 'block';
  }



}

