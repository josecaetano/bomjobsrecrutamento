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

    if(isset($_POST["salvar_idioma"])) {
        $id_candidato  = $_SESSION['Candidato_Logado'];
        $lingua1         = limpar($_POST['lingua1']);
        $nivel_lingua1   = limpar($_GET['nivel_lingua1']);
        $lingua2         = limpar($_POST['lingua2']);
        $nivel_lingua2   = limpar($_GET['nivel_lingua2']);
        $lingua3         = limpar($_POST['lingua3']);
        $nivel_lingua3   = limpar($_GET['nivel_lingua3']);
        $lingua4         = limpar($_POST['lingua4']);
        $nivel_lingua4   = limpar($_GET['nivel_lingua4']);
        
        $inserir = mysqli_query($conexao, " UPDATE candidato SET lingua1 = '$lingua1', nivel_lingua1 = '$nivel_lingua1', lingua2 = '$lingua2', nivel_lingua2 = '$nivel_lingua2',  lingua3 = '$lingua3', nivel_lingua3 = '$nivel_lingua3', lingua4 = '$lingua4', nivel_lingua4 = '$nivel_lingua4' WHERE id_candidato = '$id_candidato'");
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