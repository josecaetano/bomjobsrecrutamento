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
    <title>Cadastro de Candidato | Bom Jobs Recrutamento</title>
    <style>
        #login { width: 50%; }
        @media screen and (max-width: 700px) { 
            #login { width: 100%; }
        }
    </style>
</head>
<body>
    <!-- Menu - Barra de navegaçãp -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primeira">
        <div class="container-fluid">
            <a class="navbar-brand" href="../"><img src="../_img/logo-branco.png" alt=""></a>
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
                <div class="alert alert-danger" role="alert">
                    <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php   } ?>
            <h2 class="text-primeira">Cadastre-se e poderás se candidatar às vagas de emprego com um clique!</h2>
            <form action="../_bd/cadastrar_candidato.php" method="post" class="row">
                <div class="col-sm-12 mb-3">
                    <label for="nome_candidato" class="form-label">Nome do candidato *</label>
                    <input type="text" class="form-control" id="nome_candidato" name="nome_candidato" placeholder="Nome completo do candidato" required>
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="data_nasc" class="form-label">Data de nascimento *</label>
                    <input type="date" class="form-control" id="data_nasc" name="data_nasc" max="<?php echo date('Y-m-d'); ?>" required>
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="bi" class="form-label">Bilhete ou passaport nº *</label>
                    <input type="text" class="form-control" id="bi" name="bi" placeholder="Número do documento" required>
                </div>
                <div class="col-sm-6 col-lg-4 mb-3">
                    <label for="estado_civil" class="form-label">Estado Cívil *</label>
                    <select name="estado_civil" id="estado_civil" class="form-select" required>
                        <option value="Solteiro(a)">Solteiro(a)</option>
                        <option value="Casado(a)">Casado(a)</option> 
                        <option value="Divorciado(a)">Devorciado(a)</option>
                        <option value="Viúvo(a)">Viúvo(a)</option>                         
                    </select> 
                </div>
                <div class="col-sm-6 col-lg-4 mb-3">
                    <label for="Chomem">Gênero</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="genero" id="Chomem" value="Homem" checked>
                        <label class="form-check-label" for="Chomem">Homem</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="Cmulher">Mulher</label>
                        <input class="form-check-input" type="radio" name="genero" id="Cmulher" value="Mulher">
                    </div>
                </div> 
                <div class="col-sm-6 col-lg-4 mb-3">
                    <label for="nacionalidade" class="form-label">Nacionalidade *</label> 
                    <input class="form-control" list="datalistOptions" id="nacionalidade" name="nacionalidade">
                    <datalist id="datalistOptions">
                        <?php
                           $consultar_nacionalidade = mysqli_query($conexao, "SELECT * FROM nacionalidade ORDER BY nacionalidade ASC");
                           if(mysqli_num_rows($consultar_nacionalidade) > 0) {
                               while($nacionalidade = mysqli_fetch_array($consultar_nacionalidade)) {
                        ?>
                        <option value="<?php echo $nacionalidade['nacionalidade']; ?>">
                        <?php } } ?>
                    </datalist> 
                </div>
                <div class="col-sm-6">
                    <label for="telefone" class="form-label">Contacto *</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Número de telefone" required>
                </div>               
                <div class="col-sm-6 mb-3">
                    <label for="email" class="form-label">Email *</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="examplo@mail.com" required>
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="senha" class="form-label">Senha *</label>
                    <input type="password" class="form-control" id="senha" name="senha" required>
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="inputCSenha" class="form-label">Confirmação da senha *</label>
                    <input type="password" class="form-control" id="inputCSenha" name="confirmacao_senha" placeholder="Repita a sua senha" required>
                </div>
                <div class="d-grid gap-2">
                    <a class="btn btn-primeira" data-bs-toggle="modal" href="#exampleModalToggleExtra" role="button">Cadastrar</a>
                    <span class="py-2">Já tens tem uma conta? <a href="../Login_Candidato/">Inicie a sessão</a></span> 
                </div> 
                <!-- Modal a ser usado-->
                <div class="modal fade" id="exampleModalToggleExtra" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel">Formação Acadêmica e Pretenção salarial</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row">
                            <div class="col-sm-12 col-lg-4">
                                <label for="fa1_titulo" class="form-label">Título obtido</label>
                                <select name="fa1_titulo" id="fa1_titulo" class="form-select">
                                    <option value="Ensino Básico">Ensino Básico</option>
                                    <option value="Ensino Médio">Ensino Médio</option>
                                    <option value="Universitário">Universitário</option>
                                    <option value="Licenciatura">Licenciatura</option>
                                    <option value="Curso Profissional">Curso Profissional</option>                                     
                                </select>
                            </div>
                            <div class="col-sm-12 col-lg-8 mb-3">
                                <label for="fa1_instituto" class="form-label">Nome da Instituição *</label>
                                <input type="text" class="form-control" id="fa1_instituto" name="fa1_instituto" placeholder="Nome da Instituição onde fez ou faz o Ensino Médio">
                            </div>
                            <div class="col-sm-12 col-lg-8 mb-3">
                                <label for="fa1_curso" class="form-label">Curso</label>
                                <input type="text" class="form-control" id="fa1_curso" name="fa1_curso">
                            </div>
                            <div class="col-sm12 col-lg-4 mb-3">
                                <label for="pretencao_salarial" class="form-label">Pretenção salarial *</label>
                                <input type="number" class="form-control" name="pretencao_salarial" id="pretencao_salarial" min="0" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primeira" data-bs-target="#exampleModalToggleProximo" data-bs-toggle="modal">Próximo</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="exampleModalToggleProximo" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabelContacto">Contacto de Emergência</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    <div class="col-sm-8 mb-3">
                        <label for="nome_contacto" class="form-label">Nome do contacto *</label>
                        <input type="text" class="form-control" id="nome_contacto" name="nome_contacto" placeholder="O nome da pessoa" required>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <label for="relacao_contacto" class="form-label">Relação</label>
                        <select name="relacao_contacto" id="relacao_contacto" class="form-select">
                            <option value="Pai">Pai</option>
                            <option value="Mãe">Mãe</option>
                            <option value="Marido">Marido</option>
                            <option value="Mulher">Mulher</option>
                            <option value="Irmão">Irmão</option>
                            <option value="Irmã">Irmã</option>
                            <option value="Tio(a)">Tio(a)</option>
                            <option value="Filho(a)">Filho(a)</option>
                            <option value="Amigo(a)">Amigo(a)</option>
                        </select>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label for="telefone_emergencia" class="form-label">Telefone *</label>
                        <input type="text" class="form-control" id="telefone_emergencia" name="telefone_emergencia" placeholder="O telefone da pessoa" required>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label for="empregadora_contacto" class="form-label">Empregadora</label>
                        <input type="text" class="form-control" id="empregadora_contacto" name="empregadora_contacto" placeholder="Onde ele(a) trabalha">
                    </div>
                </div>
                <div class="modal-footer">
                    <button  type ="submit" class="btn btn-primeira" name="cadastrar">Concluir a candidatura</button>
                </div>
                </div>
            </div>
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