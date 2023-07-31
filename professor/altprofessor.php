<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar professor</title>
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
            margin-left: 100px;
        }

        .submit:hover {
            background-color: #800000;
        }
</style>
<body>
    <?php
        include_once('../conexao.php');

      $idprofessor = $_POST['idprofessor'];
   
      ##sql para selecionar apens um aluno
      $sql = "SELECT * FROM Professor where idprofessor= :idprofessor";
      
      # junta o sql a conexao do banco
      $retorno = $conexao->prepare($sql);
   
      ##diz o paramentro e o tipo  do paramentros
      $retorno->bindParam(':idprofessor',$idprofessor, PDO::PARAM_INT);
   
      #executa a estrutura no banco
      $retorno->execute();
   
     #transforma o retorno em array
      $array_retorno=$retorno->fetch();
      
      ##armazena retorno em variaveis
      $nomeprofessor = $array_retorno['nomeprofessor'];
      $idade = $array_retorno['idade'];
      $endereco = $array_retorno['endereco'];
      $cpf= $array_retorno['cpf']; 
      $datanascimento= $array_retorno['datanascimento']; 
      $estatus= $array_retorno['estatus']; 

   ?>
     <form method="POST" action="crudprofessor.php">
     <p for=>Nome completo</p>
           <input type="text" class="butao" name="nomeprofessor"  value= " <?php echo htmlspecialchars($nomeprofessor) ?> " >
           <p for=>Digite seu endereço</p>                                     
           <input type="text" class="butao" name="endereco" value= "<?php echo  htmlentities($endereco)?> " >
           <p for=>Digite seu cpf</p>
           <input type="text" class="butao"  name="cpf" value= "<?php echo htmlspecialchars($cpf) ?> " > 
           <p for=>Informe sua data de nascimento</p>
           <input type="text" class="butao" name="datanascimento"  value= "<?php echo htmlspecialchars($datanascimento) ?> " >
           <p for=>Digite sua idade</p>   
           <input type="text" class="butao" name="idade"  value= "<?php echo htmlspecialchars($idade) ?> " >

           <p for=>Informe seu status</p>
        <select name="estatus" class="butao" value ="<?php echo $estatus ?>" >
        <option value="">Selecione</option>
     <option value="AP">AP</option>
        <option value="RP">RP</option> </select>

           <input type="hidden" name="idprofessor"  value=<?php echo $idprofessor?> >
           
           <input  class="submit" type="submit" name="update" value="Alterar">
     </form>
    
</body>
</html>