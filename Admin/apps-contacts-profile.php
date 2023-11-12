<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<?php
$firstname = $_SESSION["firstname"];
$lastname = $_SESSION["lastname"];
$fullname = $firstname . " " . $lastname;
$permission = $_SESSION["permission"];
$empresas = $_SESSION["empresas"];
?>

<head>
    
    <title>Perfil</title>
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
                            <h4 class="mb-sm-0 font-size-18">Perfil</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Contato</a></li>
                                    <li class="breadcrumb-item active">Perfil</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-xl-9 col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm order-2 order-sm-1">
                                        <div class="d-flex align-items-start mt-3 mt-sm-0">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-xl me-3">
                                                    <img src="assets/images/users/avatar-1.png" alt="" class="img-fluid rounded-circle d-block">
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div>
                                                    <h5 class="font-size-16 mb-1"><?php echo($fullname) ?></h5>
                                                    <p class="text-muted font-size-13"><?php echo(ucfirst($permission)) ?></p>
                                                    <h6>Empresas Vinculadas:</h6>
                                                    <div class="d-flex flex-wrap align-items-start gap-2 gap-lg-3 text-muted font-size-13" style="display: flex; flex-direction: column; align-items: start;" >
                                                        <?php foreach ($empresas as $empresa): ?>
                                                            <div>
                                                                <i class='mdi mdi-circle-medium me-1 text-success align-middle'></i>
                                                                <?php echo $empresa['name']; ?>
                                                                <p><?php echo $empresa['address']; ?></p>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-auto order-1 order-sm-2">
                                        <div class="d-flex align-items-start justify-content-end gap-2">
                                            <div>
                                                <button id="btnEditar" type="button" class="btn btn-soft-light"><i class="me-1"></i> Editar perfil </button>
                                            </div>
                                            <div>
                                                <div class="dropdown">
                                                    <button class="btn btn-link font-size-16 shadow-none text-muted dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bx bx-dots-horizontal-rounded"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item" href="#">Action</a></li>
                                                        <li><a class="dropdown-item" href="#">Another action</a></li>
                                                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php if (isset($_GET['editar']) && $_GET['editar'] === 'true'): ?>
                                    <div class="auth-content my-auto">
                                    <div class="text-center">
                                        <h5 class="mb-0">Editar usuário</h5>
                                        <p class="text-muted mt-2">Edite abaixo os campos que forem necessários</p>
                                    </div>
                                    <form class="needs-validation mt-4 pt-2" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                        <div class="mb-3 <?php echo (!empty($useremail_err)) ? 'has-error' : ''; ?>">
                                            <label for="useremail" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="useremail" placeholder="Insira seu email" required name="useremail" value="<?php echo $useremail; ?>">
                                            <span class="text-danger"><?php echo $useremail_err; ?></span>
                                        </div>

                                        <div class="mb-3 <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                                            <label for="username" class="form-label">Nome de usuário</label>
                                            <input type="text" class="form-control" id="username" placeholder="Insira seu nome de usuário" required name="username" value="<?php echo $username; ?>">
                                            <span class="text-danger"><?php echo $username_err; ?></span>
                                        </div>

                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Primeiro nome</label>
                                            <input type="text" class="form-control" id="firstname" placeholder="Insira seu primeiro nome" required name="firstname" value="<?php echo $firstname; ?>">
                                            <!-- Adicionando uma mensagem de erro para validação -->
                                            <span class="text-danger"><?php echo $firstname_err; ?></span>
                                        </div>

                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">Último nome</label>
                                            <input type="text" class="form-control" id="lastname" placeholder="Insira seu último nome" required name="lastname" value="<?php echo $lastname; ?>">
                                            <!-- Adicionando uma mensagem de erro para validação -->
                                            <span class="text-danger"><?php echo $lastname_err; ?></span>
                                        </div>

                                        <div class="mb-3">
                                            <label for="cpf" class="form-label">CPF</label>
                                            <input type="text" class="form-control" id="cpf" placeholder="Insira seu último nome" required name="cpf" value="<?php echo $cpf; ?>">
                                            <!-- Adicionando uma mensagem de erro para validação -->
                                            <span class="text-danger"><?php echo $cpf_err; ?></span>
                                        </div>

                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Telefone</label>
                                            <input type="text" class="form-control" id="phone" placeholder="Insira seu último nome" required name="phone" value="<?php echo $phone; ?>">
                                            <!-- Adicionando uma mensagem de erro para validação -->
                                            <span class="text-danger"><?php echo $phone_err; ?></span>
                                        </div>

                                        <div class="mb-3">
                                            <label for="cep" class="form-label">CEP</label>
                                            <input type="text" class="form-control" id="cep" placeholder="Insira seu último nome" required name="cep" value="<?php echo $cep; ?>">
                                            <!-- Adicionando uma mensagem de erro para validação -->
                                            <span class="text-danger"><?php echo $cep_err; ?></span>
                                        </div>

                                        <div class="mb-3">
                                            <label for="address" class="form-label">Endereço</label>
                                            <input type="text" class="form-control" id="address" placeholder="Insira seu último nome" required name="address" value="<?php echo $address; ?>">
                                            <!-- Adicionando uma mensagem de erro para validação -->
                                            <span class="text-danger"><?php echo $address_err; ?></span>
                                        </div>

                                        <div class="mb-3">
                                            <label for="birth_date" class="form-label">Data de Nascimento</label>
                                            <input type="text" class="form-control" id="birth_date" placeholder="Insira seu último nome" required name="birth_date" value="<?php echo $birth_date; ?>">
                                            <!-- Adicionando uma mensagem de erro para validação -->
                                            <span class="text-danger"><?php echo $birth_date_err; ?></span>
                                        </div>
                                        
                                        <div class="mb-4">
                                            <p class="mb-0">Atualizando você concorda com os <a href="#" class="text-primary">Termos de Uso</a></p>
                                        </div>
                                        <div class="mb-3">
                                            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Salvar</button>
                                        </div>
                                    </form>
                                </div>
                                <?php endif ?>
                                <!-- <ul class="nav nav-tabs-custom card-header-tabs border-top mt-4" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link px-3 active" data-bs-toggle="tab" href="#overview" role="tab">Overview</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link px-3" data-bs-toggle="tab" href="#about" role="tab">About</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link px-3" data-bs-toggle="tab" href="#post" role="tab">Post</a>
                                    </li>
                                </ul> -->
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
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

<script>
// Adiciona um ouvinte de clique ao botão
document.getElementById('btnEditar').addEventListener('click', function() {
    // Redireciona para a mesma página com a variável 'editar' definida como 'true'
    window.location.href = window.location.pathname + '?editar=true';
});
</script>

<script src="assets/js/app.js"></script>

</body>

</html>