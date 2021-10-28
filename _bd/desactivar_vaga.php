<?php
    session_start();
    require_once("conexao.php");
    $cod = $_GET['codigo'];
    $actualizar = mysqli_query($conexao, "UPDATE vaga SET status_vaga = 0 WHERE id_vaga = '$cod'");
    
    if($actualizar) {
        if (isset($_SESSION['Admin_Logado'])) {
            header('Location: ../Vaga_activa/');
        }
        if (isset($_SESSION['Empregadora_Logada'])) {
            header('Location: ../Painel_Empregadora/');
        }
    }
?>