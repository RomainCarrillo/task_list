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
    $req = $db->prepare('DELETE FROM task WHERE id = :id');
    $req->execute(array(
        "id" => $id
    ));
    $req->closeCursor();
    $index = 'index.php';
    header('location:' . $index);
} else {
    echo '<p>Pas de tâche sélectionnée</p><br><a href="index.php">Retour à la liste</a>';
}
