<?php 
    //Importação da Base de dados
    require_once("../_bd/conexao.php"); 
    session_start();
    //Controle de segurança
    if (!isset($_SESSION['Candidato_Logado'])) {
        header('Location: ../Login_Candidato/');
    }
    $id_candidato = $_SESSION['Candidato_Logado'];
    $consultar_candidato = mysqli_query($conexao, "SELECT * FROM candidato AS C INNER JOIN experiencia_profissional AS EP ON C.id_candidato = EP.cod_candidato INNER JOIN formacao_academica AS FA ON C.id_candidato = FA.cod_candidato WHERE C.id_candidato = '$id_candidato'");
    $candidato = mysqli_fetch_array($consultar_candidato);
?>
<!doctype html>
<html lang="pt">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- importação do Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <!-- Importação dos Ícones -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- Meu estilo -->
    <link rel="stylesheet" href="../_css/estilo.css">
    <link rel="shortcut icon" href="../_img/favicon.ico" type="image/x-icon">
    <title>Perfil do Candidato | Bom Jobs Recrutamento</title>
    <style>
        section div { padding: 10px; }
    </style>
</head>
<body>
    <!-- Menu - Barra de navegação -->
    <nav class="navbar navbar-expand-sm navbar-dark bg-primeira">
        <div class="container-fluid">
            <a class="navbar-brand" href="../Painel_Candidato/"><img src="../_img/logo-branco.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="../Painel_Candidato/">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="../Minhas_Vagas/">Minhas candidaturas</a></li>
                    <li class="nav-item"><a class="nav-link" href="../Vagas/">Todas vagas disponíveis</a></li>
                    <li class="nav-item"><a class="nav-link active" href="../Perfil_Candidato/">Meu perfil</a></li>
                    <li class="nav-item"> <button class="nav-link btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Minha conta <i class="bi bi-arrow-down"></i></button> </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">Dados da Candidato</h5>
            <hr>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="row">
                <span>Nome: <strong> <?php echo $candidato['nome']; ?> </strong></span> <br>
                <?php 
                    $dataNasc = explode("-", $candidato['data_nasc']);
                    $anoNasc = $dataNasc[0]; $mesNasc = $dataNasc[1]; $diaNasc = $dataNasc[2];
                    $anoAtual = date("Y"); $mesAtual = date("m"); $diaAtual = date("d");
                    $idade = $anoAtual - $anoNasc;
                    if ($mesAtual < $mesNasc){
                        $idade -= 1;
                    } elseif ( ($mesAtual == $mesNasc) && ($diaAtual <= $diaNasc) ){
                        $idade -= 1;
                    }
                ?>
                <span>Idade: <strong><?php echo $idade; ?> anos</span></strong> <br>
                <span>Estado civil: <strong><?php echo $candidato['estado_civil']; ?></strong> </span> <br>
                <span>Nacionalidade: <strong><?php echo $candidato['nacionalidade']; ?></strong> </span> <br>
                <span>Telefone: <strong><?php echo $candidato['telefone']; ?></strong> </span> <br>
                <span>Email: <strong><?php echo $candidato['email']; ?> </span></strong>
            </div>
            <div class="d-grid">
                <a href="../_incluir/logout.php"class="btn btn-danger">Terminar sessão</a>
            </div>
        </div>
    </div>
    <main>
        <!-- Painel-->
        <section class="container pt-2">
            <div class="row mb-2">
                <?php  if(isset($_SESSION['error'])) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php    echo $_SESSION['error']; unset($_SESSION['error']); ?>
                    </div>
                <?php   } ?>
                <?php   if(isset($_SESSION['success'])) { ?>
                    <div class="col-sm-12 alert alert-success alert-dismissible fade show" role="alert">
                        <?php    echo $_SESSION['success']; unset($_SESSION['success']); ?>
                    </div>
                <?php   } ?>
                <!-- LADO ESQUERDO -->
                <div class="col-sm-12 col-md-6 col-lg-4 bg-terceira">
                    <!-- Foto -->
                    <form action="" method="post" class="text-center">
                        <?php if($candidato['foto'] == "" || $candidato['foto'] == null){ ?>
                            <img src="../_img/foto-user.png" alt="" class="img-fluid rounded-circle">
                        <?php } else { ?>
                            <img src="../fotos-dos-candidatos/<?php echo $candidato['foto'] ?>" alt="" class="rounded-circle" width="220px" height="220px">
                        <?php } ?>
                    </form>
                    <!-- Nome completo -->
                    <h2 class="text-center py-1"><?php echo $candidato['nome']; ?></h2><hr>
                    <!-- Dados Pessoais -->
                    <div class="d-flex justify-content-between">
                        <h3 class="h6 text-primeira pt-2">DADOS PESSOAIS</h3>
                        <button class="btn btn-primeira" data-bs-toggle="modal" data-bs-target="#staticBackdropOPessoias" >Editar</button>
                    </div>
                    <p><?php echo $candidato['genero'] ?>, <?php echo $idade ?> anos de idade</p>
                    <p><strong>Data de nascimento:</strong> <?php echo $candidato['data_nasc']; ?></p>
                    <p><strong>Nacionalidade:</strong> <?php echo $candidato['nacionalidade']; ?></p>
                    <p>BI Nº <?php echo $candidato['bi']?></p>        
                    <!-- Contactos -->
                    <hr>
                    <div class="d-flex justify-content-between bg-terceira">
                        <h3 class="h6 pt-2">CONTACTOS</h3>
                        <button class="btn btn-primeira" data-bs-toggle="modal" data-bs-target="#staticBackdropOContactos">Editar</button>
                    </div>
                    <p><strong>Telefone:</strong> <?php echo $candidato['telefone']; ?></p>
                    <p><strong>Email:</strong> <?php echo $candidato['email']; ?></p>
                    <!-- Localização -->
                    <hr>
                    <div class="d-flex justify-content-between bg-terceira">
                        <h3 class="h6 pt-2">LOCALIZAÇÃO</h3>
                        <button class="btn btn-primeira" data-bs-toggle="modal" data-bs-target="#staticBackdropOLocalizacao">Editar</button>
                    </div>
                    <p><strong>Província:</strong> <?php echo $candidato['provincia']; ?></p>
                    <p><strong>Município:</strong> <?php echo $candidato['municipio']; ?></p>
                    <!-- Línguas -->
                    <hr>
                    <div class="d-flex justify-content-between bg-terceira">
                        <h3 class="h6 pt-2">LÍNGUAS</h3>
                        <button class="btn btn-primeira" data-bs-toggle="modal" data-bs-target="#staticBackdropOLinguas">Editar</button>
                    </div>
                    <p><?php echo $candidato['lingua1']; ?> | <?php echo $candidato['nivel_lingua1']; ?></p>
                    <p><?php echo $candidato['lingua2']; ?> | <?php echo $candidato['nivel_lingua2']; ?></p>
                    <p><?php echo $candidato['lingua3']; ?> | <?php echo $candidato['nivel_lingua3']; ?></p>
                    <p><?php echo $candidato['lingua4']; ?> | <?php echo $candidato['nivel_lingua4']; ?></p>
                    
                    <h3 class="h6">CURRICULUM</h2>
                    <small>Atenção: Carregaga um currículum no formato PDF, com um tamanho menor que 5MB.</small>
                    <form action="../_bd/carregar_curriculum.php" method="post" enctype="multipart/form-data" class="pt-1">
                        <input type="file" name="curriculum" id="curriculum">
                        <input type="submit" value="Carregar o curriculum" class="btn btn-primeira mt-1">
                    </form>
                </div>
                <!-- LADO DIREITO -->    
                <div class="col-sm-12 col-md-6 col-lg-8 pt-0">
                    <div class="d-flex justify-content-between bg-terceira">
                        <h3 class="h5 text-primeira">FORMAÇÃO ACADÊMICA</h3>
                        <button class="btn btn-primeira" data-bs-toggle="modal" data-bs-target="#staticBackdropFormAcademica">Editar</button>
                    </div>
                    <!-- 1ª Formação Acadêmica -->
                    <div class="row">
                        <div class="col-sm-12 col-lg-3">
                            <p><strong>Título obtido</strong> <br> <?php echo $candidato['fa1_titulo']; ?></p>
                        </div>
                        <div class="col-sm-12 col-lg-4">
                            <p><strong>Nome da Instituição</strong> <br> <?php echo $candidato['fa1_instituto']; ?></p>
                        </div>
                        <div class="col-sm-12 col-lg-5">
                            <p><strong>Curso</strong> <br> <?php echo $candidato['fa1_curso']; ?></p>
                        </div>
                    </div>
                    <!-- 2ª Formação Acadêmica -->
                    <?php if($candidato['fa2_instituto'] != "") { ?>
                    <div class="row">
                        <div class="col-sm-12 col-lg-3">
                            <p><strong>Título obtido</strong> <br> <?php echo $candidato['fa2_titulo']; ?></p>
                        </div>
                        <div class="col-sm-12 col-lg-4">
                            <p><strong>Nome da Instituição</strong> <br> <?php echo $candidato['fa2_instituto']; ?></p>
                        </div>
                        <div class="col-sm-12 col-lg-5">
                            <p><strong>Curso</strong> <br> <?php echo $candidato['fa2_curso']; ?></p>
                        </div>
                    </div>  
                    <?php } ?>                  
                    <!-- 3ª Formação Acadêmica -->
                    <?php if($candidato['fa3_instituto'] != "") { ?>
                    <div class="row">
                        <div class="col-sm-12 col-lg-3">
                            <p><strong>Título obtido</strong> <br> <?php echo $candidato['fa3_titulo']; ?></p>
                        </div>
                        <div class="col-sm-12 col-lg-4">
                            <p><strong>Nome da Instituição</strong> <br> <?php echo $candidato['fa3_instituto']; ?></p>
                        </div>
                        <div class="col-sm-12 col-lg-5">
                            <p><strong>Curso</strong> <br> <?php echo $candidato['fa3_curso']; ?></p>
                        </div>
                    </div>
                    <?php } ?>
                    <!-- 4ª Formação Acadêmica -->
                    <?php if($candidato['fa4_instituto'] != "") { ?>
                    <div class="row">
                        <div class="col-sm-12 col-lg-3">
                            <p><strong>Título obtido</strong> <br> <?php echo $candidato['fa4_titulo']; ?></p>
                        </div>
                        <div class="col-sm-12 col-lg-4">
                            <p><strong>Nome da Instituição</strong> <br> <?php echo $candidato['fa4_instituto']; ?></p>
                        </div>
                        <div class="col-sm-12 col-lg-5">
                            <p><strong>Curso</strong> <br> <?php echo $candidato['fa4_curso']; ?></p>
                        </div>
                    </div>
                    <?php } ?>
                    <!-- 5ª Formação Acadêmica -->
                    <?php if($candidato['fa5_instituto'] != "") { ?>
                    <div class="row">
                        <div class="col-sm-12 col-lg-3">
                            <p><strong>Título obtido</strong> <br> <?php echo $candidato['fa5_titulo']; ?></p>
                        </div>
                        <div class="col-sm-12 col-lg-4">
                            <p><strong>Nome da Instituição</strong> <br> <?php echo $candidato['fa5_instituto']; ?></p>
                        </div>
                        <div class="col-sm-12 col-lg-5">
                            <p><strong>Curso</strong> <br> <?php echo $candidato['fa5_curso']; ?></p>
                        </div>
                    </div>
                    <?php } ?>
 
                    <!-- Experiências Profissionais  -->
                    <div class="d-flex justify-content-between bg-terceira">
                        <h3 class="h5 text-primeira">EXPERIÊNCIA PROFISSIONAL</h3>
                        <button class="btn btn-primeira"data-bs-toggle="modal" data-bs-target="#staticBackdropEspProfissional">Editar</button>
                    </div>       
                    <!-- 1ª Experiência Profissional  -->
                    <?php 
                    if($candidato['ep1_data_inicio'] != "" && $candidato['ep1_data_inicio'] != null) {
                        $dataInicio = explode("-", $candidato['ep1_data_inicio']);
                        $dataFim    = explode("-", $candidato['ep1_data_fim']);

                        $anoInicio = $dataInicio[0]; $mesInicio = $dataInicio[1]; $diaInicio = $dataInicio[2];
                        $anoFim = $dataFim[0]; $mesFim = $dataFim[1]; $diaFim = $dataFim[2];
                        $tempo1_ano = $anoFim - $anoInicio;
                        if ($mesFim < $mesInicio) {
                            $tempo1_ano -= 1;
                        } elseif ( ($mesFim == $mesInicio) && ($diaFim <= $diaInicio) ) {
                            $tempo1_ano -= 1;
                        }

                        if($tempo1_ano == 0) { 
                            $tempo1_mes = $mesFim - $mesInicio;
                            if($tempo1_mes < 0) { $tempo1_mes = $tempo1_mes * (-1); } 
                        }
                    }                        
                    ?>
                    <div class="row">
                        <div class="col-sm-12 col-lg-4">
                            <p><strong>Tempo de trabalho <br> </strong><?php if(isset($tempo1_ano)){ if($tempo1_ano == 0) { echo $tempo1_mes ." mes(es)"; } else { echo $tempo1_ano ." ano(s)"; }} ?></p>
                        </div>
                        <div class="col-sm-12 col-lg-4">
                            <p><strong>Nome da Empresa</strong> <br> <?php echo $candidato['ep1_empregadora']; ?></p>
                        </div>
                        <div class="col-sm-12 col-lg-4">
                            <p><strong>Função</strong> <br> <?php echo $candidato['ep1_funcao']; ?></p>
                        </div>
                        <div class="col-sm-12">
                            <p><strong>Descrição</strong> <br> <?php echo $candidato['ep1_descricao']; ?></p>
                        </div>
                    </div>
                    <!-- 2ª Experiência Profissional  -->
                    <?php 
                    if($candidato['ep2_empregadora'] != "") {
                        $dataInicio2 = explode("-", $candidato['ep2_data_inicio']);
                        $dataFim2    = explode("-", $candidato['ep2_data_fim']);
                        $anoInicio2 = $dataInicio2[0]; $mesInicio2 = $dataInicio2[1]; $diaInicio2 = $dataInicio2[2];
                        $anoFim2 = $dataFim2[0]; $mesFim2 = $dataFim2[1]; $diaFim2 = $dataFim2[2];
                        $tempo2_ano = $anoFim2 - $anoInicio2;
                        if ($mesFim2 < $mesInicio2) {
                            $tempo2_ano -= 1;
                        } elseif ( ($mesFim2 == $mesInicio2) && ($diaFim2 <= $diaInicio2) ) {
                            $tempo2_ano -= 1;
                        }
                        if($tempo2_ano == 0) { 
                            $tempo2_mes = $mesFim2 - $mesInicio2;
                            if($tempo2_mes < 0) { 
                                $tempo2_mes = $tempo2_mes * (-1); 
                            } 
                        }                        
                    ?>
                    <div class="row">
                        <hr>
                        <div class="col-sm-12 col-lg-4">
                            <p><strong>Tempo de trabalho <br> </strong><?php if($tempo2_ano == 0) { echo $tempo2_mes ." mes(es)"; } else { echo $tempo2_ano ." ano(s)"; }?></p>
                        </div>
                        <div class="col-sm-12 col-lg-4">
                            <p><strong>Nome da Empresa</strong> <br> <?php echo $candidato['ep2_empregadora']; ?></p>
                        </div>
                        <div class="col-sm-12 col-lg-4">
                            <p><strong>Função</strong> <br> <?php echo $candidato['ep2_funcao']; ?></p>
                        </div>
                        <div class="col-sm-12">
                            <p><strong>Descrição</strong> <br> <?php echo $candidato['ep2_descricao']; ?></p>
                        </div>
                    </div>
                    <?php } ?>
                    <!-- 3ª Experiência Profissional  -->
                    <?php 
                    if($candidato['ep3_empregadora'] != "") {
                        $dataInicio3 = explode("-", $candidato['ep3_data_inicio']);
                        $dataFim3    = explode("-", $candidato['ep3_data_fim']);
                        $anoInicio3 = $dataInicio3[0]; $mesInicio3 = $dataInicio3[1]; $diaInicio3 = $dataInicio3[2];
                        $anoFim3 = $dataFim3[0]; $mesFim3 = $dataFim3[1]; $diaFim3 = $dataFim3[2];
                        $tempo3_ano = $anoFim3 - $anoInicio3;
                        if ($mesFim3 < $mesInicio3) {
                            $tempo3_ano -= 1;
                        } elseif ( ($mesFim3 == $mesInicio3) && ($diaFim3 <= $diaInicio3) ) {
                            $tempo3_ano -= 1;
                        }
                        if($tempo3_ano == 0) { 
                            $tempo3_mes = $mesFim3 - $mesInicio3;
                            if($tempo3_mes < 0) { 
                                $tempo3_mes = $tempo3_mes * (-1); 
                            } 
                        }                        
                    ?>
                    <div class="row">
                        <hr>
                        <div class="col-sm-12 col-lg-4">
                            <p><strong>Tempo de trabalho <br> </strong><?php if($tempo3_ano == 0) { echo $tempo3_mes ." mes(es)"; } else { echo $tempo3_ano ." ano(s)"; }?></p>
                        </div>
                        <div class="col-sm-12 col-lg-4">
                            <p><strong>Nome da Empresa</strong> <br> <?php echo $candidato['ep3_empregadora']; ?></p>
                        </div>
                        <div class="col-sm-12 col-lg-4">
                            <p><strong>Função</strong> <br> <?php echo $candidato['ep3_funcao']; ?></p>
                        </div>
                        <div class="col-sm-12">
                            <p><strong>Descrição</strong> <br> <?php echo $candidato['ep3_descricao']; ?></p>
                        </div>
                    </div>
                    <?php } ?>
                    <!-- 4ª Experiência Profissional  -->
                    <?php 
                    if($candidato['ep4_empregadora'] != "") {
                        $dataInicio4 = explode("-", $candidato['ep4_data_inicio']);
                        $dataFim4    = explode("-", $candidato['ep4_data_fim']);
                        $anoInicio4 = $dataInicio4[0]; $mesInicio4 = $dataInicio4[1]; $diaInicio4 = $dataInicio4[2];
                        $anoFim4 = $dataFim4[0]; $mesFim4 = $dataFim4[1]; $diaFim4 = $dataFim4[2];
                        $tempo4_ano = $anoFim4 - $anoInicio4;
                        if ($mesFim4 < $mesInicio4) {
                            $tempo4_ano -= 1;
                        } elseif ( ($mesFim4 == $mesInicio4) && ($diaFim4 <= $diaInicio4) ) {
                            $tempo4_ano -= 1;
                        }
                        if($tempo4_ano == 0) { 
                            $tempo4_mes = $mesFim4 - $mesInicio4;
                            if($tempo4_mes < 0) { 
                                $tempo4_mes = $tempo4_mes * (-1); 
                            } 
                        }                        
                    ?>
                    <div class="row">
                        <hr>
                        <div class="col-sm-12 col-lg-4">
                            <p><strong>Tempo de trabalho <br> </strong><?php if($tempo4_ano == 0) { echo $tempo4_mes ." mes(es)"; } else { echo $tempo4_ano ." ano(s)"; }?></p>
                        </div>
                        <div class="col-sm-12 col-lg-4">
                            <p><strong>Nome da Empresa</strong> <br> <?php echo $candidato['ep4_empregadora']; ?></p>
                        </div>
                        <div class="col-sm-12 col-lg-4">
                            <p><strong>Função</strong> <br> <?php echo $candidato['ep4_funcao']; ?></p>
                        </div>
                        <div class="col-sm-12">
                            <p><strong>Descrição</strong> <br> <?php echo $candidato['ep4_descricao']; ?></p>
                        </div>
                    </div>
                    <?php } ?>
                        
                    <!-- 5ª Experiência Profissional  -->
                    <?php 
                    if($candidato['ep5_empregadora'] != "") {
                        $dataInicio5 = explode("-", $candidato['ep5_data_inicio']);
                        $dataFim5    = explode("-", $candidato['ep5_data_fim']);
                        $anoInicio5 = $dataInicio5[0]; $mesInicio5 = $dataInicio5[1]; $diaInicio5 = $dataInicio5[2];
                        $anoFim5 = $dataFim5[0]; $mesFim5 = $dataFim3[1]; $diaFim5 = $dataFim5[2];
                        $tempo5_ano = $anoFim5 - $anoInicio5;
                        if ($mesFim5 < $mesInicio5) {
                            $tempo5_ano -= 1;
                        } elseif ( ($mesFim5 == $mesInicio5) && ($diaFim5 <= $diaInicio5) ) {
                            $tempo5_ano -= 1;
                        }
                        if($tempo5_ano == 0) { 
                            $tempo5_mes = $mesFim5 - $mesInicio5;
                            if($tempo5_mes < 0) { 
                                $tempo5_mes = $tempo5_mes * (-1); 
                            } 
                        }                        
                    ?>
                    <div class="row">
                        <hr>
                        <div class="col-sm-12 col-lg-4">
                            <p><strong>Tempo de trabalho <br> </strong><?php if($tempo5_ano == 0) { echo $tempo5_mes ." mes(es)"; } else { echo $tempo5_ano ." ano(s)"; }?></p>
                        </div>
                        <div class="col-sm-12 col-lg-4">
                            <p><strong>Nome da Empresa</strong> <br> <?php echo $candidato['ep5_empregadora']; ?></p>
                        </div>
                        <div class="col-sm-12 col-lg-4">
                            <p><strong>Função</strong> <br> <?php echo $candidato['ep5_funcao']; ?></p>
                        </div>
                        <div class="col-sm-12">
                            <p><strong>Descrição</strong> <br> <?php echo $candidato['ep5_descricao']; ?></p>
                        </div>
                    </div>
                    <?php } ?>

                    <!-- Contacto de Emergência -->
                    <div class="col-sm-12 col-md-6 col-lg-12 pty-2">
                        <div class="d-flex justify-content-between bg-terceira">
                        <h3 class="h5 text-primeira">CONTACTO DE EMERGÊNCIA</h3>
                            <button class="btn btn-primeira" data-bs-toggle="modal" data-bs-target="#staticBackdropEmergencia">Editar</button>
                        </div>
                    </div>
                    <!-- 1º Contacto de Emergência -->
                    <div class="row">
                        <div class="col-sm-12 col-lg-3 my-2">
                            <label for="" class="form-label">Nome de contacto</label>
                            <p><?php echo $candidato['nome_contacto1']; ?></p>
                        </div>
                        <div class="col-sm-12 col-lg-3 my-2">
                            <label for="" class="form-label">Telefone</label>
                            <p><?php echo $candidato['telefone_emergencia1']; ?></p>
                        </div>
                        <div class="col-sm-12 col-lg-3 my-2">
                            <label for="" class="form-label">Empregadora</label>
                            <p><?php echo $candidato['empregadora_contacto1']; ?></p>
                        </div>
                        <div class="col-sm-12 col-lg-2 my-2">
                            <label for="" class="form-label">Relação</label>
                            <p><?php echo $candidato['relacao_contacto1']; ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class ="row">
                        <!-- Mais um contacto de emergência -->
                        <div class="col-sm-12 col-lg-3 my-2">
                            <label for="" class="form-label">Nome do contacto</label>
                            <p><?php echo $candidato['nome_contacto2']; ?></p>
                        </div>
                        <div class="col-sm-12 col-lg-3 my-2">
                            <label for="" class="form-label">Telefone</label>
                            <p><?php echo $candidato['telefone_emergencia2']; ?></p>
                        </div>
                        <div class="col-sm-12 col-lg-3 my-2">
                            <label for="" class="form-label">Empregadora</label>
                            <p><?php echo $candidato['empregadora_contacto2']; ?></p>
                        </div>
                        <div class="col-sm-12 col-lg-2 my-2">
                            <label for="" class="form-label">Relação</label>
                            <p><?php echo $candidato['relacao_contacto2']; ?></p>
                        </div>
                    </div>  
                    <div class="row">  
                        <!-- Objectivos -->
                        <div class="col-sm-12 col-md-6 col-lg-12 pt-0">
                            <div class="d-flex justify-content-between bg-terceira">
                                <h3 class="h5 text-primeira">OBJECTIVOS</h3>
                                <button class="btn btn-primeira" data-bs-toggle="modal" data-bs-target="#staticBackdropObjectivo">Editar</button>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-12">
                            <p><?php echo $candidato['objectivos']; ?></p>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- Modal Formação Academica  -->
        <div class="modal fade" id="staticBackdropFormAcademica" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropAcademica" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="../_bd/salvar_formacao_academica.php" method="post" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropAcademica">FORMAÇÃO ACADÊMICA</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body row">
                        <div class="row">
                            <div class="col-sm-12 col-lg-3">
                                <label for="fa1_titulo" class="form-label">Título obtido</label>
                                <select name="fa1_titulo" id="fa1_titulo" class="form-select">
                                <?php if($candidato['fa1_titulo'] == "Ensino Básico") { ?>
                                    <option selected>Ensino Básico</option>
                                <?php } else { ?>
                                    <option value="Ensino Básico">Ensino Básico</option>
                                <?php } ?>
                                <?php if($candidato['fa1_titulo'] == "Ensino Médio") { ?>
                                    <option selected>Ensino Médio</option>
                                <?php } else { ?>
                                    <option value="Ensino Médio">Ensino Médio</option>
                                <?php } ?>
                                <?php if($candidato['fa1_titulo'] == "Universitário") { ?>
                                    <option selected>Universitário</option>
                                <?php } else { ?>
                                    <option value="Universitário">Universitário</option>
                                <?php } ?>
                                <?php if($candidato['fa1_titulo'] == "Licenciatura") { ?>
                                    <option selected>Licenciatura</option>
                                <?php } else { ?>
                                    <option value="Licenciatura">Licenciatura</option>
                                <?php } ?> 
                                <?php if($candidato['fa1_titulo'] == "Curso Profissional") { ?>
                                    <option selected>Curso Profissional</option>
                                <?php } else { ?>
                                    <option value="Curso Profissional">Curso Profissional</option>
                                <?php } ?>                                       
                                </select>
                            </div>
                            <div class="col-sm-12 col-lg-4">
                                <label for="fa1_instituto" class="form-label">Nome da Instituição</label>
                                <input type="text" class="form-control" id="fa1_instituto" name="fa1_instituto" placeholder="Nome da Instituição onde fez ou faz o Ensino Médio" value="<?php echo $candidato['fa1_instituto']; ?>">
                            </div>
                            <div class="col-sm-12 col-lg-4">
                                <label for="fa1_curso" class="form-label">Curso</label>
                                <input type="text" class="form-control" id="fa1_curso" name="fa1_curso" value="<?php echo $candidato['fa1_curso']; ?>">
                            </div>
                            <!-- Botão que chama a 2ª Formação Acadêmica -->
                            <div class="col-sm-12 col-lg-1 pt-4">
                                <button class="col btn btn-primeira" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAcademia2" aria-expanded="false" aria-controls="collapseAcademia2">+</button>
                            </div>
                        </div>
                        <!-- Formação Acadêmica 2 - Caso não esteja preenchido -->
                        <?php if($candidato['fa2_instituto'] == "") { ?>
                        <div class="collapse row pt-1" id="collapseAcademia2">
                            <div class="col-sm-12 col-lg-3">
                                <label for="fa2_titulo" class="form-label">Título obtido</label>
                                <select name="fa2_titulo" id="fa2_titulo" class="form-select">
                                <?php if($candidato['fa2_titulo'] == "Ensino Básico") { ?>
                                    <option selected>Ensino Básico</option>
                                <?php } else { ?>
                                    <option value="Ensino Básico">Ensino Básico</option>
                                <?php } ?>
                                <?php if($candidato['fa2_titulo'] == "Ensino Médio") { ?>
                                    <option selected>Ensino Médio</option>
                                <?php } else { ?>
                                    <option value="Ensino Médio">Ensino Médio</option>
                                <?php } ?>
                                <?php if($candidato['fa2_titulo'] == "Universitário") { ?>
                                    <option selected>Universitário</option>
                                <?php } else { ?>
                                    <option value="Universitário">Universitário</option>
                                <?php } ?>
                                <?php if($candidato['fa2_titulo'] == "Licenciatura") { ?>
                                    <option selected>Licenciatura</option>
                                <?php } else { ?>
                                    <option value="Licenciatura">Licenciatura</option>
                                <?php } ?> 
                                <?php if($candidato['fa2_titulo'] == "Curso Profissional") { ?>
                                    <option selected>Curso Profissional</option>
                                <?php } else { ?>
                                    <option value="Curso Profissional">Curso Profissional</option>
                                <?php } ?>                                      
                                </select>
                            </div>
                            <div class="col-sm-12 col-lg-4">
                                <label for="fa2_instituto" class="form-label">Nome da Instituição</label>
                                <input type="text" class="form-control" id="fa2_instituto" name="fa2_instituto" placeholder="Nome da Instituição onde fez ou faz o Ensino Médio" value="<?php echo $candidato['fa2_instituto']; ?>">
                            </div>
                            <div class="col-sm-12 col-lg-4">
                                <label for="fa2_curso" class="form-label">Curso</label>
                                <input type="text" class="form-control" id="fa2_curso" name="fa2_curso" value="<?php echo $candidato['fa2_curso']; ?>">
                            </div>
                            <!-- Botão que chama a 3ª Formação Acadêmica -->
                            <div class="col-sm-12 col-lg-1 pt-4">
                                <button class="btn btn-primeira" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAcademia3" aria-expanded="false" aria-controls="collapseAcademia3">+</button>
                            </div>
                        </div>
                        <?php } else { ?>
                        <!-- Formação Acadêmica 2 - Caso esteja preenchido -->
                        <div class="collapse show row pt-1" id="collapseAcademia2">
                            <div class="col-sm-12 col-lg-3">
                                <label for="fa2_titulo" class="form-label">Título obtido</label>
                                <select name="fa2_titulo" id="fa2_titulo" class="form-select">
                                <?php if($candidato['fa2_titulo'] == "Ensino Básico") { ?>
                                    <option selected>Ensino Básico</option>
                                <?php } else { ?>
                                    <option value="Ensino Básico">Ensino Básico</option>
                                <?php } ?>
                                <?php if($candidato['fa2_titulo'] == "Ensino Médio") { ?>
                                    <option selected>Ensino Médio</option>
                                <?php } else { ?>
                                    <option value="Ensino Médio">Ensino Médio</option>
                                <?php } ?>
                                <?php if($candidato['fa2_titulo'] == "Universitário") { ?>
                                    <option selected>Universitário</option>
                                <?php } else { ?>
                                    <option value="Universitário">Universitário</option>
                                <?php } ?>
                                <?php if($candidato['fa2_titulo'] == "Licenciatura") { ?>
                                    <option selected>Licenciatura</option>
                                <?php } else { ?>
                                    <option value="Licenciatura">Licenciatura</option>
                                <?php } ?> 
                                <?php if($candidato['fa2_titulo'] == "Curso Profissional") { ?>
                                    <option selected>Curso Profissional</option>
                                <?php } else { ?>
                                    <option value="Curso Profissional">Curso Profissional</option>
                                <?php } ?>                                       
                                </select>
                            </div>
                            <div class="col-sm-12 col-lg-4">
                                <label for="fa2_instituto" class="form-label">Nome da Instituição</label>
                                <input type="text" class="form-control" id="fa2_instituto" name="fa2_instituto" placeholder="Nome da Instituição onde fez ou faz o Ensino Médio" value="<?php echo $candidato['fa2_instituto']; ?>">
                            </div>
                            <div class="col-sm-12 col-lg-4">
                                <label for="fa2_curso" class="form-label">Curso</label>
                                <input type="text" class="form-control" id="fa2_curso" name="fa2_curso" value="<?php echo $candidato['fa2_curso']; ?>">
                            </div>
                            <!-- Botão que chama a 3ª Formação Acadêmica -->
                            <div class="col-sm-12 col-lg-1 pt-4">
                                <button class="btn btn-primeira" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAcademia3" aria-expanded="false" aria-controls="collapseAcademia3">+</button>
                            </div>
                        </div>
                        <?php } ?>

                        <!-- Formação Acadêmica 3 - Caso não esteja preenchido -->
                        <?php if($candidato['fa3_instituto'] == "") { ?>
                        <div class="collapse row pt-1" id="collapseAcademia3">
                            <div class="col-sm-12 col-lg-3">
                                <label for="fa3_titulo" class="form-label">Título obtido</label>
                                <select name="fa3_titulo" id="fa3_titulo" class="form-select">
                                <?php if($candidato['fa3_titulo'] == "Ensino Básico") { ?>
                                    <option selected>Ensino Básico</option>
                                <?php } else { ?>
                                    <option value="Ensino Básico">Ensino Básico</option>
                                <?php } ?>
                                <?php if($candidato['fa3_titulo'] == "Ensino Médio") { ?>
                                    <option selected>Ensino Médio</option>
                                <?php } else { ?>
                                    <option value="Ensino Médio">Ensino Médio</option>
                                <?php } ?>
                                <?php if($candidato['fa3_titulo'] == "Universitário") { ?>
                                    <option selected>Universitário</option>
                                <?php } else { ?>
                                    <option value="Universitário">Universitário</option>
                                <?php } ?>
                                <?php if($candidato['fa3_titulo'] == "Licenciatura") { ?>
                                    <option selected>Licenciatura</option>
                                <?php } else { ?>
                                    <option value="Licenciatura">Licenciatura</option>
                                <?php } ?>   
                                <?php if($candidato['fa3_titulo'] == "Curso Profissional") { ?>
                                    <option selected>Curso Profissional</option>
                                <?php } else { ?>
                                    <option value="Curso Profissional">Curso Profissional</option>
                                <?php } ?>                                     
                                </select>
                            </div>
                            <div class="col-sm-12 col-lg-4">
                                <label for="fa3_instituto" class="form-label">Nome da Instituição</label>
                                <input type="text" class="form-control" id="fa3_instituto" name="fa3_instituto" placeholder="Nome da Instituição onde fez ou faz o Ensino Médio" value="<?php echo $candidato['fa3_instituto']; ?>">
                            </div>
                            <div class="col-sm-12 col-lg-4">
                                <label for="fa3_curso" class="form-label">Curso</label>
                                <input type="text" class="form-control" id="fa3_curso" name="fa3_curso" value="<?php echo $candidato['fa3_curso']; ?>">
                            </div>
                            <!-- Botão que chama a 4ª Formação Acadêmica -->
                            <div class="col-sm-12 col-lg-1 pt-4">
                                <button class="btn btn-primeira" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAcademia4" aria-expanded="false" aria-controls="collapseAcademia4">+</button>
                            </div>
                        </div>
                        <?php } else { ?>
                        <!-- Formação Acadêmica 3 - Caso esteja preenchido -->
                        <div class="collapse show row pt-1" id="collapseAcademia3">
                            <div class="col-sm-12 col-lg-3">
                                <label for="fa3_titulo" class="form-label">Título obtido</label>
                                <select name="fa3_titulo" id="fa3_titulo" class="form-select">
                                <?php if($candidato['fa3_titulo'] == "Ensino Básico") { ?>
                                    <option selected>Ensino Básico</option>
                                <?php } else { ?>
                                    <option value="Ensino Básico">Ensino Básico</option>
                                <?php } ?>
                                <?php if($candidato['fa3_titulo'] == "Ensino Médio") { ?>
                                    <option selected>Ensino Médio</option>
                                <?php } else { ?>
                                    <option value="Ensino Médio">Ensino Médio</option>
                                <?php } ?>
                                <?php if($candidato['fa3_titulo'] == "Universitário") { ?>
                                    <option selected>Universitário</option>
                                <?php } else { ?>
                                    <option value="Universitário">Universitário</option>
                                <?php } ?>
                                <?php if($candidato['fa3_titulo'] == "Licenciatura") { ?>
                                    <option selected>Licenciatura</option>
                                <?php } else { ?>
                                    <option value="Licenciatura">Licenciatura</option>
                                <?php } ?> 
                                <?php if($candidato['fa3_titulo'] == "Curso Profissional") { ?>
                                    <option selected>Curso Profissional</option>
                                <?php } else { ?>
                                    <option value="Curso Profissional">Curso Profissional</option>
                                <?php } ?>                                       
                                </select>
                            </div>
                            <div class="col-sm-12 col-lg-4">
                                <label for="fa3_instituto" class="form-label">Nome da Instituição</label>
                                <input type="text" class="form-control" id="fa3_instituto" name="fa3_instituto" placeholder="Nome da Instituição onde fez ou faz o Ensino Médio" value="<?php echo $candidato['fa3_instituto']; ?>">
                            </div>
                            <div class="col-sm-12 col-lg-4">
                                <label for="fa3_curso" class="form-label">Curso</label>
                                <input type="text" class="form-control" id="fa3_curso" name="fa3_curso" value="<?php echo $candidato['fa3_curso']; ?>">
                            </div>
                            <!-- Botão que chama a 4ª Formação Acadêmica -->
                            <div class="col-sm-12 col-lg-1 pt-4">
                                <button class="btn btn-primeira" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAcademia4" aria-expanded="false" aria-controls="collapseAcademia4">+</button>
                            </div>
                        </div>
                        <?php } ?>

                        <!-- Formação Acadêmica 4 - Caso não esteja preenchido -->
                        <?php if($candidato['fa4_instituto'] == "" && $candidato['fa4_curso'] == "") { ?>
                        <div class="collapse row pt-1" id="collapseAcademia4">
                            <div class="col-sm-12 col-lg-3">
                                <label for="fa4_titulo" class="form-label">Título obtido</label>
                                <select name="fa4_titulo" id="fa4_titulo" class="form-select">
                                <?php if($candidato['fa4_titulo'] == "Ensino Básico") { ?>
                                    <option selected>Ensino Básico</option>
                                <?php } else { ?>
                                    <option value="Ensino Básico">Ensino Básico</option>
                                <?php } ?>
                                <?php if($candidato['fa4_titulo'] == "Ensino Médio") { ?>
                                    <option selected>Ensino Médio</option>
                                <?php } else { ?>
                                    <option value="Ensino Médio">Ensino Médio</option>
                                <?php } ?>
                                <?php if($candidato['fa4_titulo'] == "Universitário") { ?>
                                    <option selected>Universitário</option>
                                <?php } else { ?>
                                    <option value="Universitário">Universitário</option>
                                <?php } ?>
                                <?php if($candidato['fa4_titulo'] == "Licenciatura") { ?>
                                    <option selected>Licenciatura</option>
                                <?php } else { ?>
                                    <option value="Licenciatura">Licenciatura</option>
                                <?php } ?> 
                                <?php if($candidato['fa4_titulo'] == "Curso Profissional") { ?>
                                    <option selected>Curso Profissional</option>
                                <?php } else { ?>
                                    <option value="Curso Profissional">Curso Profissional</option>
                                <?php } ?>                                      
                                </select>
                            </div>
                            <div class="col-sm-12 col-lg-4">
                                <label for="fa4_instituto" class="form-label">Nome da Instituição</label>
                                <input type="text" class="form-control" id="fa4_instituto" name="fa4_instituto" placeholder="Nome da Instituição onde fez ou faz o Ensino Médio" value="<?php echo $candidato['fa4_instituto']; ?>">
                            </div>
                            <div class="col-sm-12 col-lg-4">
                                <label for="fa4_curso" class="form-label">Curso</label>
                                <input type="text" class="form-control" id="fa4_curso" name="fa4_curso" value="<?php echo $candidato['fa4_curso']; ?>">
                            </div>
                            <!-- Botão que chama a 5ª Formação Acadêmica -->
                            <div class="col-sm-12 col-lg-1 pt-4">
                                <button class="btn btn-primeira" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAcademia5" aria-expanded="false" aria-controls="collapseAcademia5">+</button>
                            </div>
                        </div>
                        <?php } else { ?>
                        <!-- Formação Acadêmica 4 - Caso esteja preenchido -->
                        <div class="collapse show row pt-1" id="collapseAcademia4">
                            <div class="col-sm-12 col-lg-3">
                                <label for="fa4_titulo" class="form-label">Título obtido</label>
                                <select name="fa4_titulo" id="fa4_titulo" class="form-select">
                                <?php if($candidato['fa4_titulo'] == "Ensino Básico") { ?>
                                    <option selected>Ensino Básico</option>
                                <?php } else { ?>
                                    <option value="Ensino Básico">Ensino Básico</option>
                                <?php } ?>
                                <?php if($candidato['fa4_titulo'] == "Ensino Médio") { ?>
                                    <option selected>Ensino Médio</option>
                                <?php } else { ?>
                                    <option value="Ensino Médio">Ensino Médio</option>
                                <?php } ?>
                                <?php if($candidato['fa4_titulo'] == "Universitário") { ?>
                                    <option selected>Universitário</option>
                                <?php } else { ?>
                                    <option value="Universitário">Universitário</option>
                                <?php } ?>
                                <?php if($candidato['fa4_titulo'] == "Licenciatura") { ?>
                                    <option selected>Licenciatura</option>
                                <?php } else { ?>
                                    <option value="Licenciatura">Licenciatura</option>
                                <?php } ?>   
                                <?php if($candidato['fa4_titulo'] == "Curso Profissional") { ?>
                                    <option selected>Curso Profissional</option>
                                <?php } else { ?>
                                    <option value="Curso Profissional">Curso Profissional</option>
                                <?php } ?>                                     
                                </select>
                            </div>
                            <div class="col-sm-12 col-lg-4">
                                <label for="fa4_instituto" class="form-label">Nome da Instituição</label>
                                <input type="text" class="form-control" id="fa4_instituto" name="fa4_instituto" placeholder="Nome da Instituição onde fez ou faz o Ensino Médio" value="<?php echo $candidato['fa4_instituto']; ?>">
                            </div>
                            <div class="col-sm-12 col-lg-4">
                                <label for="fa4_curso" class="form-label">Curso</label>
                                <input type="text" class="form-control" id="fa4_curso" name="fa4_curso" value="<?php echo $candidato['fa4_curso']; ?>">
                            </div>
                            <!-- Botão que chama a 5ª Formação Acadêmica -->
                            <div class="col-sm-12 col-lg-1 pt-4">
                                <button class="btn btn-primeira" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAcademia5" aria-expanded="false" aria-controls="collapseAcademia5">+</button>
                            </div>
                        </div>
                        <?php } ?>

                        <!-- Formação Acadêmica 5 - Caso não esteja preenchido -->
                        <?php if($candidato['fa5_instituto'] == "") { ?>
                        <div class="collapse row pt-1" id="collapseAcademia5">
                            <div class="col-sm-12 col-lg-3">
                                <label for="fa5_titulo" class="form-label">Título obtido</label>
                                <select name="fa5_titulo" id="fa5_titulo" class="form-select">
                                <?php if($candidato['fa5_titulo'] == "Ensino Básico") { ?>
                                    <option selected>Ensino Básico</option>
                                <?php } else { ?>
                                    <option value="Ensino Básico">Ensino Básico</option>
                                <?php } ?>
                                <?php if($candidato['fa5_titulo'] == "Ensino Médio") { ?>
                                    <option selected>Ensino Médio</option>
                                <?php } else { ?>
                                    <option value="Ensino Médio">Ensino Médio</option>
                                <?php } ?>
                                <?php if($candidato['fa5_titulo'] == "Universitário") { ?>
                                    <option selected>Universitário</option>
                                <?php } else { ?>
                                    <option value="Universitário">Universitário</option>
                                <?php } ?>
                                <?php if($candidato['fa5_titulo'] == "Licenciatura") { ?>
                                    <option selected>Licenciatura</option>
                                <?php } else { ?>
                                    <option value="Licenciatura">Licenciatura</option>
                                <?php } ?> 
                                <?php if($candidato['fa5_titulo'] == "Curso Profissional") { ?>
                                    <option selected>Curso Profissional</option>
                                <?php } else { ?>
                                    <option value="Curso Profissional">Curso Profissional</option>
                                <?php } ?>                                       
                                </select>
                            </div>
                            <div class="col-sm-12 col-lg-4">
                                <label for="fa5_instituto" class="form-label">Nome da Instituição</label>
                                <input type="text" class="form-control" id="fa5_instituto" name="fa5_instituto" placeholder="Nome da Instituição onde fez ou faz o Ensino Médio" value="<?php echo $candidato['fa5_instituto']; ?>">
                            </div>
                            <div class="col-sm-12 col-lg-4">
                                <label for="fa5_curso" class="form-label">Curso</label>
                                <input type="text" class="form-control" id="fa5_curso" name="fa5_curso" value="<?php echo $candidato['fa5_curso']; ?>">
                            </div>
                        </div>
                        <?php } else { ?>
                        <!-- Formação Acadêmica 5 - Caso esteja preenchido -->
                        <div class="collapse show row pt-1" id="collapseAcademia5">
                            <div class="col-sm-12 col-lg-3">
                                <label for="fa5_titulo" class="form-label">Título obtido</label>
                                <select name="fa5_titulo" id="fa5_titulo" class="form-select">
                                <?php if($candidato['fa5_titulo'] == "Ensino Básico") { ?>
                                    <option selected>Ensino Básico</option>
                                <?php } else { ?>
                                    <option value="Ensino Básico">Ensino Básico</option>
                                <?php } ?>
                                <?php if($candidato['fa5_titulo'] == "Ensino Médio") { ?>
                                    <option selected>Ensino Médio</option>
                                <?php } else { ?>
                                    <option value="Ensino Médio">Ensino Médio</option>
                                <?php } ?>
                                <?php if($candidato['fa5_titulo'] == "Universitário") { ?>
                                    <option selected>Universitário</option>
                                <?php } else { ?>
                                    <option value="Universitário">Universitário</option>
                                <?php } ?>
                                <?php if($candidato['fa5_titulo'] == "Licenciatura") { ?>
                                    <option selected>Licenciatura</option>
                                <?php } else { ?>
                                    <option value="Licenciatura">Licenciatura</option>
                                <?php } ?>   
                                <?php if($candidato['fa5_titulo'] == "Curso Profissional") { ?>
                                    <option selected>Curso Profissional</option>
                                <?php } else { ?>
                                    <option value="Curso Profissional">Curso Profissional</option>
                                <?php } ?>                                     
                                </select>
                            </div>
                            <div class="col-sm-12 col-lg-4">
                                <label for="fa5_instituto" class="form-label">Nome da Instituição</label>
                                <input type="text" class="form-control" id="fa5_instituto" name="fa5_instituto" placeholder="Nome da Instituição onde fez ou faz o Ensino Médio" value="<?php echo $candidato['fa5_instituto']; ?>">
                            </div>
                            <div class="col-sm-12 col-lg-4">
                                <label for="fa5_curso" class="form-label">Curso</label>
                                <input type="text" class="form-control" id="fa5_curso" name="fa5_curso" value="<?php echo $candidato['fa5_curso']; ?>">
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="salvar-formacao" class="btn btn-success">Salvar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Experiência Profissional  -->
        <div class="modal fade" id="staticBackdropEspProfissional" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropProfissional" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="../_bd/salvar_experiencia_profissional.php" method="post" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropProfissional">EXPERIÊNCIA PROFISSIONAL</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body row">
                        <div class="col-sm-12 col-lg-5 my-2">
                            <label for="ep1_empregadora" class="form-label">Nome da Empregadora</label>
                            <input type="text" class="form-control" id="ep1_empregadora" name="ep1_empregadora" value="<?php echo $candidato['ep1_empregadora']; ?>">
                        </div>
                        <div class="col-sm-12 col-lg-4 my-2">
                            <label for="ep1_funcao" class="form-label">Função</label>
                            <input type="text" class="form-control" id="ep1_funcao" name="ep1_funcao" value="<?php echo $candidato['ep1_funcao']; ?>">
                        </div>
                        <div class="col-sm-12 col-lg-3 my-2">
                            <label for="ep1_data_inicio" class="form-label">De</label>
                            <input type="date" class="form-control" id="ep1_data_inicio" name="ep1_data_inicio" value="<?php echo $candidato['ep1_data_inicio']; ?>">
                        </div>
                        <div class="col-sm-12 col-lg-9 my-2">
                            <label for="ep1_descricao" class="form-label">Descrição</label>
                            <textarea rows="3" class="form-control" id="ep1_descricao" name="ep1_descricao" placeholder=""><?php echo $candidato['ep1_descricao']; ?></textarea>
                        </div>
                        <div class="col-sm-12 col-lg-3 my-2">
                            <label for="ep1_data_fim" class="form-label">Até</label>
                            <input type="date" class="form-control" id="ep1_data_fim" name="ep1_data_fim" placeholder="" value="<?php echo $candidato['ep1_data_fim']; ?>">
                            <!-- Botão que chama a 2ª experiência Profissional -->
                            <div class="col-sm-12 col-lg-1 mt-2">
                                <button class="btn btn-primeira" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEsperiencia2" aria-expanded="false" aria-controls="collapseEsperiencia2">+</button>
                            </div>
                        </div>               
                        
                        <!-- Experiência Profissional 2 - Caso não esteja preencido -->
                        <?php if($candidato['ep2_empregadora'] == "") { ?>
                        <div class="collapse row" id="collapseEsperiencia2">
                            <div class="col-sm-12 col-lg-5 my-2">
                                <label for="ep2_empregadora" class="form-label">Nome da Empregadora</label>
                                <input type="text" class="form-control" id="ep2_empregadora" name="ep2_empregadora">
                            </div>
                            <div class="col-sm-12 col-lg-4 my-2">
                                <label for="ep2_funcao" class="form-label">Função</label>
                                <input type="text" class="form-control" id="ep2_funcao" name="ep2_funcao">
                            </div>
                            <div class="col-sm-12 col-lg-3 my-2">
                                <label for="ep2_data_inicio" class="form-label">De</label>
                                <input type="date" class="form-control" id="ep2_data_inicio" name="ep2_data_inicio" placeholder="">
                            </div>
                            <div class="col-sm-12 col-lg-9 my-2">
                                <label for="ep2_descricao" class="form-label">Descrição</label>
                                <textarea rows="3" class="form-control" id="ep2_descricao" name="ep2_descricao" placeholder=""></textarea>
                            </div>
                            <div class="col-sm-12 col-lg-3 my-2">
                                <label for="ep2_data_fim" class="form-label">Até</label>
                                <input type="date" class="form-control" id="ep2_data_fim" name="ep2_data_fim" placeholder="">
                                <!-- Botão que chama a 3ª Experiência Profissional -->
                                <div class="col-sm-12 col-lg-1 mt-2">
                                    <button class="btn btn-primeira" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEsperiencia3" aria-expanded="false" aria-controls="collapseEsperiencia3">+</button>
                                </div>
                            </div>
                        </div>
                        <?php } else { ?>
                        <div class="collapse show row" id="collapseEsperiencia2">
                            <div class="col-sm-12 col-lg-5 my-2">
                                <label for="ep2_empregadora" class="form-label">Nome da Empregadora</label>
                                <input type="text" class="form-control" id="ep2_empregadora" name="ep2_empregadora" placeholder="" value="<?php echo $candidato['ep2_empregadora']; ?>">
                            </div>
                            <div class="col-sm-12 col-lg-4 my-2">
                                <label for="ep2_funcao" class="form-label">Função</label>
                                <input type="text" class="form-control" id="ep2_funcao" name="ep2_funcao" placeholder="" value="<?php echo $candidato['ep2_funcao']; ?>">
                            </div>
                            <div class="col-sm-12 col-lg-3 my-2">
                                <label for="ep2_data_inicio" class="form-label">De</label>
                                <input type="date" class="form-control" id="ep2_data_inicio" name="ep2_data_inicio" placeholder="" value="<?php echo $candidato['ep2_data_inicio']; ?>">
                            </div>
                            <div class="col-sm-12 col-lg-9 my-2">
                                <label for="ep2_descricao" class="form-label">Descrição</label>
                                <textarea rows="3" class="form-control" id="ep2_descricao" name="ep2_descricao" placeholder=""><?php echo $candidato['ep2_descricao']; ?></textarea>
                            </div>
                            <div class="col-sm-12 col-lg-3 my-2">
                                <label for="ep2_data_fim" class="form-label">Até</label>
                                <input type="date" class="form-control" id="ep2_data_fim" name="ep2_data_fim" placeholder="" value="<?php echo $candidato['ep2_data_fim']; ?>">
                                <!-- Botão que chama a 3ª Experiência Profissional -->
                                <div class="col-sm-12 col-lg-1 mt-2">
                                    <button class="btn btn-primeira" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEsperiencia3" aria-expanded="false" aria-controls="collapseEsperiencia3">+</button>
                                </div>
                            </div>  
                        </div>
                        <?php } ?>

                        <!-- Experiência Profissional 3 - Caso não esteja preencido -->
                        <?php if($candidato['ep3_empregadora'] == "") { ?>
                        <div class="collapse row" id="collapseEsperiencia3">
                            <div class="col-sm-12 col-lg-5 my-2">
                                <label for="ep3_empregadora" class="form-label">Nome da Empregadora</label>
                                <input type="text" class="form-control" id="ep3_empregadora" name="ep3_empregadora" placeholder="">
                            </div>
                            <div class="col-sm-12 col-lg-4 my-2">
                                <label for="ep3_funcao" class="form-label">Função</label>
                                <input type="text" class="form-control" id="ep3_funcao" name="ep3_funcao" placeholder="">
                            </div>
                            <div class="col-sm-12 col-lg-3 my-2">
                                <label for="ep3_data_inicio" class="form-label">De</label>
                                <input type="date" class="form-control" id="ep3_data_inicio" name="ep3_data_inicio" placeholder="">
                            </div>
                            <div class="col-sm-12 col-lg-9 my-2">
                                <label for="ep3_descricao" class="form-label">Descrição</label>
                                <textarea rows="3" class="form-control" id="ep3_descricao" name="ep3_descricao" placeholder=""></textarea>
                            </div>
                            <div class="col-sm-12 col-lg-3 my-2">
                                <label for="ep3_data_fim" class="form-label">Até</label>
                                <input type="date" class="form-control" id="ep3_data_fim" name="ep3_data_fim" placeholder="">
                                <!-- Botão que chama a 4ª Experiência Profissional -->
                                <div class="col-sm-12 col-lg-1 mt-2">
                                    <button class="btn btn-primeira" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEsperiencia4" aria-expanded="false" aria-controls="collapseEsperiencia4">+</button>
                                </div>
                            </div>
                        </div>
                        <?php } else { ?>
                        <div class="collapse show row" id="collapseEsperiencia3">
                            <div class="col-sm-12 col-lg-5 my-2">
                                <label for="ep3_empregadora" class="form-label">Nome da Empregadora</label>
                                <input type="text" class="form-control" id="ep3_empregadora" name="ep3_empregadora" placeholder="" value="<?php echo $candidato['ep3_empregadora']; ?>">
                            </div>
                            <div class="col-sm-12 col-lg-4 my-2">
                                <label for="ep3_funcao" class="form-label">Função</label>
                                <input type="text" class="form-control" id="ep3_funcao" name="ep3_funcao" placeholder="" value="<?php echo $candidato['ep3_funcao']; ?>">
                            </div>
                            <div class="col-sm-12 col-lg-3 my-2">
                                <label for="ep3_data_inicio" class="form-label">De</label>
                                <input type="date" class="form-control" id="ep3_data_inicio" name="ep3_data_inicio" placeholder="" value="<?php echo $candidato['ep3_data_inicio']; ?>">
                            </div>
                            <div class="col-sm-12 col-lg-9 my-2">
                                <label for="ep3_descricao" class="form-label">Descrição</label>
                                <textarea rows="3" class="form-control" id="ep3_descricao" name="ep3_descricao" placeholder=""><?php echo $candidato['ep3_descricao']; ?></textarea>
                            </div>
                            <div class="col-sm-12 col-lg-3 my-2">
                                <label for="ep3_data_fim" class="form-label">Até</label>
                                <input type="date" class="form-control" id="ep3_data_fim" name="ep3_data_fim" placeholder="" value="<?php echo $candidato['ep3_data_fim']; ?>">
                                <!-- Botão que chama a 4ª Experiência Profissional -->
                                <div class="col-sm-12 col-lg-1 mt-2">
                                    <button class="btn btn-primeira" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEsperiencia4" aria-expanded="false" aria-controls="collapseEsperiencia4">+</button>
                                </div>
                            </div>
                        </div>
                        <?php } ?>

                        <!-- Experiência Profissional 4 - Caso não esteja preencido -->
                        <?php if($candidato['ep4_empregadora'] == "") { ?>
                        <div class="collapse row" id="collapseEsperiencia4">
                            <div class="col-sm-12 col-lg-5 my-2">
                                <label for="ep4_empregadora" class="form-label">Nome da Empregadora</label>
                                <input type="text" class="form-control" id="ep4_empregadora" name="ep4_empregadora" placeholder="">
                            </div>
                            <div class="col-sm-12 col-lg-4 my-2">
                                <label for="ep4_funcao" class="form-label">Função</label>
                                <input type="text" class="form-control" id="ep4_funcao" name="ep4_funcao" placeholder="">
                            </div>
                            <div class="col-sm-12 col-lg-3 my-2">
                                <label for="ep4_data_inicio" class="form-label">De</label>
                                <input type="date" class="form-control" id="ep4_data_inicio" name="ep4_data_inicio" placeholder="">
                            </div>
                            <div class="col-sm-12 col-lg-9 my-2">
                                <label for="ep4_descricao" class="form-label">Descrição</label>
                                <textarea rows="3" class="form-control" id="ep4_descricao" name="ep4_descricao" placeholder=""></textarea>
                            </div>
                            <div class="col-sm-12 col-lg-3 my-2">
                                <label for="ep4_data_fim" class="form-label">Até</label>
                                <input type="date" class="form-control" id="ep4_data_fim" name="ep4_data_fim" placeholder="">
                                <!-- Botão que chama a 5ª Experiência Profissional -->
                                <div class="col-sm-12 col-lg-1 mt-2">
                                    <button class="btn btn-primeira" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEsperiencia5" aria-expanded="false" aria-controls="collapseEsperiencia5">+</button>
                                </div>
                            </div>
                        </div>
                        <?php } else { ?>
                        <div class="collapse show row" id="collapseEsperiencia4">
                            <div class="col-sm-12 col-lg-5 my-2">
                                <label for="ep4_empregadora" class="form-label">Nome da Empregadora</label>
                                <input type="text" class="form-control" id="ep4_empregadora" name="ep4_empregadora" placeholder="" value="<?php echo $candidato['ep4_empregadora']; ?>">
                            </div>
                            <div class="col-sm-12 col-lg-4 my-2">
                                <label for="ep4_funcao" class="form-label">Função</label>
                                <input type="text" class="form-control" id="ep4_funcao" name="ep4_funcao" placeholder="" value="<?php echo $candidato['ep4_funcao']; ?>">
                            </div>
                            <div class="col-sm-12 col-lg-3 my-2">
                                <label for="ep4_data_inicio" class="form-label">De</label>
                                <input type="date" class="form-control" id="ep4_data_inicio" name="ep4_data_inicio" placeholder="" value="<?php echo $candidato['ep4_data_inicio']; ?>">
                            </div>
                            <div class="col-sm-12 col-lg-9 my-2">
                                <label for="ep4_descricao" class="form-label">Descrição</label>
                                <textarea rows="3" class="form-control" id="ep4_descricao" name="ep4_descricao" placeholder=""><?php echo $candidato['ep4_descricao']; ?></textarea>
                            </div>
                            <div class="col-sm-12 col-lg-3 my-2">
                                <label for="ep4_data_fim" class="form-label">Até</label>
                                <input type="date" class="form-control" id="ep4_data_fim" name="ep4_data_fim" placeholder="" value="<?php echo $candidato['ep4_data_fim']; ?>">
                            </div>
                            <!-- Botão que chama a 5ª Experiência Profissional -->
                            <div class="col-sm-12 col-lg-1 mt-2">
                                <button class="btn btn-primeira" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEsperiencia5" aria-expanded="false" aria-controls="collapseEsperiencia5">+</button>
                            </div>
                        </div>
                        <?php } ?>

                        <!-- Experiência Profissional 5 - Caso não esteja preencido -->
                        <?php if($candidato['ep5_empregadora'] == "") { ?>
                        <div class="collapse row" id="collapseEsperiencia5">
                            <div class="col-sm-12 col-lg-5 my-2">
                                <label for="ep5_empregadora" class="form-label">Nome da Empregadora</label>
                                <input type="text" class="form-control" id="ep5_empregadora" name="ep5_empregadora" placeholder="">
                            </div>
                            <div class="col-sm-12 col-lg-4 my-2">
                                <label for="ep5_funcao" class="form-label">Função</label>
                                <input type="text" class="form-control" id="ep5_funcao" name="ep5_funcao" placeholder="">
                            </div>
                            <div class="col-sm-12 col-lg-3 my-2">
                                <label for="ep5_data_inicio" class="form-label">De</label>
                                <input type="date" class="form-control" id="ep5_data_inicio" name="ep5_data_inicio" placeholder="">
                            </div>
                            <div class="col-sm-12 col-lg-9 my-2">
                                <label for="ep5_descricao" class="form-label">Descrição</label>
                                <textarea rows="3" class="form-control" id="ep5_descricao" name="ep5_descricao" placeholder=""></textarea>
                            </div>
                            <div class="col-sm-12 col-lg-3 my-2">
                                <label for="ep5_data_fim" class="form-label">Até</label>
                                <input type="date" class="form-control" id="ep5_data_fim" name="ep5_data_fim" placeholder="">
                            </div>
                        </div>
                        <?php } else { ?>
                        <div class="collapse show row" id="collapseEsperiencia5">
                            <div class="col-sm-12 col-lg-5 my-2">
                                <label for="ep5_empregadora" class="form-label">Nome da Empregadora</label>
                                <input type="text" class="form-control" id="ep5_empregadora" name="ep5_empregadora" placeholder="" value="<?php echo $candidato['ep5_empregadora']; ?>">
                            </div>
                            <div class="col-sm-12 col-lg-4 my-2">
                                <label for="ep5_funcao" class="form-label">Função</label>
                                <input type="text" class="form-control" id="ep5_funcao" name="ep5_funcao" placeholder="" value="<?php echo $candidato['ep5_funcao']; ?>">
                            </div>
                            <div class="col-sm-12 col-lg-3 my-2">
                                <label for="ep5_data_inicio" class="form-label">De</label>
                                <input type="date" class="form-control" id="ep5_data_inicio" name="ep5_data_inicio" placeholder="" value="<?php echo $candidato['ep5_data_inicio']; ?>">
                            </div>
                            <div class="col-sm-12 col-lg-9 my-2">
                                <label for="ep5_descricao" class="form-label">Descrição</label>
                                <textarea rows="3" class="form-control" id="ep5_descricao" name="ep5_descricao" placeholder=""><?php echo $candidato['ep5_descricao']; ?></textarea>
                            </div>
                            <div class="col-sm-12 col-lg-3 my-2">
                                <label for="ep5_data_fim" class="form-label">Até</label>
                                <input type="date" class="form-control" id="ep5_data_fim" name="ep5_data_fim" placeholder="" value="<?php echo $candidato['ep5_data_fim']; ?>">
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="salvar_experiencia" class="btn btn-success">Salvar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Contacto de Emergência  -->
        <div class="modal fade" id="staticBackdropEmergencia" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropEmergencia" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropEmergencia">Contacto de Emergência</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body row">
                        <div class="col-sm-12 col-lg-3 my-2">
                            <label for="nome_contacto1" class="form-label">Nome do Contacto</label>
                            <input type="text" class="form-control" id="nome_contacto1" name="nome_contacto1" placeholder="O nome do contacto" value="<?php echo $candidato['nome_contacto1']; ?>">
                        </div>
                        <div class="col-sm-12 col-lg-3 my-2">
                            <label for="telefone_emergencia1" class="form-label">Telefone</label>
                            <input type="text" class="form-control" id="telefone_emergencia1" name="telefone_emergencia1" placeholder="O telefone da pessoa" value="<?php echo $candidato['telefone_emergencia1']; ?>">
                        </div>
                        <div class="col-sm-12 col-lg-3 my-2">
                            <label for="empregadora_contacto1" class="form-label">Empregadora</label>
                            <input type="text" class="form-control" id="empregadora_contacto1" name="empregadora_contacto1" placeholder="Onde o contacto trabalha" value="<?php echo $candidato['empregadora_contacto1']; ?>">
                        </div>
                        <div class="col-sm-12 col-lg-2 my-2">
                            <label for="relacao_contacto1" class="form-label">Relação</label>
                            <select name="relacao_contacto1" id="relacao_contacto1" class="form-select">
                                <option value="Pai">Pai</option>
                                <option value="Mãe">Mãe</option>
                                <option value="Marido">Marido</option>
                                <option value="Mulher">Mulher</option>
                                <option value="Irmão">Irmão</option>
                                <option value="Irmã">Irmã</option>
                                <option value="Tio">Tio</option>
                                <option value="Tia">Tia</option>
                                <option value="Filho">Filho</option>
                                 <option value="Filha">Filha</option>
                            </select>
                        </div> 
                        <!-- Botão adicionar mais um contacto de emergência -->
                        <div class="col-sm-12 col-lg-1 mt-4">
                            <button class="btn btn-primeira" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEmergencia" aria-expanded="false" aria-controls="collapseEmergencia">+</button>
                        </div> 
                        <!-- Mais um contacto de emergência -->
                        <div class="collapse row" id="collapseEmergencia">
                            <div class="col-sm-12 col-lg-3 my-2">
                                <label for="nome_contacto2" class="form-label">Nome do contacto</label>
                                <input type="text" class="form-control" id="nome_contacto2" name="nome_contacto2" placeholder="O nome do contacto" value="<?php echo $candidato['nome_contacto2']; ?>"> 
                            </div>
                            <div class="col-sm-12 col-lg-3 my-2">
                                <label for="telefone_emergencia2" class="form-label">Telefone</label>
                                <input type="text" class="form-control" id="telefone_emergencia2" name="telefone_emergencia2" placeholder="O telefone da pessoa" value="<?php echo $candidato['telefone_emergencia2']; ?>">
                            </div>
                            <div class="col-sm-12 col-lg-4 my-2">
                                <label for="empregadora_contacto2" class="form-label">Empregadora</label>
                                <input type="text" class="form-control" id="empregadora_contacto2" name="empregadora_contacto2" placeholder="" value="<?php echo $candidato['empregadora_contacto2']; ?>">
                            </div>
                            <div class="col-sm-12 col-lg-2 my-2">
                                <label for="relacao_contacto2" class="form-label">Relação</label>
                                <select name="relacao_contacto2" id="relacao_contacto2" class="form-select">
                                    <option value="Pai">Pai</option>
                                    <option value="Mãe">Mãe</option>
                                    <option value="Marido">Marido</option>
                                    <option value="Mulher">Mulher</option>
                                    <option value="Irmão">Irmão</option>
                                    <option value="Irmã">Irmã</option>
                                    <option value="Tio">Tio</option>
                                    <option value="Tia">Tia</option>
                                    <option value="Filho">Filho</option>
                                    <option value="Filha">Filha</option>
                                </select>
                            </div>
                        </div> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success">Salvar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Objectivos  -->
        <div class="modal fade" id="staticBackdropObjectivo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropObjectivo" aria-hidden="true">
            <div  class="modal-dialog modal-lg">
                <form action="../_bd/salvar_objectivos.php" method="post" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropObjectivo">Objectivos</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body row">
                        <div class="col-sm-12 col-lg-12">
                            <label for="interesse" class="form-label"></label>
                            <textarea class="form-control" id="interesse" name="interesse" placeholder=""><?php echo $candidato['objectivos']; ?></textarea>
                        </div> 
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="salvar_objectivos" class="btn btn-success">Salvar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Dados Pessoais  -->
        <div class="modal fade" id="staticBackdropOPessoias" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropOPessoias" aria-hidden="true">
            <div class="modal-dialog">
                <form action="../_bd/salvar_dadospessoais.php" method="post" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropOPessoias">Dados Pessoais</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body row">
                        <div class="col-sm-12 col-lg-12 my-2">
                            <label for="nome" class="form-label">Nome completo *</label>
                            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $candidato['nome']; ?>">
                        </div> 
                        <div class="col-sm-12 col-lg-6 my-2">
                            <label for="data_nasc" class="form-label">Data de nascimento *</label>
                            <input type="date" class="form-control" id="data_nasc" name="data_nasc" max="<?php echo date('Y-m-d'); ?>" value="<?php echo $candidato['data_nasc']; ?>">
                        </div> 
                        <div class="col-sm-12 col-lg-6 my-2">
                            <label for="nacionalidade" class="form-label">Nacionalidade *</label>
                            <select class="form-select" name="nacionalidade">
                                <option selected><?php echo $candidato['nacionalidade']; ?></option>
                                <?php
                                    $consultar_nacionalidade = mysqli_query($conexao, "SELECT * FROM nacionalidade ORDER BY nacionalidade ASC");
                                    if(mysqli_num_rows($consultar_nacionalidade) > 0) {
                                        while($nacionalidade = mysqli_fetch_array($consultar_nacionalidade)) {
                                ?>
                                    <option value="<?php echo $nacionalidade['nacionalidade']; ?>"><?php echo $nacionalidade['nacionalidade']; ?></option>
                                <?php } } ?>
                            </select> 
                        </div>
                        <div class="col-sm-12 col-lg-8 my-2">
                            <label for="bi" class="form-label">BI nº</label>
                            <input type="text" class="form-control" id="bi" name="bi" value="<?php echo $candidato['bi']; ?>">
                        </div>
                        <div class="col-sm-12 col-lg-4 my-2">
                            <label for="genero" class="form-label">Gênero</label>
                            <select name="genero" id="genero" class="form-select">
                            <?php if($candidato['genero'] == "Homem") { ?>
                                <option selected>Homem</option>
                                <option value="Mulher">Mulher</option>
                            <?php } else { ?>
                                <option value="Homem">Homem</option>
                                <option selected>Mulher</option>
                            <?php } ?>
                            </select>
                        </div>  
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="salvar_dadospessoais" class="btn btn-success">Salvar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Contactos  -->
        <div class="modal fade" id="staticBackdropOContactos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropOContactos" aria-hidden="true">
            <div class="modal-dialog">
                <form action="../_bd/salvar_contacto.php" method="post" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropOContactos">Contactos</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body row">
                        <div class="col-sm-12 col-lg-5">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo $candidato['telefone']; ?>">
                        </div> 
                        <div class="col-sm-12 col-lg-7">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?php echo $candidato['email']; ?>">
                        </div> 
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="salvar_contacto" class="btn btn-success">Salvar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Localização  -->
        <div class="modal fade" id="staticBackdropOLocalizacao" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropOLocalizacao" aria-hidden="true">
            <div class="modal-dialog">
                <form action="../_bd/salvar_localizacao.php" method="post" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropOLocalizacao">Localização</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body row">
                        <div class="col-sm-12 col-lg-6">
                        <label for="provincia" class="form-label">Província</label>
                            <select name="provincia" id="provincia" class="form-select" required>
                                <option value="Bengo">Bengo</option>
                                <option value="Benguela">Benguela</option>
                                <option value="Bié">Bié</option>
                                <option value="Cabinda">Cabinda</option>
                                <option value="Cuando-Cubango">Cuando-Cubango</option>
                                <option value="Cunene">Cunene</option>
                                <option value="Huambo">Huambo</option>
                                <option value="Huíla">Huíla</option>
                                <option value="Kwanza Sul">Kwanza Sul</option>
                                <option value="Kwanza Norte">Kwanza Norte</option>
                                <option selected>Luanda</option>
                                <option value="Lunda Sul">Lunda Sul</option>
                                <option value="Lunda Norte">Lunda Norte</option>
                                <option value="Malanje">Malanje</option>
                                <option value="Moxico">Moxico</option>
                                <option value="Namibe">Namibe</option>
                                <option value="Uíge">Uíge</option>
                                <option value="Zaire">Zaire</option>                                
                            </select>
                        </div> 
                        <div class="col-sm-12 col-lg-6">
                            <label for="municipio" class="form-label">Município *</label>
                            <select name="municipio" id="municipio" class="form-select" required>
                                <option selected>Luanda</option>
                                <option value="Sambizanga">Sambizanga</option>
                                <option value="Ambriz">Ambriz</option>
                                <option value="Andulo">Andulo</option>
                                <option value="Ambaca">Ambaca</option>
                                <option value="Ambuim">Ambuim</option>
                                <option value="Alto Zambeze">Alto Zambeze</option>
                                <option value="Auto Cauale">Auto Cauale</option>
                                <option value="Ambuíla">Ambuíla</option>
                                <option value="Banga">Banga</option>
                                <option value="Baia Farta">Baia Farta</option>
                                <option value="Balombo">Balombo</option>
                                <option value="Bailundo">Bailundo</option>
                                <option value="Belas">Belas</option>
                                <option value="Benguela">Benguela</option>
                                <option value="Bembe">Bembe</option>
                                <option value="Belize">Belize</option>
                                <option value="Bocoio">Bocoio</option>
                                <option value="Bolongongo">Bolongongo</option>
                                <option value="Bibala">Bibala</option>
                                <option value="Bundas">Bundas</option>
                                <option value="Buengas">Buengas</option>
                                <option value="Bungo">Bungo</option>
                                <option value="Bucu-Zau">Bucu-Zau</option>
                                <option value="Bula Atumba">Bula Atumba</option>
                                <option value="Caála">Caála</option>
                                <option value="Cabinda">Cabinda</option>
                                <option value="Caombo">Caomba</option>
                                <option value="Caconda">Caconda</option>
                                <option value="Caungula">Caungula</option>
                                <option value="Caiambambo">Caiambambo</option>
                                <option value="Cacongo">Cacongo</option>
                                <option value="Cacolo">Cacolo</option>
                                <option value="Cacula">Cacula</option>
                                <option value="Cacuaco">Cacuaco</option> 
                                <option value="Cacuso">Cacuso</option>
                                <option value="Calai">Calai</option>
                                <option value="Calandula">Calandula</option>
                                <option value="Caluquembe">Caluquembe</option>
                                <option value="Cahama">Cahama</option>
                                <option value="Cahiungo">Cahiungo</option>
                                <option value="Cambulo">Cambulo</option>
                                <option value="Camacupa">Camacupa</option>
                                <option value="Cameia">Cameia</option>
                                <option value="Camanongue">Camanongue</option>
                                <option value="Camucuio">Camucuio</option>
                                <option value="Cambambe">Cambambe</option>
                                <option value="Cambundi-Catembo">Cambundi-Catembo</option>
                                <option value="Cangandala">Cangandala</option>
                                <option value="Capenda-Camulemba">Capenda-Camulemba</option>
                                <option value="Cassongue">Cassongue</option>
                                <option value="Catabola">Catabola</option>
                                <option value="Catumbela">Catumbela</option>
                                <option value="Cazengo">Cazengo</option>
                                <option value="Cela">Cela</option>
                                <option value="Cicala-Choloanga">Cicala-Choloanga</option>
                                <option value="Citato">Citato</option>
                                <option value="Conda">Conda</option>
                                <option value="Cuaba Nzoji">Cuaba Nzoji</option>
                                <option value="Cuangar">Cuangar</option>
                                <option value="Cuango">Cuango</option>
                                <option value="Cuílo">Cuílo</option>
                                <option value="Cuanhama">Cuanhama</option>
                                <option value="Cuemba">Cuemba</option>
                                <option value="Cuimba">Cuimba</option>
                                <option value="Cuito">Cuito</option>
                                <option value="Cubal">Cubal</option>
                                <option value="Cunda-dia-Baze">Cunda-dia-Baze</option>
                                <option value="Cunhinga">Cunhinga</option>
                                <option value="Cuchi">Cuchi</option>
                                <option value="Curoca">Curoca</option>
                                <option value="Cuvango">Cuvango</option>
                                <option value="Cuvelai">Cuvelai</option>
                                <option value="Chiange">Chiange</option>
                                <option value="Chibia">Chibia</option>
                                <option value="Chicomba">Chicomba</option>
                                <option value="Chinguar">Chinguar</option>
                                <option value="Chinjenje">Chinjenje</option>
                                <option value="Chipindo">Chipindo</option>
                                <option value="Chitembo">Chitembo</option>
                                <option value="Chongoroi">Chongoroi</option>
                                <option value="Dala">Dala</option>
                                <option value="Dande">Dande</option>
                                <option value="Damba">Damba</option>
                                <option value="Dembos">Dembos</option>
                                <option value="Dirico">Dirico</option>
                                <option value="Ebo">Ebo</option>
                                <option value="Ecunha">Ecunha</option>
                                <option value="Ganda">Ganda</option>
                                <option value="Gonguembo">Gonguembo</option>
                                <option value="Gulungo Alto">Gulungo Alto</option>
                                <option value="Huambo">Huambo</option>
                                <option value="Humpata">Humpata</option>
                                <option value="Ícolo e Bengo">Ícolo e Bengo</option>
                                <option value="Jamba">Jamba</option>
                                <option value="Léua">Léua</option>
                                <option value="Lobito">Lobito</option>
                                <option value="Londuimbali">Londuimbali</option>
                                <option value="Longonjo">Longonjo</option>
                                <option value="Lóvua">Lóvua</option>
                                <option value="Luacano">Luacano</option>
                                <option value="Luau">Luau</option>
                                <option value="Lubango">Lubango</option>
                                <option value="Lubalo">Lubalo</option>
                                <option value="Lucapa">Lucapa</option>
                                <option value="Lucala">Lucala</option>
                                <option value="Luchazes">Luchazes</option>
                                <option value="Luquembo">Luquembo</option>
                                <option value="Malanje">Malanje</option>
                                <option value="Massango">Massango</option>
                                <option value="Matala">Matala</option>
                                <option value="Marimba">Marimba</option>
                                <option value="Mavinga">Mavinga</option>
                                <option value="Menongue">Menongue</option>
                                <option value="Milunga">Milunga</option>
                                <option value="Moxico">Moxico</option>
                                <option value="Muconda">Muconda</option>
                                <option value="Mbanza Congo">Mbanza Congo</option>
                                <option value="Mucamba">Mucamba</option>
                                <option value="Mucari">Mucari</option>
                                <option value="Mungo">Mungo</option>
                                <option value="Mussende">Mussende</option>
                                <option value="Nancova">Nancova</option>
                                <option value="Namacunde">Namacunde</option>
                                <option value="Negage">Negage</option>
                                <option value="Nóqui">Nóqui</option>
                                <option value="Nharea">Nharea</option>
                                <option value="Nzeto">Nzeto</option>
                                <option value="Ombadja">Ombadja</option>
                                <option value="Porto Amboim">Porto Amboim</option>
                                <option value="Puri">Puri</option> 
                                <option value="Quiela">Quiela</option>
                                <option value="Quibala">Quibala</option>
                                <option value="Quiculungo">Quiculungo</option>
                                <option value="Quilamba Quiaxi">Quilamba Quiaxi</option>
                                <option value="Quilemda">Quilemda</option>
                                <option value="Quilengues">Quilengues</option>
                                <option value="Quimbele">Quimbele</option>
                                <option value="Quissama">Quissama</option>
                                <option value="Quitexe">Quitexe</option>
                                <option value="Quipungo">Quipungo</option>
                                <option value="Quirima">Quirima</option>
                                <option value="Rivungo">Rivungo</option>
                                <option value="Saurimo">Saurimo</option>
                                <option value="Sanza Pombo">Sanza Pombo</option>
                                <option value="Seles">Seles</option>
                                <option value="Soio">Soio</option>
                                <option value="Songo">Songo</option>
                                <option value="Sumbe">Sumbe</option>
                                <option value="Talatona">Talatona</option>
                                <option value="Tômbua">Tômbua</option>
                                <option value="Tomboco">Tomboco</option>        
                                <option value="Ucuma">Ucuma</option>
                                <option value="Uíge">Uíge</option>
                                <option value="Viana">Viana</option>
                                <option value="Virei">Virei</option>
                                <option value="Xá-Muteba">Xá-Muteba</option>
                                <option value="Zombo">Zombo</option> 
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="salvar_localizacao" class="btn btn-success">Salvar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Línguas  -->
        <div class="modal fade" id="staticBackdropOLinguas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropOLinguas" aria-hidden="true">
            <div class="modal-dialog">
                <form action="../_bd/salvar_idioma.php" method="post" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropOLinguas">Línguas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body row">
                        <div class="mt-2 col-sm-12 col-lg-7">
                            <label for="lingua1" class="form-label">1ª Edioma</label>
                            <input class="form-control" list="datalistOptions" id="lingua1" placeholder="O idioma" name="lingua1">
                            <datalist id="datalistOptions">
                                <option value="Chinês">
                                <option value="Espanhol">
                                <option value="Francês">
                                <option value="Inglês">
                                <option value="Português">
                                <option value="Vietnamita">                             
                            </datalist>
                        </div> 
                        <div class="mt-2 col-sm-12 col-lg-5">
                            <label for="nivel_lingua1" class="form-label">Nível</label>
                            <select name="nivel_lingua1" id="nivel_lingua1" class="form-select">
                                <option value="Baixo">Baixo</option>
                                <option value="Médio">Médio</option>
                                <option value="Alto">Alto</option>
                            </select>
                        </div>
                        <div class="mt-2 col-sm-12 col-lg-7">
                            <label for="lingua2" class="form-label">2ª Edioma</label>
                            <input class="form-control" list="datalistOptions" id="lingua2" placeholder="O idioma" name="lingua2">
                            <datalist id="datalistOptions">
                                <option value="Chinês">
                                <option value="Espanhol">
                                <option value="Francês">
                                <option value="Inglês">
                                <option value="Português">
                                <option value="Vietnamita">                             
                            </datalist>
                        </div> 
                        <div class="mt-2 col-sm-12 col-lg-5">
                            <label for="nivel_lingua2" class="form-label">Nível</label>
                            <select name="nivel_lingua2" id="nivel_lingua2" class="form-select">
                                <option value="Baixo">Baixo</option>
                                <option value="Médio">Médio</option>
                                <option value="Alto">Alto</option>
                            </select>
                        </div>
                        <div class="mt-2 col-sm-12 col-lg-7">
                            <label for="lingua3" class="form-label">3ª Edioma</label>
                            <input class="form-control" list="datalistOptions" id="lingua3" placeholder="O idioma" name="lingua3">
                            <datalist id="datalistOptions">
                                <option value="Chinês">
                                <option value="Espanhol">
                                <option value="Francês">
                                <option value="Inglês">
                                <option value="Português">
                                <option value="Vietnamita">                             
                            </datalist>
                        </div> 
                        <div class="mt-2 col-sm-12 col-lg-5">
                            <label for="nivel_lingua3" class="form-label">Nível</label>
                            <select name="nivel_lingua3" id="nivel_lingua3" class="form-select">
                                <option value="Baixo">Baixo</option>
                                <option value="Médio">Médio</option>
                                <option value="Alto">Alto</option>
                            </select>
                        </div>
                        <div class="mt-2 col-sm-12 col-lg-7">
                            <label for="lingua4" class="form-label">4ª Edioma</label>
                            <input class="form-control" list="datalistOptions" id="lingua4" placeholder="O idioma" name="lingua4">
                            <datalist id="datalistOptions">
                                <option value="Chinês">
                                <option value="Espanhol">
                                <option value="Francês">
                                <option value="Inglês">
                                <option value="Português">
                                <option value="Vietnamita">                             
                            </datalist>
                        </div>
                        <div class="mt-2 col-sm-12 col-lg-5">
                            <label for="nivel_lingua4" class="form-label">Nível</label>
                            <select name="nivel_lingua4" id="nivel_lingua4" class="form-select">
                                <option value="Baixo">Baixo</option>
                                <option value="Médio">Médio</option>
                                <option value="Alto">Alto</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="salvar_idioma" class="btn btn-success">Salvar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- Rodapé -->
    <?php include_once("../_incluir/rodape.php"); ?>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <!-- ConveyThis button: -->
    <div id="conveythis-wrapper-main"><a href="https://www.conveythis.com" class="conveythis-no-translate notranslate" title="ConveyThis" >ConveyThis</a></div>
    <script src="//s2.conveythis.com/javascriptClassic/1/conveythis.js"></script>
    <script src="//s2.conveythis.com/javascriptClassic/1/translate.js"></script>
    <script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function(e) {
    conveythis.init({source_language_id: 768, languages: [{"id":"768","active":true},{"id":"703","active":false},{"id":"719","active":false},{"id":"792","active":false}]})
    });
    </script>
    <!-- End ConveyThis button code. -->
</body>
</html>