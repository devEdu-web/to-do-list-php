<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="./public/css/auth.css" rel="stylesheet">
    <title>Register</title>
</head>

<body class="d-flex flex-column justify-content-center align-items-center">

    <div class="alert alert-danger" role="alert" id="error">
        A simple danger alert—check it out!
    </div>

    <div class="alert alert-success" role="alert" id="success">
        A simple danger alert—check it out!
    </div>

    <main class="p-4 d-flex flex-column align-items-center">

        <h2 class="mb-5">Register</h2>

        <form name="userForm" method="POST" action="./components/Register.php" class="form d-flex flex-column align-items-center gap-3">

            <div class="form-group d-flex flex-column">
                <label>Name</label>
                <input type="text" name="name" id="name">
            </div>

            <div class="form-group d-flex flex-column">
                <label>Email</label>
                <input type="text" name="email" id="email">
            </div>

            <div class="form-group d-flex flex-column">
                <label>Password</label>
                <input type="password" name="password" id="password">
            </div>

            <div class="form-group d-flex flex-column mb-3">
                <label>Confirm Password</label>
                <input type="password" name="confirmPassword" id="confirmPassword">
            </div>

            <input type="submit" value="Register">

            <span>Already have an account? <a href="/login.php">Login</a></span>

        </form>


    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
     <script src="./public/js/register.js"></script>
</body>

</html>