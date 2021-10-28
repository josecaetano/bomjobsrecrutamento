<?php 
    session_start();
    unset($_SESSION['Candidato_Logado']);
    unset($_SESSION['Empregadora_Logada']);
    session_destroy();
    header('Location: ../');
?>