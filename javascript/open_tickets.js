const ticketFilterSelect = document.querySelector('.ticket-filter');
ticketFilterSelect.addEventListener('change', () => {
  ticketFilterSelect.form.submit();
});

const logoutBox1 = document.querySelector('.logout-box');

logoutBox1.addEventListener('click', (event) => {
  logoutBox.style.animation = 'slideOutLoginToLogout 2s ease-in-out';
  
  setTimeout(() => {
    window.location.href = 'page.php';
  }, 500)
});

const tickets = document.querySelectorAll('.ticket-display');

tickets.forEach((ticket) => {
  const filtersToggle = ticket.querySelector('.filters-toggle');
  const filtersContainer = ticket.querySelector('.filters-container');

  filtersToggle.addEventListener('click', () => {
    if (filtersContainer.style.display === 'none') {
      filtersContainer.style.display = 'grid';
    } else {
      filtersContainer.style.display = 'none';
    }
  });
});



