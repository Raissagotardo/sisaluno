<?php
##permite acesso as variaves dentro do aquivo conexao
require_once('../conexao.php');
$sql_id = "SELECT id FROM professor";
$result_id = $conexao->query($sql_id);

$idprofessor_s = array();

if ($result_id) {
    if ($result_id->rowCount() > 0) {
        while ($row_id = $result_id->fetch(PDO::FETCH_ASSOC)) {
            $idprofessor_s[] = $row_id["id"];
        }
    } else {
        echo "A tabela professor não possui um professor cadastrada.";
    }
} else {
    $errorInfo = $conexao->errorInfo();
    echo "Erro ao executar a consulta SQL: " . $errorInfo[2];
    exit;
}
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
        $nomedisciplina = $_GET["nomedisciplina"];
        $ch= $_GET["ch"];
        $semestre=$_GET["semestre"];
        $idprofessor=$_GET["idprofessor"];

        ##codigo SQL
        $sql = "INSERT INTO disciplina (nomedisciplina, ch, semestre, idprofessor) 
                VALUES('$nomedisciplina','$ch','$semestre', '$idprofessor')";

        ##junta o codigo sql a conexao do banco
        $sqlcombanco = $conexao->prepare($sql);

        ##executa o sql no banco de dados
        if($sqlcombanco->execute()){
            echo "<script> alert('OK! A disciplina $nomedisciplina foi Incluida com sucesso!!!')
            window.location.href = 'listadisciplina.php';
            </script>";
        }
           
        }
#######alterar
if(isset($_GET['update'])){

    ##dados recebidos pelo metodo POST 
    $id= $_GET["id"];
    $nomedisciplina= $_GET["nomedisciplina"];
    $ch= $_GET["ch"];
    $semestre= $_GET["semestre"];
    $idprofessor= $_GET["idprofessor"];
   
   
      ##codigo sql
    $sql = "UPDATE  disciplina SET nomedisciplina= :nomedisciplina, ch= :ch, semestre=:semestre, idprofessor=:idprofessor WHERE id= :id ";
   
    ##junta o codigo sql a conexao do banco
    $stmt = $conexao->prepare($sql);

    ##diz o paramentro e o tipo  do paramentros
    $stmt->bindParam(':id',$id, PDO::PARAM_INT);
    $stmt->bindParam(':nomedisciplina',$nomedisciplina, PDO::PARAM_STR);
    $stmt->bindParam(':ch',$ch, PDO::PARAM_STR);
    $stmt->bindParam(':semestre',$semestre, PDO::PARAM_STR);
    $stmt->bindParam(':idprofessor',$idprofessor, PDO::PARAM_INT);
    $stmt->execute();

     if($stmt->execute())
        {    echo "<script> alert('OK! A disciplina $nomedisciplina foi alterada com sucesso!!!')
            window.location.href = 'listadisciplina.php';
             </script>";
        }
        

}        


if (isset($_GET['excluir'])) {
    $id = $_GET['id'];

    $sql = "SELECT nomedisciplina FROM disciplina WHERE id = :id";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $result_stmt = $stmt->fetch(PDO::FETCH_ASSOC);

    $nomedisciplina = $result_stmt['nomedisciplina'];

    // Redireciona o usuário para a página de confirmação de exclusão
    echo "<script>
        var confirmar = confirm('Tem certeza que deseja excluir a disciplina $nomedisciplina?');
        if (confirmar) {
            window.location.href = 'excluirdisciplina.php? id=$id'; 
        } else {
            window.location.href = 'listadisciplina.php';
        }
    </script>";
}
?>