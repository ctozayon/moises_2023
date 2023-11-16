<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<head>

    <title>Gestão de Usuários</title>
    <?php include 'layouts/head.php'; ?>

    <!-- flatpickr css -->
    <link href="assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css">

    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

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
                            <h4 class="mb-sm-0 font-size-18">Gestão de Usuários</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Administração</a></li>
                                    <li class="breadcrumb-item active">Gestão de Usuários</li>
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
                                <h4 class="card-title">Usuários cadastradas</h4>
                                <p class="card-title-desc">Confira os usuários já cadastradas logo abaixo.
                                </p>
                            </div><!-- end card header-->

                            <div class="card-body">
                            
                                        <div class="table-responsive">
                                            <table class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                                <thead>
                                                    <tr class="bg-transparent">
                                                        <th style="width: 30px;">
                                                        <i class="mdi mdi-checkbox-outline text-primary me-1"></i>
                                                        </th>
                                                        <th style="width: 120px;">ID</th>
                                                        <th>Email</th>
                                                        <th>Usuário</th>
                                                        <th>Primeiro Nome</th>
                                                        <th>Último Nome</th>
                                                        <th>CPF</th>
                                                        <th>Telefone</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
        
                                                    <tr>
                                                        <td>
                                                            <div class="form-check font-size-16">
                                                                <input type="checkbox" class="form-check-input">
                                                                <label class="form-check-label"></label>
                                                            </div>
                                                        </td>
                                                        
                                                        <td><a href="javascript: void(0);" class="text-body fw-medium">#MN0215</a> </td>
                                                        <td>
                                                            teste1@teste.com
                                                        </td>
                                                        <td>teste_limitado</td>
                                                        
                                                        <td>
                                                            Teste
                                                        </td>
                                                        <td>
                                                            Limitado
                                                        </td>
                                                        <td>
                                                            123456789-12
                                                        </td>
                                                        
                                                        <td>
                                                            (11)99999-9999
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="form-check font-size-16">
                                                                <input type="checkbox" class="form-check-input">
                                                                <label class="form-check-label"></label>
                                                            </div>
                                                        </td>
                                                        
                                                        <td><a href="javascript: void(0);" class="text-body fw-medium">#MN0216</a> </td>
                                                        <td>
                                                            teste2@teste.com
                                                        </td>
                                                        <td>teste_geral</td>
                                                        
                                                        <td>
                                                            Teste
                                                        </td>
                                                        <td>
                                                            Geral
                                                        </td>
                                                        <td>
                                                            987654321-98
                                                        </td>
                                                        
                                                        <td>
                                                            (41)98888-8888
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="form-check font-size-16">
                                                                <input type="checkbox" class="form-check-input">
                                                                <label class="form-check-label"></label>
                                                            </div>
                                                        </td>
                                                        
                                                        <td><a href="javascript: void(0);" class="text-body fw-medium">#MN0212</a> </td>
                                                        <td>
                                                            teste3@teste.com
                                                        </td>
                                                        <td>teste_admin</td>
                                                        
                                                        <td>
                                                            Teste
                                                        </td>
                                                        <td>
                                                            Admin
                                                        </td>
                                                        <td>
                                                            975318642-36
                                                        </td>
                                                        
                                                        <td>
                                                            (11)97777-7777
                                                        </td>
                                                    </tr>                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end table responsive -->

                            </div><!-- end card-body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-start ">
                                    <div class="flex-shrink-0 me-3 align-self-center">
                                        <img src="assets/images/users/avatar-1.jpg" class="avatar-sm rounded-circle" alt="">
                                    </div>
                                    
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-16 mb-1"><a href="#" class="text-dark">Usuário Teste</a></h5>
                                        <!-- <p class="text-muted mb-0">Available</p> -->
                                        <div class="d-flex flex-wrap gap-2 mt-1">
                                            <span class="badge rounded-pill bg-primary">Limitado</span>
                                            <span class="badge rounded-pill bg-success">Geral</span>
                                            <span class="badge rounded-pill bg-info">Admin</span>
                                        </div>
                                    </div>

                                    <div class="flex-shrink-0">
                                        <div class="dropdown chat-noti-dropdown">
                                            <button class="btn dropdown-toggle p-0" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-horizontal-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Editar</a>
                                                <a class="dropdown-item" href="#">Excluir</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card header-->

                            <div class="card-body">

                                <div class="row mb-4">
                                    <label for="horizontal-primeiro-nome" class="col-sm-3 col-form-label">Primeiro Nome</label>
                                    <div class="col-sm-9">
                                        <p>Teste</p>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="horizontal-ultimo-nome" class="col-sm-3 col-form-label">Último Nome</label>
                                    <div class="col-sm-9">
                                        <p>Limitado</p>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="horizontal-email" class="col-sm-3 col-form-label">E-mail</label>
                                    <div class="col-sm-9">
                                        <p>teste1@teste.com</p>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="horizontal-usuario" class="col-sm-3 col-form-label">Usuário</label>
                                    <div class="col-sm-9">
                                        <p>teste_limitado</p>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="horizontal-cpf" class="col-sm-3 col-form-label">CPF</label>
                                    <div class="col-sm-9">
                                        <p>123456789-12</p>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="horizontal-telefone" class="col-sm-3 col-form-label">Telefone</label>
                                    <div class="col-sm-9">
                                        <p>(11)99999-9999</p>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="horizontal-empresas-vinculadas" class="col-sm-3 col-form-label">Empresas vinculadas</label>
                                    <div class="col-sm-9">
                                        <div class="d-flex flex-wrap gap-2 mt-1">
                                            <span class="badge rounded-pill bg-warning">Cria</span>
                                            <span class="badge rounded-pill bg-danger">Faza</span>
                                        </div>
                                    </div>
                                </div>
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

<?php include 'layouts/vendor-scripts.php'; ?>

<!-- Datatable init js -->
<script src="assets/js/pages/datatables.init.js"></script>

<!-- flatpickr js -->
<script src="assets/libs/flatpickr/flatpickr.min.js"></script>

<!-- Required datatable js -->
<script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

<!-- Responsive examples -->
<script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<script src="assets/js/app.js"></script>

</body>

</html>