let sidebar = document.querySelector(".sidebar");
let sidebarToggle = document.querySelector(".sidebar-toggle");
sidebarToggle.addEventListener("click", function () {
    if (sidebar.classList.contains("notext")) {
        sidebarToggle.innerHTML = '<i class="fa-solid fa-angle-right"></i>';
    } else {
        sidebarToggle.innerHTML = '<i class="fa-solid fa-angle-left"></i>';
    }
    sidebar.classList.toggle("notext");
});
