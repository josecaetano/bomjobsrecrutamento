<?php 
    //Importação da Base de dados
    require_once("../_bd/conexao.php"); 
    session_start();
    //Controle de segurança
    if (!isset($_SESSION['Admin_Logado'])) {
        header('Location: ../Login_Admin/');
    }
    $id_admin = $_SESSION['Admin_Logado'];
    $consultar_admin = mysqli_query($conexao, "SELECT * FROM admin_bj WHERE id_admin = '{$id_admin}'");
    $admin = mysqli_fetch_array($consultar_admin);
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
    <title>Painel de controle | Bom Jobs Recrutamento</title>
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
                    <li class="nav-item"><a class="nav-link active" href="../Painel_Admin/">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="../Empregadoras/">Empregadoras</a></li>
                    <li class="nav-item"><a class="nav-link" href="../Candidatos/">Candidatos</a></li>
                    <li class="nav-item"><a class="nav-link" href="../Vaga_activa/">Vagas</a></li>
                    <li class="nav-item"> <button class="nav-link btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Minha conta <i class="bi bi-arrow-down"></i></button> </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">Bom Jobs Recrutamento</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="row">
                <span class="h5"><strong> <?php echo $admin['nome']; ?> </strong></span>
            </div>
            <div class="d-grid mb-2">
                <a href="../_incluir/logout.php"class="btn btn-danger">Terminar sessão</a>
            </div>
        </div>
    </div>
    <main>
        </section>
        <!-- Painel-->
        <section id="painel" class="container py-3">
            <div class="row">
                <div class="col-lg-3 text-center">
                    <?php
                        //Contando o número de Candidatos
                        $consult_candidatos = mysqli_query($conexao, "SELECT COUNT(id_candidato) AS cont_candidatos FROM candidato");
                        $num_candidatos = mysqli_fetch_array($consult_candidatos);
                        //Contando o número de Empregadoras
                        $consult_empregadora = mysqli_query($conexao, "SELECT COUNT(id_empregadora) AS cont_empregadoras FROM empregadora");
                        $num_empregadoras = mysqli_fetch_array($consult_empregadora);
                        //Contando o número de Vagas Disponíveis
                        $consult_vagas = mysqli_query($conexao, "SELECT COUNT(id_vaga) AS cont_vagas FROM vaga WHERE status_vaga != 0");
                        $num_vagas = mysqli_fetch_array($consult_vagas);
                    ?>
                    <div class="row">
                        <span class="fs-2"><i class="bi bi-people text-segunda"></i></span> <br>
                        <p class="h3 text-segunda"><?php echo $num_candidatos['cont_candidatos']; ?></p>
                        <p>Candidatos Cadastrados</p>
                    </div>
                    <div class="row">
                        <span class="fs-2"><i class="bi bi-building text-segunda"></i></span> <br>
                        <p class="h3 text-segunda"><?php echo $num_empregadoras['cont_empregadoras']; ?></p>
                        <p>Empregadoras Cadastradas</p>
                    </div>
                    <div class="row">
                        <span class="fs-2"><i class="bi bi-briefcase text-segunda"></i></span> <br>
                        <p class="h3 text-segunda"><?php echo $num_vagas['cont_vagas']; ?></p>
                        <p>Vagas Disponíveis</p>
                    </div>
                </div>
                <div class="col-lg-9">
                    <form action="" method="get" class="row mb-2">
                        <div class="col-sm-12 col-md-6 mb-1">
                            <label for="inputPesquisa" class="form-label">Pesquisar por nome ou código da empresa</label>
                            <input type="text" name="inputPesquisa" class="form-control" id="inputPesquisa" placeholder="Digite aqui para pesquisar">
                        </div>
                        <div class="col-sm-12 col-md-6 mb-1">
                            <label for="inputVaga" class="form-label">Pesquisar por nome ou código da vaga</label>
                            <input type="text" name="inputVaga" class="form-control" id="inputVaga" placeholder="Digite aqui para pesquisar">
                        </div>
                        <div class="col-sm-12">
                            <button type="submit" name="pesquisar" class="btn btn-primeira">Pesquisar</button>
                            <?php if(isset($_GET["inputPesquisa"])) { 
                                $inputPesquisa  = $_GET["inputPesquisa"];  
                                $inputVaga      = $_GET['inputVaga']; 
                            ?>                                
                                <p class="h4 fw-normal text-center">Resultado da pesquisa: <strong><?php echo $_GET["inputPesquisa"]; ?></strong> e <strong><?php echo $_GET["inputVaga"]; ?></strong></p>
                            <?php } ?>
                        </div>
                    </form>
                    <?php
                        //Buscando algumas vagas de emprego
                        $consultar_empregadora = "SELECT * FROM vaga AS V INNER JOIN empregadora AS E ON V.cod_empregadora = E.id_empregadora";
                        if(isset($_GET['inputPesquisa']) && isset($_GET['inputVaga'])) {
                            $consultar_empregadora .= " WHERE ((id_empregadora = '$inputPesquisa') OR (nome LIKE '%{$inputPesquisa}%')) AND ((id_vaga = '$inputVaga') OR (nome_vaga LIKE '%{$inputVaga}%'))";
                        }
                        $consultar_empregadora .= " ORDER BY E.id_empregadora DESC";
                        $resultado = mysqli_query($conexao, $consultar_empregadora);
                        if(mysqli_num_rows($resultado) > 0) {
                            while($empregadora = mysqli_fetch_array($resultado)) {
                    ?>
                    <div class="row">
                        <div class="col">
                            <p>Nome da Empresa <br><strong><?php echo $empregadora['nome']; ?></strong></p>
                        </div>
                        <div class="col">
                            <p>Vaga <br><strong><?php echo $empregadora['nome_vaga']; ?></strong></p>
                        </div>
                        <div class="col">
                            <p>Validade <br><strong><?php echo $empregadora['data_expiracao']; ?></strong></p>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Editar</button>
                        </div>
                    </div>

                    <!-- Modal Editar Empregadora -->
                    <div class="modal fade" id="exampleModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $empregadora['nome']; ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    data do contrato
                                    data do fim
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } } else {
                        echo "Nenhum resultado encontrado para " . $inputPesquisa . " e " . $inputVaga;
                    } ?>
                </div>
            </div>
        </section>
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