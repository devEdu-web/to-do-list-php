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
      email: formData.email,
      password: formData.password
    })
  };

  const response = await fetch(form.action, options)
  
  if(response.status == 302) {
    window.location.href = '/index.php'
  } else {
    const json = await response.json()
    errorDiv.innerHTML = json.message;
    errorDiv.style.display = 'block';
  }

}