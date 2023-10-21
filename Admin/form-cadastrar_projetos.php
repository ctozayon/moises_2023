<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<head>

    <title>Novo projeto</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>

</head>

<?php include 'layouts/body.php'; ?>

<!-- Begin page -->
<div id="layout-wrapper">

    <?php include 'layouts/menu.php'; ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Novo projeto</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Extração</a></li>
                                    <li class="breadcrumb-item active">Projetos</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Dados do projeto</h4>
                                <p class="card-title-desc">Preencha nos campos abaixo os dados referente ao projeto que está sendo criado.</p>
                            </div>
                            <div class="card-body p-4">                         
                                <div class="row">
                                    <form>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="mb-3">
                                                    <label class="form-label">Empresa do projeto</label>
                                                    <select class="form-select">
                                                        <option>Cria</option>
                                                        <option>Faza</option>
                                                        <option>Arti</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="mb-3">
                                                    <label for="example-text-input" class="form-label">Nome do projeto</label>
                                                    <input class="form-control" type="text" id="nomeProjeto">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="example-date-input" class="form-label">Data de início planejada</label>
                                                    <input class="form-control" type="date" value="2023-01-01" id="dataInicioPlanejada">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="example-date-input" class="form-label">Data de início executada</label>
                                                    <input class="form-control" type="date" value="2023-01-01" id="dataInicioExecutada">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="example-date-input" class="form-label">Data de término</label>
                                                    <input class="form-control" type="date" value="2023-01-01" id="dataTermino">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <div class="mb-3">
                                                    <label class="form-label">Estado</label>
                                                    <select class="form-select">
                                                        <option>AC</option>
                                                        <option>AL</option>
                                                        <option>AP</option>
                                                        <option>AM</option>
                                                        <option>BA</option>
                                                        <option>CE</option>
                                                        <option>DF</option>
                                                        <option>ES</option>
                                                        <option>GO</option>
                                                        <option>MA</option>
                                                        <option>MT</option>
                                                        <option>MS</option>
                                                        <option>MG</option>
                                                        <option>PA</option>
                                                        <option>PB</option>
                                                        <option>PR</option>
                                                        <option>PE</option>
                                                        <option>PI</option>
                                                        <option>RJ</option>
                                                        <option>RN</option>
                                                        <option>RS</option>
                                                        <option>RO</option>
                                                        <option>RR</option>
                                                        <option>SC</option>
                                                        <option>SP</option>
                                                        <option>SE</option>
                                                        <option>TO</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="mb-3">
                                                    <label for="example-text-input" class="form-label">Cidade</label>
                                                    <input class="form-control" type="text" id="cidade">
                                                </div>
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="mb-3">
                                                    <label for="example-text-input" class="form-label">Bairro</label>
                                                    <input class="form-control" type="text" id="bairro">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="example-text-input" class="form-label">Quantidade de pessoas envolvidas na produção</label>
                                                    <input class="form-control" type="text" id="qtddPessoasProducao">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="example-text-input" class="form-label">Quantidade de funções envolvidas na produção</label>
                                                    <input class="form-control" type="text" id="qtddFuncoesProducao">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-lg-auto">
                                                <div class="w-lg">
                                                    <button type="submit" class="btn btn-primary w-lg">Gerar tabela pessoas x remuneração</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-lg-auto">
                                                <div class="mt-4">
                                                    <div class="mb-3">
                                                        <!-- Inserir aqui a estrutura que montará a tabela dinamicamente após clicar no botão -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-lg-auto">
                                                <div class="mt-4">
                                                    <div class="mb-3">
                                                        <label for="example-text-input" class="form-label">Remuneração média das pessoas envolvidas na produção</label>
                                                        <input class="form-control" type="text" id="remuneracaoMedia">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="example-text-input" class="form-label">Custo estimado do projeto</label>
                                                    <input class="form-control" type="text" id="custoEstimadoProjeto">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="example-text-input" class="form-label">Custo executado no projeto</label>
                                                    <input class="form-control" type="text" id="custoExecutadoProjeto">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-lg-auto">
                                                <div class="mt-4">
                                                    <button type="submit" class="btn btn-primary w-lg">Salvar projeto</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>                    
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


        <?php include 'layouts/footer.php'; ?>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->


<!-- Right Sidebar -->
<?php include 'layouts/right-sidebar.php'; ?>
<!-- /Right-bar -->

<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>

<script src="assets/js/app.js"></script>

</body>

</html>