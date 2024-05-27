
  
  
  <?php  
// Déclaration des variables 
$server='localhost';
$username='root';
$password='';
$dbname='ofppt';

try {
    // Nouvelle connexion avec la base de données 
    $pdo = new PDO("mysql:host=$server;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérification de la méthode d'envoi 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        // Récupération des données 
        $nom = $_POST['name'];
        $cin = $_POST['cin'];

        // Préparation de la requête 
        $stmt = $pdo->prepare('SELECT * FROM users WHERE cin = :cin AND nom = :nom');
        // Lier les paramètres 
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':cin', $cin);
        // Exécuter la requête
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Redirection vers la page dashboard avec le nom de l'utilisateur en tant que paramètre
            header("Location: dashboard.php?nom=$nom");
            exit;
        } else {
            echo "Utilisateur non trouvé.";
        }
        
    }
} catch(PDOException $e) {
    echo 'Erreur : '.$e->getMessage();
}
?>

  
  <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification des utilisateurs</title>
   <link rel="stylesheet" href="views/loginStyle.css">
</head>
<body>
    <div class="login-box">
       
        <h2>User Login</h2>
        <form action="" method="POST">
            <div class="textbox">
                <input type="text" name="name" placeholder=" username " required>
            </div>
            <div class="textbox">
                <input type="password" name="cin" placeholder=" password" required>
            </div>
            <div class="remember-me">
                <label>
                    <input type="checkbox" name="remember"> Remember me
                </label>
                <a href="#" class="forgot-password">Forgot Password?</a>
            </div>
            <input type="submit" class="btn" value="LOGIN">
        </form>
    </div>
</body>
</html>
