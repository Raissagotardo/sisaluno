<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista aluno</title>
</head>
<style>
     body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
            
        }
       .container{
        display: flex;
        flex-direction: column;
        justify-content: center;
            align-items: center;
       }
        table {
            width: 80%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #b22222;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #b22222;
            color: #fff;
        }


        .button {
            background-color: #b22222;
            border: none;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            height: 30px;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s ease;
            display: block;
            margin: 20px auto;
            width: 100px;
        }
        .button a {
            color: #fff;
            text-decoration: none;
        }

        .button:hover {
            background-color: #800000;
        }

        .button3 {
            background-color: #b22222;
        }

</style>
<body>
<?php 
/*
 * Melhor prática usando Prepared Statements
 * 
 */
  require_once('conexao.php');
   
  $retorno = $conexao->prepare('SELECT * FROM Aluno');
  $retorno->execute();

?>       <div class="container">
        <table> 
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOME</th>
                    <th>IDADE</th>
                    <th>ENDEREÇO</th>
                    <th>DATA DE NASCIMENTO</th>
                    <th>STATUS DO ALUNO</th>
                    <th>ALTERAR</th>
                    <th>EXCLUIR</th>
                    

                </tr>
            </thead>

            <tbody>
                <tr>
                    <?php foreach($retorno->fetchall() as $value) { ?>
                        <tr>
                        <td> <?php echo $value['idaluno'] ?>   </td> 
                            <td> <?php echo $value['nomealuno']?>  </td> 
                            <td> <?php echo $value['idadealuno']?> </td> 
                            <td> <?php echo $value['enderecoaluno']?> </td> 
                            <td> <?php echo $value['datanascimentoaluno']?> </td> 
                            <td> <?php echo $value['estatusaluno']?> </td> 
                            <td>
                               <form method="GET" action="altaluno.php">
                                        <input name="idaluno" type="hidden" value="<?php echo $value['idaluno'];?>"/>
                                        <button  class='button button3' name="alterar"  type="submit">Alterar</button>
                                </form>

                             </td> 

                             <td>
                               <form method="GET" action="crudaluno.php">
                                        <input name="idaluno" type="hidden" value="<?php echo $value['idaluno'];?>"/>
                                        <button  class='button button3' name="excluir"  type="submit">Excluir</button>
                                </form>

                             </td> 
                      </tr>
                    <?php  }  ?> 
                 </tr>
            </tbody>
        </table>
      </div>
<?php         
   echo "<button class='button button3'><a href='index.php'>voltar</a></button>";
?>
</body>
</html>