<?php 
    //Importação da Base de dados
    require_once("../_bd/conexao.php"); 
    session_start();
    //Controle de segurança
    if (!isset($_SESSION['Candidato_Logado'])) {
        header('Location: ../Login_Candidato/');
    }
    $id_candidato = $_SESSION['Candidato_Logado'];
    $consultar_candidato = mysqli_query($conexao, "SELECT * FROM candidato WHERE id_candidato = '{$id_candidato}'");
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
    <title>Painel do Candidato | Bom Jobs Recrutamento</title>
    <style>

    </style>
</head>
<body>
    <!-- Menu - Barra de navegação -->
    <nav class="navbar navbar-expand-sm navbar-dark bg-primeira">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img src="../_img/logo-branco.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="../Minhas_Vagas/">Minhas candidaturas</a></li>
                    <li class="nav-item"><a class="nav-link" href="../Vagas/">Todas vagas disponíveis</a></li>
                    <li class="nav-item"><a class="nav-link" href="../Perfil_Candidato/">Meu perfil</a></li>
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
            <div class="row" id="vaga">
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
                <span>Província: <strong><?php echo $candidato['provincia']; ?> </span></strong> <br>
            </div>
            <div class="d-grid">
                <a href="../_incluir/logout.php"class="btn btn-danger">Terminar sessão</a>
            </div>
        </div>
    </div>
    <main class="container py-3">
        <div class="row">
            <h2 class="my-3 text-primeira">Vagas de acordo ao seu perfil</h2>
            <?php 
                $cons_vaga = mysqli_query($conexao, "SELECT * FROM vaga AS V INNER JOIN empregadora AS E ON V.cod_empregadora = E.id_empregadora LIMIT 5");
                if(mysqli_num_rows($cons_vaga) > 0) {
                    while($vaga_recente = mysqli_fetch_array($cons_vaga)) {
            ?>
            <div class="col-sm-12 col-lg-6 mb-2">
                <hr>
                <p class="h4 text-primeira"><?php echo $vaga_recente['nome_vaga']; ?></p>
                <p>Descrição: <?php echo $vaga_recente['descricao']; ?></p>
                <p>Nome da empregadora: <strong><?php echo $vaga_recente['nome']; ?></strong> <br> Apresentação: <?php echo $vaga_recente['apresentacao']; ?></p>
                <p><?php echo $vaga_recente['r10_provincia'] . ", " . $vaga_recente['r11_municipio']; ?></p>
            </div>
            <?php } } ?>         
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