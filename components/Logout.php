<?php

setcookie("jwtToken", "", time() - 3600, "/");

header('Location: /login.php');
