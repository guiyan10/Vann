'use strict';


/**
 * toggle active class on header
 * when clicked nav-toggle-btn
 */

const header = document.querySelector("[data-header]");
const navToggleBtn = document.querySelector("[data-menu-toggle-btn]");

navToggleBtn.addEventListener("click", function () {
  header.classList.toggle("active");
});



/**
 * toggle ctx-menu when click on card-menu-btn
 */

const menuBtn = document.querySelectorAll("[data-menu-btn]");

for (let i = 0; i < menuBtn.length; i++) {
  menuBtn[i].addEventListener("click", function () {
    this.nextElementSibling.classList.toggle("active");
  });
}



/**
 * load more btn loading spin toggle
 */

const loadMoreBtn = document.querySelector("[data-load-more]");

loadMoreBtn.addEventListener("click", function () {
  this.classList.toggle("active");
});

  document.getElementById('open-modal-button').addEventListener('click', () => {
      document.getElementById('settings-modal').style.display = 'block';
  });

  document.querySelector('.close-button').addEventListener('click', () => {
      document.getElementById('settings-modal').style.display = 'none';
  });

  window.addEventListener('click', (event) => {
      if (event.target == document.getElementById('settings-modal')) {
          document.getElementById('settings-modal').style.display = 'none';
      }
  });

  document.getElementById('settings-form').addEventListener('submit', (event) => {
      event.preventDefault();
      const theme = document.getElementById('theme').value;
      const language = document.getElementById('language').value;
      alert(`Tema: ${theme}\nIdioma: ${language}`);
      document.getElementById('settings-modal').style.display = 'none';
  });

  document.getElementById('delete-account-button').addEventListener('click', () => {
      const confirmDelete = confirm('Tem certeza que deseja excluir sua conta? Esta ação não pode ser desfeita.');
      if (confirmDelete) {
          alert('Conta excluída.');
          // Aqui você pode adicionar a lógica para realmente excluir a conta.
          document.getElementById('settings-modal').style.display = 'none';
      }
  });
