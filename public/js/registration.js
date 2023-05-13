const submitForm = () => {
  let payload = {
      first_name: document.getElementById("rFirstName").value,
      last_name: document.getElementById("rLastName").value,
      email: document.getElementById("rEmail").value,
      password: document.getElementById("rPassword").value,
      password_confirmation: document.getElementById("rPasswordConfirmation").value,
      role: "teacher"
  }

  const token = document.head.querySelector('meta[name="csrf-token"]');
  fetch('http://localhost:80/api/en/registration', {
    method: "POST",
    body: JSON.stringify(payload),
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      'X-CSRF-TOKEN': token.content
    }
  }).then(response => {
    return response.json()
  }).then(result => {
    console.log(result.data)
  }).catch((error) => {
    console.log(error);
  })
}