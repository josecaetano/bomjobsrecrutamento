<?php
    //Importação da Base de dados
    require_once("../_bd/conexao.php");
    session_start();   
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
    <title>Cadastrar Empregadora | Bom Jobs Recrutamento</title>
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
            <h2 clas="text-primeira">Crie o seu perfil e publique as sua vagas de emprego.</h2>
            <form action="../_bd/cadastrar_empregadora.php" method="post" class="row">
                <div class="col-sm-12 col-lg-7 mb-3">
                    <label for="nome_empregadora" class="form-label">Nome da Empregadora *</label>
                    <input type="text" class="form-control" id="nome_empregadora" name="nome_empregadora" placeholder="Empresa ou empregador particular" required>
                </div>
                <div class="col-sm-12 col-lg-5 mb-3">
                    <label for="tipo_empresa" class="form-label">Tipo de Empresa *</label>
                    <select name="tipo_empresa" id="tipo_empresa" class="form-select" required>
                        <option value="Estatal">Estatal</option>
                        <option value="Privada">Privada</option>                        
                    </select>
                </div>
                <div class="col-sm-12 col-lg-6 mb-3">
                    <label for="area_actuacao" class="form-label">Área de Actuação *</label>
                    <input type="text" class="form-control" id="area_actuacao" name="area_actuacao" required>
                </div>
                <div class="col-sm-12 col-lg-6 mb-3">
                    <label for="tipo_industrial" class="form-label">Tipo Industrial *</label>
                    <select class="form-select" id="tipo_industrial" name="tipo_industrial" required>
                        <?php 
                            $selecionar_categoria = mysqli_query($conexao, "SELECT id_categoria, nome_categoria FROM categoria ORDER BY nome_categoria ASC");
                            if(mysqli_num_rows($selecionar_categoria) > 0) {
                                while($categoria = mysqli_fetch_array($selecionar_categoria)) {
                        ?>
                            <option value="<?php echo $categoria['nome_categoria']; ?>"><?php echo $categoria['nome_categoria']; ?></option>
                        <?php
                            }  }
                        ?>
                    </select>
                </div>
                <div class="col-sm-12 mb-3">
                    <label for="descricao" class="form-label">Descrição *</label>
                    <textarea name="descricao" class="form-control" id="descricao" rows="2" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="apresentacao" class="form-label">Apresentação *</label>
                    <textarea name="apresentacao" class="form-control" id="apresentacao" rows="2" required></textarea>
                </div>
                <div class="col-sm-12 col-lg-7 mb-3">
                    <label for="localizacao" class="form-label">Localização *</label>
                    <input type="text" class="form-control" id="localizacao" name="localizacao" required>
                </div>
                <div class="col-sm-12 col-lg-5 mb-3">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="telefone" name="telefone">
                </div>
                <div class="col-sm-12 col-lg-7 mb-3">
                    <label for="email" class="form-label">Email *</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="examplo@mail.com" required>
                </div>
                <div class="col-sm-12 col-lg-5 mb-3">
                    <label for="usuario" class="form-label">Nome de usuário *</label>
                    <input type="text" class="form-control" id="usuario" name="usuario" required>
                </div>
                <div class="col-sm-12 col-lg-6 mb-3">
                    <label for="senha" class="form-label">Senha *</label>
                    <input type="password" class="form-control" id="senha" name="senha" required>
                </div>
                <div class="col-sm-12 col-lg-6 mb-3">
                    <label for="inputCSenha" class="form-label">Confirmação da Senha *</label>
                    <input type="password" class="form-control" id="inputCSenha" name="confirmacao_senha" placeholder="Confirma a sua senha" required>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primeira" name="cadastrar">Cadastrar</button>
                    <span class="py-2">Já tens tem uma conta? <a href="../Login_Empregadora/">Inicie a sessão</a></span>
                </div>
            </form>
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