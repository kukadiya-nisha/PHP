$(document).ready(function () {
    // Function to validate a field
    function validateField(input) {
        let field = $(input);
        let value = field.val().trim();
        let errorSpan = $("#" + field.attr("name") + "Error");
        let fieldType = field.data("validation") || ""; // Get validation type
        let minLength = field.data("min") || 0;
        let maxLength = field.data("max") || 9999;

        let errorMessage = "";

        // Required field validation
        if (fieldType.includes("required") && value === "") {
            errorMessage = "This field is required.";
        }
        // Email validation
        else if (fieldType.includes("email") && !/^\S+@\S+\.\S+$/.test(value)) {
            errorMessage = "Enter a valid email.";
        }
        // Alphabetical validation
        else if (fieldType.includes("alpha") && !/^[A-Za-z\s]+$/.test(value)) {
            errorMessage = "Only letters are allowed.";
        }
        // Numeric validation
        else if (fieldType.includes("numeric") && !/^\d+$/.test(value)) {
            errorMessage = "Only numbers are allowed.";
        }
        // Min length validation
        else if (fieldType.includes("min") && value.length < minLength) {
            errorMessage = `Must be at least ${minLength} characters.`;
        }
        // Max length validation
        else if (fieldType.includes("max") && value.length > maxLength) {
            errorMessage = `Must be less than ${maxLength} characters.`;
        }
         // File upload validation
        else if (fieldType.includes("file") && !/\.(jpg|jpeg|png)$/i.test(value)) {
            errorMessage = "Only JPG, JPEG, or PNG files are allowed.";
        }
        else if (fieldType.includes("file") && field[0].files[0].size > 200000) {
            errorMessage = "File size must be less than 200KB.";
        }

        // Show or clear error message
        if (errorMessage) {
            errorSpan.text(errorMessage).show();
            field.addClass("is-invalid");
            field.removeClass("is-valid"); // Add red border
        } else {
            errorSpan.text("").hide();
            field.removeClass("invalid");
            field.addClass("is-valid"); // Remove red border
        }
    }

    // Attach validation event to all inputs with `oninput`
    $("input, textarea").on("input", function () {
        validateField(this);
    });

    // Validate form on submit
    $("form").on("submit", function (e) {
        let isValid = true;

        $(this).find("input, textarea").each(function () {
            validateField(this);
            if ($(this).next(".error").text() !== "") {
                isValid = false;
            }
        });

        if (!isValid) {
            e.preventDefault(); // Prevent submission if validation fails
        }
    });
});
