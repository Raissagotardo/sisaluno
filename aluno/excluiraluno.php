<?php
include_once('crudaluno.php');

if (isset($_GET['idaluno'])) {
    $idaluno = $_GET['idaluno'];
    $sql = "DELETE FROM Aluno WHERE idaluno=:idaluno";

    try {
        include_once('../conexao.php'); 

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':idaluno', $idaluno, PDO::PARAM_INT);
        $stmt->execute();

        // Verifica se a exclusão foi bem-sucedida
        if ($stmt->rowCount() > 0) {
            echo "<script>alert('OK! O aluno de ID $idaluno foi excluído com sucesso!!!')</script>";
        } else {
            echo "<script>alert('Erro ao excluir o aluno de ID $idaluno.')</script>";
        }

    } catch (PDOException $e) {
        echo "<script>alert('Erro ao excluir o aluno.')</script>";
    }
    echo "<script>window.location.href = 'listaaluno.php';</script>";
}
?>
