document.addEventListener("DOMContentLoaded", () => {
    const breadcrumbDesc = document.querySelectorAll(".breadcrumb-item > h6");
    const bcResizeTrigger = {
        "5-items": 992,
        "4-items": 768,
        "3-items": 576
    };
    const radioboxes = [document.querySelector("#dlcode-label"), document.querySelector("#restriction-label")];
    const codeCboxes = [...document.querySelectorAll("#dlcodes .checkbox-container > .custom-card"), ...document.querySelectorAll("#restrictions .restriction-checkboxes > .custom-control")];
    const uiSelects = document.querySelectorAll(".ui-widget.ui-widget-content");
    const formContainer = document.querySelector("#formContainer");
    const idDropdown = document.querySelector("#valid_id_dropdown");
    const idContainer = document.querySelector("#valid_id_container");
    const idDropdownBtn = document.querySelector("#id_dropdown_btn");
    const jpContainer = document.querySelector(".japan-container");

    const handleContent = () => {
        breadcrumbDesc.forEach((element) => {
            element.style.display = window.innerWidth >= bcResizeTrigger[`${breadcrumbDesc.length}-items`] ? 'block' : 'none';
        });
        // jpContainer.style.height = `${formContainer.clientHeight - document.querySelector(`#step2 .step-title-container`).clientHeight - 10}px`;

    };
    handleContent();

    window.addEventListener("resize", () => {
        handleContent();

        let currentStepNumber = parseInt(document.querySelector("div.form-step.active").id.replace('step', ''));
        const progressCarIndicator = document.querySelector('.progress-car-indicator');
        console.log(currentStepNumber);

        if (window.innerWidth <= 991) {
            // progressCarIndicator.style.minWidth = `calc(${(currentStepNumber - 1) * 25}% + 38px)`;
            progressCarIndicator.style.width = `calc(${(currentStepNumber - 1) * 25}% + ${7 - currentStepNumber}%)`;
            switch(currentStepNumber) {
                case 2:
                    progressCarIndicator.style.minWidth = `calc(25% + 38px)`;
                    break;
                case 3:
                    progressCarIndicator.style.minWidth = `calc(50% + 30px)`;
                    break;
                case 4:
                    progressCarIndicator.style.minWidth = `calc(75% + 22px)`;
                    break;
                case 5:
                    progressCarIndicator.style.minWidth = `calc(100% + 12px)`;
                    break;
                default:
                    progressCarIndicator.style.minWidth = `52px`;
                    break;
            }
          }
          else if (window.innerWidth < 1400) {
            progressCarIndicator.style.minWidth = `unset`;
            switch(currentStepNumber) {
              case 1:
                progressCarIndicator.style.width = `52px`;
                break;
              case 2:
                progressCarIndicator.style.width = `calc(25% + 32px)`;
                break;
              case 3:
                progressCarIndicator.style.width = `calc(50% + 32px)`;
                break;
              case 4:
                progressCarIndicator.style.width = `calc(75% + 10px)`;
                break;
              case 5:
                progressCarIndicator.style.width = `99%`;
                break;
              default:
                progressCarIndicator.style.width = `52px`;
                break;
            }
          }
          else if (window.innerWidth >= 1400) {
            progressCarIndicator.style.minWidth = `unset`;
            switch(currentStepNumber) {
              case 1:
                progressCarIndicator.style.width = `52px`;
                break;
              case 2:
                progressCarIndicator.style.width = `calc(25% + 32px)`;
                break;
              case 3:
                progressCarIndicator.style.width = `calc(50% + 32px)`;
                break;
              case 4:
                progressCarIndicator.style.width = `calc(75% + 14px)`;
                break;
              case 5:
                progressCarIndicator.style.width = `100%`;
                break;
              default:
                progressCarIndicator.style.width = `52px`;
                break;
            }
          }
    });

    radioboxes.forEach((element1, parentIndex) => {
        element1.querySelector(`input`).addEventListener("click", () => {
            if (element1.querySelector(`input[type="radio"]`).checked) {
                element1.classList.remove("hover-g-300", "cursor-pointer");

                radioboxes.forEach((element2, childIndex) => {
                    if (parentIndex !== childIndex) {
                        element2.classList.add("hover-g-300", "cursor-pointer");
                        element1.querySelectorAll(`input[type="checkbox"]`).forEach(field => {
                            field.dispatchEvent(new Event('change'));
                        });
                    }
                });

                setTimeout(() => {
                    const stepTitleContainer = document.querySelector("#step1 .step-title-container");
                    formContainer.scrollTo({top: element1.offsetTop - stepTitleContainer.clientHeight - 50, behavior: 'smooth'});
                }, 100);
            }
        });
    });

    codeCboxes.forEach(element => {
        let elementCbox = element.querySelector(`input[type="checkbox"]`);
        elementCbox.addEventListener("change", () => {
            if (elementCbox.checked) {
                element.classList.add("bg-g-300");
            }
            else {
                element.classList.remove("bg-g-300");
            }
        });
    });

    uiSelects.forEach(element => {
        if (element.style.display !== 'none') {
            formContainer.style.overflowY = "hidden";
        }
        else {
            formContainer.style.overflowY = "auto";
        }
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