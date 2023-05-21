const userBoxes = document.querySelectorAll('.user-box-popup')

userBoxes.forEach((element) => {
  const id = element.querySelector('.uid')
  const uid = id.getAttribute('value')
  const csrf = element.querySelector('.csrf').value

  const select = element.querySelector('.user-type-select');
  select.addEventListener('change', async function(e) {
    const level = e.target.value;
    const response = await fetch('../api/api_users.php?uid=' + uid + '&level=' + encodeURIComponent(level) + '&csrf=' + csrf);
    const content = await response.json();

    if (content.success === "0") {
      element.style.borderColor = "red";
    } else {
      if (level === "0") {
        element.style.borderColor = "green";
      }
      if (level === "1") {
        element.style.borderColor = "orange";
      }
      if (level === "2") {
        element.style.borderColor = "red";
      }
    }
  });
});

