<?php 
    require_once("../_bd/conexao.php");
    session_start();
     //Controle de segurança
     if (!isset($_SESSION['Candidato_Logado'])) {
        header('Location: ../Login_Candidato/');
    }
    $id_candidato = $_SESSION['Candidato_Logado'];
    $consultar_candidato = mysqli_query($conexao, "SELECT * FROM candidato WHERE id_candidato = '{$id_candidato}'");
    $candidato = mysqli_fetch_array($consultar_candidato);
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
    <title>Vagas disponíveis | Bom Jobs Recrutamento</title>
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
            <a class="navbar-brand" href="../Painel_Candidato/"><img src="../_img/logo-branco.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="../Painel_Candidato/">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="../Minhas_Vagas/">Minhas candidaturas</a></li>
                    <li class="nav-item"><a class="nav-link active" href="../Vagas/">Todas vagas disponíveis</a></li>
                    <li class="nav-item"><a class="nav-link" href="../Perfil_Candidato/">Meu perfil</a></li>
                    <li class="nav-item"> <button class="nav-link btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Minha conta<i class="bi bi-arrow-down"></i></button> </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">Dados da Candidato</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="row">
                <span>Nome: <strong> <?php echo $candidato['nome']; ?> </strong></span> <br>
                <?php 
                    $dataNasc = explode("-", $candidato['data_nasc']);
                    $anoNasc = $dataNasc[0]; $mesNasc = $dataNasc[1]; $diaNasc = $dataNasc[2];
                    $anoAtual = date("Y"); $mesAtual = date("m"); $diaAtual = date("d");
                    $idade = $anoAtual - $anoNasc;
                    if ($mesAtual < $mesNasc){
                        $idade -= 1;
                    } elseif ( ($mesAtual == $mesNasc) && ($diaAtual <= $diaNasc) ){
                        $idade -= 1;
                    }
                ?>
                <span>Idade: <strong><?php echo $idade; ?> anos</span></strong> <br>
                <span>Estado civil: <strong><?php echo $candidato['estado_civil']; ?></strong> </span> <br>
                <span>Nacionalidade: <strong><?php echo $candidato['nacionalidade']; ?></strong> </span> <br>
                <span>Telefone: <strong><?php echo $candidato['telefone']; ?></strong> </span> <br>
                <span>Email: <strong><?php echo $candidato['email']; ?> </span></strong>
            </div>
            <div class="d-grid">
                <a href="../_incluir/logout.php"class="btn btn-danger">Terminar sessão</a>
            </div>
        </div>
    </div>
    <main>
        <!-- Pesquisa de vagas -->
        <aside class="container mt-3 p-3">
            <form action="index.php" method="GET" class="row">
                <div class="col-sm-12 col-lg-5 mb-1">
                    <label for="campo-pesquisa" class="form-label">Pesquisa por vagas disponíveis</label>
                    <input type="text" class="form-control" id="campo-pesquisa" name="vaga" placeholder="Pesquisa por nome da vaga" required>
                </div>
                <div class="col-sm-12 col-lg-2 mb-1">
                    <label for="industria" class="form-label">Indústria</label>
                    <select class="form-select" id="industria" name="industria">
                        <option></option>
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
                <div class="col-sm-12 col-lg-2 mb-1">
                    <label for="tipo_trabalho" class="form-label">Tipo de trabalho</label>
                    <select name="tipo_trabalho" id="tipo_trabalho" class="form-select">
                        <option></option>
                        <option value="Freelancer">Freelancer</option>
                        <option value="Meio período">Meio período</option>
                        <option value="Permanente">Permanente</option>
                        <option value="Estágio">Estágio</option>
                    </select>
                </div>
                <div class="col-sm-12 col-lg-3 mb-1">
                    <label for="provincia" class="form-label">Província</label>
                    <select name="provincia" id="provincia" class="form-select">
                        <option></option>
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
                        <option value="Luanda">Luanda</option>
                        <option value="Lunda Norte">Lunda Norte</option>
                        <option value="Lunda Sul">Lunda Sul</option>                        
                        <option value="Malanje">Malanje</option>
                        <option value="Moxico">Moxico</option>
                        <option value="Namibe">Namibe</option>
                        <option value="Uíge">Uíge</option>
                        <option value="Zaire">Zaire</option>                                
                    </select>
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-dark mb-3" name="pesquisar">Pesquisar</button>
                </div>
                <?php if(isset($_GET["pesquisar"])) { ?>
                    <h4 class="fw-normal text-center">Resultado da pesquisa: <strong><?php echo $_GET["vaga"]; ?></strong></h4>
                <?php } ?>
            </form>
        </aside>
        <!-- Todas as vagas -->
        <section id="vagas" class="container my-4">
            <?php
                //Buscando algumas vagas de emprego
                $consulta = "SELECT * FROM vaga AS V INNER JOIN empregadora AS E ON V.cod_empregadora = E.id_empregadora WHERE (V.status_vaga = 1)";
                if(isset($_GET["vaga"])) {
                    $nome_vaga = $_GET["vaga"];
                    $consulta .= " AND ((V.nome_vaga LIKE '%{$nome_vaga}%') OR (E.nome LIKE '%{$nome_vaga}%'))";
                }

                if(isset($_GET["industria"]) && ($_GET["industria"] != "")) {
                    $industria = $_GET["industria"];
                    $consulta .= " AND (cod_categoria = '$industria')";
                }

                if(isset($_GET["tipo_trabalho"]) && $_GET["tipo_trabalho"] != "") {
                    $tipo_trabalho = $_GET["tipo_trabalho"];
                    $consulta .= " AND (tipo_emprego = '$tipo_trabalho')";
                }

                if(isset($_GET["provincia"]) && $_GET["provincia"] != "") {
                    $provincia = $_GET["provincia"];
                    $consulta .= " AND (r10_provincia = '$provincia')";
                }

                $resultado = mysqli_query($conexao, $consulta);
                if(mysqli_num_rows($resultado) > 0) {
                    while($vaga = mysqli_fetch_array($resultado)) {
            ?>
                <div class="row">
                    <div class="col-sm-12 col-lg-3">
                        <h4 class="h5 text-segunda"><?php echo $vaga['nome_vaga'] ?></h4>
                        <span>Descrição: <strong><?php echo $vaga['descricao']; ?></strong></span> <br>
                        <span><i class="bi bi-briefcase-fill"></i> <strong><?php echo $vaga['tipo_emprego'] ?></strong></span> <br>
                        <span><i class="bi bi-geo-alt-fill"></i> <?php echo $vaga['localizacao'] ?></span> <br>
                        <span><i class="bi bi-calendar"></i> Expira em <?php echo date('d-M-Y', strtotime($vaga['data_expiracao'])) ?>
                        </span>
                    </div>
                    <div class="col-sm-12 col-lg-3">
                        <h4 class="h5">Empregadora</h4>
                        <span>Nome: <strong><?php echo $vaga['nome']; ?> </strong></span> <br>
                        <span>Descrição: <strong><?php echo $vaga['descricao']; ?> </strong></span> <br>
                        <span>Apresentação: <strong><?php echo $vaga['apresentacao']; ?> </strong></span>
                    </div>
                    <div class="col-sm-12 col-lg-4">
                        <h4 class="h5">Requisitos necessários</h4>
                        <span>Titulação mínima: <strong><?php echo $vaga['r1_titulacao'] ?> </strong></span> <br>
                        <span>Experiência: <strong><?php echo $vaga['r2_experiencia'] ?> </strong></span> <br>
                        <span>Nacionalidade: <strong><?php echo $vaga['r3_nacionalidade'] ?> </strong></span> <br>
                        <span>Lingua: <strong><?php echo $vaga['r4_lingua']; ?> </strong></span> <br>
                        <span>Área: <strong><?php echo $vaga['r5_area']; ?> </strong></span> <br>
                        ...
                    </div>
                    <div class="col-sm-12 col-lg-2">
                        <a href="../Candidatura_express?codigo=<?php echo $vaga['id_vaga'] ?>" class="btn btn-outline-dark">Ver mais</a>
                    </div>
                </div>
            <?php
                    }
                } else {
                    echo "Nenhum resultado encontrado para ".$_GET['vaga'];
                }
            ?>
        </section>
    </main>
    <!-- Rodapé -->
    <?php include_once("../_incluir/rodape.php"); ?>

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