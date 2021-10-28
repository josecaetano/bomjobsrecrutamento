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

    if(isset($_POST["salvar_dadospessoais"])) {
        $id_candidato  = $_SESSION['Candidato_Logado'];
        $nome          = limpar($_POST['nome']);
        $data_nasc     = limpar($_POST['data_nasc']);
        $nacionalidade = limpar($_POST['nacionalidade']);
        $bi            = limpar($_POST['bi']);
        $genero        = limpar($_POST['genero']);
        
        $inserir = mysqli_query($conexao, " UPDATE candidato SET nome = '$nome', data_nasc = '$data_nasc', nacionalidade = '$nacionalidade', bi = '$bi', genero = '$genero' WHERE id_candidato = '$id_candidato'");
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