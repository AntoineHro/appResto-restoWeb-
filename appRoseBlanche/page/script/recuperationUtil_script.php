<?php
if (isset($_SESSION['idUtilisateur'])) {
    $stmt = $pdo->prepare("SELECT * FROM Utilisateurs WHERE idUtilisateur = :idUtilisateur");
    $stmt->execute([':idUtilisateur' => $_SESSION['idUtilisateur']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>