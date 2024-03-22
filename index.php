<?php 
    include_once("config.php");

    $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
    $dia = isset($_POST["dia"]) ? $_POST["dia"] : "";
    if(isset($_FILES["foto"]))
    {
        $foto = $_FILES["foto"];
        if($foto['size'] > 5477916) 
             die('Arquivo muito grande!! Max:5MB');

        $pasta = "imagens/";
        $nomeDoArquivo = $foto["name"];
        $novoNomeDoArquivo = $nome . "-" . $dia;

        $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

        if($extensao != "jpg" && $extensao != "png" && $extensao != "jpeg" )
            die("Tipo de arquivo não aceito");
        $path = $pasta . $novoNomeDoArquivo . "." . $extensao;
        $deucerto = move_uploaded_file($foto["tmp_name"], $path);
        
        
        $result = mysqli_query($conexao, "INSERT INTO alunos(nome,data,foto) VALUES('$nome', '$dia', '$path')");
        
  
            
    }
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto Niver</title>
    <link rel="shortcut icon" href="imagens/1.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <div class="container">
        
        <div class="box_form">
            
            <form  enctype="multipart/form-data"action="index.php" method="POST">
                <h1 class="title">Formulário Aniversário Next</h1>
                    
                        <label for="inome">Nome:</label>
                        <input type="text" name="nome" id="inome" required  placeholder="Nome Completo" >
                    
                
                        <label for="idia">Data do Aniversário </label>
                        <input type="date" name="dia" id="idia" required>
            
                   
                        <label for="ifoto">Sua Foto: </label>
                        <input type="file" name="foto" id="ifoto" required>
                    
                    
                        <button type="submit" value="Enviar" id="enviar" name="enviar">
                        Enviar
                        </button>
                    
            </form>
        </div>
    </div>
        
    
           
        
    
</body>
</html>