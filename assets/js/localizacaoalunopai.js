
// Função para alternar a visibilidade do menu suspenso
function toggleDropdown() {
    var dropdown = document.getElementById("userDropdown");
    dropdown.classList.toggle("show");
}

    var map = L.map('mapid').setView([51.505, -0.09], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

// Função para abrir o modal
function openModal() {
    var modal = document.getElementById("modal");
    modal.style.display = "block";
}

// Função para fechar o modal
function closeModal() {
    var modal = document.getElementById("modal");
    modal.style.display = "none";
}

// Adicionando um ouvinte de evento ao botão de denúncia para abrir o modal
document.querySelector('.denuncia').addEventListener('click', function() {
    openModal();
});
