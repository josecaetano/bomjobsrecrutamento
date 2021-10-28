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
    <title>Todos candidatos disponíveis | Bom Jobs Recrutamento</title>
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
                    <li class="nav-item"><a class="nav-link active" href="../Candidatos/">Candidatos</a></li>
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
                <div class="col-sm-12 col-lg-6 mb-1">
                    <label for="campo-pesquisa" class="form-label">Pesquisa por candidatos disponíveis</label>
                    <input type="text" class="form-control" id="campo-pesquisa" name="pesquisa" placeholder="Pesquisa por nome do candidato, interesses ou localização" required>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-dark mb-3">Pesquisar</button>
                </div>
                <?php if(isset($_GET["pesquisa"])){ ?>
                    <h4 class="text-center">Resultado da pesquisa: <strong><?php echo $_GET["pesquisa"]; ?></strong></h4>
                <?php } ?>
            </form>
        </aside>
        <!-- Todos os candidatos -->
        <section id="vagas" class="container my-4">
            <?php
                //Buscando alguns candidatos
                $consulta = "SELECT * FROM candidato AS C INNER JOIN experiencia_profissional AS EP ON C.id_candidato = EP.cod_candidato INNER JOIN formacao_academica AS FA ON C.id_candidato = FA.cod_candidato";
                if(isset($_GET["pesquisa"])){
                    $pesquisa = $_GET["pesquisa"];
                    $consulta .= " WHERE (nome LIKE '%{$pesquisa}%') OR (provincia LIKE '%{$pesquisa}%')";
                }
                $resultado = mysqli_query($conexao, $consulta);
                if(mysqli_num_rows($resultado) > 0) {
                    while($informacao = mysqli_fetch_array($resultado)) {
            ?>
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-3">
                        <h4 class="h5">Dados Pessoais</h4>
                        <span>Nome completo: <strong><?php echo $informacao['nome']; ?></strong></span> <br>
                        <span>Data de nascimento: <strong><?php echo $informacao['data_nasc']; ?></strong></span> <br>
                        <span>Nacionalidade: <strong><?php echo $informacao['nacionalidade']; ?></strong></span> <br>
                        <span>Estado civil: <strong><?php echo $informacao['estado_civil']; ?></strong></span> <br>
                        <span><i class="bi bi-geo-alt-fill"></i> <?php echo $informacao['municipio']; ?>, <?php echo $informacao['provincia']; ?></span>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <h4 class="h5">Formação Acadêmica</h4>
                        <span>Título acadêmico: <strong><?php echo $informacao['fa1_titulo']; ?></strong></span> <br>
                        <span>Instituição: <strong><?php echo $informacao['fa1_instituto']; ?></strong></span> <br>
                        <span>Curso: <strong><?php echo $informacao['fa1_curso']; ?></strong></span> <br>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-3">
                        <h4 class="h5">Experiência Profissional</h4>
                        <span>Empresa recente: <strong> <?php echo $informacao['ep1_empregadora']; ?></strong></span> <br>
                        <span>Função: <strong><?php echo $informacao['ep1_funcao']; ?></strong></span> <br>
                        <span>Tempo de trabalho: <strong> <?php echo $informacao['ep1_data_inicio']; ?></strong></span>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-2">
                        <img src="../fotos-dos-candidatos/<?php echo $informacao['foto']; ?>" alt="" class="img-fluid">
                    </div>
                    <div class="d-grid col-sm-12 mt-1">
                        <a class="btn btn-primeira" href="../Curriculum/<?php echo $informacao['curriculum']; ?>">Baixar curriculum</a>
                    </div>
                </div>
            <?php
                }  } else {
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