<?php 
    //Importação da Base de dados
    require_once("../_bd/conexao.php"); 
    session_start();
    //Controle de segurança
    if (!isset($_SESSION['Contratante_Logado'])) {
        header('Location: ../Login_Contratante/');
    }
    $id_admin = $_SESSION['Contratante_Logado'];
    $consultar_admin = mysqli_query($conexao, "SELECT * FROM contratante_bj WHERE id_contratante = '$id_admin'");
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
    <title>Todos os contratos | Bom Jobs Recrutamento</title>
</head>
<body>
    <!-- Menu - Barra de navegação -->
    <nav class="navbar navbar-expand-sm navbar-dark bg-primeira">
        <div class="container-fluid">
            <a class="navbar-brand" href="../Painel_Contratante/"><img src="../_img/logo-branco.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="../Painel_Contratante/">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="../Contrato_Empregadora/">Contrato</a></li>
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
        <section class="container py-3">
            <div class="row">
                <h3 class="text-center">Formulário de Contrato</h3>
                <hr>
                <div class="col-md-6 mb-2">
                    <form action="" method="get">
                        <label for="inputPesquisa" class="form-label">Pesquisa</label>
                        <input type="text" class="form-control" name="inputPesquisa" id="inputPesquisa" placeholder="Digite o número ou o nome da empregadora">
                        <button type="submit" name="pesquisar" class="btn btn-primeira mt-1">Pesquisar</button>
                    </form>
                    <?php   if(isset($_SESSION['error'])) { ?>
                        <div class="alert alert-danger mt-1 p-2 rounded">
                            <?php    echo $_SESSION['error'];
                                unset($_SESSION['error']); ?>
                        </div>
                    <?php   } ?>
                    <?php   if(isset($_SESSION['success'])) { ?>
                        <div class="alert alert-success mt-1 p-2 rounded">
                            <?php    echo $_SESSION['success'];
                                unset($_SESSION['success']); ?>
                        </div>
                    <?php   } ?>
                </div>
                <div class="col-md-6 mb-2">
                <?php 
                    if(isset($_GET['pesquisar']) && isset($_GET['inputPesquisa'])) {
                        $caixa_pesquisa = $_GET['inputPesquisa'];
                        $consultar_empregadora = mysqli_query($conexao, "SELECT id_empregadora, nome, vagas_disponiveis, autorizacao FROM empregadora WHERE (id_empregadora = '$caixa_pesquisa') OR (nome LIKE '%{$caixa_pesquisa}%')");
                        if(mysqli_num_rows($consultar_empregadora) > 0) {
                            $dado_empregadora = mysqli_fetch_array($consultar_empregadora);
                ?>
                    <form action="../_bd/salvar_contrato.php" method="post" class="row">
                        <input type="hidden" name="id_empregadora" id="id_empregadora" value="<?php echo $dado_empregadora['id_empregadora']; ?>">
                        <div class="col-sm-12 mb-2">
                            <label for="nome_empregadora" class="form-label">Nome da Empregadora *</label>
                            <input type="text" class="form-control" name="nome_empregadora" id="nome_empregadora" value="<?php echo $dado_empregadora['nome']; ?>" required>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-2">
                            <label for="num_vagas" class="form-label">Vagas *</label>
                            <input type="number" class="form-control" name="num_vagas" id="num_vagas" min="1" value="<?php echo $dado_empregadora['vagas_disponiveis']; ?>"  required>
                        </div>
                        <div class="col-md-6 col-lg-4 mb-2">
                            <label for="data_contrato" class="form-label">Data do contrato</label>
                            <input type="date" class="form-control" name="data_contrato" id="data_contrato" value="<?php echo $dado_empregadora['vagas_disponiveis']; ?>">
                        </div>
                        <div class="col-md-6 col-lg-4 mb-2">
                            <label>Autorizar *</label><br>
                            <?php if($dado_empregadora['autorizacao'] == 1) { ?>
                                <input type="radio" name="autorizacao" id="inputAutorizacao1" value="1" checked>
                                <label for="inputAutorizacao1">Sim</label><br>
                                <input type="radio" name="autorizacao" id="inputAutorizacao2" valeu="0">
                                <label for="inputAutorizacao2">Não</label>
                            <?php } else { ?>
                                <input type="radio" name="autorizacao" id="inputAutorizacao1" value="1">
                                <label for="inputAutorizacao1">Sim</label><br>
                                <input type="radio" name="autorizacao" id="inputAutorizacao2" valeu="0" checked>
                                <label for="inputAutorizacao2">Não</label>
                            <?php } ?>
                        </div>
                        <hr>
                        <div class="col-12 text-center">
                            <strong><p class="text-center my-2">Enviar depois de preencher!</p></strong>
                            <strong><P>Enquanto não for assinado o presente contrato, estará condicionado de publicar qualquer vaga!</P></strong>
                        </div>
                        <hr>
                        <div class=" mb-3 d-grid gap-2 col-sm-12 col-md-6">
                            <button type="submit" class="btn btn-success" name="enviar">Guardar</button>
                        </div>
                        <div class=" mb-3 d-grid gap-2 col-sm-12 col-md-6">
                            <button type="submit" class="btn btn-danger" name="Cancelar">Cancelar</button>
                        </div>
                    </form>
                <?php 
                            } else { 
                                echo "Nenhum resultado encontrado para " . $_GET['inputPesquisa'];
                            }
                    }
                ?>
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