var menu_btn = document.querySelector("#menu-btn");
var sidebar = document.querySelector("#sidebar");
var container = document.querySelector(".my-container");
if (menu_btn && sidebar && container) {
    menu_btn.addEventListener("click", () => {
        sidebar.classList.toggle("active-nav");
        container.classList.toggle("active-cont");
    });
}

function showSuccessCheck() {
    Swal.fire({
        icon: "success",
        title: "",
        text: "",
        showConfirmButton: false,
        timer: 1200,
        customClass: {
            popup: "success-check-only",
        },
    });
}

// custom modal ---------------------------------------------

// end custom modal ---------------------------------------------
