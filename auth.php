<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>[Auth] WorkChat</title>

    <link rel="stylesheet" href="./style/auth.css">
    <link rel="stylesheet" href="./style/sweetalert2.css">

    <script src="./js/jquery.js"></script>
    <script src="./js/sweetalert2.js"></script>

</head>
<body>
    
    <div class="bg"></div>

    <div class="auth login">
        <h1 class="title">WorkChat</h1>
        <img src="./img/logo-auth.svg" alt="Logotipo WorkChat" class="logo">
        <form action="./process/login.php" method="POST" id="login">
            <input type="text" name="email" class="field" placeholder="E-mail ou Username" required>
            <input type="password" name="password" class="field" placeholder="Senha" required>
            <button>Entrar</button>
        </form>
        <p class="toogle" onclick="$('.register').fadeIn()">Primeira vez aqui? Cadastre-se</p>
    </div>

    <div class="auth register">
        <h1 class="title">Criar sua conta</h1>
        <form action="./process/registration.php" method="POST" id="register">
            <input type="text" name="username" minlength="5" maxlength="15" class="field" placeholder="Digite um username" required>
            <input type="email" name="email" class="field" placeholder="Digite um E-mail" required>
            <input type="password" name="password" class="field" placeholder="Digite uma Senha" required>
            <input type="password" name="rePassword" class="field" placeholder="Confirme a Senha" required>
            <button>Criar conta</button>        
        </form>
        <p class="toogle" onclick="$('.register').fadeOut()">Já tem uma conta? Faça Login.</p>
    </div>

    <script>
        $("#login").on('submit', function(e){
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: './process/login.php',
                data: $('#login').serialize(),
                success: function (data){
                    location.href = './';
                },
                error: function (error){
                    Swal.fire({
                        title: 'Algo deu errado!',
                        text: error.statusText,
                        icon: 'error',
                        confirmButtonText: 'Tentar novamente'
                    })
                }
            })
        });
        // Melhor implementar o swing pois ele usa nos CDUs dos phps ao gerar o die e no swing ele identifica como erro, realizando tratamento. Sem eles ele simplesmente não printa nada.
        $("#register").on('submit', function(e){
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: './process/registration.php',
                data: $('#register').serialize(),
                success: function (data){
                    location.href = './';
                },
                error: function (error){
                    Swal.fire({
                        title: 'Algo deu errado!',
                        text: error.statusText,
                        icon: 'error',
                        confirmButtonText: 'Tentar novamente'
                    })
                }
            })
        });
    </script>
</body>
</html>