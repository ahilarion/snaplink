document.addEventListener('DOMContentLoaded', function () {
    const CHECKBOX = document.querySelector(".slide");
    const SHORTER_LINK_FORM = document.querySelector(".shorter-link-form");
    const FILE_LINK_FORM = document.querySelector(".file-link-form");

    console.log(CHECKBOX);

    CHECKBOX.addEventListener("click", () => {
        SHORTER_LINK_FORM.classList.toggle("show");
        FILE_LINK_FORM.classList.toggle("show");
    });

    document.getElementById('fileInput').addEventListener('change', updateFileName);

    function updateFileName() {
        let fileInput = document.getElementById('fileInput');
        let fileName = document.getElementById('fileName');

        fileName.textContent = fileInput.files[0] ? fileInput.files[0].name : 'Aucun fichier sélectionné';
    }
});