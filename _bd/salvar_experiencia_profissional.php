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

    if(isset($_POST["salvar_experiencia"])) {
        $cod_candidato      = $_SESSION['Candidato_Logado'];
        $ep1_empregadora    = limpar($_POST['ep1_empregadora']);
        $ep1_funcao         = limpar($_POST['ep1_funcao']);
        $ep1_data_inicio    = limpar($_POST['ep1_data_inicio']);
        $ep1_data_fim       = limpar($_POST['ep1_data_fim']);
        $ep1_descricao      = limpar($_POST['ep1_descricao']);

        $ep2_empregadora    = limpar($_POST['ep2_empregadora']);
        $ep2_funcao         = limpar($_POST['ep2_funcao']);
        $ep2_data_inicio    = limpar($_POST['ep2_data_inicio']);
        $ep2_data_fim       = limpar($_POST['ep2_data_fim']);
        $ep2_descricao      = limpar($_POST['ep2_descricao']);

        $ep3_empregadora    = limpar($_POST['ep3_empregadora']);
        $ep3_funcao         = limpar($_POST['ep3_funcao']);
        $ep3_data_inicio    = limpar($_POST['ep3_data_inicio']);
        $ep3_data_fim       = limpar($_POST['ep3_data_fim']);
        $ep3_descricao      = limpar($_POST['ep3_descricao']);

        $ep4_empregadora    = limpar($_POST['ep4_empregadora']);
        $ep4_funcao         = limpar($_POST['ep4_funcao']);
        $ep4_data_inicio    = limpar($_POST['ep4_data_inicio']);
        $ep4_data_fim       = limpar($_POST['ep4_data_fim']);
        $ep4_descricao      = limpar($_POST['ep4_descricao']);

        $ep5_empregadora    = limpar($_POST['ep5_empregadora']);
        $ep5_funcao         = limpar($_POST['ep5_funcao']);
        $ep5_data_inicio    = limpar($_POST['ep5_data_inicio']);
        $ep5_data_fim       = limpar($_POST['ep5_data_fim']);
        $ep5_descricao      = limpar($_POST['ep5_descricao']);

        $actualizar = mysqli_query($conexao, "UPDATE experiencia_profissional SET ep1_empregadora = '$ep1_empregadora', ep1_funcao = '$ep1_funcao', ep1_data_inicio = '$ep1_data_inicio', ep1_data_fim = '$ep1_data_fim', ep1_descricao = '$ep1_descricao', ep2_empregadora = '$ep2_empregadora', ep2_funcao = '$ep2_funcao', ep2_data_inicio = '$ep2_data_inicio', ep2_data_fim = '$ep2_data_fim', ep2_descricao = '$ep2_descricao', ep3_empregadora = '$ep3_empregadora', ep3_funcao = '$ep3_funcao', ep3_data_inicio = '$ep3_data_inicio', ep3_data_fim = '$ep3_data_fim', ep3_descricao = '$ep3_descricao', ep4_empregadora = '$ep4_empregadora', ep4_funcao = '$ep4_funcao', ep4_data_inicio = '$ep4_data_inicio', ep4_data_fim = '$ep4_data_fim', ep4_descricao = '$ep4_descricao', ep5_empregadora = '$ep5_empregadora', ep5_funcao = '$ep5_funcao', ep5_data_inicio = '$ep5_data_inicio', ep5_data_fim = '$ep5_data_fim', ep5_descricao = '$ep5_descricao' WHERE cod_candidato = '$cod_candidato'");

        if(!$actualizar) {
            $_SESSION['error'] = "Erro ao editar os dados!";
        } else {
            $_SESSION['success'] = "Dados editados com sucesso!";
        }
    }
    header('Location: ../Perfil_Candidato/');
?>