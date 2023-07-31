
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Professores</title>
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
include_once('../conexao.php');
   
  $retorno = $conexao->prepare('SELECT * FROM Professor');
  $retorno->execute();

?>       <div class="container">
        <table> 
            <thead>
                <tr>
                   <th>ID</th>
                    <th>CPF</th>
                    <th>NOME</th>
                    <th>ENDEREÇO</th>
                    <th>IDADE</th>
                    <th>STATUS</th>
                    <th>DATA DE NASCIMENTO</th>
                    <th>ALTERAR</th>
                    <th>EXCLUIR</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <?php foreach($retorno->fetchall() as $value) { ?>
                        <tr>
                        <td> <?php echo $value['idprofessor'] ?>   </td> 
                            <td> <?php echo $value['cpf'] ?>   </td> 
                            <td> <?php echo $value['nomeprofessor']?>  </td> 
                            <td> <?php echo $value['endereco']?> </td> 
                            <td> <?php echo $value['idade']?> </td> 
                            <td> <?php echo $value['estatus'] ?>   </td> 
                            <td> <?php echo $value['datanascimento'] ?>   </td> 
          

                            <td>
                               <form method="POST" action="altprofessor.php">
                                        
                                        <input name="idprofessor" type="hidden" value="<?php echo $value['idprofessor'];?>"/>
                                        <button class='button button3' name="alterar"  type="submit">Alterar</button>
                                </form>

                             </td> 

                             <td>
                               <form method="POST" action="crudprofessor.php">
                                        <input name="idprofessor" type="hidden" value="<?php echo $value['idprofessor'];?>"/>
                                        <button  class='button button3' name="excluir"  type="submit">Excluir</button>
                                </form>

                             </td> 


                       
                      </tr>
                    <?php  } 
                     ?> 
                 </tr>
            </tbody>
        </table>
      </div>
<?php      
   echo "<button class='button button3'><a href='../index.php'>voltar</a></button>";
?>
</body>
</html>
