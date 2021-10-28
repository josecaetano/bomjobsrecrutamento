<?php
    //Importação da Base de dados
    require_once("conexao.php");
    session_start();
    function limpar($input){
        global $conexao;
        //SQL Inject
        $var = mysqli_escape_string($conexao, $input);
        //XSS
        $var = htmlspecialchars($var);
        return $var;
    }

    if(isset($_POST["salvar-formacao"])) {
        $cod_candidato      = $_SESSION['Candidato_Logado'];
        $fa1_titulo         = limpar($_POST['fa1_titulo']);
        $fa1_instituto      = limpar($_POST['fa1_instituto']);
        $fa1_curso          = limpar($_POST['fa1_curso']);
        $fa2_titulo         = limpar($_POST['fa2_titulo']);
        $fa2_instituto      = limpar($_POST['fa2_instituto']);
        $fa2_curso          = limpar($_POST['fa2_curso']);
        $fa3_titulo         = limpar($_POST['fa3_titulo']);
        $fa3_instituto      = limpar($_POST['fa3_instituto']);
        $fa3_curso          = limpar($_POST['fa3_curso']);
        $fa4_titulo         = limpar($_POST['fa4_titulo']);
        $fa4_instituto      = limpar($_POST['fa4_instituto']);
        $fa4_curso          = limpar($_POST['fa4_curso']);
        $fa5_titulo         = limpar($_POST['fa5_titulo']);
        $fa5_instituto      = limpar($_POST['fa5_instituto']);
        $fa5_curso          = limpar($_POST['fa5_curso']);

        $inserir = mysqli_query($conexao, "UPDATE formacao_academica SET fa1_titulo = '$fa1_titulo', fa1_instituto = '$fa1_instituto', fa1_curso = '$fa1_curso', fa2_titulo = '$fa2_titulo',fa2_instituto = '$fa2_instituto', fa2_curso = '$fa2_curso', fa3_titulo = '$fa3_titulo', fa3_instituto = '$fa3_instituto', fa3_curso = '$fa3_curso', fa4_titulo = '$fa4_titulo', fa4_instituto = '$fa4_instituto', fa4_curso = '$fa4_curso', fa5_titulo = '$fa5_titulo', fa5_instituto = '$fa5_instituto', fa5_curso = '$fa5_curso' WHERE cod_candidato = '$cod_candidato'");
        if(!$inserir){
            $_SESSION['error'] = "Erro ao editar os dados!";
        } else {
            $_SESSION['success'] = "Dados editados com sucesso!";
        }
    } else {
        $_SESSION['error'] = "Erro ao editar os dados!";
    }
    header('Location: ../Perfil_Candidato/');
?>