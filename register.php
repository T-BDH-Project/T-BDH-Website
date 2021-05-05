<?php
session_start();
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 't-bdh');

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn === false) {
    die("ERREUR : Impossible de se connecter. " . mysqli_connect_error());
}

function getIPAddress(){
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

$ip = getIPAddress();

if (isset($_POST['email']) > 0 && isset($_POST['pseudo']) > 0 && isset($_POST['password']) > 5){
    $email = htmlspecialchars($_POST['email']);
    $pseudo = htmlspecialchars($_POST['$pseudo']);
    $password = base64_encode($_POST['password']);

    $_SESSION["email"] = $email;
    $_SESSION["pseudo"] = $pseudo;

    $query = "INSERT INTO users(`email`, `pseudo`, `password`, `ip`) VALUES ('$email', '$pseudo' '$password', '$ip')";

    $execute = mysqli_query($conn, $query);
    
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/register.css">
    <script src="https://kit.fontawesome.com/89e6528a6f.js" crossorigin="anonymous"></script>
    <title>T-BDH - Register</title>

    <meta name="theme-color" content="#8e9fff" />
    <meta name="title" content="T-BDH"/>
    <meta name="description" content="T-BDH"/>
  
    <!-- Open Graph -->
    <meta property="og:title" content="T-BDH" />
    <!-- <meta property="og:url" content=""/> -->
    <meta property="og:description" content="T-BDH est un système d'hebergement"/>
    <meta property="og:image" content="https://cdn.discordapp.com/attachments/834397569861025852/835874425260867654/T-BDHtbdh.png">

    <!-- Twitter -->
    <meta name="twitter:card" value="summary"/>
    <meta name="twitter:title" content="T-BDH" />
    <meta name="twitter:description" content="T-BDH est un système d'hebergement"/>
    <meta name="twitter:image" content="https://cdn.discordapp.com/attachments/833355698518753321/836221285393629184/T-BDH.png"/>
</head>
<body>
    <main>
        <a href="index.html"><i class="fas fa-arrow-left"></i></a>
        <h1>S'inscrire</h1>
        <form method="POST" class="form">
            <label>E-mail :</label>
            <input name="email" class="input" type="email"><br>
            <label>Pseudo :</label>
            <input name="pseudo" class="input" type="text"><br>
            <label>Mot de passe :</label>
            <input name="password" class="input" type="password">
            <input type="submit" class="submit" value="S'inscrire">
        </form>
        <?php if (isset($_POST['email']) && isset($_POST['email']) && $_POST['email'] < 1 && $_POST['email'] < 1){ ?>
            <p style="font-size: 13px; color: #FF0000; text-align: center;">Veuillez rentrer un mail ainsi qu'un pseudo.</p>
        <?php $_POST = null; return; 
        }elseif (isset($_POST['email']) && isset($_POST['pseudo']) && $_POST['password'] <= 4){ ?>
            <p style="font-size: 13px; color: #FF0000; text-align: center;">Vote mot de passe est soit trop court (moins de 5 caractères) soit inexistant, réessayer.</p>
        <?php $_POST = null; return; 
        } ?>
        
        <div class="register">
            <p>Tu as déjà un compte ?</p> <a style="color: #8e9fff; text-decoration: none;" href="register.html"> Connecte toi</a>
        </p>
    </main>
</body>
</html>