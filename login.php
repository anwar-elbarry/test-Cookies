<?php 
session_start();
if (!isset($_SESSION["name"]) && isset($_COOKIE["name"])) {
    $_SESSION["name"] = $_COOKIE["name"];
    echo "Bienvenue, " . $_SESSION["name"];
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST["name"];
    $password = $_POST["password"];
    $langue = $_POST["langue"];
    $remember = isset($_POST["remember"]) ? $_POST["remember"] : null;

    if ($remember === 'on') {
        setcookie('name', $name, time() + (30 * 24 * 60 * 60), '/'); // 30 days expiration
    }
    else{
        session_destroy(); 
        setcookie('name', '', time() - 3600, '/');
    }
    $_SESSION["name"] = $name;
    $_SESSION["langue"] = $langue;
    echo "Connexion réussie !    bien venu $name<br>Votre langue préférée : $langue<br>
    <br>
    <a href='logout.php' class='flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600'>log-out</a>";
} else {
    echo "Échec de la connexion : username ou mot de passe incorrect.";
}

?>