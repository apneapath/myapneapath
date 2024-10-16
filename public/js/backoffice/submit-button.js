// Get all input fields in the form
const inputs = document.querySelectorAll("input, textarea, select");
const updateButton = document.getElementById("updateButton");
const originalValues = Array.from(inputs).map((input) => input.value);

// Function to check for changes
function checkForChanges() {
    const currentValues = Array.from(inputs).map((input) => input.value);
    const hasChanges = originalValues.some(
        (value, index) => value !== currentValues[index]
    );
    updateButton.disabled = !hasChanges;
}

// Add event listeners to all inputs
inputs.forEach((input) => {
    input.addEventListener("input", checkForChanges);
    input.addEventListener("change", checkForChanges);
});
