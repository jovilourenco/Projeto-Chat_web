<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal</title>

    <link type="text/css" rel="stylesheet" href="style/homepage.css">
    <link type="text/css" rel="stylesheet" href="style/inbox.css">
    <link type="text/css" rel="stylesheet" href="style/chat.css">
    <link type="text/css" rel="stylesheet" href="style/profile.css">
    
    <link rel="stylesheet" href="style/sweetalert2.css">
    <script src="./js/jquery.js"></script>
    <script src="./js/sweetalert2.js"></script>

</head>
<body>
    
    <header id="cabecalho">
        <ul id="nav">
            <li id="menu">
                <button class="item" id="botao"><img src="./img/PersonFilled.png" alt=""></button>
                <div id="drop">
                    <button class="item subitem" onclick="logout()">Sair</button>
                </div>
            </li>
        </ul>
    </header>

    <div id="container">
        <div id="menu-guia" class="column">
            <button id="botao-perfil">Perfil</button>
            <button id="botao-chat">Chat</button>
        </div>

        <div id="inbox" class="column">
            <p class="title">Conversas</p>
            <input type="text" maxlength="15" name="username" class="searchField" onkeyup="search()" placeholder="Pesquisar usuário">
            <div id="searchContainer"></div>
            <div class="container"></div>
        </div>

        <div id="chat" class="column"></div>

        <div id="profile" class="column">
            <p class="title">Perfil</p>
            <div class="container"></div>
        </div>

    </div>
</body>

<script>

    const botao = document.querySelector("#botao");
    const drop = document.querySelector("#drop");
    botao.addEventListener("click", () => drop.classList.toggle("active"));

    const perfil = document.querySelector("#botao-perfil");
    const chatbt = document.querySelector("#botao-chat");
    const chatbox = document.querySelector("#chat");
    const profilebox = document.querySelector("#profile");
    const inbox = document.querySelector("#inbox");

    perfil.addEventListener("click", () => {
        profilebox.style.display = "inline-block";
        chatbox.style.display = "none";
        inbox.style.display = "none";
        perfil.style.backgroundColor = '#E1E2FF';
        chatbt.style.backgroundColor = '';
    });

    chatbt.addEventListener("click", () => {
        chatbox.style.display = "inline-block";
        profilebox.style.display = "none";
        inbox.style.display = "inline-block";
        chatbt.style.backgroundColor = '#E1E2FF';
        perfil.style.backgroundColor = '';
    });

    // Set initial visibility
    profilebox.style.display = "inline-block";
    chatbox.style.display = "none";
    inbox.style.display = "none";

    // FUNÇÕES RELACIONADAS AO BD
    function loadInbox(){
        $.ajax({
            url: 'process/inbox.php',
            success: function(data) {
                $('#inbox .container').html(data);
            },
            error: function (error){
                Swal.fire({
                    title: 'Erro',
                    text: error.statusText,
                    icon: 'error',
                    confirmButtonText: 'Ok'
                })
            }
        });
    }

    function loadProfile(id = 0){
        $.ajax({
            url: 'process/profile.php?id=' + id,
            success: function(data) {
                $('#profile .container').html(data);
            },
            error: function (error){
                Swal.fire({
                    title: 'Erro',
                    text: error.statusText,
                    icon: 'error',
                    confirmButtonText: 'Ok'
                })
            }
        });
    }

    function chat(id = 0){
        $.ajax({
            url: 'process/chat.php?id=' + id,
            success: function(data) {
                $('#chat').html(data);
            },
            error: function (error){
                Swal.fire({
                    title: 'Erro',
                    text: error.statusText,
                    icon: 'error',
                    confirmButtonText: 'Ok'
                })
            }
        });
    }

    function search() {
        var term = $('input.searchField').val();
        if (term.length >= 3){
            $.ajax({
                url: 'process/search.php?term=' + term,
                success: function(data) {
                    $('#searchContainer').html(data);
                    $('#searchContainer').show();
                }
            })
        }else{
            $('#searchContainer').hide();
        }
    }

    function logout(){
        $.ajax({
            url: 'process/logout.php',
            beforeSend: function() {
                $("#loading").show();
            },
            success: function() {
                location.href = 'auth.php';
            }
        })
    }

    $(document).ready(function() {
        setInterval(() => {
            loadInbox();
        }, 3000);
        loadProfile();
        chat();
    })
</script>

</html>