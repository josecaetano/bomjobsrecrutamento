<?php 
    //Importação da Base de dados
    require_once("../_bd/conexao.php"); 
    session_start();
    //Controle de segurança
    if (!isset($_SESSION['Contratante_Logado'])) {
        header('Location: ../Login_Contratante/');
    }
    $id_contratante = $_SESSION['Contratante_Logado'];
    $consultar_admin = mysqli_query($conexao, "SELECT * FROM contratante_bj WHERE id_contratante = '$id_contratante'");
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
                    <li class="nav-item"><a class="nav-link" href="../Contrato_Empregadora/">Contrato</a></li>
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
        <div class="Container">
            <div class="row">
                <div class="col-sm-12 col-md-7">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <img src="../_img/capa.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                        <img src="../_img/capa.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                        <img src="../_img/capa.jpg" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>   
                </div>
                <div class="col-sm-12 col-md-5 my-2 text-center">
                    <h4>Contratos e suas Claúsulas</4> 
                </div>
            </div>
        </div>
        <div class="container my-4 text-center">
        <h3>Empregadoras existentes</h3>

        <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdropContratante" class="btn btn-primeira my-3">Ver todas</button>
        <hr>
            <div class="row">
                <div class="col-sm-12 col-md-4 my-3">
                    <h5>Empregadoras Recentes</h5>

                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos aut vel molestias enim? Vitae voluptas rem hic ut ipsa recusandae excepturi voluptatibus architecto doloribus aut suscipit quisquam, eaque sunt sint!</p>

                        <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdropRecentes" class="btn btn-primeira my-3">Todas</button>
                </div>
                <div class="col-sm-12 col-md-4 my-3">
                    <h5>Empregadoras em espera</h5>

                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos aut vel molestias enim? Vitae voluptas rem hic ut ipsa recusandae excepturi voluptatibus architecto doloribus aut suscipit quisquam, eaque sunt sint!</p>

                    <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdropEspera" class="btn btn-primeira my-3">Todas</button>
                </div>
                <div class="col-sm-12 col-md-4 my-3">
                    <h5>Empregadoras contradas</h5>

                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos aut vel molestias enim? Vitae voluptas rem hic ut ipsa recusandae excepturi voluptatibus architecto doloribus aut suscipit quisquam, eaque sunt sint!</p>

                    <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdropContratadas" class="btn btn-primeira my-3">Todas</button>
                </div>
            </div>
        </div>
    </main>
    <!-- Modal Empregadoras Contratante -->
    <div class="modal fade" id="staticBackdropContratante" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen-xxl-down">
            <div class="modal-content">
            <div class="modal-header bg bg-primeira text-white">
                <h5 class="modal-title" id="staticBackdropLabel">TODAS EMPREGADORAS</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis, dolorum non. Rem eaque dignissimos harum animi deserunt, ad inventore consequatur nisi est ipsum sit assumenda enim saepe atque odio possimus.</p>
            </div>
            <div class="modal-footer bg bg-primeira">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal Empregadoras Recentes -->
    <div class="modal fade" id="staticBackdropRecentes" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header bg bg-primeira text-white">
                <h5 class="modal-title" id="staticBackdropLabel">EMPREGADORAS RECENTES</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni sit, facilis molestias quisquam incidunt beatae totam? Nihil culpa illum deleniti, similique nesciunt vitae necessitatibus eveniet nobis, consequuntur ducimus delectus odit!</p>
            </div>
            <div class="modal-footer bg bg-primeira">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal Empregadoras em espera -->
    <div class="modal fade" id="staticBackdropEspera" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header bg bg-primeira text-white">
                <h5 class="modal-title" id="staticBackdropLabel">EMPREGADORAS EM ESPERA</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus ex accusamus quasi nulla fugiat laudantium iure exercitationem atque aut quo et, dolor adipisci delectus sit blanditiis quod commodi, repellendus natus.</p>
            </div>
            <div class="modal-footer bg bg-primeira">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal Empregadoras Contradas -->
    <div class="modal fade" id="staticBackdropContratadas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header bg bg-primeira text-white">
                <h5 class="modal-title" id="staticBackdropLabel">EMPREGADORAS CONTRADAS</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum neque distinctio, laudantium tempore velit, ipsam dolorum minima sapiente incidunt eos libero ratione odio. Aliquid, laudantium! Magni omnis hic voluptates eaque?</p>
            </div>
            <div class="modal-footer bg bg-primeira">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
            </div>
            </div>
        </div>
    </div>

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