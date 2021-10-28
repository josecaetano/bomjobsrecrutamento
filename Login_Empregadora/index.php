<?php
    //Importação da Base de dados
    require_once("../_bd/conexao.php");
    //Verificação
    if(isset($_POST["entrar"])) {
		$usuario    = mysqli_escape_string($conexao, $_POST["usuario"]);
	    $senha      = mysqli_escape_string($conexao, $_POST["senha"]);
	    $verificar  = mysqli_query($conexao, "SELECT * FROM empregadora AS E WHERE (usuario = '$usuario' OR telefone = '$usuario') AND senha = '$senha' AND E.status = 1");
	    if (mysqli_num_rows($verificar) <= 0 ) {
	    	$_SESSION['erroLogin'] = "Informações de login inválidas! Atenção: caso tenhas feito o cadastro recentemente, precisas aguardar até que o administrador aprove a tua candidatura.";
	    } else {          
            session_start();
            $result = mysqli_fetch_array($verificar);
	        $_SESSION['Empregadora_Logada'] = $result['id_empregadora'];
	        header('Location: ../Painel_Empregadora/');
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
    <title>Login | Empregadora</title>
    <style>
        #login { width: 40%; }
        @media screen and (max-width: 700px) { 
            #login { width: 100%; }
        }
    </style>
</head>
<body>
    <!-- Menu - Barra de navegaçãp -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primeira">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php"><img src="../_img/logo-branco.png"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"> <a class="nav-link active" href="../"><i class="bi bi-house-fill"></i> Home</a> </li>
                </ul>
            </div>
        </div>
    </nav>
    <main>
        <!-- Login -->
        <section id="login" class="container my-4">
            <h2 class="text-primeira">Entre na sua conta, publique as suas vagas de forma rápida e encontre candidatos qualificados.</h2>
            <form action="index.php" method="post">
                <div class="mb-3">
                    <label for="inputUsuario" class="form-label">Usuário</label>
                    <input type="text" class="form-control" id="inputUsuario" name="usuario" placeholder="Nome de usuário ou email" required>
                </div>
                <div class="mb-3">
                    <label for="inputSenha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="inputSenha" name="senha" required>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primeira" name="entrar">Entrar</button>
                    <span class="py-2">Ainda não tem uma conta? <a href="../Cadastro_Empregadora/">Cadastre-se</a></span>
                </div>
            </form>
            <?php   if(isset($_SESSION['erroLogin'])) { ?>
                <div class="alert alert-danger mt-1 p-2 rounded">
                    <?php echo $_SESSION['erroLogin']; unset($_SESSION['erroLogin']); ?>
                </div>
            <?php   } ?>
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