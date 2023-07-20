
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> crudprofessor</title>
</head>
<style>
body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
        }

        .button {
            background-color: #b22222;
            border: none;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s ease;
            display: block;
            margin: 20px auto;
            width: 150px;
        }

        .button a {
            color: #fff;
            text-decoration: none;
        }

        .button:hover {
            background-color: #800000;
        }
</style>
<body>
<?php
##permite acesso as variaves dentro do aquivo conexao
require_once('conexao.php');



##cadastrar
if(isset($_POST['cadastrar'])){
        ##dados recebidos pelo metodo GET
        $nomeprofessor = $_POST["nomeprofessor"];
          $cpf= $_POST["cpf"];
           $idade= $_POST["idade"];
        $datanascimento = $_POST["datanascimento"];
      $endereco = $_POST["endereco"];
        $estatus= $_POST["estatus"];
       
        ##codigo SQL
        $sql = "INSERT INTO Professor (nomeprofessor, cpf, idade, datanascimento, endereco, estatus) VALUES('$nomeprofessor','$cpf','$idade', '$datanascimento', '$endereco', '$estatus')";

        ##junta o codigo sql a conexao do banco
        $sqlcombanco = $conexao->prepare($sql);

        ##executa o sql no banco de dados
        if($sqlcombanco->execute())
            {
                echo " O Professor
                $nomeprofessor foi Incluido com sucesso!!!"; 
                echo " <button class='button'><a href='index.php'>voltar</a></button>";
            }
        }
#######alterar
if(isset($_POST['update'])){

    ##dados recebidos pelo metodo POST
    $nomeprofessor = $_POST["nomeprofessor"];
          $cpf= $_POST["cpf"];
           $idade= $_POST["idade"];
        $datanascimento = $_POST["datanascimento"];
      $endereco = $_POST["endereco"];
        $estatus= $_POST["estatus"];
        $idprofessor= $_POST["idprofessor"];

   
      ##codigo sql
    $sql = "UPDATE  Professor SET nomeprofessor= :nomeprofessor, cpf= :cpf, idade= :idade, datanascimento= :datanascimento, endereco= :endereco, estatus= :estatus WHERE idprofessor= :idprofessor ";
   
    ##junta o codigo sql a conexao do banco
    $stmt = $conexao->prepare($sql);

    ##diz o paramentro e o tipo  do paramentros
    $stmt->bindParam(':cpf',$cpf, PDO::PARAM_STR);
    $stmt->bindParam(':nomeprofessor',$nomeprofessor, PDO::PARAM_STR);
    $stmt->bindParam(':endereco',$endereco, PDO::PARAM_STR);
    $stmt->bindParam(':idade',$idade, PDO::PARAM_INT);
    $stmt->bindParam(':datanascimento',$datanascimento, PDO::PARAM_STR);
    $stmt->bindParam(':estatus',$estatus, PDO::PARAM_STR);
    $stmt->bindParam(':idprofessor',$idprofessor, PDO::PARAM_INT);

    $stmt->execute();
 


    if($stmt->execute())
        {
            echo " O  Professor
             $nomeprofessor foi Alterado com sucesso!!!"; 

            echo " <button class='button'><a href='listaprofessor.php'>voltar</a></button>";
        }

}        


##Excluir
if(isset($_POST['excluir'])){
    $idprofessor= $_POST['idprofessor'];
    $sql ="DELETE FROM `Professor` WHERE idprofessor={$idprofessor}";
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
    $stmt = $conexao->prepare($sql);
    $stmt->execute();

    if($stmt->execute())
        {
            echo " O Professor de id $idprofessor foi excluido!!!"; 

            echo " <button class='button'><a href='index.php'>voltar</a></button>";
        }

}
        
?>
</body>
</html>
