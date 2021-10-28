<?php 
    //Importação da Base de dados
    include_once("_bd/conexao.php");
    session_start();
?>
<!doctype html>
<html lang="pt">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="_img/favicon.ico" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <!-- Ícones -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- Meu estilo -->
    <link rel="stylesheet" href="_css/estilo.css">
    <title>Bom Jobs Recrutamento</title>
    <style>
        #capa { background: url(_img/capa.jpg); background-size: cover; height: 90vh; }
        main { margin-top: -60px; }
    </style>
</head>
<body>
    <!-- Menu - Barra de navegação -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img src="_img/logo.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"> <a class="nav-link active" aria-current="page" href="index.php">Home</a> </li>
                    <li class="nav-item dropdown"> 
                        <a class="nav-link dropdown-toggle" id="navbarCandidato" role="button" data-bs-toggle="dropdown" aria-expanded="false">Candidatos</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarCandidato">
                            <li><a class="dropdown-item" href="Login_Candidato/">Iniciar sessão</a></li>
                            <li><a class="dropdown-item" href="Cadastro_Candidato/">Cadastrar-se</a></li>                            
                        </ul>
                    </li>
                    <li class="nav-item dropdown"> 
                        <a class="nav-link dropdown-toggle" id="navbarEmpregadores" role="button" data-bs-toggle="dropdown" aria-expanded="false">Empregadoras</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarEmpregadores">
                            <li><a class="dropdown-item" href="Login_Empregadora/">Iniciar sessão</a></li>
                            <li><a class="dropdown-item" href="Cadastro_Empregadora/">Cadastrar-se</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="Contactos/">Contactos</a> </li>
                </ul>
            </div>
        </div>
    </nav>
    <main>
        <!-- Capa -->
        <section id="capa" class="row align-items-center justify-content-end pe-4">
            <div class="col-5">
                <p class="h3 text-primeira fw-light">BEM-VINDO</p>
                <h1 class="display-5 text-segunda fw-bold">VAGAS DE EMPREGO</h1>
                <p class="h3 text-primeira fw-light">ENCONTRE O EMPREGO IDEAL PARA VOCÊ DE FORMA FÁCIL</p>
                <a href="Login_Candidato/" class="btn btn-segunda">CANDIDATAR-SE</a>
            </div>
        </section>
        <!-- Sobre -->
        <section id="empregos" class="container py-3">
            <div class="row text-center">
                <h2 class="h4 text-primeira mb-2">Empregos mais recentes</h2>
                    <?php
                        $consultar_empregos = mysqli_query($conexao, "SELECT * FROM vaga AS V INNER JOIN empregadora AS E ON V.cod_empregadora = E.id_empregadora LIMIT 6");
                        if(mysqli_num_rows($consultar_empregos) > 0) {
                            while($emprego = mysqli_fetch_array($consultar_empregos)) {
                    ?>
                        <div class="col-sm-12 col-md-4 mt-3">
                            <span><?php echo $emprego['nome_vaga']; ?></span>
                            <p><?php echo $emprego['nome']; ?></p>
                            <a href="#" class="my-1 btn btn-segunda">Leia mais.</a>
                        </div>
                    <?php } } ?> 
            </div>
            <div class="text-center mt-4">
                <a href="#" class="btn btn-primeira" data-bs-toggle="modal" data-bs-target="#staticBackdropMais">Ver todas</a>
            </div>
        </section>
        <!-- Modal das vagas -->
        <div class="modal fade" id="staticBackdropMais" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header bg-primeira">
                        <h5 class="modal-title text-center text-white" id="staticBackdropLabel">Empregos mais perto de você!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body card-body">
                        <div class="row text-justyfi">
                            <?php
                                $consultar_empregos = mysqli_query($conexao, "SELECT * FROM vaga AS V INNER JOIN empregadora AS E ON V.cod_empregadora = E.id_empregadora LIMIT 6");
                                if(mysqli_num_rows($consultar_empregos) > 0) {
                                    while($emprego = mysqli_fetch_array($consultar_empregos)) {
                            ?>
                                <div class="col-sm-12 col-lg-3 my-3 mx-1 card bg-terceira">
                                    <span><strong>VAGA: </strong><?php echo $emprego['nome_vaga']; ?></span><br>
                                    <span><strong>Tipo: </strong><?php echo $emprego['tipo_emprego']; ?></span><br>
                                    <span><strong>Disponível: </strong><?php echo $emprego['num_vagas']; ?> vagas.</span><br>
                                    <span><strong>Experiência: </strong><?php echo $emprego['r2_experiencia']; ?> anos.</span><br>
                                    <span><strong>Descrição: </strong><?php echo $emprego['descricao_vaga']; ?></span><br>
                                    <span><strong>Titulação: </strong><?php echo $emprego['r1_titulacao']; ?></span><br>
                                    <span><strong>Nacionalidade: </strong><?php echo $emprego['r3_nacionalidade']; ?></span><br>
                                    <span><strong>Publicada: </strong><?php echo $emprego['data_publicacao']; ?></span><br>
                                    <span><strong>Expiração: </strong><?php echo $emprego['data_expiracao']; ?></span><br>
                                    <p><strong>Empregadora: </strong><?php echo $emprego['nome']; ?></p>
                                    <a href="#" class="my-2 btn btn-primeira popover-test" title="Popover title" data-bs-content="Popover body content is set in this attribute.">Candidatar-se</a>
                                </div>
                            <?php } } ?> 
                        </div>
                    </div>
                    <div class="modal-footer bg-primeira">
                        <p class="text-white">Precisa ser <strong>cadastrado</strong> para candidatar-se a uma vaga de emprego!</p>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- 1º -->
        <section class="bg-terceira py-5">
            <div class="container py-1">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-5">
                        <img src="_img/publicar-post.png" alt="" class="img-fluid">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-7 text-start">
                        <h3 class="h2">Publique vagas ilimitadas</h3>
                        <p>Tens acesso ao seu próprio painel de controle. Podes administrar as suas vagas da melhor forma, saber a tempo quem se candidatou ás suas vagas e entre outras vantagens</p>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ex, laudantium neque blanditiis, architecto magni doloribus consequatur labore explicabo veritatis commodi exercitationem eveniet voluptatum saepe optio velit ea possimus sapiente itaque.</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- 2º -->
        <section class="py-5">
            <div class="container py-1">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-7 text-start">
                        <h3 class="h2">Inscrição online para candidatos</h3>
                        <p>Tens acesso ao seu próprio painel de controle. Podes administrar as suas vagas da melhor forma, saber a tempo quem se candidatou ás suas vagas e entre outras vantagens</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate fugit officiis autem deleniti est repellendus sit dolor magni quidem laudantium explicabo nemo error, consectetur accusantium itaque numquam esse omnis inventore.</p>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-5">
                        <img src="_img/trabalho-em-casa.png" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </section>
        <!-- 3º -->
        <section class="bg-terceira py-5">
            <div class="container py-1">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-7 text-start">
                        <h3 class="h2">Crie o seu curriculum online</h3>
                        <p>Tens acesso ao seu próprio painel de controle. Podes administrar as suas vagas da melhor forma, saber a tempo quem se candidatou ás suas vagas e entre outras vantagens</p>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Autem aspernatur architecto praesentium animi fugit. Nesciunt, porro deleniti! Dolorum, dignissimos! Praesentium, eaque ab. Nostrum nulla ad accusantium dolor magni expedita voluptatum.</p>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-5">
                        <img src="_img/cv-online.png" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- Rodapé -->
    <?php include_once("_incluir/rodape.php"); ?>
    
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