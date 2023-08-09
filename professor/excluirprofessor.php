
<?php

require_once('crudprofessor.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM professor WHERE id= :id";

    try {
        include_once('../conexao.php'); 

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Verifica se a exclusão foi bem-sucedida
        if ($stmt->rowCount() > 0) {
            echo "<script>alert('OK! O professor de ID $id foi excluído com sucesso!!!')</script>";
        } else {
            echo "<script>alert('Erro ao excluir o professor de ID $id.')</script>";
        }

    } catch (PDOException $e) {
        echo "<script>alert('Erro ao excluir o professor.')</script>";
    }
    echo "<script>window.location.href = 'listaprofessor.php';</script>";
}
?>

