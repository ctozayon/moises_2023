<?php include 'layouts/session.php'; ?>

<?php 
include 'layouts/config.php';

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    // Validate useremail
    if (empty(trim($_POST["useremail"]))) {
        $useremail_err = "Por favor digite seu e-mail de usuário.";
    } elseif (!filter_var($_POST["useremail"], FILTER_VALIDATE_EMAIL)) {
        $useremail_err = "Formato de e-mail inválido.";
    } else {
        // Set parameters
        $param_useremail = trim($_POST["useremail"]);
    }

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Por favor insira seu nome de usuário.";
    } else {
        $username = trim($_POST["username"]);
    }

    if (!empty(trim($_POST["password"]))) {
        // Validate password
        if (empty(trim($_POST["password"]))) {
            $password_err = "Por favor insira a senha.";
        } elseif (strlen(trim($_POST["password"])) < 6) {
            $password_err = "A senha deve conter pelo menos 6 caracteres.";
        } else {
            $password = trim($_POST["password"]);
        }
    }

    // Validate firstname
    if (empty(trim($_POST["firstname"]))) {
        $firstname_err = "Digite seu primeiro nome.";
    } else {
        $firstname = trim($_POST["firstname"]);
    }

    // Validate lastname
    if (empty(trim($_POST["lastname"]))) {
        $lastname_err = "Digite seu último nome.";
    } else {
        $lastname = trim($_POST["lastname"]);
    }

    if (!empty(trim($_POST["confirm_password"]))) {
        // Validate confirm password
        if (empty(trim($_POST["confirm_password"]))) {
            $confirm_password_err = "Confirme a sua senha.";
        } else {
            $confirm_password = trim($_POST["confirm_password"]);
            if (empty($password_err) && ($password != $confirm_password)) {
                $confirm_password_err = "A senha não está compatível.";
            }
        }
    }

    // Check input errors before inserting in database
    if (empty($useremail_err) && empty($username_err) && empty($firstname_err) && empty($lastname_err) && empty($password_err) && empty($confirm_password_err) && empty($cpf_err)) {
        
        if (!empty(trim($_POST["confirm_password"])) && !empty(trim($_POST["password"]))) {
            $sql = "UPDATE users SET useremail = ? , username = ? , firstname = ? , lastname = ? , cpf = ? , phone = ? , cep = ? , address = ? , birth_date = ? , password = ? , token = ? WHERE id = ?";
        } else {
            // Prepare an insert statement
            $sql = "UPDATE users SET useremail = ? , username = ? , firstname = ? , lastname = ? , cpf = ? , phone = ? , cep = ? , address = ? , birth_date = ? WHERE id = ?";
        }
                
        if ($stmt = mysqli_prepare($link, $sql)) {
            if (!empty(trim($_POST["confirm_password"])) && !empty(trim($_POST["password"]))) {
                // Prepare an insert statement
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
                $param_token = bin2hex(random_bytes(50)); // generate unique token
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ssssssssssss", $param_useremail, $param_username, $param_firstname, $param_lastname, $param_cpf, $param_phone, $param_cep, $param_address, $param_birth_date, $param_password, $param_token, $param_id);
            } else {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ssssssssss", $param_useremail, $param_username, $param_firstname, $param_lastname, $param_cpf, $param_phone, $param_cep, $param_address, $param_birth_date, $param_id);
            }

            // Set parameters
            $param_useremail = trim($_POST["useremail"]);
            $param_username = trim($_POST["username"]);
            $param_firstname = trim($_POST["firstname"]);
            $param_lastname = trim($_POST["lastname"]);
            $param_cpf = trim($_POST["cpf"]);
            $param_phone = trim($_POST["phone"]);
            $param_cep = trim($_POST["cep"]);
            $param_address = trim($_POST["address"]);
            $param_birth_date = trim($_POST["birth_date"]);
            $param_id = $_SESSION["user_id"];

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                header("location: index.php");
                $_SESSION["useremail"] = $param_useremail;
                $_SESSION["username"] = $param_username;
                $_SESSION["firstname"] = $param_firstname;
                $_SESSION["cpf"] = $param_cpf;
                $_SESSION["phone"] = $param_phone;
                $_SESSION["cep"] = $param_cep;
                $_SESSION["address"] = $param_address;
                $_SESSION["birth_date"] = $param_birth_date;
                $_SESSION["lastname"] = $param_lastname;
            } else {
                echo "Algo está errado. Por favor, tente novamente mais tarde.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
}
?>


<?php include 'layouts/head-main.php'; ?>

<?php
$useremail = $_SESSION["useremail"];
$username = $_SESSION["username"];
$firstname = $_SESSION["firstname"];
$lastname = $_SESSION["lastname"];
$cpf = $_SESSION["cpf"];
$phone = $_SESSION["phone"];
$cep = $_SESSION["cep"];
$address = $_SESSION["address"];
$birth_date = $_SESSION["birth_date"];
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
                                            <!-- <div>
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
                                            </div> -->
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
                                            <input type="email" class="form-control" id="useremail" placeholder="<?php echo $useremail ?>" required name="useremail" value="<?php echo $useremail; ?>">
                                            <!-- <span class="text-danger"><!?php echo $useremail_err; ?></span> -->
                                        </div>

                                        <div class="mb-3 <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                                            <label for="username" class="form-label">Usuário</label>
                                            <input type="text" class="form-control" id="username" placeholder="<?php echo $username ?>" required name="username" value="<?php echo $username; ?>">
                                            <!-- <span class="text-danger"><!?php echo $username_err; ?></span> -->
                                        </div>

                                        <div class="mb-3">
                                            <label for="firstname" class="form-label">Primeiro nome</label>
                                            <input type="text" class="form-control" id="firstname" placeholder="<?php echo $firstname ?>" required name="firstname" value="<?php echo $firstname; ?>">
                                            <!-- Adicionando uma mensagem de erro para validação -->
                                            <!-- <span class="text-danger"><!?php echo $firstname_err; ?></span> -->
                                        </div>

                                        <div class="mb-3">
                                            <label for="lastname" class="form-label">Último nome</label>
                                            <input type="text" class="form-control" id="lastname" placeholder="<?php echo $lastname ?>" required name="lastname" value="<?php echo $lastname; ?>">
                                            <!-- Adicionando uma mensagem de erro para validação -->
                                            <!-- <span class="text-danger"><!?php echo $lastname_err; ?></span> -->
                                        </div>

                                        <div class="mb-3">
                                            <label for="cpf" class="form-label">CPF</label>
                                            <input type="text" class="form-control" id="cpf" placeholder="<?php echo $cpf ?>" required name="cpf" value="<?php echo $cpf; ?>">
                                            <!-- Adicionando uma mensagem de erro para validação -->
                                            <!-- <span class="text-danger"><!?php echo $cpf_err; ?></span> -->
                                        </div>

                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Telefone</label>
                                            <input type="text" class="form-control" id="phone" placeholder="<?php echo $phone ?>" required name="phone" value="<?php echo $phone; ?>">
                                            <!-- Adicionando uma mensagem de erro para validação -->
                                            <!-- <span class="text-danger"><!?php echo $phone_err; ?></span> -->
                                        </div>

                                        <div class="mb-3">
                                            <label for="cep" class="form-label">CEP</label>
                                            <input type="text" class="form-control" id="cep" placeholder="<?php echo $cep ?>" required name="cep" value="<?php echo $cep; ?>">
                                            <!-- Adicionando uma mensagem de erro para validação -->
                                            <!-- <span class="text-danger"><!?php echo $cep_err; ?></span> -->
                                        </div>
    
                                        <div class="mb-3">
                                            <label for="numero" class="form-label">Número</label>
                                            <input type="text" class="form-control" id="numero" placeholder="Insira o número" name="numero">
                                            <!-- Adicionando uma mensagem de erro para validação -->
                                            <!-- <span class="text-danger"><!?php echo $numero_err; ?></span> -->
                                        </div>

                                        <div class="mb-3">
                                            <label for="address" class="form-label">Endereço</label>
                                            <input type="text" class="form-control" id="address" placeholder="<?php echo $address ?>" required name="address" value="<?php echo $address; ?>">
                                            <!-- Adicionando uma mensagem de erro para validação -->
                                            <!-- <span class="text-danger"><!?php echo $address_err; ?></span> -->
                                        </div>

                                        <div class="mb-3">
                                            <label for="birth_date" class="form-label">Data de Nascimento</label>
                                            <input type="date" class="form-control" id="birth_date" placeholder="<?php echo $birth_date ?>" required name="birth_date" value="<?php echo $birth_date; ?>">
                                            <!-- Adicionando uma mensagem de erro para validação -->
                                            <!-- <span class="text-danger"><!?php echo $birth_date_err; ?></span> -->
                                        </div>

                                        <!-- <div class="mb-3 <!?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                            <label for="userpassword" class="form-label">Senha</label>
                                            <input type="password" class="form-control" id="userpassword" placeholder="Insira sua senha" name="password" value="<?php echo $password; ?>">
                                            <span class="text-danger"><!?php echo $password_err; ?></span>
                                        </div>

                                        <div class="mb-3 <!?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                                            <label class="form-label" for="userpassword">Confirme a senha</label>
                                            <input type="password" class="form-control" id="confirm_password" placeholder="Confirme sua senha" name="confirm_password" value="<?php echo $confirm_password; ?>">
                                            <span class="text-danger"><!?php echo $confirm_password_err; ?></span>
                                        </div> -->
                                        
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


<!-- Adicionando JQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
<!-- Adicionando Javascript -->
<script>

$(document).ready(function() {

    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#rua").val("");
        $("#numero").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#uf").val("");
        $("#address").val("");
    }

    // Quando o campo cep perde o foco.
    $("#cep").blur(function() {

        // Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        // Verifica se campo cep possui valor informado.
        if (cep != "") {

            // Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            // Valida o formato do CEP.
            if(validacep.test(cep)) {

                // Preenche os campos com "..." enquanto consulta webservice.
                // $("#rua").val("...");
                // $("#numero").val("...");
                // $("#bairro").val("...");
                // $("#cidade").val("...");
                // $("#uf").val("...");
                $("#address").val("...");

                // Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        // Atualiza os campos com os valores da consulta.
                        // $("#rua").val(dados.logradouro);
                        // $("#bairro").val(dados.bairro);
                        // $("#cidade").val(dados.localidade);
                        // $("#uf").val(dados.uf);

                        // Adiciona um evento de escuta para o campo número.
                        $("#numero").on('input', function() {
                            // Atualiza dinamicamente o campo de endereço completo.
                            $("#address").val(dados.logradouro + ", " + $(this).val() + ", " + dados.bairro + ", " + dados.localidade + " - " + dados.uf);
                            console.log($("#address").val());
                        });

                        // Atualiza inicialmente o campo de endereço completo.
                        $("#address").val(dados.logradouro + ", " + $("#numero").val() + ", " + dados.bairro + ", " + dados.localidade + " - " + dados.uf);
                        console.log($("#address").val());
                    } else {
                        // CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                    }
                });
            } else {
                // CEP é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } else {
            // CEP sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });
});

</script>

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