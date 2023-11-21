<?php
include 'layouts/session.php';
// Include config file
include 'layouts/config.php';
session_start();
if (!isset($usuarios) ||$_SERVER['REQUEST_METHOD'] === 'POST'){
    $sql = "SELECT U.id, U.username, U.useremail, U.firstname, U.lastname, U.cpf, U.phone, COALESCE(UP.permission_id, 3) as permission_id, COALESCE(P.description, 'limitado') as description
    FROM users U
    LEFT JOIN user_permissions UP ON U.id = UP.user_id
    LEFT JOIN permissions P ON UP.permission_id = P.id";

    // Executar a consulta
    $result = mysqli_query($link, $sql);

    // Verificar se a consulta foi bem-sucedida
    if ($result) {
        // Inicializar a variável empresa como um array para armazenar os resultados
        $usuarios = array();

        // Obter os resultados da consulta
        while ($row = mysqli_fetch_assoc($result)) {
            // Adicionar cada linha ao array
            $usuarios[] = $row;
        }

        if ($usuarios){
            $_SESSION["usuarios"] = $usuarios;
        }
        else{
            $_SESSION["usuarios"] = "";
        }

        // Liberar o resultado da consulta
        mysqli_free_result($result);

        // Exibir o conteúdo da variável empresa (pode ser removido em produção)
        var_dump($empresas);
    } else {
        // Se a consulta falhou, exibir uma mensagem de erro
        echo "Erro na consulta: " . mysqli_error($link);
    }

    // Close connection
    mysqli_close($link);
}
?>
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
                                            <table  id="tabela-usuarios" class="table align-middle datatable dt-responsive table-check nowrap" style="border-collapse: collapse; border-spacing: 0 8px; width: 100%;">
                                                <thead>
                                                    <tr class="bg-transparent">
                                                        <!-- <th style="width: 30px;">
                                                        <i class="mdi mdi-checkbox-outline text-primary me-1"></i>
                                                        </th> -->
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
                                                    <?php
                                                    foreach ($usuarios as $usuario){?>
                                                        <tr>
                                                            <!-- <td>
                                                                <div class="form-check font-size-16">
                                                                    <input type="checkbox" class="form-check-input">
                                                                    <label class="form-check-label"></label>
                                                                </div>
                                                            </td> -->
                                                            
                                                            <td><a href="javascript: void(0);" class="text-body fw-medium"><?php echo $usuario['id'] ?></a> </td>
                                                            <td> <?php echo $usuario['useremail'] ?> </td>
                                                            <td> <?php echo $usuario['username'] ?> </td>
                                                            <td> <?php echo $usuario['firstname'] ?> </td>
                                                            <td> <?php echo $usuario['lastname'] ?> </td>
                                                            <td> <?php echo $usuario['cpf'] ?> </td>
                                                            <td> <?php echo $usuario['phone'] ?> </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    ?>
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

<!-- <script> -->
// function atualizarTabela(usuarios) {
//     // Variável para armazenar a referência ao DataTable
//     var dataTable;

//     // Inicialize o DataTable se ainda não foi inicializado
//     if (!$.fn.DataTable.isDataTable('#datatable')) {
//         dataTable = $('#datatable').DataTable({
//             "paging": true,
//             "info": true
//             // Adicione outras opções conforme necessário
//         });
//     } else {
//         // Se já estiver inicializado, apenas atualize a referência
//         dataTable = $('#datatable').DataTable();
//     }

//     // Salve a referência ao DataTable para uso posterior
//     $('#tabela-usuarios').data('datatable', dataTable);

//     // Verifique se o DataTable foi inicializado
//     if (dataTable) {
//         // Limpe os dados existentes no DataTable
//         dataTable.clear();

//         // Adicione os novos dados ao DataTable
//         <?php
//         if (isset($usuarios)) {
//             foreach ($usuarios as $usuario) {
//                 echo "dataTable.row.add([
//                     '{$usuario['username']}',
//                     '{$usuario['fistname']}',
//                     '{$usuario['lastname']}',
//                     '{$usuario['cpf']}',
//                     '{$usuario['phone']}'
//                 ]);";
//             }
//         }
//         ?>
        
//         // Atualize o DataTable
//         dataTable.draw();
//     } else {
//         console.error('Erro: DataTable não inicializado.');
//     };
// };
// </script>

</body>

</html>