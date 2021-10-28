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

    if(isset($_POST["enviar"])){
        $id_empregadora         = limpar($_POST["id_empregadora"]);
        $num_vagas              = limpar($_POST["num_vagas"]);
        $data_contrato          = limpar($_POST["data_contrato"]);
        $autorizacao            = limpar($_POST["autorizacao"]);
        
        $inserir = mysqli_query($conexao, "UPDATE empregadora SET vagas_disponiveis = '$num_vagas', data_contrato = '$data_contrato', autorizacao = '$autorizacao' WHERE id_empregadora = '$id_empregadora'");

        if(!$inserir){
            $_SESSION['error'] = "Erro ao fechar o contrato."; 
        } else {
            $_SESSION['success'] = "Contrato feito com sucesso!";
        }
    }
    header('Location: ../Contrato_Empregadora/');
?>