<?php
session_start();

include 'connexion_dbh.php';
include '../functionLOG.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = htmlspecialchars($_POST['login']);
    $pass = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM Utilisateurs WHERE login = :login");
    $stmt->bindParam(':login', $login);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($pass, $user['mdpUtilisateur'])) {
        $_SESSION['idUtilisateur'] = $user['idUtilisateur'];

        // Enregistre en session la connexion réussie
        $_SESSION['login'] = $user['login'];

        // Enregistre la tentative de connexion
        $resultat = "OK";
        $message = "connexion réussie";
        $password = "...";
        $operation = "connexion";

        logToDisk($login, $password, $resultat, $message, $operation);

        // Redirection vers l'index une fois connecté'
        header("Location: ../../index.php");
        exit();

    } else {

        // Connexion échouée
        $resultat = "KO";
        $messages[] = "login et/ou password invalide";
        $message = implode(',', $messages);
        $password = "...";

        $operation = "tentative-connexion";

        // Enregistre la tentative de connexion
        logToDisk($login, $password, $resultat, $message, $operation);
        header("Location: ../connexion.php");
        exit();

    }
}
?>