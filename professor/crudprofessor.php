
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
include_once('../conexao.php');
function isBlank($str) {
    return !isset($str) || trim($str) === '';
}

function isInteger($num) {
    return is_numeric($num) && intval($num) == $num;
}

function isText($str) {
    return !preg_match('/<script[^>]*>|<\/script>|<.*?[^>]>/i', $str);
} 

##cadastrar
if(isset($_POST['cadastrar'])){
        ##dados recebidos pelo metodo GET
        $nomeprofessor = $_POST["nomeprofessor"];
          $cpf= $_POST["cpf"];
           $idade= $_POST["idade"];
        $datanascimento = $_POST["datanascimento"];
      $endereco = $_POST["endereco"];
        $estatus= $_POST["estatus"];
       
      
        if (
            isBlank($nomeprofessor) || !isText($nomeprofessor) ||
            isBlank($cpf)||  !preg_match('/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/', $cpf) ||
            isBlank($idade) || !isInteger($idade) ||
            isBlank($datanascimento) ||
            isBlank($endereco) || !isText($endereco) ||
            isBlank($estatus) || !isText($estatus)
        ) {
            echo "<script> alert('Por favor, preencha todos os campos corretamente antes de cadastrar.')
            window.location.href = 'cadprofessor.php';
            </script>";
        } else {
             if (empty($nomeprofessor) || str_word_count($nomeprofessor) < 2) {
                echo "<script>alert('Nome deve conter mais de um valor.')
                window.location.href = 'cadprofessor.php'; 
                </script>";
            }  elseif ($idade < 18) {
                echo "<script> alert('A idade do professor não pode ser menor que 18 anos.')
                window.location.href = 'cadprofessor.php';
                </script>";
            }
             else {
                $anoNascimento = date("Y", strtotime($datanascimento));
                $idadeCalculada = date("Y") - $anoNascimento;
    
                if ($idadeCalculada != $idade) {
                    echo "<script> alert('A data de nascimento não corresponde à idade fornecida.')
                    window.location.href = 'cadprofessor.php';
                    </script>";
                } else{ ##codigo SQL
        $sql = "INSERT INTO Professor (nomeprofessor, cpf, idade, datanascimento, endereco, estatus) VALUES('$nomeprofessor','$cpf','$idade', '$datanascimento', '$endereco', '$estatus')";

        ##junta o codigo sql a conexao do banco
        $sqlcombanco = $conexao->prepare($sql);

        ##executa o sql no banco de dados
        if($sqlcombanco->execute())
            {
                echo "<script> alert('OK! O professor  $nomeprofessor foi Incluido com sucesso!!!')
            window.location.href = 'listaprofessor.php';
            </script>";
            
                    }
                }
            }
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
            echo "<script> alert('OK! O professor $nomeprofessor foi alterado com sucesso!!!')
            window.location.href = 'listaprofessor.php';
             </script>";
        }

}        



##Excluir
if (isset($_POST['excluir'])) {
    $idprofessor = $_POST['idprofessor'];

    include_once('../conexao.php');

    $sql = "SELECT nomeprofessor FROM Professor WHERE idprofessor = :idprofessor";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':idprofessor', $idprofessor, PDO::PARAM_INT);
    $stmt->execute();
    $result_stmt = $stmt->fetch(PDO::FETCH_ASSOC);

    $nomeprofessor = $result_stmt['nomeprofessor'];

    // Redireciona o usuário para a página de confirmação de exclusão
    echo "<script>
        var confirmar = confirm('Tem certeza que deseja excluir o professor $nomeprofessor?');
        if (confirmar) {
            window.location.href = 'excluirprofessor.php? idprofessor=$idprofessor'; 
        } else {
            window.location.href = 'listaprofessor.php';
        }
    </script>";
}
?>
</body>
</html>
