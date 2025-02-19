<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form with Custom Error Message Display</title>

    <!-- Include jQuery -->
    <script src="./jquery/jquery-3.7.1.min.js"></script>
    <script src="./jquery/jquery.validate.js"></script>
    <script src="./jquery/additional-methods.min.js"></script>
    <!-- Include jQuery Validation Plugin -->
    

    <script>
        $.validator.addMethod('filesize', function(value, element, param) {
        if (element.files.length === 0) {
            return true; // Skip validation if no file
        }
        return element.files[0].size <= param;
    }, 'File size must be less than {0} bytes');

        $(document).ready(function () {
            // Initialize the form validation
            $("#myForm").validate({
                rules: {
                    username: {
                        required: true,
                        minlength: 5
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    number: {
                        required: true,
                        number: true,
                        minlength: 10,
                        maxlength: 10
                    },
                    password: {
                        required: true,
                        pattern: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/
                    },
                    semester: {
                        required: true
                    },
                    division: {
                        required: true
                    },
                    subjects: {
                        required: true
                        
                    },
                    files:{
                        required:true,
                        // accept: "application/pdf",
                        extension: "pdf",
                        // max file size is 250kb
                    filesize: 250000
                    }
                },
                messages: {
                    username: {
                        required: "Please enter your username",
                        minlength: "Username must be at least 5 characters"
                    },
                    email: {
                        required: "Please enter your email",
                        email: "please enter valide email address"
                    },
                    number: {
                        required: "Please enter a number",
                        number: "Please enter a valid number",
                        minlength: "Number must be exactly 10 digits",
                        maxlength: "Number must be exactly 10 digits"
                    },
                    password: {
                        required: "Please enter a password",
                        pattern: "Password must be at least 8 characters long and contain at least one lowercase letter, one uppercase letter, one digit, and one special character (@$!%*?&)."
                    },
                    semester: {
                        required: "Please select your semester"
                    },
                    division: {
                        required: "Please select your division"
                    },
                    subjects: {
                        required: "Please select your subjects"
                    },
                    files:{
                        required: "Please select your files",
                        // accept: "Please select only pdf files",
                        extension: "Please select only pdf files",
                        filesize: "File size should not be more than 5MB"
                    }
                },
                errorPlacement: function (error, element) {
                    // Custom error message placement
                    var errorElement = $('#' + element.attr('id') +
                        '-error'); // Find the corresponding error div by id
                    errorElement.html(error.text()); // Set the error text in the div
                    errorElement.show(); // Show the error div
                },
                success: function (label, element) {
                    // Hide the error message when input is valid
                    var errorElement = $('#' + $(element).attr('id') + '-error');
                    errorElement.hide();
                }
            });
        });
    </script>
</head>

<body>

    <h2>User Registration</h2>
    <form id="myForm" action="" method="post" enctype="multipart/form-data">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="Enter your username"><br><br>
        <div id="username-error" style="display:none;"></div><br>

        <label for="email">email:</label>
        <input type="text" id="email" name="email" placeholder="Enter your email"><br><br>
        <div id="email-error" style="display:none;"></div><br>

        <label for="number">number:</label>
        <input type="text" id="number" name="number" placeholder="Enter your number"><br><br>
        <div id="number-error" style="display:none;"></div><br>

        <label for="password">password:</label>
        <input type="text" id="password" name="password" placeholder="Enter your password"><br><br>
        <div id="password-error" style="display:none;"></div><br>

        <label for="semester">semester:</label><br>
        <input type="radio" name="semester" id="semester" value="1">1<br>
        <input type="radio" name="semester" id="semester" value="2">2<br>
        <input type="radio" name="semester" id="semester" value="3">3<br>
        <input type="radio" name="semester" id="semester" value="4">4<br>
        <input type="radio" name="semester" id="semester" value="5">5<br>
        <input type="radio" name="semester" id="semester" value="6">6<br><br>
        <div id="semester-error" style="display:none;"></div><br>

        <label for="division">division:</label><br>
        <select name="division" id="division">
            <option value=""></option>
            <option value="a">A</option>
            <option value="b">B</option>
            <option value="c">C</option>
            <option value="d">D</option>
        </select><br><br>
        <div id="division-error" style="display:none;"></div><br>

        <label for="subjects">subjects:</label><br>
        <input type="checkbox" name="subjects" id="subjects" value="Python">Python<br>
        <input type="checkbox" name="subjects" id="subjects" value="PHP">PHP<br>
        <input type="checkbox" name="subjects" id="subjects" value="IOT">IOT<br>
        <input type="checkbox" name="subjects" id="subjects" value="MAD">MAD<br>
        <input type="checkbox" name="subjects" id="subjects" value="SAD">SAD<br>
        <input type="checkbox" name="subjects" id="subjects" value="WDT-1">WDT-1<br>
        <input type="checkbox" name="subjects" id="subjects" value="ESL-2">ESL-2<br>
        <input type="checkbox" name="subjects" id="subjects" value="AS">AS<br>
        <input type="checkbox" name="subjects" id="subjects" value="PC">PC<br>
        <input type="checkbox" name="subjects" id="subjects" value="DE">DE<br>
        <div id="subjects-error" style="display:none;"></div><br>

        <label for="files">files:</label><br>
        <input type="file" id="files" name="files" multiple><br><br>
        <!-- Custom error message div for files-->
         <div id="files-error" style="display:none;"></div><br>

        <input type="submit" value="Submit">
    </form>

</body>

</html>