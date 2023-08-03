<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar disciplina</title>
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
            height: 100%;
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
            margin-left: 60px;
        }

        .submit:hover {
            background-color: #800000;
        }
</style>
<body>
    <?php
        include_once('../conexao.php');

      $id = $_GET['id'];
   
      ##sql para selecionar apens um aluno
      $sql = "SELECT * FROM disciplina where id= :id";
      
      # junta o sql a conexao do banco
      $retorno = $conexao->prepare($sql);
   
      ##diz o paramentro e o tipo  do paramentros
      $retorno->bindParam(':id',$id, PDO::PARAM_INT);
   
      #executa a estrutura no banco
      $retorno->execute();
   
     #transforma o retorno em array
      $array_retorno=$retorno->fetch();
      
      ##armazena retorno em variaveis
      $nomedisciplina = $array_retorno['nomedisciplina'];
      $ch = $array_retorno['ch'];
      $semestre= $array_retorno['semestre']; 
      $idprofessor=$array_retorno['idprofessor'];

   ?>
     <form method="get" action="cruddisciplina.php">
     <p for=>Nome da disciplina: </p>
           <input type="text" class="butao" name="nomedisciplina"  value= " <?php echo htmlspecialchars($nomedisciplina) ?> " >
           <p for=>Digite seu endereço</p>                                     
           <input type="text" class="butao" name="ch" value= "<?php echo  htmlentities($ch)?> " >
           <p for=>Digite seu semestre</p>
           <input type="text" class="butao"  name="semestre" value= "<?php echo htmlspecialchars($semestre) ?> " > 
           <p for=>Informe o id do professor</p>
        <select name="idprofessor" class="butao" value ="
        <?php 
        include_once('./cruddisciplina.php');
        foreach ($idprofessor_s as $id_p) {
                echo "<option value=\"$id_p\">$id_p</option>";
            } ?>" >
    </select>

           <input type="hidden" name="id"  value=<?php echo $id?> >
           
           <input  class="submit" type="submit" name="update" value="Alterar">
     </form>
    
</body>
</html>