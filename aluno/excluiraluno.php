<?php
include_once('crudaluno.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM aluno WHERE id=:id";

    try {
        include_once('../conexao.php'); 

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Verifica se a exclusão foi bem-sucedida
        if ($stmt->rowCount() > 0) {
            echo "<script>alert('OK! O aluno de ID $id foi excluído com sucesso!!!')</script>";
        } else {
            echo "<script>alert('Erro ao excluir o aluno de ID $id.')</script>";
        }

    } catch (PDOException $e) {
        echo "<script>alert('Erro ao excluir o aluno.')</script>";
    }
    echo "<script>window.location.href = 'listaaluno.php';</script>";
}
?>
