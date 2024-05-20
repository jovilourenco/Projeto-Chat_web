<?php
    include_once("./connection/connect.php");

    if(isset($_POST['email']) && isset($_POST['password'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        if($email == "" || $password == ""){
            die(header("HTTP/1.0 401 Formulário de login não preenchido ou incompleto."));
        }

        $stmt = $con->prepare("SELECT Id, Password, Token, Secure FROM User WHERE (Email LIKE ? OR Username LIKE ?) LIMIT 1");

        $stmt->bind_param("ss", $email, $email);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();
        
        if($user && password_verify($password, $user["Password"])){
            setcookie("ID", $user["Id"], time() + (10*365*24*60*60));
            setcookie("TOKEN", $user["Token"], time() + (10*365*24*60*60));
            setcookie("SECURE", $user["Secure"], time() + (10*365*24*60*60));
            return true;
        }else{
            die(header("HTTP/1.0 401 Email ou Senha incorretos!"));
        }

    }else{
        die(header("HTTP/1.0 401 Formulário de autenticação inválido"));
    }
?>