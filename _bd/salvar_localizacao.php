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

    if(isset($_POST["salvar_localizacao"])) {
        $id_candidato  = $_SESSION['Candidato_Logado'];
        $provincia         = limpar($_POST['provincia']);
        $municipio     = limpar($_POST['municipio']);
        
        $inserir = mysqli_query($conexao, " UPDATE candidato SET provincia = '$provincia', municipio = '$municipio' WHERE id_candidato = '$id_candidato'");
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