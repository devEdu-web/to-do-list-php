<?php

require(__DIR__ . '/components/User.php');
require(__DIR__ . '/components/Auth.php');

if (isset($_COOKIE['jwtToken'])) {
    $jwt = $_COOKIE['jwtToken'];
    $isTokenValid = verifyJwt($jwt);

    if($isTokenValid) {
        http_response_code(403);
        header('Location: /index.php');
    }
} 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="./public/css/auth.css" rel="stylesheet">
    <title>Login</title>
</head>

<body class="d-flex flex-column justify-content-center align-items-center">


    <div class="alert alert-danger" role="alert" id="error">
        A simple danger alert—check it out!
    </div>
    <main class="p-4 d-flex flex-column align-items-center">

        <h2 class="mb-3">Login</h2>

        <form name="userForm" method="POST" action="/components/Login.php" class="form d-flex flex-column align-items-center gap-3">

            <div class="form-group d-flex flex-column">
                <label>Email</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div class="form-group d-flex flex-column mb-3">
                <label>Password</label>
                <input type="password" name="password" id="password" required>
            </div>

            <input type="submit" value="Login">

            <span>Doesn't have an account? <a href="/register.php">Register</a></span>
        </form>


    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <script src="./public/js/login.js"></script>
</body>

</html>