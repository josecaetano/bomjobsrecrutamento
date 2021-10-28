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

    if(isset($_POST["salvar_contacto"])) {
        $id_candidato  = $_SESSION['Candidato_Logado'];
        $telefone          = limpar($_POST['telefone']);
        $email     = limpar($_POST['email']);
        
        $inserir = mysqli_query($conexao, " UPDATE candidato SET telefone = '$telefone', email = '$email' WHERE id_candidato = '$id_candidato'");
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