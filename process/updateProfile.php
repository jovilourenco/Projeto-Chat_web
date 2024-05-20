<?php
    include_once("check.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $imagename = $username."_".rand(999,999999).$_FILES['imgInp']['name'];
        $imagetemp = $_FILES['imgInp']['tmp_name'];
        $imagePath = "../profilePics/";

        if (is_uploaded_file($imagetemp)){
            if (move_uploaded_file($imagetemp, $imagePath.$imagename)){
                $stmt = $con->prepare("UPDATE User SET `Picture` = ? WHERE Id = ?");
                $stmt->bind_param("si",$imagename, $uid);
                $stmt->execute();

                if($stmt->affected_rows > 0){
                    
                }else{
                    die(header("HTTP/1.0 401 Erro ao salvar imagem."));
                }

            }else{
                die(header("HTTP/1.0 401 Erro ao salvar imagem."));
            }
        }else{
            die(header("HTTP/1.0 401 Erro no upload da imagem."));
        }
    }else{
        die(header("HTTP/1.0 401 Faltam Parâmetros."));
    }
?>