// Toggle sidebar (DOM + event → memenuhi syarat DOM/events)
const toggleBtn = document.getElementById('toggleSidebar');
const sidebar = document.getElementById('sidebar');

if (toggleBtn && sidebar) {
    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('is-open');
    });
}

// LOGIN VALIDATION
const formLogin = document.getElementById("formLogin");

if (formLogin) {
    formLogin.addEventListener("submit", function (e) {
        const user = document.getElementById("username").value.trim();
        const pass = document.getElementById("password").value.trim();

        if (user === "" || pass === "") {
            e.preventDefault();
            alert("Username dan Password tidak boleh kosong!");
        }
    });
}
