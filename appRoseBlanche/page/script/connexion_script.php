<?php
    session_start();

include 'connexion_dbh.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = htmlspecialchars($_POST['login']);
    $pass = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM Utilisateurs WHERE login = :login");
    $stmt->bindParam(':login', $login);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($pass, $user['mdpUtilisateur'])) {
        $_SESSION['idUtilisateur'] = $user['idUtilisateur'];
        $_SESSION['login'] = $user['login'];

        header("Location: ../../index.php");
        exit();
    } else {
        echo "Pseudo ou mot de passe incorrect.";
        exit();
    }
}
?>