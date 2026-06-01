<?php
session_start();
require_once 'connexion_dbh.php';
include '../functionLOG.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' 
    && !empty($_POST['login']) 
    && !empty($_POST['email']) 
    && !empty($_POST['password'])) {

    $pseudo = htmlspecialchars($_POST['login']);
    $email = htmlspecialchars($_POST['email']);
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);


    $stmt = $pdo->prepare("SELECT * FROM Utilisateurs WHERE login = :login OR email = :email");
    $stmt->execute(['login' => $pseudo, 'email' => $email]);

    if ($stmt->rowCount() > 0) {
            $login = $pseudo . " " . $email ;

            // Enregistre la tentative de connexion
            $resultat = "KO";
            $message = "inscription échouée car pseudo ou e-mail déjà utilisé.";
            $password = "...";
            $operation = "tentative-inscription";

            logToDisk($login, $password, $resultat, $message, $operation);
            
            header('Location: ../../index.php');
            exit();
    } else {

        $stmt = $pdo->prepare("INSERT INTO Utilisateurs (login, email, mdpUtilisateur) VALUES (:login, :email, :mdpUtilisateur)");
        $stmt->bindParam(':login', $pseudo);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mdpUtilisateur', $pass);


        if ($stmt->execute()) {
            $_SESSION['idUtilisateur'] = $pdo->lastInsertId();
            $_SESSION['login'] = $pseudo;

            $login = $_SESSION['login'];

            // Enregistre la tentative de connexion
            $resultat = "OK";
            $message = "inscription réussie";
            $password = "...";
            $operation = "inscription";

            logToDisk($login, $password, $resultat, $message, $operation);

            // Redirection vers l'index une fois inscrit
            header('Location: ../../index.php');
            exit();
        } else {
            $login = $pseudo;

            // Enregistre la tentative de connexion
            $resultat = "KO";
            $message = "inscription échouée lors de la requete SQL";
            $password = "...";
            $operation = "tentative-inscription";

            logToDisk($login, $password, $resultat, $message, $operation);

            header('Location: ../../index.php');
            exit();
        }      
    }
}

?>