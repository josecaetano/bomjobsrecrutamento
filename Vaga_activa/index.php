<?php 
    require_once("../_bd/conexao.php");
    session_start();
     //Controle de segurança
     if (!isset($_SESSION['Admin_Logado'])) {
        header('Location: ../Login_Admin/');
    }
    $id_admin = $_SESSION['Admin_Logado'];
    $consultar_admin = mysqli_query($conexao, "SELECT * FROM admin_bj WHERE id_admin = '{$id_admin}'");
    $admim = mysqli_fetch_array($consultar_admin);

    $cons = mysqli_query($conexao, "SELECT id_vaga, data_expiracao FROM vaga");
    if(mysqli_num_rows($cons) > 0){
        while($vag = mysqli_fetch_array($cons)){
            $id_vaga = $vag['id_vaga'];
            if($vag['data_expiracao'] <= date('Y-m-d')){
                $comando_actualizar = mysqli_query($conexao, "UPDATE vaga SET status_vaga = 0 WHERE id_vaga = '$id_vaga'");
            }
        }
    }
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
    <title>Todos as vagas | Bom Jobs Recrutamento</title>
    <style>
        aside { background-color: #f2f2f2; }
        #vagas > div { border: 1px solid #c3c3c3; padding: 10px; margin-bottom: 10px; }
        #vagas span { color: #003461; text-decoration: none; }
    </style>
</head>
<body>
    <!-- Menu - Barra de navegaçãp -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primeira">
        <div class="container-fluid">
            <a class="navbar-brand" href="../Painel_Candidato/"><img src="../_img/logo-branco.png"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="../Painel_Admin/">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="../Empregadoras/">Empregadoras</a></li>
                    <li class="nav-item"><a class="nav-link" href="../Candidatos/">Candidatos</a></li>
                    <li class="nav-item"><a class="nav-link active" href="../Vaga_activa/">Vagas</a></li>
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
                <span class="h5"><strong> <?php echo $admim['nome']; ?> </strong></span>
            </div>
            <div class="d-grid mt-2">
                <a href="../_incluir/logout.php"class="btn btn-danger">Terminar sessão</a>
            </div>
        </div>
    </div>
    <main>
        <!-- Pesquisa de vagas -->
        <aside class="container mt-3 p-3">
            <form action="index.php" method="GET" class="row">
                <div class="col-12 mb-1">
                    <label for="campo-pesquisa" class="form-label">Pesquisa por vagas</label>
                    <input type="text" class="form-control" id="campo-pesquisa" name="pesquisa" placeholder="Pesquisa por nome da vaga ou tipo de vaga" required>
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-dark mb-3">Pesquisar</button>
                </div>
                <?php if(isset($_GET["pesquisa"])){ ?>
                    <h4 class="text-center">Resultado da pesquisa: <strong><?php echo $_GET["pesquisa"]; ?></strong></h4>
                <?php } ?>
            </form>
        </aside>
        <!-- Todas as vagas -->
        <section id="vagas" class="container my-4">
            <?php   if(isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger" role="alert">
                <?php    echo $_SESSION['error'];
                    unset($_SESSION['error']); ?>
            </div>
            <?php   } ?>
            <?php   if(isset($_SESSION['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php    echo $_SESSION['success'];
                        unset($_SESSION['success']); ?>
                </div>
            <?php   } ?>
            <?php
                //Buscando algumas vagas de emprego
                $consulta = "SELECT * FROM vaga AS V INNER JOIN empregadora AS E ON V.cod_empregadora = E.id_empregadora";
                if(isset($_GET["pesquisa"])) {
                    $pesquisa = $_GET["pesquisa"];
                    $consulta .= " WHERE (nome_vaga LIKE '%{$pesquisa}%') OR (tipo_emprego LIKE '%{$pesquisa}%')";
                }
                $consulta .= " ORDER BY id_vaga DESC LIMIT 10";
                $resultado = mysqli_query($conexao, $consulta);
                if(mysqli_num_rows($resultado) > 0){
                    while($informacao = mysqli_fetch_array($resultado)){
            ?>
                <div class="row">
                    <div class="col-sm-12 col-md-5 col-lg-5">
                        <h4 class="h5">Informações</h4>
                        <span class="text-primeira h6">Nome da vaga: <strong><?php echo $informacao['nome_vaga']; ?></strong></span> <br>
                        <span>Descrição: <strong><?php echo $informacao['descricao_vaga']; ?></strong></span> <br> 
                        <span>Número de vagas: <strong><?php echo $informacao['num_vagas']; ?></strong></span> <br> 
                        <span>Empregadora: <strong><?php echo $informacao['nome']; ?></strong></span>
                    </div>
                    <div class="col-sm-12 col-md-5 col-lg-5">
                        <h4 class="h5">Outros</h4>
                        <span><strong>Tipo:</strong> <?php echo $informacao['tipo_emprego']; ?></span> <br>
                        <span><strong>Data da publicação:</strong> <?php echo $informacao['data_publicacao']; ?></span> <br>
                        <span><strong>Data do fim:</strong> <?php echo $informacao['data_expiracao']; ?></span>
                    </div>
                    <div class="col-sm-12 col-md-2 col-lg-2">
                        <?php if($informacao['status_vaga'] == 0) { ?>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $informacao['id_vaga']; ?>">Inactiva</button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal<?php echo $informacao['id_vaga']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="../_bd/activar_vaga.php" method="post" class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Activar vaga | <?php echo $informacao['id_vaga']; ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div>
                                                <p>Nome da vaga: <strong><?php echo $informacao['nome_vaga']; ?></strong></p>
                                                <p><?php echo $informacao['data_expiracao']; ?></p>
                                                <input type="date" class="form-control" name="nova_data" id="nova_data" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
                                                <input type="hidden" name="codigo" value="<?php echo $informacao['id_vaga']; ?>">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                            <button type="submit" class="btn btn-primary">Salvar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php } else { ?>
                            <a href="../_bd/desactivar_vaga.php?codigo=<?php echo $informacao['id_vaga']; ?>" class="btn btn-success">Activa</a>
                        <?php } ?>
                    </div>
                </div>
            <?php
                    }
                } else {
                    echo "Nenhum resultado encontrado";
                }
            ?>
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