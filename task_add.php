<?php
$myDb = 'mysql:dbname=task_list;host=localhost';
$user = 'root';
$pwd = '';


try {
    $db = new PDO($myDb, $user, $pwd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    die('Error warning : ' . $e->getMessage());
}

if (!empty($_POST['title'])) {
    $title = htmlspecialchars($_POST['title']);
    $detail = htmlspecialchars($_POST['detail']);
    if (!empty($_POST['deadline_date'])) {
        $deadline_date = htmlspecialchars($_POST['deadline_date']);
        $req = $db->prepare('INSERT INTO `task`(`title`, `detail`, `deadline_date`) VALUES (:title,:detail,:deadline_date)');
        $req->execute(array(
            'title' => $title,
            'detail' => $detail,
            'deadline_date' => $deadline_date
        ));
    } else {
        $req = $db->prepare('INSERT INTO `task`(`title`, `detail`) VALUES (:title,:detail)');
        $req->execute(array(
            'title' => $title,
            'detail' => $detail,
        ));
    }
    $req->closeCursor();
    $index = 'index.php';
    header('location:' . $index);
} else {
    echo '<p>Le titre de la tâche est obligatoire.<p><br><a href="index.php">Retour à la liste</a>';
}
