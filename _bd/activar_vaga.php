<?php
    session_start();
    require_once("conexao.php");
    $codigo_vaga    = $_POST['codigo'];
    $data_expiracao = $_POST['nova_data'];

    $actualizar = mysqli_query($conexao, "UPDATE vaga SET data_expiracao = '$data_expiracao', status_vaga = 1 WHERE id_vaga = '$codigo_vaga'");
    
    if($actualizar) {
        $_SESSION['success'] = "A vaga foi activa!";
    } else {
        $_SESSION['error'] = "Erro ao activar a vaga";
    }
    
    if (isset($_SESSION['Admin_Logado'])) {
        header('Location: ../Vaga_activa/');
    }
    if (isset($_SESSION['Empregadora_Logada'])) {
        header('Location: ../Painel_Empregadora/');
    }
?>