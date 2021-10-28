<?php 
    //Importação da Base de dados
    require_once("../_bd/conexao.php"); 
    session_start();
    //Controle de segurança
    if (!isset($_SESSION['Empregadora_Logada'])) {
        header('Location: ../Login_Empregadora/');
    }
    $id_empregadora = $_SESSION['Empregadora_Logada'];
    $consultar_empregadora = mysqli_query($conexao, "SELECT * FROM empregadora WHERE id_empregadora = '{$id_empregadora}'");
    $empregadora = mysqli_fetch_array($consultar_empregadora);
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
    <title>Painel de controle | Empregadora</title>
    <style>
        div h2 { background-color: #cecece; text-align: center; padding: 15px 0; text-transform: uppercase; }
        #vaga { border-bottom: 1px solid #c3c3c3; padding: 10px; }
        #vaga a { color: #003461; text-decoration: none; }
        small { font-weight: bold; text-transform: uppercase; padding: 15px; margin-top: 10px; }
        #error { color: red; background-color: #f8dada; }
        #success { color: green; background-color: #c8e7c8; }
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
                    <li class="nav-item"> <button class="nav-link active btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Minha conta <i class="bi bi-arrow-down"></i></button> </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">Dados da Empregadora</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="row">
                <span class="h5"><strong> <?php echo $empregadora['nome']; ?> </strong></span> <br>
                <span><strong>Descrição:</strong> <?php echo $empregadora['descricao']; ?> </span> <br>
                <span><strong>Localizaçõo:</strong> <?php echo $empregadora['localizacao']; ?> </span> <br>
                <span><strong>Telefone:</strong> <?php echo $empregadora['telefone']; ?> </span> <br>
                <span><strong>Email:</strong> <?php echo $empregadora['email']; ?> </span> <br>
                <span><strong>Administrador:</strong> <?php echo $empregadora['usuario']; ?> </span> <br>
            </div>
            <div class="d-grid">
                <a href="../_incluir/logout.php"class="btn btn-danger">Terminar sessão</a>
            </div>
        </div>
    </div>
    <main>
        </section>
        <!-- Painel-->
        <section id="painel" class="container py-3">
            <nav class="col">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Publicar vaga</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Minhas vagas</button>
                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Candidatos</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <h2 class="h3">Publicar Vaga</h2>
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
                    <form action="../_bd/cadastro_vaga.php" method="post" class="pt-3 row needs-validation" novalidate>
                        <div class="col-sm-12 col-md-6">
                            <div class="row">
                                <div class="col-sm-12 col-lg-6 mb-3">
                                    <label for="nome_vaga" class="form-label">Nome da vaga *</label>
                                    <input type="text" class="form-control" id="nome_vaga" name="nome_vaga" placeholder="Exemplo: Fotógrafo" required>
                                    <div class="valid-feedback">Looks good!</div>
                                </div>
                                <div class="col-sm-12 col-lg-6 mb-3">
                                    <label for="industria" class="form-label">Indústria *</label>
                                    <select class="form-select" id="industria" name="industria" required>
                                        <?php 
                                            $selecionar_categoria = mysqli_query($conexao, "SELECT id_categoria, nome_categoria FROM categoria ORDER BY nome_categoria ASC");
                                            if(mysqli_num_rows($selecionar_categoria) > 0) {
                                                while($categoria = mysqli_fetch_array($selecionar_categoria)) {
                                        ?>
                                            <option value="<?php echo $categoria['id_categoria']; ?>"><?php echo $categoria['nome_categoria'] ?></option>
                                        <?php
                                            }  }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-lg-4 mb-3">
                                    <label for="tipo_emprego" class="form-label">Tipo de emprego *</label>
                                    <select class="form-select" id="tipo_emprego" name="tipo_emprego" required>
                                        <option value="Freelancer">Freelancer</option>
                                        <option value="Meio período">Meio período</option>
                                        <option value="Permanente">Tempo inteiro</option>
                                        <option value="Estágio">Estágio</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-lg-4 mb-3">
                                    <label for="num_vagas" class="form-label">Nº de vagas *</label>
                                    <input type="number" class="form-control" name="num_vagas" id="num_vagas" min="1" required>
                                </div>
                                <div class="col-sm-12 col-lg-4 mb-3">
                                    <label for="data_expiracao" class="form-label">Data de Expiração *</label>
                                    <input type="date" min="<?php echo date('Y-m-d'); ?>" class="form-control" name="data_expiracao" id="data_expiracao" required>
                                </div>
                                <div class="col-sm-12 mb-3">
                                    <label for="descricao" class="form-label">Descrição do trabalho *</label>
                                    <textarea class="form-control" id="descricao" name="descricao" rows="2" placeholder="Descreva a função do empregado" required></textarea>
                                </div>
                               
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="row">
                                <div class="col-sm-12 col-lg-4 mb-3">
                                    <label for="titulacao_minima" class="form-label">Titulação mínima *</label>
                                    <select class="form-select" aria-label="Default select example" id="titulacao_minima" name="titulacao_minima">
                                        <option selected>Ensino básico</option>
                                        <option value="Ensino médio">Ensino médio</option>
                                        <option value="Frequência universitária">Universitário</option>
                                        <option value="Licenciatura">Licenciatura</option>
                                        <option value="Mestrado">Mestrado</option>
                                        <option value="Doutorado">Doutorado</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-lg-4 mb-3">
                                    <label for="experiencia" class="form-label">Anos de Experiência *</label>
                                    <select name="experiencia" id="experiencia" class="form-select">
                                        <option selected>Nenhum</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10 ou mais">10 ou mais</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-lg-4 mb-3">
                                    <label for="nacionalidade" class="form-label">Nacionalidade *</label>
                                    <input class="form-control" list="datalistOptions" id="nacionalidade" name="nacionalidade">
                                    <datalist id="datalistOptions">
                                        <?php
                                            $consultar_nacionalidade = mysqli_query($conexao, "SELECT * FROM nacionalidade ORDER BY nacionalidade ASC");
                                            if(mysqli_num_rows($consultar_nacionalidade) > 0) {
                                                while($nacionalidade = mysqli_fetch_array($consultar_nacionalidade)) {
                                        ?>
                                        <option value="<?php echo $nacionalidade['nacionalidade'] ?>">
                                        <?php } } ?>
                                    </datalist>   
                                </div>
                                <div class="col-sm-12 col-lg-3 mb-3">
                                    <label for="lingua" class="form-label">Lingua falada *</label>
                                    <input class="form-control" list="datalistOptions" id="lingua" placeholder="O idioma" name="lingua">
                                    <datalist id="datalistOptions">
                                        <option value="Chinês">
                                        <option value="Espanhol">
                                        <option value="Francês">
                                        <option value="Inglês">
                                        <option value="Português">
                                        <option value="Vietnamita">                             
                                    </datalist>
                                </div>
                                <div class="col-sm-12 col-lg-3 mb-3">
                                    <label for="inputSalario" class="form-label">Salário *</label>
                                    <input type="text" class="form-control" name="salario" id="inputSalario" required>
                                </div>
                                <div class="col-sm-12 col-lg-3 mb-3">
                                    <label for="idadeMin" class="form-label">Idade mínima *</label>
                                    <input type="number" min="0" max="60" class="form-control" name="idadeMin" id="idadeMin" required>
                                </div>
                                <div class="col-sm-12 col-lg-3 mb-3">
                                    <label for="idadeMax" class="form-label">Idade máxima *</label>
                                    <input type="number" min="0" max="60" class="form-control" name="idadeMax" id="idadeMax" required>
                                </div>
                                <div class="col-sm-12 col-lg-6 mb-6">
                                    <label for="area" class="form-label">Área *</label>
                                    <input type="text" class="form-control" name="area" id="area" required>
                                </div>
                                <div class="col-sm-12 col-lg-6 mb-3">
                                    <label for="genero" class="form-label">Gênero *</label>
                                    <select name="genero" id="genero" class="form-select">
                                        <option selected>Homem e Mulher</option>
                                        <option value="Homem">Homem</option>
                                        <option value="Mulher">Mulher</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-lg-6 mb-3">
                                    <label for="provincia" class="form-label">Província *</label>
                                    <select name="provincia" id="provincia" class="form-select" required>
                                        <option selected>Luanda</option>
                                        <option value="Bengo">Bengo</option>
                                        <option value="Benguela">Benguela</option>
                                        <option value="Bié">Bié</option>
                                        <option value="Cabinda">Cabinda</option>
                                        <option value="Cuando-Cubango">Cuando-Cubango</option>
                                        <option value="Cunene">Cunene</option>
                                        <option value="Huambo">Huambo</option>
                                        <option value="Huíla">Huíla</option>
                                        <option value="Kwanza Sul">Kwanza Sul</option>
                                        <option value="Kwanza Norte">Kwanza Norte</option>
                                        <option value="Lunda Sul">Lunda Sul</option>
                                        <option value="Lunda Norte">Lunda Norte</option>
                                        <option value="Malanje">Malanje</option>
                                        <option value="Moxico">Moxico</option>
                                        <option value="Namibe">Namibe</option>
                                        <option value="Uíge">Uíge</option>
                                        <option value="Zaire">Zaire</option>
                                        
                                    </select>
                                </div>
                                <div class="col-sm-12 col-lg-6 mb-3">
                                    <label for="municipio" class="form-label">Município *</label>
                                    <select name="municipio" id="municipio" class="form-select" required>
                                        <option selected>Luanda</option>
                                        <option value="Sambizanga">Sambizanga</option>
                                        <option value="Ambriz">Ambriz</option>
                                        <option value="Andulo">Andulo</option>
                                        <option value="Ambaca">Ambaca</option>
                                        <option value="Ambuim">Ambuim</option>
                                        <option value="Alto Zambeze">Alto Zambeze</option>
                                        <option value="Auto Cauale">Auto Cauale</option>
                                        <option value="Ambuíla">Ambuíla</option>
                                        <option value="Banga">Banga</option>
                                        <option value="Baia Farta">Baia Farta</option>
                                        <option value="Balombo">Balombo</option>
                                        <option value="Bailundo">Bailundo</option>
                                        <option value="Belas">Belas</option>
                                        <option value="Benguela">Benguela</option>
                                        <option value="Bembe">Bembe</option>
                                        <option value="Belize">Belize</option>
                                        <option value="Bocoio">Bocoio</option>
                                        <option value="Bolongongo">Bolongongo</option>
                                        <option value="Bibala">Bibala</option>
                                        <option value="Bundas">Bundas</option>
                                        <option value="Buengas">Buengas</option>
                                        <option value="Bungo">Bungo</option>
                                        <option value="Bucu-Zau">Bucu-Zau</option>
                                        <option value="Bula Atumba">Bula Atumba</option>
                                        <option value="Caála">Caála</option>
                                        <option value="Cabinda">Cabinda</option>
                                        <option value="Caombo">Caomba</option>
                                        <option value="Caconda">Caconda</option>
                                        <option value="Caungula">Caungula</option>
                                        <option value="Caiambambo">Caiambambo</option>
                                        <option value="Cacongo">Cacongo</option>
                                        <option value="Cacolo">Cacolo</option>
                                        <option value="Cacula">Cacula</option>
                                        <option value="Cacuaco">Cacuaco</option> 
                                        <option value="Cacuso">Cacuso</option>
                                        <option value="Calai">Calai</option>
                                        <option value="Calandula">Calandula</option>
                                        <option value="Caluquembe">Caluquembe</option>
                                        <option value="Cahama">Cahama</option>
                                        <option value="Cahiungo">Cahiungo</option>
                                        <option value="Cambulo">Cambulo</option>
                                        <option value="Camacupa">Camacupa</option>
                                        <option value="Cameia">Cameia</option>
                                        <option value="Camanongue">Camanongue</option>
                                        <option value="Camucuio">Camucuio</option>
                                        <option value="Cambambe">Cambambe</option>
                                        <option value="Cambundi-Catembo">Cambundi-Catembo</option>
                                        <option value="Cangandala">Cangandala</option>
                                        <option value="Capenda-Camulemba">Capenda-Camulemba</option>
                                        <option value="Cassongue">Cassongue</option>
                                        <option value="Catabola">Catabola</option>
                                        <option value="Catumbela">Catumbela</option>
                                        <option value="Cazengo">Cazengo</option>
                                        <option value="Cela">Cela</option>
                                        <option value="Cicala-Choloanga">Cicala-Choloanga</option>
                                        <option value="Citato">Citato</option>
                                        <option value="Conda">Conda</option>
                                        <option value="Cuaba Nzoji">Cuaba Nzoji</option>
                                        <option value="Cuangar">Cuangar</option>
                                        <option value="Cuango">Cuango</option>
                                        <option value="Cuílo">Cuílo</option>
                                        <option value="Cuanhama">Cuanhama</option>
                                        <option value="Cuemba">Cuemba</option>
                                        <option value="Cuimba">Cuimba</option>
                                        <option value="Cuito">Cuito</option>
                                        <option value="Cubal">Cubal</option>
                                        <option value="Cunda-dia-Baze">Cunda-dia-Baze</option>
                                        <option value="Cunhinga">Cunhinga</option>
                                        <option value="Cuchi">Cuchi</option>
                                        <option value="Curoca">Curoca</option>
                                        <option value="Cuvango">Cuvango</option>
                                        <option value="Cuvelai">Cuvelai</option>
                                        <option value="Chiange">Chiange</option>
                                        <option value="Chibia">Chibia</option>
                                        <option value="Chicomba">Chicomba</option>
                                        <option value="Chinguar">Chinguar</option>
                                        <option value="Chinjenje">Chinjenje</option>
                                        <option value="Chipindo">Chipindo</option>
                                        <option value="Chitembo">Chitembo</option>
                                        <option value="Chongoroi">Chongoroi</option>
                                        <option value="Dala">Dala</option>
                                        <option value="Dande">Dande</option>
                                        <option value="Damba">Damba</option>
                                        <option value="Dembos">Dembos</option>
                                        <option value="Dirico">Dirico</option>
                                        <option value="Ebo">Ebo</option>
                                        <option value="Ecunha">Ecunha</option>
                                        <option value="Ganda">Ganda</option>
                                        <option value="Gonguembo">Gonguembo</option>
                                        <option value="Gulungo Alto">Gulungo Alto</option>
                                        <option value="Huambo">Huambo</option>
                                        <option value="Humpata">Humpata</option>
                                        <option value="Ícolo e Bengo">Ícolo e Bengo</option>
                                        <option value="Jamba">Jamba</option>
                                        <option value="Léua">Léua</option>
                                        <option value="Lobito">Lobito</option>
                                        <option value="Londuimbali">Londuimbali</option>
                                        <option value="Longonjo">Longonjo</option>
                                        <option value="Lóvua">Lóvua</option>
                                        <option value="Luacano">Luacano</option>
                                        <option value="Luau">Luau</option>
                                        <option value="Lubango">Lubango</option>
                                        <option value="Lubalo">Lubalo</option>
                                        <option value="Lucapa">Lucapa</option>
                                        <option value="Lucala">Lucala</option>
                                        <option value="Luchazes">Luchazes</option>
                                        <option value="Luquembo">Luquembo</option>
                                        <option value="Malanje">Malanje</option>
                                        <option value="Massango">Massango</option>
                                        <option value="Matala">Matala</option>
                                        <option value="Marimba">Marimba</option>
                                        <option value="Mavinga">Mavinga</option>
                                        <option value="Menongue">Menongue</option>
                                        <option value="Milunga">Milunga</option>
                                        <option value="Moxico">Moxico</option>
                                        <option value="Muconda">Muconda</option>
                                        <option value="Mbanza Congo">Mbanza Congo</option>
                                        <option value="Mucamba">Mucamba</option>
                                        <option value="Mucari">Mucari</option>
                                        <option value="Mungo">Mungo</option>
                                        <option value="Mussende">Mussende</option>
                                        <option value="Nancova">Nancova</option>
                                        <option value="Namacunde">Namacunde</option>
                                        <option value="Negage">Negage</option>
                                        <option value="Nóqui">Nóqui</option>
                                        <option value="Nharea">Nharea</option>
                                        <option value="Nzeto">Nzeto</option>
                                        <option value="Ombadja">Ombadja</option>
                                        <option value="Porto Amboim">Porto Amboim</option>
                                        <option value="Puri">Puri</option> 
                                        <option value="Quiela">Quiela</option>
                                        <option value="Quibala">Quibala</option>
                                        <option value="Quiculungo">Quiculungo</option>
                                        <option value="Quilamba Quiaxi">Quilamba Quiaxi</option>
                                        <option value="Quilemda">Quilemda</option>
                                        <option value="Quilengues">Quilengues</option>
                                        <option value="Quimbele">Quimbele</option>
                                        <option value="Quissama">Quissama</option>
                                        <option value="Quitexe">Quitexe</option>
                                        <option value="Quipungo">Quipungo</option>
                                        <option value="Quirima">Quirima</option>
                                        <option value="Rivungo">Rivungo</option>
                                        <option value="Saurimo">Saurimo</option>
                                        <option value="Sanza Pombo">Sanza Pombo</option>
                                        <option value="Seles">Seles</option>
                                        <option value="Soio">Soio</option>
                                        <option value="Songo">Songo</option>
                                        <option value="Sumbe">Sumbe</option>
                                        <option value="Talatona">Talatona</option>
                                        <option value="Tômbua">Tômbua</option>
                                        <option value="Tomboco">Tomboco</option>        
                                        <option value="Ucuma">Ucuma</option>
                                        <option value="Uíge">Uíge</option>
                                        <option value="Viana">Viana</option>
                                        <option value="Virei">Virei</option>
                                        <option value="Xá-Muteba">Xá-Muteba</option>
                                        <option value="Zombo">Zombo</option> 
                                    </select>
                                </div>                               
                                <div class="col-sm-12 mb-3">
                                    <label for="inputAptidoes" class="form-label">Aptidões</label>
                                    <textarea class="form-control" id="inputAptidoes" name="aptidoes" rows="2" placeholder="Descreva as suas aptidões" required></textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primeira" name="cadastrar">Cadastrar</button>
                    </form>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <h2 class="h3">As minhas Vagas</h2>
                    <?php
                        $consult = mysqli_query($conexao, "SELECT * FROM vaga WHERE cod_empregadora = '{$id_empregadora}'");
                        if(mysqli_num_rows($consult) > 0){
                            while ($vaga = mysqli_fetch_array($consult) ) {
                    ?>
                        <div class="row" id="vaga">
                            <div class="col-sm-12 col-lg-4">
                                <h3 class="h6 text-primeira py-2">DADOS DA VAGA</h3>
                                <span>Nome da vaga: <strong class="text-segunda"><?php echo $vaga['nome_vaga'] ?></strong></span> <br>
                                <span><i class="bi bi-briefcase-fill"></i> <?php echo $vaga['tipo_emprego'] ?></span> <br>
                                <span> <i class="bi bi-calendar"></i> Expira em <?php echo date('d-M-Y', strtotime($vaga['data_expiracao'])) ?></span>
                            </div>
                            <div class="col-sm-12 col-lg-4">
                                <h3 class="h6 text-primeira py-2">REQUISITOS</h3>
                                <span>Titulação mínima: <strong><?php echo $vaga['r1_titulacao'] ?></strong></span> <br>
                                <span>Experiência: <strong><?php echo $vaga['r2_experiencia'] ?> anos</strong></span> <br>
                                <span>Nacionalidade: <?php echo $vaga['r3_nacionalidade'] ?></span>
                            </div>
                            <div class="col-sm-12 col-lg-3">
                                <?php   if ($vaga['status_vaga'] == 0) {   ?>
                                    <a href="../_bd/activar_vaga.php?cod=<?php echo $vaga['id_vaga'] ?>" class="btn btn-danger">Inativo</a>
                                <?php } else { ?>
                                    <a href="../_bd/desactivar_vaga.php?cod=<?php echo $vaga['id_vaga'] ?>" class="btn btn-success">Activo</a>
                                <?php } ?>                               
                            </div>
                        </div>
                    <?php
                            }
                        } else {
                            echo "Você ainda não publicou nenhuma vaga!";
                        }
                    ?>
                </div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <h2 class="h3">Candidatos às vagas</h2>
                    <?php
                        $consult = mysqli_query($conexao, "SELECT * FROM vaga as v INNER JOIN vaga_candidato as vc ON v.id_vaga = vc.cod_vaga INNER JOIN candidato as c ON vc.cod_candidato = c.id_candidato WHERE v.cod_empregadora = '{$id_empregadora}'");
                        if(mysqli_num_rows($consult) > 0){
                            while ($vaga = mysqli_fetch_array($consult) ) {
                    ?>
                        <div class="row" id="vaga">
                            <div class="col-sm-12 col-lg-3">
                                <h3 class="h6">DADOS DA VAGA</h3>
                                <hr>
                                <span>Nome da vaga: <strong class="text-segunda"><?php echo $vaga['nome_vaga'] ?></strong></span><br>
                                <span><i class="bi bi-briefcase-fill"></i> <?php echo $vaga['tipo_emprego'] ?></span><br>
                                <span> <i class="bi bi-calendar"></i> Expira em <?php echo date('d-M-Y', strtotime($vaga['data_expiracao'])) ?></span>                                
                            </div>
                            <div class="col-sm-12 col-lg-4">
                                <h3 class="h6">DADOS DO CANDIDATO</h3>
                                <hr>
                                <span>Nome do candidato: <strong><?php echo $vaga['nome'] ?></strong></span> <br>
                                <?php 
                                    $dataNasc = explode("-", $vaga['data_nasc']);
                                    $anoNasc = $dataNasc[0]; $mesNasc = $dataNasc[1]; $diaNasc = $dataNasc[2];
                                    $anoAtual = date("Y"); $mesAtual = date("m"); $diaAtual = date("d");
                                    $idade = $anoAtual - $anoNasc;
                                    if ($mesAtual < $mesNasc){
                                        $idade -= 1;
                                    } elseif ( ($mesAtual == $mesNasc) && ($diaAtual <= $diaNasc) ){
                                        $idade -= 1;
                                    }
                                ?>
                                <span>Idade: <strong><?php echo $idade ?> anos</strong></span> <br>
                                <span>Telefone: <strong><?php echo $vaga['telefone']; ?></strong></span> <br>
                                <span>Email: <strong><?php echo $vaga['email']; ?></strong></span> <br>
                                <span>Vive em: <strong><?php echo $vaga['municipio']; ?>, <?php echo $vaga['provincia']; ?></strong></span> <br>
                                <span>Pretenção salarial: <strong><i class="bi bi-currency-exchange"></i> <?php echo $vaga['pretencao_salarial']; ?></strong></span>
                            </div>
                            <div class="col-sm-12 col-lg-3">
                                <?php if( $vaga['curriculum'] != "") { ?>
                                    <a href="../Curriculum/<?php echo $vaga['curriculum']; ?>" class="btn btn-segunda">Baixar curriculo</a>
                                <?php } else { 
                                    echo "O candidato não carregou nenhum curriculum!";
                                 } ?>                     
                            </div>
                            <div class="col-sm-12 col-lg-2">
                                <?php if($vaga['foto'] != "") { ?>
                                    <img src="../fotos-dos-candidatos/<?php echo $vaga['foto']; ?>" alt="" class="rounded-circle" width="200px" height="200px">
                                <?php } else { ?>
                                    <img src="../_img/foto-user.png" alt="" class="rounded-circle" width="200px" height="200px">
                                <?php } ?>
                            </div>
                        </div>
                    <?php
                            }
                        } else {
                            echo "Nenhum candidato";
                        }
                    ?>
                </div>
            </div>
        </section>
    </main>
    
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
            })
        })()
    </script>
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