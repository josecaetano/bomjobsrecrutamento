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

    if(isset($_POST["cadastrar"]) && ($_POST["senha"] == $_POST["confirmacao_senha"])){
        $nome_candidato             = limpar($_POST["nome_candidato"]);
        $data_nasc                  = limpar($_POST["data_nasc"]);
        $bi                         = limpar($_POST["bi"]);
        $estado_civil               = limpar($_POST["estado_civil"]);
        $genero                     = limpar($_POST["genero"]);
        $nacionalidade              = limpar($_POST["nacionalidade"]);
        $telefone                   = limpar($_POST["telefone"]);
        $email                      = limpar($_POST["email"]);
        $senha                      = limpar($_POST["senha"]);
        $telefone_emergencia        = limpar($_POST["telefone_emergencia"]);
        $nome_contacto              = limpar($_POST["nome_contacto"]); 
        $relacao_contacto           = limpar($_POST["relacao_contacto"]);
        $empregadora_contacto       = limpar($_POST["empregadora_contacto"]);
        $pretencao_salarial         = limpar($_POST["pretencao_salarial"]);      
        
        $fa1_titulo         = limpar($_POST["fa1_titulo"]);
        $fa1_instituto      = limpar($_POST["fa1_instituto"]);
        $fa1_curso          = limpar($_POST["fa1_curso"]);

        $inserir = mysqli_query($conexao, "INSERT INTO candidato (id_candidato, nome, genero, data_nasc, nacionalidade, estado_civil, bi, telefone, telefone_emergencia1, nome_contacto1, relacao_contacto1, empregadora_contacto1, email, pretencao_salarial, senha) VALUES (DEFAULT, '$nome_candidato', '$genero', '$data_nasc', '$nacionalidade', '$estado_civil', '$bi', '$telefone', '$telefone_emergencia', '$nome_contacto', '$relacao_contacto', '$empregadora_contacto', '$email', '$pretencao_salarial', '$senha')");
        
        if(!$inserir) {
            $_SESSION['error'] = "Erro ao cadastrar o Candidato!";
            header('Location: ../Cadastro_Candidato/');
        } else {
            $consultar = mysqli_query($conexao, "SELECT MAX(id_candidato) AS maior_id FROM candidato");
            $maior_id =  mysqli_fetch_array($consultar);
            $_SESSION["Candidato_Logado"] = $maior_id["maior_id"];
            $cod_candidato = $maior_id["maior_id"];

            $inserir_experiencia = mysqli_query($conexao, "INSERT INTO experiencia_profissional (cod_candidato) VALUES ('$cod_candidato')");
            if($inserir_experiencia) {
                $inserir_formacao = mysqli_query($conexao, "INSERT INTO formacao_academica (cod_candidato, fa1_titulo, fa1_instituto, fa1_curso) VALUES ('$cod_candidato', '$fa1_titulo', '$fa1_instituto', '$fa1_curso')");
                if($inserir_formacao) {
                    header('Location: ../Painel_Candidato/');
                } else {
                    $_SESSION['error'] = "Erro ao cadastrar o Candidato - Formação Acadêmica!";
                    header('Location: ../Cadastro_Candidato/');
                }
            } else {
                $_SESSION['error'] = "Erro ao cadastrar o Candidato - Experiência Profissional!";
                header('Location: ../Cadastro_Candidato/');
            }
        }
    } else {
        $_SESSION['error'] = "Erro! As senhas precisam ser iguais";
        header('Location: ../Cadastro_Candidato/');
    }
?>