<?php
    include_once("check.php");

    if(isset($_GET["id"]) && $_GET["id"] > 0){
        $user_id = $_GET["id"];

        $getUser = $con->prepare("SELECT Username FROM User WHERE (Id LIKE ?) LIMIT 1");
        $getUser->bind_param("i", $user_id);
        $getUser->execute();
        $user = $getUser->get_result()->fetch_assoc();

        ?>
            <div class="topMenu">
                <img src="img/close.png" onclick="chat()" />
                <p class="title"><?php echo $user["Username"]; ?></p>
            </div>

            <div class="innerContainer"></div>
                <form method="POST" enctype="multipart/form-data" id="sendMessage">
                    <input type="number" name="id" value="<?php echo $user_id; ?>" hidden/>
                    <input type="text" name="message" maxlength="500" id="messageInput" placeholder="Escreva aqui sua mensagem"/>
                    <input type="file" name="image" accept="image/x-png,image/jpeg" id="sendImage" hidden />
                    <label for="sendImage"><img src="img/image.png"/></label>
                </form>

                <script>
                    function sendMessage(){
                        var formData = new FormData($("#sendMessage")[0]);
                        $.ajax({
                            type: 'post',
                            url: 'process/send.php',
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function(){
                                $("#sendMessage")[0].reset();
                            },
                            error: function (error){
                                Swal.fire({
                                    title: 'Mensagem não alterada',
                                    text: error.statusText,
                                    icon: 'error',
                                    confirmButtonText: 'Tentar novamente.'
                                })
                            }
                        });
                    }

                    $("#messageInput").on('keyup', function(e){
                        if(e.keyCode === 13 && ($("#messageInput").val().length>0)){
                            sendMessage();
                        }
                    });

                    $("#sendImage").change(function(){
                        sendMessage();
                        console.log("send")
                    });

                    setInterval(() => {

                        $.ajax({
                            url: 'process/retrieve.php?id=<?php echo $user_id; ?>',
                            success: function (data) {
                                $('#chat .innerContainer').html(data);
                                $('#chat .innerContainer');
                            },
                            error: function (error) {
                                Swal.fire({
                                    title: 'Erro de chat',
                                    text: error.statusText,
                                    icon: 'error',
                                    confirmButtonText: 'Ok'
                                })
                            }
                        });
                    }, 1500);

                </script>
        
        <?php

    } else{
        ?>
        <div class="empty">
            <p>Selecione uma conversa para socializar com um usuário!</p>    
        </div>
        <?php
    }

?>