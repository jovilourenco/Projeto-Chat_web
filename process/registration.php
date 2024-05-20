<?php
include_once("./connection/connect.php");

if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['rePassword'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rePassword = $_POST['rePassword'];

    if($username == "" || $email == "" || $password == "" || $rePassword == ""){
        die(header("HTTP/1.0 401 Formulario de registro nao preenchido ou incompleto."));
    }

    $checkUsername = $con->prepare("SELECT Id FROM User WHERE Username = ? LIMIT 1");
    $checkUsername->bind_param("s", $username);
    $checkUsername->execute();
    $checkUsername->store_result();
    $countUsername = $checkUsername->num_rows;

    if($countUsername > 0){
        die(header("HTTP/1.0 401 Username em uso. Tente outro."));
    }

    $checkEmail = $con->prepare("SELECT Id FROM User WHERE Email = ? LIMIT 1");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $checkEmail->store_result();
    $countEmail = $checkEmail->num_rows;

    if($countEmail > 0){
        die(header("HTTP/1.0 401 Email em uso. Tente outro."));
    }

    if($password != $rePassword){
        die(header("HTTP/1.0 401 Senhas divergentes."));
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    $token = bin2hex(openssl_random_pseudo_bytes(28));
    $secure = rand(100000, 999999);

    $stmt = $con->prepare("INSERT INTO User (Username, Email, Password, Online, Token, Secure, Creation) VALUES (?, ?, ?, now(), ?, ?, now())");
    $stmt->bind_param("sssss", $username, $email, $password, $token, $secure);
    $stmt->execute();

    $userId = $stmt->insert_id;

    if($stmt && $userId){
        setcookie("ID", $userId, time() + (10*365*24*60*60));
        setcookie("TOKEN", $token, time() + (10*365*24*60*60));
        setcookie("SECURE", $secure, time() + (10*365*24*60*60));
    } else {
        die(header("HTTP/1.0 401 Houve um erro na base de dados."));
    }
} else {
    die(header("HTTP/1.0 401 Formulario de autenticação invalido."));
}
?>
