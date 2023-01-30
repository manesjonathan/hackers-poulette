<?php
require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

session_start();

if (isset($_SESSION['post_message']) && $_SESSION['post_message']) {
    echo '<script>alert("Message sent")</script>';
}
$_SESSION['post_message'] = false;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="description" content="Hackers Poulette Website">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/assets/css/output.css">
    <script defer src="public/assets/js/index.js"></script>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <title>Hackers Poulette</title>
</head>
<body class="h-screen  bg-black">
<main>
    <section class="w-full bg-black">
        <div class="relative overflow-hidden bg-no-repeat bg-cover"
             style="background-position: 50%; background-image: url('public/assets/images/background_alt_sec.avif'); height: 200px;">
        </div>
        <article class="w-1/2 text-gray-50 px-4 md:px-12 mx-auto ">

            <form class="form" id="form" name="form" method="post" action="form.php">
                <label for="firstName">
                    <input name="firstName" type="text" required
                           class="w-full px-3 py-1.5 my-2 text-gray-50 bg-gray-700 border border-solid border-gray-300 rounded transition ease-in-out focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                           placeholder="First Name">
                </label>
                <div id="firstNameError" class="error" style="display:none;">Please enter a first name</div>

                <label for="lastName">
                    <input name="lastName" type="text" required
                           class="w-full px-3 py-1.5 my-2 text-gray-50 bg-gray-700 border border-solid border-gray-300 rounded transition ease-in-out focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                           placeholder="Last Name">
                </label>
                <div id="lastNameError" class="error" style="display:none;">Please enter a last name</div>

                <label for="email">
                    <input name="email" type="email" required
                           class="w-full px-3 py-1.5 my-2 text-gray-50 bg-gray-700 border border-solid border-gray-300 rounded transition ease-in-out focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                           placeholder="Email">
                </label>
                <div id="emailError" class="error" style="display:none;">Please enter a valid email address</div>

                <label for="comment">
                <textarea name="comment" required
                          class="w-full px-3 py-1.5 my-2 text-gray-50 bg-gray-700 border border-solid border-gray-300 rounded transition ease-in-out focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                          rows="3" placeholder="Message"></textarea>
                </label>
                <div id="commentError" class="error" style="display:none;">Please enter a message</div>

                <label for="sendMail" class="inline-block text-gray-50">Send me a copy of this message
                    <input type="checkbox"
                           name="sendMail"
                           class="appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-green-500 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat mr-2 cursor-pointer"
                           checked>
                </label>
                <input id="submit-btn" type="submit"
                       class="g-recaptcha w-full py-2.5 my-4 bg-gray-700 text-gray-50 text-sm uppercase rounded shadow-md hover:bg-green-500 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-500 active:shadow-lg transition duration-150 ease-in-out"
                       data-sitekey="<?php echo $_ENV['GOOGLE_RECAPTCHA_SITE_KEY']; ?>"
                       data-callback='submitForm'
                       data-action='submit' value="Submit">
            </form>
        </article>
    </section>
</main>
<script>

    function validateForm() {
        const firstName = document.forms["form"]["firstName"].value;
        const lastName = document.forms["form"]["lastName"].value;
        const email = document.forms["form"]["email"].value;
        const comment = document.forms["form"]["comment"].value;
        const firstNameError = document.getElementById("firstNameError");
        const lastNameError = document.getElementById("lastNameError");
        const emailError = document.getElementById("emailError");
        const commentError = document.getElementById("commentError");
        let valid = true;

        if (firstName === "") {
            firstNameError.style.display = "block";
            valid = false;
        } else {
            firstNameError.style.display = "none";
        }

        if (lastName === "") {
            lastNameError.style.display = "block";
            valid = false;
        } else {
            lastNameError.style.display = "none";
        }

        if (email === "") {
            emailError.style.display = "block";
            valid = false;
        } else {
            emailError.style.display = "none";
        }

        if (comment === "") {
            commentError.style.display = "block";
            valid = false;
        } else {
            commentError.style.display = "none";
        }

        return valid;
    }

    function submitForm(token) {

        if (validateForm()) {
            console.log(token)

            const button = document.createElement('input');
            button.type = 'hidden';
            button.name = 'recaptcha_token';
            button.value = token;
            let form = document.getElementById("form");
            form.appendChild(button)
            try {
                form.submit();
                console.log("after sumbit")
            } catch (e) {
                console.log(e);
            }
        }
    }
</script>
</body>
</html>
