<?php
    //Importação da Base de dados
    require_once("conexao.php");
    session_start();
    $id_candidato = $_SESSION['Candidato_Logado'];
    $arquivo 	  = $_FILES['curriculum']['name'];
    
    //Pasta onde o arquivo vai ser salvo
    $_UP['pasta'] = '../Curriculum/';
    
    //Tamanho máximo do arquivo em Bytes
    $_UP['tamanho'] = 1024*1024*50; //5mb
    
    //Array com a extensões permitidas
    $_UP['extensoes'] = array('pdf');
    
    //Renomeiar
    $_UP['renomeia'] = false;
    
    //Array com os tipos de erros de upload do PHP
    $_UP['erros'][0] = 'Não houve erro';
    $_UP['erros'][1] = 'O arquivo no upload é maior que o limite do PHP';
    $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especificado no HTML';
    $_UP['erros'][3] = 'O arquivo foi carregado parcialmente';
    $_UP['erros'][4] = 'O arquivo não foi carregado';
    
    //Verifica se houve algum erro com o upload. Sem sim, exibe a mensagem do erro
    if($_FILES['curriculum']['error'] != 0){
        die("Não foi possível carregar o curriculum!<br>Erro: ". $_UP['erros'][$_FILES['curriculum']['error']]);
        exit; //Para a execução do script
    }
    
    //Faz a verificação da extensao do arquivo
    $extensao = strtolower(end(explode('.', $_FILES['curriculum']['name'])));
    if(array_search($extensao, $_UP['extensoes']) === false) {		
        echo "
            <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Tecmorf/site_recrutamento/Perfil_Candidato/index.php'>
            <script type=\"text/javascript\">
                alert(\"O curriculum não foi carregado! Extesão inválida.\");
            </script>
        ";
    }
    
    //Faz a verificação do tamanho do arquivo
    else if ($_UP['tamanho'] < $_FILES['curriculum']['size']) {
        echo "
            <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Tecmorf/site_recrutamento/Perfil_Candidato/index.php'>
            <script type=\"text/javascript\">
                alert(\"Arquivo muito grande.\");
            </script>
        ";
    }
    
    //O arquivo passou em todas as verificações, hora de tentar move-lo para a pasta foto
    else {
        //Primeiro verifica se deve trocar o nome do arquivo
        if($UP['renomeia'] == true){
            //Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .pdf
            $nome_final = time().'.pdf';
        }else{
            //mantem o nome original do arquivo
            $nome_final = $_FILES['curriculum']['name'];
        }
        //Verificar se é possivel mover o arquivo para a pasta escolhida
        if(move_uploaded_file($_FILES['curriculum']['tmp_name'], $_UP['pasta']. $nome_final)) {
            //Upload efetuado com sucesso, exibe a mensagem
            $query = mysqli_query($conexao, "UPDATE candidato SET curriculum = '$nome_final' WHERE id_candidato = '$id_candidato'");
            echo "
                <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Tecmorf/site_recrutamento/Perfil_Candidato/index.php'>
                <script type=\"text/javascript\">
                    alert(\"Curriculum carregado com sucesso.\");
                </script>
            ";	
        } else {
            //Upload não efetuado com sucesso, exibe a mensagem
            echo "
                <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Tecmorf/site_recrutamento/Perfil_Candidato/index.php'>
                <script type=\"text/javascript\">
                    alert(\"Erro ao carregar o curriculum.\");
                </script>
            ";
        }
    }
?>