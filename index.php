<?php

$myDb = 'mysql:dbname=task_list;host=localhost';
$user = 'root';
$pwd = '';

$db = new PDO($myDb, $user, $pwd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>To do list</title>
</head>

<body>
    <div id="main-content" class="container px-4 py-5">
        <h1>To do list</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </p>
        <!--Nav start-->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="to-do-tab" data-bs-toggle="tab" data-bs-target="#to-do" type="button" role="tab" aria-controls="to-do" aria-selected="true">En attente</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="done-tab" data-bs-toggle="tab" data-bs-target="#done" type="button" role="tab" aria-controls="done" aria-selected="false">Terminé</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="add-tab" data-bs-toggle="tab" data-bs-target="#add" type="button" role="tab" aria-controls="add" aria-selected="false">Nouvelle tâche</button>
            </li>
        </ul>
        <!-- content start -->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="to-do" role="tabpanel" aria-labelledby="to-do-tab">
                <!--Tâches en attentes -->
                <div id="tasks-to-do" class="container px-4 py-5">
                    <h2 class="pb-2 border-bottom">Tâches en attente</h2>
                    <div id="tasks-list" class="row g-4 py-5 row-cols-1 row-cols-lg-3 d-flex justify-content-evenly">
                        <?php
                        $req = $db->prepare('SELECT * FROM task WHERE done != 1');
                        $req->execute();
                        while ($task = $req->fetch()) {
                            if (!empty($task['deadline_date'])) { ?>
                                <div class="card" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $task['title'] ?></h5>
                                        <em>Echéance : <?= $task['deadline_date'] ?></em>
                                        <p class="card-text"><?= $task['detail'] ?></p>
                                        <div class="d-flex justify-content-between d-flex align-content-between flex-wrap">
                                            <form action="task_status.php?task=<?= $task['id'] ?>" method="post">
                                                <button class="btn btn-success" name="close-task" value="close">Terminer</button>
                                            </form>
                                            <form action="task_delete.php?task=<?= $task['id'] ?>" method="post">
                                                <button class="btn btn-danger" name="delete-task" value="delete">Supprimer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } else { ?>
                                <div class="card" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $task['title'] ?></h5>
                                        <p class="card-text"><?= $task['detail'] ?></p>
                                        <div class="d-flex justify-content-between d-flex align-content-between flex-wrap">
                                            <form action="task_status.php?task=<?= $task['id'] ?>" method="post">
                                                <button class="btn btn-success" name="close-task" value="close">Terminer</button>
                                            </form>
                                            <form action="task_delete.php?task=<?= $task['id'] ?>" method="post">
                                                <button class="btn btn-danger" name="delete-task" value="delete">Supprimer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        $req->closeCursor();
                        ?>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="done" role="tabpanel" aria-labelledby="done-tab">
                <!--Tâches terminées -->
                <div id="tasks-done" class="container px-4 py-5">
                    <h2 class="pb-2 border-bottom">Tâches en terminées</h2>
                    <div id="tasks-list" class="row g-4 py-5 row-cols-1 row-cols-lg-3 d-flex justify-content-evenly">
                        <?php
                        $req = $db->prepare('SELECT * FROM task WHERE done = 1');
                        $req->execute();
                        while ($task = $req->fetch()) {
                            if (!empty($task['deadline_date'])) { ?>
                                <div class="card" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $task['title'] ?></h5>
                                        <em>Echéance : <?= $task['deadline_date'] ?></em>
                                        <p class="card-text"><?= $task['detail'] ?></p>
                                        <div class="d-flex justify-content-between d-flex align-content-between flex-wrap">
                                            <form action="task_status.php?task=<?= $task['id'] ?>" method="post">
                                                <button class="btn btn-info" name="close-task" value="open">Réouvrir</button>
                                            </form>
                                            <form action="task_delete.php?task=<?= $task['id'] ?>" method="post">
                                                <button class="btn btn-danger" name="delete-task" value="delete">Supprimer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } else { ?>
                                <div class="card" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $task['title'] ?></h5>
                                        <p class="card-text"><?= $task['detail'] ?></p>
                                        <div class="d-flex justify-content-between d-flex align-content-between flex-wrap">
                                            <form action="task_status.php?task=<?= $task['id'] ?>" method="post">
                                                <button class="btn btn-info" name="close-task" value="open">Réouvrir</button>
                                            </form>
                                            <form action="task_delete.php?task=<?= $task['id'] ?>" method="post">
                                                <button class="btn btn-danger" name="delete-task" value="delete">Supprimer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        $req->closeCursor();
                        ?>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="add" role="tabpanel" aria-labelledby="add-tab">
                <!--Formulaire d'ajout d'une tâche-->
                <div id="task-add" class="container px-4 py-5">
                    <h2 class="pb-2 border-bottom">Ajouter une tâche :</h2>
                    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
                        <form action="task_add.php" method="post">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="title" id="title" required>
                                <label for="title">Titre</label>
                                <div id="titleHelp" class="form-text">Le titre est obligatoire.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea type="text" class="form-control" name="detail" id="detail"></textarea>
                                <label for="detail">Description</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control" name="deadline_date" id="deadline_date">
                                <label for="deadline_date">Echéance</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="submit" class="btn btn-primary" id="submit" value="Ajouter">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>