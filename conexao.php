<?php

define('HOST','localhost');
define('USER', 'root');
define('SENHA', '5318');
define('DBNAME', 'IFBAIANO');


try {

    $conexao = new pdo('mysql:host=' . HOST . ';dbname=' .
                                     DBNAME, USER, SENHA);
} catch (PDOException $e) {
    echo "Erro: Conexão com banco de dados não foi realizada com sucesso.
     Erro gerado " . $e->getMessage();
}

?>

