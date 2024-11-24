<?php

require(__DIR__ . '/components/User.php');
require(__DIR__ . '/components/Auth.php');
require(__DIR__ . '/config/database.php');

if (isset($_COOKIE['jwtToken'])) {

    $jwt = $_COOKIE['jwtToken'];
    $isTokenValid = verifyJwt($jwt);

    if(!$isTokenValid) {
        http_response_code(403);
        header('Location: /login.php');
    }
} else {
    header('Location: /login.php');
}

$userId = $_COOKIE['userId'];
$tasks = [];
$userName = null;

$stmt = $pdo->prepare('SELECT * FROM tasks WHERE user_id = :id and completed = false');
$stmt->bindValue(':id', $userId);
$stmt->execute();

if($stmt->rowCount() > 0) {
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$stmt = $pdo->prepare('SELECT * FROM users WHERE id = :id');
$stmt->bindValue(':id', $userId);
$stmt->execute();

if($stmt->rowCount() > 0) {
    $user = $stmt->fetchAll(PDO::FETCH_ASSOC)[0]['name'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4a667f2131.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="./public/css/style.css" rel="stylesheet">
    <title>Tasks</title>
</head>
<body>

    <ul class="nav nav-pills mb-3">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Tasks</a>
        </li>

        <li hrtime class="nav-item">
            <a href="/completed.php" class="nav-link" aria-disabled="true">Completed</a>
        </li>
    </ul>


    
    <div class="alert alert-danger" role="alert" id="error">
        A simple danger alert—check it out!
    </div>
    <main>

        <div class="mb-5">

            <form name="userForm" action="/components/CreateTask.php" method="post" class="form">
                <input type="text" name="task" id="task" placeholder="Add a new task">
                <select name="priority" class="form-select">
                    <option>Priority</option>
                    <option selected value="low">Low</option>
                    <option value="normal">Normal</option>
                    <option value="important">Important</option>
                    <option value="critical">Critical</option>
                </select>
                <input type="submit" value="Add Task">
            </form>

        </div>

        <div class="d-flex flex-column gap-2">

            <?php foreach($tasks as $task) : ?>

                <div class="card p-2 task">
                <form action="/components/Update.php" class="to-do-form edit-task hidden" method="POST">
                    <input type="hidden" name="id" value="<?= $task['id'] ?>">
                    <input value="<?= $task['title']?>" type="text" name="title" id="" placeholder="Edit your task here">
                    <select name="priority" class="form-select">
                        <option>Priority</option>
                        <option selected value="low">Low</option>
                        <option value="normal">Normal</option>
                        <option value="important">Important</option>
                        <option value="critical">Critical</option>
                    </select>
                    <button type="submit" class="form-button confirm-button">
                    
                        <i class="fa-solid fa-check"></i>
                    </button>
                </form>
                    <div class="description">
                        <h1 class="fs-3"><?= $task['title']?></h1>
                        <p>Priority: <?= $task['priority']?></p>
                    </div>

                    <div class="actions d-flex gap-2">
                        <a href="/components/CompleteTask.php?id=<?= $task['id'] ?>">
                            <i class="fa-solid fa-check"></i>
                        </a>

                        <a class="action-button edit-button">
                                <i class="fa-regular fa-pen-to-square"></i>
                        </a>


                        <a href="/components/DeleteTask.php?id=<?= $task['id'] ?>">
                            <i class="fa-solid fa-trash delete-button"></i>
                        </a>

                    </div>

                </div>
            <?php endforeach ?>

        </div>

        <div class="user">
            <span>Welcome, <?= $user ?></span>
            <a href="/components/Logout.php" class="logout">Logout</a>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="/public/js/update.js"></script>
</body>
</html>