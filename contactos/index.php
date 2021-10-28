<!doctype html>
<html lang="pt">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../_img/favicon.ico" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <!-- Ícones -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- Meu estilo -->
    <link rel="stylesheet" href="../_css/estilo.css">
    <title>Contactos | Bom Jobs Recrutamento</title>
    <style>
        #capa { background: url(../_img/capa-contactos.jpg); background-size: cover; height: 70vh; }
        fieldset { border-color: #000; }
        fieldset#localizacao { background: url("../_img/icone-localizacao.png") no-repeat 95% 95%; }
        #mensagem hr { margin: auto; width: 70px; } */
    </style>
</head>
<body>
    <!-- Menu - Barra de navegação -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primeira">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img src="../_img/logo-branco.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"> <a class="nav-link" href="../">Home</a> </li>
                    <li class="nav-item dropdown"> 
                        <a class="nav-link dropdown-toggle" id="navbarCandidato" role="button" data-bs-toggle="dropdown" aria-expanded="false">Candidatos</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarCandidato">
                            <li><a class="dropdown-item" href="../Login_Candidato/">Iniciar sessão</a></li>
                            <li><a class="dropdown-item" href="../Cadastro_Candidato/">Cadastrar-se</a></li>                            
                        </ul>
                    </li>
                    <li class="nav-item dropdown"> 
                        <a class="nav-link dropdown-toggle" id="navbarEmpregadores" role="button" data-bs-toggle="dropdown" aria-expanded="false">Empregadoras</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarEmpregadores">
                            <li><a class="dropdown-item" href="../Login_Empregadora/">Iniciar sessão</a></li>
                            <li><a class="dropdown-item" href="../Cadastro_Empregadora/">Cadastrar-se</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"> <a class="nav-link active" href="index.php">Contactos</a> </li>
                </ul>
            </div>
        </div>
    </nav>
    <main>
        <!-- Capa -->
        <section id="capa" class="row align-items-center justify-content-end pe-4">
            <div class="col-5">
                <h1 class="display-4 text-white fw-bold">Contactos</h1>
            </div>
        </section>
        <!-- Contactos -->
        <section id="mensagem" class="container py-4">
            <h3 class="text-center">Entre em contacto</h3>
            <hr>
            <p class="text-center">Envia a sua mensagem, preenchendo o formulário abaixo</p>
            <div class="container">
                <form action="" method="post" class="row">
                    <div class="col-sm-12">
                        <label for="nomeUser" class="form-label">Nome Completo *</label>
                        <input type="text" class="form-control" id="nomeUser" placeholder="Seu nome completo" required>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="emailUser" class="form-label">Email *</label>
                        <input type="email" class="form-control" id="emailUser" placeholder="O seu email" required>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="telefoneUser" class="form-label">Telefone</label>
                        <input type="text" class="form-control" id="telefoneUser" placeholder="O seu terminal telefônico" required>
                    </div>
                    <div class="mb-3">
                        <label for="textoUser" class="form-label">Mensagem</label>
                        <textarea class="form-control" id="textoUser" rows="3"></textarea>
                    </div>
                </form>
            </div>
        </section>
        
        <div id="mapa">

        </div>
        <!-- Rodapé -->
        <?php include_once("../_incluir/rodape.php"); ?>
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