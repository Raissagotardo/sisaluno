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
        $nome = $_GET["nome"];
        $idade = $_GET["idade"];
        $datanascimento= $_GET["datanascimento"];
        $endereco = $_GET["endereco"];
        $estatus= $_GET["estatus"]; 
        ##codigo SQL

        if (
            isBlank($nome) || !isText($nome) ||
            isBlank($idade) || !isInteger($idade) ||
            isBlank($datanascimento) ||
            isBlank($endereco) || !isText($endereco) ||
            isBlank($estatus) || !isText($estatus)
        ) {
            echo "<script> alert('Por favor, preencha todos os campos corretamente antes de cadastrar.')
            window.location.href = 'cadaluno.php';
            </script>";
        } else {
             if (empty($nome) || str_word_count($nome) < 2) {
                echo "<script>alert('Nome deve conter mais de um valor.')
                window.location.href = 'cadaluno.php'; 
                </script>";
            }  elseif ($idade < 5) {
                echo "<script> alert('A idade do aluno não pode ser menor que 5 anos.')
                window.location.href = 'cadaluno.php';
                </script>";
            }
             else {
                $anoNascimento = date("Y", strtotime($datanascimento));
                $idadeCalculada = date("Y") - $anoNascimento;
    
                if ($idadeCalculada != $idade) {
                    echo "<script> alert('A data de nascimento não corresponde à idade fornecida.')
                    window.location.href = 'cadaluno.php';
                    </script>";
                } else {
                    $sql = "INSERT INTO aluno (nome, idade, datanascimento, endereco,estatus) 
                    VALUES('$nome', '$idade', '$datanascimento', '$endereco', '$estatus')";
    
                    $sqlcombanco = $conexao->prepare($sql);
    
                    if ($sqlcombanco->execute()) {
                        echo "<script> alert('OK! O aluno  $nome foi Incluido com sucesso!!!')
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
    $nome = $_GET["nome"];
    $idade = $_GET["idade"];
    $datanascimento= $_GET["datanascimento"];
    $endereco = $_GET["endereco"];
    $estatus= $_GET["estatus"];
    $id=$_GET["id"];

      ##codigo sql
    $sql = "UPDATE  aluno SET nome= :nome, idade= :idade , datanascimento= :datanascimento, endereco= :endereco , estatus= :estatus WHERE id= :id";
   
    ##junta o codigo sql a conexao do banco
    $stmt = $conexao->prepare($sql);

    ##diz o paramentro e o tipo  do paramentros
    $stmt->bindParam(':id',$id, PDO::PARAM_INT);
    $stmt->bindParam(':nome',$nome, PDO::PARAM_STR); 
    $stmt->bindParam(':idade',$idade, PDO::PARAM_INT);
    $stmt->bindParam(':datanascimento',$datanascimento, PDO::PARAM_STR);
    $stmt->bindParam(':endereco',$endereco, PDO::PARAM_STR);
    $stmt->bindParam(':estatus',$estatus, PDO::PARAM_STR);
   
    $stmt->execute();

    if($stmt->execute())
        {    echo "<script> alert('OK! O aluno(a) $nome foi alterado com sucesso!!!')
            window.location.href = 'listaaluno.php';
             </script>";
        }

}        


##Excluir
if (isset($_GET['excluir'])) {
    $id = $_GET['id'];

    // Obtém o nome do aluno (assumindo que você possui a conexão com o banco de dados)
    $sql_nome = "SELECT nome FROM aluno WHERE id = :id";
    $stmt_nome = $conexao->prepare($sql_nome);
    $stmt_nome->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt_nome->execute();
    $resultado_nome = $stmt_nome->fetch(PDO::FETCH_ASSOC);
    $nome = $resultado_nome['nome'];

    // Mostra um script de confirmação em JavaScript antes de executar a exclusão
    echo "<script>
        var confirmar = confirm('Tem certeza que deseja excluir o aluno $nome?');
        if (confirmar) {
            window.location.href = 'excluiraluno.php?id=$id'; 
        } else {
            window.location.href = 'listaaluno.php';
        }
    </script>";
}


        
?>

</body>
</html>