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

    if(isset($_POST["cadastrar"]) && ($_POST["senha"] == $_POST["confirmacao_senha"])) {
        $nome_empregadora       = limpar($_POST["nome_empregadora"]);
        $descricao              = limpar($_POST["descricao"]);
        $tipo_empresa           = limpar($_POST["tipo_empresa"]);
        $area_actuacao          = limpar($_POST["area_actuacao"]);
        $tipo_industrial        = limpar($_POST["tipo_industrial"]);
        $telefone               = limpar($_POST["telefone"]);
        $email                  = limpar($_POST["email"]);
        $apresentacao           = limpar($_POST["apresentacao"]);
        $localizacao            = limpar($_POST["localizacao"]);
        $usuario                = limpar($_POST["usuario"]);
        $senha                  = limpar($_POST["senha"]);

        $inserir = mysqli_query($conexao, "INSERT INTO empregadora VALUES (DEFAULT, '$nome_empregadora', '$tipo_empresa', '$descricao', '$area_actuacao', '$tipo_industrial', '$localizacao', '$telefone', '$email', '$apresentacao', 0, '$usuario', '$senha', NULL, NULL, NULL)");
        if(!$inserir){
            $_SESSION['error'] = "Erro ao cadastrar a Empregadora!"; 
        } else {
            $_SESSION['success'] = "Cadastro feito com sucesso. Aguarde o administrador da BOM JOBS aceitar o seu cadastro";
        }
    } else {
        $_SESSION['error'] = "Erro! As senhas precisam ser iguais";
    }
    header('Location: ../Cadastro_Empregadora/');
?>