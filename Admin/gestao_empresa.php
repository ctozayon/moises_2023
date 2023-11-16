<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<head>

    <title>Gestão de Empresas</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>

</head>

<?php include 'layouts/body.php'; ?>

<?php
$estados = array(
    'AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS',
    'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC',
    'SP', 'SE', 'TO'
);
?>

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
                            <h4 class="mb-sm-0 font-size-18">Gestão de Empresas</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Administração</a></li>
                                    <li class="breadcrumb-item active">Gestão de Empresas</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Empresas cadastradas</h4>
                                <p class="card-title-desc">Confira as empresas já cadastradas logo abaixo.
                                </p>
                            </div><!-- end card header-->

                            <div class="card-body">                            
                                <div class="table-responsive">
                                    <table class="table mb-0">

                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nome da Empresa</th>
                                                <th>CNPJ</th>
                                                <th>Estado</th>
                                                <th>Cidade</th>
                                                <th>Endereço</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Cria</td>
                                                <td>1234567/0001-10</td>
                                                <td>PR</td>
                                                <td>Curitiba</td>
                                                <td>Rua Maria das Dores, 143</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>Faza</td>
                                                <td>7654321/0001-90</td>
                                                <td>MG</td>
                                                <td>Belo Horizonte</td>
                                                <td>Rua José das Coves, 752</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td>Arti</td>
                                                <td>9753124/0001-34</td>
                                                <td>SP</td>
                                                <td>Campinas</td>
                                                <td>Avenida XV de Novembro, 1243</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- end card-body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Cadastrar novas empresas</h4>
                                <p class="card-title-desc">Caso você não encontre a empresa que deseja, cadastre uma nova logo abaixo.
                                </p>
                            </div><!-- end card header-->

                            <div class="card-body">
                                <form>
                                    <div class="row mb-4">
                                        <label for="horizontal-nome-empresa" class="col-sm-3 col-form-label">Nome da empresa</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="horizontal-nome-empresa" placeholder="Digite o nome da empresa">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="horizontal-cnpj" class="col-sm-3 col-form-label">CNPJ</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="horizontal-cnpj" placeholder="Digite o CNPJ">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="horizontal-estado" class="col-sm-3 col-form-label">Estado</label>
                                        <div class="col-sm-9">
                                            <select class="form-select col-sm-9" id="horizontal-estado" name="estado">
                                                <?php
                                                foreach ($estados as $estado) { ?>
                                                    <option> <?php echo $estado ?> </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="horizontal-cidade" class="col-sm-3 col-form-label">Cidade</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="horizontal-cidade" placeholder="Digite a cidade">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="horizontal-endereco" class="col-sm-3 col-form-label">Endereço</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="horizontal-endereco" placeholder="Digite o endereço">
                                        </div>
                                    </div>

                                    <div class="row justify-content-end">
                                        <div class="col-lg-auto">
                                            <div>
                                                <button type="submit" class="btn btn-primary w-md">Cadastrar empresa</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div><!-- end card-body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div><!-- end row -->


            </div>
            <!-- container-fluid -->
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
<script src="assets/libs/jquery/jquery.min.js"></script>
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/libs/metismenu/metisMenu.min.js"></script>
<script src="assets/libs/simplebar/simplebar.min.js"></script>
<script src="assets/libs/node-waves/waves.min.js"></script>
<script src="assets/libs/feather-icons/feather.min.js"></script>
<!-- pace js -->
<script src="assets/libs/pace-js/pace.min.js"></script>

<?php include 'layouts/vendor-scripts.php'; ?>

<script src="assets/js/app.js"></script>

</body>

</html>