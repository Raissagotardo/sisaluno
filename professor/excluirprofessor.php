
<?php

require_once('crudprofessor.php');

if (isset($_GET['idprofessor'])) {
    $idprofessor = $_GET['idprofessor'];
    $sql = "DELETE FROM Professor WHERE idprofessor= :idprofessor";

    try {
        include_once('../conexao.php'); 

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':idprofessor', $idprofessor, PDO::PARAM_INT);
        $stmt->execute();

        // Verifica se a exclusão foi bem-sucedida
        if ($stmt->rowCount() > 0) {
            echo "<script>alert('OK! O professor de ID $idprofessor foi excluído com sucesso!!!')</script>";
        } else {
            echo "<script>alert('Erro ao excluir o professor de ID $idprofessor.')</script>";
        }

    } catch (PDOException $e) {
        echo "<script>alert('Erro ao excluir o professor.')</script>";
    }
    echo "<script>window.location.href = 'listaprofessor.php';</script>";
}
?>

