<?php
    session_start();
require_once 'connexion_dbh.php';

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
            $message = "Pseudo ou e-mail déjà utilisé.";
    } else {

        $stmt = $pdo->prepare("INSERT INTO Utilisateurs (login, email, mdpUtilisateur) 
                               VALUES (:login, :email, :password)");
        $stmt->bindParam(':login', $pseudo);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $pass);


        if ($stmt->execute()) {
            $_SESSION['idUtilisateur'] = $pdo->lastInsertId();
            $_SESSION['login'] = $pseudo;
            header('Location: ../../index.php');
            exit();
        } else {
            echo "Erreur lors de l'inscription de l'utilisater";
            exit();
        }
    }
}

?>