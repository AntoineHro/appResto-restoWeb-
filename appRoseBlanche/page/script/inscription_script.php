<?php
require_once 'connexion_dbh.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' 
    && !empty($_POST['login']) 
    && !empty($_POST['email']) 
    && !empty($_POST['password'])) {

    $pseudo = htmlspecialchars($_POST['login']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
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
            $message = "Utilisateur enregistré avec succès. Veuillez vous rendre sur la page de connexion.";
            header('Location: ../../index.php');
            exit();
        } else {
            $message = "Erreur lors de l'enregistrement.";
        }
    }
}

?>