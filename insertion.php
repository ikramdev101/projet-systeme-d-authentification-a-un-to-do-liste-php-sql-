<?php
$server = 'localhost';
$user = 'root';
$password = '';
$dbname = 'ofppt';

try {
    // Nouvelle connexion à la base de données
    $pdo = new PDO("mysql:host=$server;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Déclaration des messages d'erreur
    $errors = array();

    // Vérification de la méthode d'envoi des données
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Récupération des données et validation
        $nom = $_POST['nom'];
        if (empty($nom)) {
            $errors['nom'] = "Le nom est requis";
        }
        $prenom = $_POST['prenom'];
        if (empty($prenom)) {
            $errors['prenom'] = "Le prénom est requis";
        }
        $cin = $_POST['cin'];
        if (empty($cin)) {
            $errors['cin'] = "Le CIN est requis";
        }

        // Si aucune erreur n'est détectée, enregistrez les données
        if (empty($errors)) {
            $stmt = $pdo->prepare("INSERT INTO users (cin, nom, prenom) VALUES (:cin, :nom, :prenom)");
            $stmt->bindParam(':cin', $cin);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->execute();
            $msg = "Enregistrement réussi";
        }
    }
} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
}

// Fermeture de la connexion (optionnel)
$pdo = null;
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentification</title>
<link rel="stylesheet" href="views/signinStyle.css">
</head>
<body>

<div class="login-box">
    <h2 class='h2'>Authentification</h2><br>
    <form action="" method='POST'>
        <div class="textbox">
            <label for="nom">NOM:</label>
            <input type="text" name='nom'><br>
            <span class="error"><?php echo isset($errors['nom']) ? $errors['nom'] : ''; ?></span><br><br>
        </div>
        <div class="textbox">
            <label for="prenom">PRENOM:</label>
            <input type="text" name='prenom'><br>
            <span class="error"><?php echo isset($errors['prenom']) ? $errors['prenom'] : ''; ?></span><br><br>
        </div>
        <div class="textbox">
            <label for="cin">Password:</label>
            <input type="password" name='cin'><br>
            <span class="error"><?php echo isset($errors['cin']) ? $errors['cin'] : ''; ?></span><br><br>
        </div>
        
        <input type="submit" class="btn" value="S'authentifier"><br><br>
    </form>
    Already have an account? <a href="login.php">login</a><br>
    <div class="messag"><?php echo isset($msg) ? $msg : ''; ?></div>
</div>

</body>
</html>
