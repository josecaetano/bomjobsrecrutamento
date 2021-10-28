<?php 
    //Base de dados
    require_once("../_bd/conexao.php");
    session_start();
    //Controle de segurança
    if (!isset($_SESSION['Candidato_Logado'])) {
        header('Location: ../Login_Candidato/');
    }
    //
    if(isset($_GET['codigo'])) { 
        $id_vaga = $_GET['codigo'];
        $num_candidato = $_SESSION['Candidato_Logado'];
    } else {
        header('Location: ../Vagas/');
    }
    //Candidatura
    if(isset($_POST['cadastrar'])) {
        $candidatar = mysqli_query($conexao, "INSERT INTO vaga_candidato VALUES (DEFAULT, '{$num_candidato}', '{$id_vaga}')");    
        if(!$candidatar){
            $_SESSION['error'] = "Erro ao candidata-se na vaga!";
        } else {
            $_SESSION['sucesso'] = "Candidatura feita com sucesso!"; 
        }
    }
    $consultar_candidato = mysqli_query($conexao, "SELECT * FROM candidato WHERE id_candidato = '{$num_candidato}'");
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
    <title>Candidatura| Bom Jobs Recrutamento</title>
    <style>
        aside { background-color: #f2f2f2; padding: 10px; }
        #vagas > div { border: 1px solid #c3c3c3; padding: 10px; margin-bottom: 10px; }
        #vagas span { color: #003461; text-decoration: none; }
    </style>
</head>
<body>
    <!-- Menu - Barra de navegaçãp -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primeira">
        <div class="container-fluid">
            <a class="navbar-brand" href="../"><img src="../_img/logo-branco.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="../Painel_Candidato/">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="../Minhas_Vagas/">Minhas candidaturas</a></li>
                    <li class="nav-item"><a class="nav-link active" href="../Vagas/">Todas vagas disponíveis</a></li>
                    <li class="nav-item"><a class="nav-link" href="../Perfil_Candidato/">Meu perfil</a></li>
                    <li class="nav-item"> <button class="nav-link btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Minha conta<i class="bi bi-arrow-down"></i></button> </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">Dados da Candidato</h5>
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
                <span>Email: <strong><?php echo $candidato['email']; ?> </span></strong> <br>
                <span>Província: <strong><?php echo $candidato['localizacao']; ?> </span></strong>
            </div>
            <div class="d-grid">
                <a href="../_incluir/logout.php"class="btn btn-danger">Terminar sessão</a>
            </div>
        </div>
    </div>
    <main>
        <section id="vagas" class="container my-4">
            <?php               
                //Buscando os dados da vaga escolhida
                $consulta = "SELECT * FROM vaga AS V INNER JOIN empregadora AS E ON V.cod_empregadora = E.id_empregadora WHERE id_vaga = '{$id_vaga}' AND status_vaga = 1";
                $resultado = mysqli_query($conexao, $consulta);
                $vaga = mysqli_fetch_array($resultado);
            ?>
                <div class="row">
                    <div class="col-sm-12 col-lg-4">
                        <h4 class="h5">Dados da vaga</h4>
                        <span>Nome da vaga: <strong class="text-segunda"><?php echo $vaga['nome_vaga']; ?></strong></span> <br>
                        <span>Função: <strong><?php echo $vaga['descricao_vaga']; ?></strong></span> <br>
                        <span>Tipo: <?php echo $vaga['tipo_emprego']; ?></span> <br>
                        <span>Número de vagas: <strong><?php echo $vaga['num_vagas']; ?></strong></span> <br>
                        <span>Localização: <strong><?php echo $vaga['localizacao']; ?></strong></span> <br>
                        <span>Expira em <?php echo date('d-M-Y', strtotime($vaga['data_expiracao'])) ?> </span> <br>
                        <?php 
                            $consultar = mysqli_query($conexao, " SELECT COUNT(cod_vaga) AS Candidatos FROM vaga_candidato WHERE cod_vaga = '$id_vaga'");
                            $num_candidatos = mysqli_fetch_array($consultar);
                            if($num_candidatos['Candidatos'] == 0) {
                        ?>
                        <span><strong>Ninguém se candidatou ainda a esta vaga.</strong></span>
                        <?php } else if($num_candidatos['Candidatos'] == 1) { ?>
                            <span><strong><?php echo $num_candidatos['Candidatos']; ?> pessoa já se candidatou a essa vaga.</strong></span>
                        <?php } else { ?>
                            <span><strong><?php echo $num_candidatos['Candidatos']; ?> pessoas já se candidataram a essa vaga.</strong></span>
                        <?php }  ?>
                    </div>
                    <div class="col-sm-12 col-lg-4">
                        <h4 class="h5">Dados da Empregadora</h4>
                        <span class="h6"><i class="bi bi-building"></i> <?php echo $vaga['nome'] ?></span> <br>
                        <span><i class="bi bi-info-circle-fill"></i> <?php echo $vaga['descricao'] ?></span> <br>
                        <span><i class="bi bi-telephone-fill"></i> <?php echo $vaga['telefone'] ?></span> <br>
                        <span><i class="bi bi-envelope-fill"></i> <?php echo $vaga['email'] ?></span> <br>
                    </div>
                    <div class="col-sm-12 col-lg-4">
                        <h4 class="h5">Requisitos</h4>
                        <span>Titulação mínima: <strong><?php echo $vaga['r1_titulacao'] ?> </strong></span> <br>
                        <span>Experiência: <strong><?php echo $vaga['r2_experiencia'] ?> </strong> anos</span> <br>
                        <span>Nacionalidade: <strong><?php echo $vaga['r3_nacionalidade'] ?> </strong></span> <br>
                        <span>Lingua: <strong><?php echo $vaga['r4_lingua']; ?> </strong></span> <br>
                        <span>Área: <strong><?php echo $vaga['r5_area']; ?> </strong></span> <br>
                        <span>Salário: <strong><?php echo $vaga['r6_salario'] ?> </strong> AKZ</span> <br>
                        <span>Aptidões: <strong><?php echo $vaga['r7_aptidoes']; ?> </strong></span> 
                    </div>
                </div>
        </section>
        <aside class="container bg-white">
            <?php
            if(!isset($_SESSION['sucesso'])) {
                $verifica = mysqli_query($conexao, "SELECT cod_vaga FROM vaga_candidato WHERE cod_vaga = '{$id_vaga}' AND cod_candidato = '$num_candidato'");
                $verifica_vaga = mysqli_fetch_array($verifica);
                if(!$verifica_vaga) {
            ?>
            <form action="" method="post">
                <div class="d-grid">
                    <input type="hidden" name="codigo" id="" value="<?php echo $id_vaga; ?>">
                    <button type="submit" name="cadastrar" class="btn btn-outline-dark">Enviar candidatura</button>
                </div>
            </form>
            <?php } else { ?>
                 <div class="alert alert-danger" role="alert"> <?php echo "Você já se candidatou a esta vaga!"; ?> </div>
            <?php
                }
            } else { ?>
                <div class="alert alert-success" role="alert"> <?php echo $_SESSION['sucesso']; unset($_SESSION['sucesso']);?> </div>
            <?php } ?>
        </aside>
    </main>

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