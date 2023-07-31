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
if(isset($_GET['cadastrar'])){
        ##dados recebidos pelo metodo GET
        $nomealuno = $_GET["nomealuno"];
        $idadealuno = $_GET["idadealuno"];
        $datanascimentoaluno= $_GET["datanascimentoaluno"];
        $enderecoaluno = $_GET["enderecoaluno"];
        $estatusaluno= $_GET["estatusaluno"]; 
        ##codigo SQL

        if (
            isBlank($nomealuno) || !isText($nomealuno) ||
            isBlank($idadealuno) || !isInteger($idadealuno) ||
            isBlank($datanascimentoaluno) ||
            isBlank($enderecoaluno) || !isText($enderecoaluno) ||
            isBlank($estatusaluno) || !isText($estatusaluno)
        ) {
            echo "<script> alert('Por favor, preencha todos os campos corretamente antes de cadastrar.')
            window.location.href = 'cadaluno.php';
            </script>";
        } else {
             if (empty($nomealuno) || str_word_count($nomealuno) < 2) {
                echo "<script>alert('Nome deve conter mais de um valor.')
                window.location.href = 'cadaluno.php'; 
                </script>";
            }  elseif ($idadealuno < 5) {
                echo "<script> alert('A idade do aluno não pode ser menor que 5 anos.')
                window.location.href = 'cadaluno.php';
                </script>";
            }
             else {
                $anoNascimento = date("Y", strtotime($datanascimentoaluno));
                $idadeCalculada = date("Y") - $anoNascimento;
    
                if ($idadeCalculada != $idadealuno) {
                    echo "<script> alert('A data de nascimento não corresponde à idade fornecida.')
                    window.location.href = 'cadaluno.php';
                    </script>";
                } else {
                    $sql = "INSERT INTO Aluno (nomealuno, idadealuno, datanascimentoaluno, enderecoaluno,estatusaluno) 
                    VALUES('$nomealuno', '$idadealuno', '$datanascimentoaluno', '$enderecoaluno', '$estatusaluno')";
    
                    $sqlcombanco = $conexao->prepare($sql);
    
                    if ($sqlcombanco->execute()) {
                        echo "<script> alert('OK! O aluno  $nomealuno foi Incluido com sucesso!!!')
                        window.location.href = 'listaaluno.php';
                        </script>";
            
                    }
                }
            }
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
        {    echo "<script> alert('OK! O aluno de $nomealuno foi alterado com sucesso!!!')
            window.location.href = 'listaaluno.php';
             </script>";
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
            echo "<script> alert('OK! O aluno  de  id $idaluno foi excluído com sucesso!!!')
            window.location.href = 'listaaluno.php';
            </script>";
        }

}
        
?>

</body>
</html>