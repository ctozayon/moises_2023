<?php
// Include config file
require_once "layouts/config.php";

// Define variables and initialize with empty values
$useremail = $username = $firstname = $lastname = $password = $confirm_password = $cpf = $phone = $cep = $address = $birth_date = "";
$useremail_err = $username_err = $firstname_err = $lastname_err = $password_err = $confirm_password_err = $cpf_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    // Validate useremail
    if (empty(trim($_POST["useremail"]))) {
        $useremail_err = "Por favor digite seu e-mail de usuário.";
    } elseif (!filter_var($_POST["useremail"], FILTER_VALIDATE_EMAIL)) {
        $useremail_err = "Formato de e-mail inválido.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE useremail = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_useremail);

            // Set parameters
            $param_useremail = trim($_POST["useremail"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $useremail_err = "Este e-mail já está sendo utilizado.";
                } else {
                    $useremail = trim($_POST["useremail"]);
                }
            } else {
                echo "Oops! Algo está errado. Por favor tente novamente mais tarde.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
            
        }
    }

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Por favor insira seu nome de usuário.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Por favor insira a senha.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "A senha deve conter pelo menos 6 caracteres.";
    } else {
        $password = trim($_POST["password"]);
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

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Confirme a sua senha.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "A senha não está compatível.";
        }
    }

    // Check input errors before inserting in database
    if (empty($useremail_err) && empty($username_err) && empty($firstname_err) && empty($lastname_err) && empty($password_err) && empty($confirm_password_err) && empty($cpf_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO users (useremail, username, firstname, lastname, cpf, phone, cep, address, birth_date, password, token) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssssss", $param_useremail, $param_username, $param_firstname, $param_lastname, $param_cpf, $param_phone, $param_cep, $param_address, $param_birth_date, $param_password, $param_token);

            // Set parameters
            $param_useremail = trim($_POST["useremail"]);
            $param_username = trim($_POST["username"]);
            $param_firstname = trim($_POST["firstname"]);
            $param_lastname = trim($_POST["lastname"]);
            $param_cpf = trim($_POST["cpf"]);
            $param_phone = trim($_POST["phone"]);
            $param_cep = trim($_POST["cep"]);
            $param_address = trim($_POST["address"]);
            $param_birth_date = trim($_POST["birth_date"]);;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_token = bin2hex(random_bytes(50)); // generate unique token

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                header("location: index.php");
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

<head>

    <title>Novo Registro | Mosýni</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>

</head>

<?php include 'layouts/body.php'; ?>

<div class="auth-page">
    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-xxl-3 col-lg-4 col-md-5">
                <div class="auth-full-page-content d-flex p-sm-5 p-4">
                    <div class="w-100">
                        <div class="d-flex flex-column h-100">
                            <div class="mb-4 mb-md-5 text-center">
                                <a href="index.php" class="d-block auth-logo">
                                    <img src="assets/images/logo-mosyni-principal.png" alt="" height="56">
                                </a>
                            </div>
                            <div class="auth-content my-auto">
                                <div class="text-center">
                                    <h5 class="mb-0">Novo registro</h5>
                                    <p class="text-muted mt-2">Faça seu registro agora.</p>
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
                                        <input type="text" class="form-control" id="cpf" placeholder="Insira seu CPF" required name="cpf" value="<?php echo $cpf; ?>">
                                        <!-- Adicionando uma mensagem de erro para validação -->
                                        <span class="text-danger"><?php echo $cpf_err; ?></span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Telefone</label>
                                        <input type="text" class="form-control" id="phone" placeholder="Insira seu telefone" required name="phone" value="<?php echo $phone; ?>">
                                        <!-- Adicionando uma mensagem de erro para validação -->
                                        <span class="text-danger"><?php echo $phone_err; ?></span>
                                    </div>

                                    <!-- <form method="get" action="."> -->
                                    <div class="mb-3">
                                        <label for="cep" class="form-label">CEP</label>
                                        <input type="text" class="form-control" id="cep" placeholder="Insira seu cep" required name="cep" value="<?php echo $cep; ?>">
                                        <!-- Adicionando uma mensagem de erro para validação -->
                                        <span class="text-danger"><?php echo $cep_err; ?></span>
                                    </div>
                                    <!-- </form> -->

                                    <div class="mb-3">
                                        <label for="numero" class="form-label">Número</label>
                                        <input type="text" class="form-control" id="numero" placeholder="Insira o número" required name="numero" value="<?php echo $numero; ?>">
                                        <!-- Adicionando uma mensagem de erro para validação -->
                                        <span class="text-danger"><?php echo $numero_err; ?></span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="address" class="form-label">Endereço</label>
                                        <input type="text" class="form-control" id="address" required name="address" value="<?php echo $address; ?>">
                                        <!-- Adicionando uma mensagem de erro para validação -->
                                        <span class="text-danger"><?php echo $address_err; ?></span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="birth_date" class="form-label">Data de Nascimento</label>
                                        <input type="text" class="form-control" id="birth_date" placeholder="Insira sua data de nascimento" required name="birth_date" value="<?php echo $birth_date; ?>">
                                        <!-- Adicionando uma mensagem de erro para validação -->
                                        <span class="text-danger"><?php echo $birth_date_err; ?></span>
                                    </div>

                                    <div class="mb-3 <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                        <label for="userpassword" class="form-label">Senha</label>
                                        <input type="password" class="form-control" id="userpassword" placeholder="Insira sua senha" required name="password" value="<?php echo $password; ?>">
                                        <span class="text-danger"><?php echo $password_err; ?></span>
                                    </div>

                                    <div class="mb-3 <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                                        <label class="form-label" for="userpassword">Confirme a senha</label>
                                        <input type="password" class="form-control" id="confirm_password" placeholder="Confirme sua senha" name="confirm_password" value="<?php echo $confirm_password; ?>">
                                        <span class="text-danger"><?php echo $confirm_password_err; ?></span>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <p class="mb-0">Registrando-se você concorda com os <a href="#" class="text-primary">Termos de Uso</a></p>
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Registrar</button>
                                    </div>
                                </form>

                                <div class="mt-4 pt-2 text-center">
                                    <div class="signin-other-title">
                                        <h5 class="font-size-14 mb-3 text-muted fw-medium">- Registrar usando -</h5>
                                    </div>

                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="javascript:void()" class="social-list-item bg-primary text-white border-primary">
                                                <i class="mdi mdi-facebook"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript:void()" class="social-list-item bg-info text-white border-info">
                                                <i class="mdi mdi-twitter"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript:void()" class="social-list-item bg-danger text-white border-danger">
                                                <i class="mdi mdi-google"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="mt-5 text-center">
                                    <p class="text-muted mb-0">Já possui uma conta ? <a href="auth-login.php" class="text-primary fw-semibold"> Login </a> </p>
                                </div>
                            </div>
                            <div class="mt-4 mt-md-5 text-center">
                                <p class="mb-0">© <script>
                                        document.write(new Date().getFullYear())
                                    </script> Desenvolvido com <i class="mdi mdi-heart text-danger"></i> por Zayon</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end auth full page content -->
            </div>
            <!-- end col -->
            <div class="col-xxl-9 col-lg-8 col-md-7">
                <div class="auth-bg pt-md-5 p-4 d-flex">
                    <div class="bg-overlay bg-primary"></div>
                    <ul class="bg-bubbles">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                    <!-- end bubble effect -->
                    <div class="row justify-content-center align-items-center">
                        <div class="col-xl-7">
                            <div class="p-0 p-sm-4 px-xl-0">
                                <div id="reviewcarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-indicators carousel-indicators-rounded justify-content-start ms-0 mb-0">
                                        <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                        <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                        <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                    </div>
                                    <!-- end carouselIndicators -->
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <div class="testi-contain text-white">
                                                <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                                <h4 class="mt-4 fw-medium lh-base text-white">“I feel confident
                                                    imposing change
                                                    on myself. It's a lot more progressing fun than looking back.
                                                    That's why
                                                    I ultricies enim
                                                    at malesuada nibh diam on tortor neaded to throw curve balls.”
                                                </h4>
                                                <div class="mt-4 pt-3 pb-5">
                                                    <div class="d-flex align-items-start">
                                                        <div class="flex-shrink-0">
                                                            <img src="assets/images/users/avatar-1.jpg" class="avatar-md img-fluid rounded-circle" alt="...">
                                                        </div>
                                                        <div class="flex-grow-1 ms-3 mb-4">
                                                            <h5 class="font-size-18 text-white">Richard Drews
                                                            </h5>
                                                            <p class="mb-0 text-white-50">Web Designer</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="carousel-item">
                                            <div class="testi-contain text-white">
                                                <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                                <h4 class="mt-4 fw-medium lh-base text-white">“Our task must be to
                                                    free ourselves by widening our circle of compassion to embrace
                                                    all living
                                                    creatures and
                                                    the whole of quis consectetur nunc sit amet semper justo. nature
                                                    and its beauty.”</h4>
                                                <div class="mt-4 pt-3 pb-5">
                                                    <div class="d-flex align-items-start">
                                                        <div class="flex-shrink-0">
                                                            <img src="assets/images/users/avatar-2.jpg" class="avatar-md img-fluid rounded-circle" alt="...">
                                                        </div>
                                                        <div class="flex-grow-1 ms-3 mb-4">
                                                            <h5 class="font-size-18 text-white">Rosanna French
                                                            </h5>
                                                            <p class="mb-0 text-white-50">Web Developer</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="carousel-item">
                                            <div class="testi-contain text-white">
                                                <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                                <h4 class="mt-4 fw-medium lh-base text-white">“I've learned that
                                                    people will forget what you said, people will forget what you
                                                    did,
                                                    but people will never forget
                                                    how donec in efficitur lectus, nec lobortis metus you made them
                                                    feel.”</h4>
                                                <div class="mt-4 pt-3 pb-5">
                                                    <div class="d-flex align-items-start">
                                                        <img src="assets/images/users/avatar-3.jpg" class="avatar-md img-fluid rounded-circle" alt="...">
                                                        <div class="flex-1 ms-3 mb-4">
                                                            <h5 class="font-size-18 text-white">Ilse R. Eaton</h5>
                                                            <p class="mb-0 text-white-50">Manager
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end carousel-inner -->
                                </div>
                                <!-- end review carousel -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container fluid -->
</div>


<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>

<!-- validation init -->
<script src="assets/js/pages/validation.init.js"></script>

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
                $("#rua").val("...");
                $("#numero").val("...");
                $("#bairro").val("...");
                $("#cidade").val("...");
                $("#uf").val("...");
                $("#address").val("...");

                // Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        // Atualiza os campos com os valores da consulta.
                        $("#rua").val(dados.logradouro);
                        $("#bairro").val(dados.bairro);
                        $("#cidade").val(dados.localidade);
                        $("#uf").val(dados.uf);

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

</body>

</html>