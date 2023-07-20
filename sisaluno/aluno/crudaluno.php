<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud Aluno</title>
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
if(isset($_GET['cadastrar'])){
        ##dados recebidos pelo metodo GET
        $nomealuno = $_GET["nomealuno"];
        $idadealuno = $_GET["idadealuno"];
        $datanascimentoaluno= $_GET["datanascimentoaluno"];
        $enderecoaluno = $_GET["enderecoaluno"];
        $estatusaluno= $_GET["estatusaluno"]; 
        ##codigo SQL
        $sql = "INSERT INTO Aluno (nomealuno, idadealuno, datanascimentoaluno, enderecoaluno,estatusaluno) 
        VALUES('$nomealuno', '$idadealuno', '$datanascimentoaluno', '$enderecoaluno', '$estatusaluno')";

        ##junta o codigo sql a conexao do banco
        $sqlcombanco = $conexao->prepare($sql);

        ##executa o sql no banco de dados
        if($sqlcombanco->execute())
            {
                echo " O aluno
                $nomealuno foi Incluido com sucesso!!!"; 
                echo " <button class='button'><a href='index.php'>voltar</a></button>";
            }
        }
#######alterar
if(isset($_GET['update'])){

    ##dados recebidos pelo metodo POST
    $nomealuno = $_GET["nomealuno"];
    $idadealuno = $_GET["idadealuno"];
    $datanascimentoaluno= $_GET["datanascimentoaluno"];
    $enderecoaluno = $_GET["enderecoaluno"];
    $estatusaluno= $_GET["estatusaluno"];
    $idaluno=$_GET["idaluno"];

      ##codigo sql
    $sql = "UPDATE  Aluno SET nomealuno= :nomealuno, idadealuno= :idadealuno , datanascimentoaluno= :datanascimentoaluno, enderecoaluno= :enderecoaluno , estatusaluno= :estatusaluno WHERE idaluno= :idaluno";
   
    ##junta o codigo sql a conexao do banco
    $stmt = $conexao->prepare($sql);

    ##diz o paramentro e o tipo  do paramentros
    $stmt->bindParam(':idaluno',$idaluno, PDO::PARAM_INT);
    $stmt->bindParam(':nomealuno',$nomealuno, PDO::PARAM_STR); 
    $stmt->bindParam(':idadealuno',$idadealuno, PDO::PARAM_INT);
    $stmt->bindParam(':datanascimentoaluno',$datanascimentoaluno, PDO::PARAM_STR);
    $stmt->bindParam(':enderecoaluno',$enderecoaluno, PDO::PARAM_STR);
    $stmt->bindParam(':estatusaluno',$estatusaluno, PDO::PARAM_STR);
   
    $stmt->execute();

    if($stmt->execute())
        {
            echo "O aluno
             $nomealuno foi Alterado com sucesso!!!"; 

            echo " <button class='button'><a href='listaaluno.php'>voltar</a></button>";
        }

}        


##Excluir
if(isset($_GET['excluir'])){
    $idaluno = $_GET['idaluno'];
    $sql ="DELETE FROM Aluno WHERE idaluno={$idaluno}";
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
    $stmt = $conexao->prepare($sql);
    $stmt->execute();

    if($stmt->execute())
        {
            echo " O aluno de id
             $idaluno foi excluido!!!"; 

            echo " <button class='button'><a href='index.php'>voltar</a></button>";
        }

}

        
?>

</body>
</html>