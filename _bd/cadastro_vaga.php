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
    if(isset($_POST["cadastrar"])) {
        $cod_empregadora        = $_SESSION['Empregadora_Logada'];
        $nome_vaga              = limpar($_POST['nome_vaga']);
        $industria              = limpar($_POST['industria']);
        $tipo_emprego           = limpar($_POST['tipo_emprego']);
        $num_vagas              = limpar($_POST['num_vagas']);
        $data_expiracao         = limpar($_POST['data_expiracao']);   
        $descricao              = limpar($_POST['descricao']);     
        $data_publicacao        = date("Y-m-d");        
        $titulacao_minima       = limpar($_POST['titulacao_minima']);
        $experiencia            = limpar($_POST['experiencia']);
        $nacionalidade          = limpar($_POST['nacionalidade']);
        $lingua                 = limpar($_POST['lingua']);
        $area                   = limpar($_POST['area']);
        $salario                = limpar($_POST['salario']);
        $aptidoes               = limpar($_POST['aptidoes']);
        $idadeMin               = limpar($_POST['idadeMin']);
        $idadeMax               = limpar($_POST['idadeMax']);
        $provincia              = limpar($_POST['provincia']);
        $municipio              = limpar($_POST['municipio']);
        $genero                 = limpar($_POST['genero']);

        $consult_vaga = mysqli_query($conexao, "SELECT vagas_disponiveis FROM empregadora WHERE id_empregadora = '$cod_empregadora'");
        $numero_de_vagas = mysqli_fetch_array($consult_vaga);
        if($numero_de_vagas['vagas_disponiveis'] > 0) {
            $inserir = mysqli_query($conexao, "INSERT INTO vaga VALUES (DEFAULT, '$cod_empregadora', '$nome_vaga', '$industria', '$tipo_emprego', '$num_vagas', '$data_expiracao', '$descricao', 1, '$data_publicacao', '$titulacao_minima', '$experiencia', '$nacionalidade', '$lingua', '$area', '$salario', '$aptidoes', '$idadeMin', '$idadeMax', '$provincia', '$municipio', '$genero')");
            $n = $numero_de_vagas['vagas_disponiveis'];
            $n--;
            $actualizar = mysqli_query($conexao, "UPDATE empregadora SET vagas_disponiveis = '$n' WHERE id_empregadora = '$cod_empregadora'"); 
            if(!$inserir || !$actualizar) {
                $_SESSION['error'] = "Erro ao cadastrar a vaga!";
            } else {
                $_SESSION['success'] = "Vaga cadastrada com sucesso!";
            }
        } else {
            $_SESSION['error'] = "Já não lhe é permitido publicar vagas. Renove o contrato para poder publicar.";
        }
    } else {
        $_SESSION['error'] = "Erro ao cadastrar a vaga!";
    }
    header('Location: ../Painel_Empregadora/');
?>