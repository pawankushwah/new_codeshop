<?php
require("./partials/connection.php");
require("./partials/function.php");

// define variables and set to empty values
$username = $password = "";
$usernameErr = $passErr = "";
$response[] = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {

        if (empty($_POST["username"])) {
            $usernameErr = "username is required";
        } else {
            $username = test_input($_POST["username"]);
        }

        if (empty($_POST["password"])) {
            $passErr = "password is required";
        } else {
            $password = test_input($_POST["password"]);
        }

        $sql = "SELECT password FROM `admin_users` WHERE `username`='$username';";
        $result = mysqli_query($conn, $sql);
        // $num = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);

        if ($row['password'] == $password) {
            $_SESSION["ADMIN_LOGIN"] = 1;
            $_SESSION["ADMIN_USERNAME"] == $username;
            header("location: ./index.php");
        } else {
            $response[] = array(
                "type" => "alert-error",
                "message" => "Invalid Credentials"
            );
        }
    }
}

// redirecting the user to admin dashboard if he is logged in 
if (isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN'] == 1) {
    header("location:index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../dist/output.css">
    <script src="src/notification.js"></script>
    <title>Login | CodeShop</title>
</head>

<body>
    <!-- Notification Bar -->
    <?php include("partials/notification.php") ?>
    <!-- Notification Bar -->
    <section class="h-screen">
        <div class="container px-6 py-12 h-full">
            <div class="flex justify-center items-center flex-wrap h-full g-6 text-gray-800">
                <div class="md:w-8/12 lg:w-6/12 mb-12 md:mb-0">
                    <img src="../images/webview/login/login_side.svg" class="w-full">
                </div>
                <div class="md:w-8/12 lg:w-5/12 lg:ml-20 space-y-2">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
                        <!-- username input -->
                        <div>
                            <input type="text" name="username" class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" placeholder="Username" />

                            <div class="w-full p-2 text-red-400"><?php if (isset($usernameErr)) echo $usernameErr; ?></div>
                        </div>

                        <!-- Password input -->
                        <div>
                            <input type="password" name="password" class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" placeholder="Password" />
                            <div class="p-2 text-red-500"><?php if (isset($passErr)) echo $passErr; ?></div>
                        </div>

                        <div class="flex justify-between items-center p-2">
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" id="exampleCheck3"/>
                                <label class="form-check-label inline-block text-gray-800" for="exampleCheck2">Remember me</label>
                            </div>
                            <a href="#!" class="text-blue-600 hover:text-blue-700 focus:text-blue-700 active:text-blue-800 duration-200 transition ease-in-out">Forgot password?</a>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" name="login" class="inline-block px-7 py-3 bg-blue-600 text-white font-medium text-sm leading-snug uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out w-full" data-mdb-ripple="true" data-mdb-ripple-color="light">
                            Sign in
                        </button>

                        <div class="flex items-center my-4 before:flex-1 before:border-t before:border-gray-300 before:mt-0.5 after:flex-1 after:border-t after:border-gray-300 after:mt-0.5">
                            <p class="text-center font-semibold mx-4 mb-0">OR</p>
                        </div>

                        <a class="px-7 py-3 text-white font-medium text-sm leading-snug uppercase rounded shadow-md hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out w-full flex justify-center items-center mb-3" style="background-color: #3b5998" href="#!" role="button" data-mdb-ripple="true" data-mdb-ripple-color="light">
                            <!-- Facebook -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="w-3.5 h-3.5 mr-2">
                                <!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                <path fill="currentColor" d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z" />
                            </svg>Continue with Facebook
                        </a>
                        <a class="px-7 py-3 mb-3 text-white font-medium text-sm leading-snug uppercase rounded shadow-md hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out w-full flex justify-center items-center" style="background-color: #55acee" href="#!" role="button" data-mdb-ripple="true" data-mdb-ripple-color="light">
                            <!-- Twitter -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512" class="w-3.5 h-3.5 mr-2"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                <path d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z" />
                            </svg>Continue with Google
                        </a>
                        <a class="px-7 py-3 text-white font-medium text-sm leading-snug uppercase rounded shadow-md hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out w-full flex justify-center items-center" style="background-color: #55acee" href="#!" role="button" data-mdb-ripple="true" data-mdb-ripple-color="light">
                            <!-- Twitter -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-3.5 h-3.5 mr-2">
                                <!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                <path fill="currentColor" d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z" />
                            </svg>Continue with Twitter
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>