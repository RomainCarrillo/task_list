<?php
$myDb = 'mysql:dbname=task_list;host=localhost';
$user = 'root';
$pwd = '';


try {
    $db = new PDO($myDb, $user, $pwd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    die('Error warning : ' . $e->getMessage());
}


if (isset($_GET['task'])) {
    $id = htmlspecialchars($_GET['task']);
    $req = $db->prepare('UPDATE task SET done = :done WHERE id = :id');

    if ($_POST['close-task'] == "close") {
        $req->execute(array(
            "done" => "1",
            "id" => $id
        ));
    } elseif ($_POST['close-task'] == "open") {
        $req->execute(array(
            "done" => "0",
            "id" => $id
        ));
    }

    $req->closeCursor();
    $index = 'index.php';
    header('location:' . $index);
} else {
    echo '<a>Pas de tâche sélectionnée</a><br><a href="index.php">Retour à la liste</a>';
}
