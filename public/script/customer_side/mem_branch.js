document.addEventListener("DOMContentLoaded", () => {
    const breadcrumbDesc = document.querySelectorAll(".breadcrumb-item > h6");
    const currentStep = document.querySelector('.form-step.active');
    const step3Checkboxes = [document.querySelector("#csticker_yes"), document.querySelector("#csticker_no"), document.querySelector("#is_diplomat_yes_1"), document.querySelector("#is_diplomat_no_1")];

    const handleContent = () => {
        breadcrumbDesc.forEach((element) => {
            element.style.display = window.innerWidth >= 768 ? 'block' : 'none';
        });
    };
    handleContent();

    window.addEventListener("resize", () => {
        handleContent();
    });
});