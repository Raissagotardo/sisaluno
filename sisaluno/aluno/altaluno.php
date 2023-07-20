<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar aluno</title>
</head>
<style>
   body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            max-width: 500px;
            padding: 20px;
            border: 2px solid #b22222;
            border-radius: 10px;
            background-color: #fff;
        }

        .butao {
            width: 90%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #b22222;
            border-radius: 5px;
        }

        .submit {
            background-color: #b22222;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            width: 50%;
            margin-left: 100px;
        }

        .submit:hover {
            background-color: #800000;
        }
</style>
<body>
<?php
    require_once('conexao.php');

   $idaluno = $_GET['idaluno'];

   ##sql para selecionar apens um aluno
   $sql = "SELECT * FROM Aluno where idaluno= :idaluno";
   
   # junta o sql a conexao do banco
   $retorno = $conexao->prepare($sql);

   ##diz o paramentro e o tipo  do paramentros
   $retorno->bindParam(':idaluno',$idaluno, PDO::PARAM_INT);

   #executa a estrutura no banco
   $retorno->execute();

  #transforma o retorno em array
   $array_retorno=$retorno->fetch();
   
   ##armazena retorno em variaveis
   $nomealuno = $array_retorno['nomealuno'];
   $idadealuno = $array_retorno['idadealuno'];
   $datanascimentoaluno = $array_retorno['datanascimentoaluno'];
   $enderecoaluno = $array_retorno['enderecoaluno'];
   $estatusaluno = $array_retorno['estatusaluno'];

?>

  <form method="GET" action="crudaluno.php">
        <input type="text" name="nomealuno" class="butao" value=<?php echo $nomealuno?> >
                                                
        <input type="text" name="idadealuno" class="butao" value=<?php echo $idadealuno ?> >
        
        <input type="text" name="datanascimentoaluno" class="butao" value=<?php echo $datanascimentoaluno ?> >

        <input type="text" name="enderecoaluno" class="butao" value=<?php echo $enderecoaluno?> >

        <input type="text" name="estatusaluno" class="butao" value=<?php echo $estatusaluno ?> >

        <input type="hidden" name="idaluno" value=<?php echo $idaluno ?> >

        <input  class="submit" type="submit" name="update" value="Alterar">
  </form>
</body>
</html>
