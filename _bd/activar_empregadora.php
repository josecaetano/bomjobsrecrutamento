<?php
    require_once("conexao.php");
    $cod = $_GET['codigo'];
    $actualizar = mysqli_query($conexao, "UPDATE empregadora AS E SET E.status = 1 WHERE id_empregadora = '{$cod}'");
    header('Location: ../Empregadoras/');
?>