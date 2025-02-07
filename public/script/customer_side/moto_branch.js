document.addEventListener("DOMContentLoaded", () => {
    const idDropdown = document.querySelector("#valid_id_dropdown");
    const idContainer = document.querySelector("#valid_id_container");
    const idDropdownBtn = document.querySelector("#id_dropdown_btn");
    const breadcrumbDesc = document.querySelectorAll(".breadcrumb-item > h6");
    const bcResizeTrigger = {
        "5-items": 992,
        "4-items": 768,
        "3-items": 576
    };

    const handleContent = () => {
        breadcrumbDesc.forEach((element) => {
            element.style.display = window.innerWidth >= bcResizeTrigger[`${breadcrumbDesc.length}-items`] ? 'block' : 'none';
        });
    };
    handleContent();

    window.addEventListener("resize", () => {
        handleContent();
    });

    idDropdownBtn.addEventListener("click", () => {
        idDropdown.classList.remove("animated-moveUpExit");
        idDropdown.classList.remove("animated-moveDown");

        if (idContainer.classList.contains("hide")) {
            idContainer.classList.add("animated-moveDown");
            idContainer.classList.remove("animated-moveUpExit");
            idDropdownBtn.querySelector("i").classList.add("rotate180");
            idContainer.classList.remove("hide");
        }
        else {
            idContainer.classList.add("animated-moveUpExit");
            idContainer.classList.remove("animated-moveDown");
            idDropdownBtn.querySelector("i").classList.remove("rotate180");

            setTimeout(() => {
                idContainer.classList.add("hide");
            }, 250);
        }
    });
});