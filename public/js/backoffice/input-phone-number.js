document.getElementById("phoneNumber").addEventListener("input", function (e) {
    this.value = this.value.replace(/[^0-9]/g, "");
});

function previewPhoto(event) {
    const file = event.target.files[0];
    const preview = document.getElementById("photoPreview");

    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result; // Set the image source to the file's data URL
        };
        reader.readAsDataURL(file); // Read the file as a data URL
    }
}
