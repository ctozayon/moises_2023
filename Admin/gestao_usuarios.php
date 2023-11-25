<?php
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
        // var_dump($empresas);
    } else {
        // Se a consulta falhou, exibir uma mensagem de erro
        echo "Erro na consulta: " . mysqli_error($link);
    }

}

if (isset($_POST['selectedUsuario'])) {
    $_SESSION['selectedUsuario'] = $_POST['selectedUsuario'];
}

// Seção para carregar empresas_usuarios do Usuario selecionado
if (isset($_POST['selectedUsuario'])) {
    $selectedUsuario = $_POST['selectedUsuario'];
    $selectedPermission = $_POST['selectedPermission'];

    if ($selectedPermission == 1 || $selectedPermission == 2) {
        $sql = "SELECT * FROM company";
    } else {
        $sql = "SELECT C.id, C.name, C.cnpj, C.cep, C.address FROM company C
        left join company_user CU on C.id = CU.id_company
        WHERE CU.id_user = " . $selectedUsuario;
    }
    
    // Executar a consulta
    $result = mysqli_query($link, $sql);

    // Verificar se a consulta foi bem-sucedida
    if ($result) {
        // Inicializar a variável $empresas_usuarios como um array para armazenar os resultados
        $empresas_usuarios = array();

        // Obter os resultados da consulta
        while ($row = mysqli_fetch_assoc($result)) {
            // Adicionar cada linha ao array
            $empresas_usuarios[] = $row;
        }

        // Liberar o resultado da consulta
        mysqli_free_result($result);

        // Enviar a resposta como JSON
        header('Content-Type: application/json');

    } else {
        // Se a consulta falhou, exibir uma mensagem de erro
        echo json_encode(array('error' => 'Erro na consulta: ' . mysqli_error($link)));
    }

    $sql1 = "SELECT U.id, U.username as 'Usuário', U.useremail as 'E-mail', U.firstname as 'Nome', U.lastname as 'Sobrenome', U.cpf, U.phone as 'Telefone', COALESCE(P.description, 'limitado') as 'Permissão'
    FROM users U
    LEFT JOIN user_permissions UP ON U.id = UP.user_id
    LEFT JOIN permissions P ON UP.permission_id = P.id
    WHERE U.id = $selectedUsuario";

    // Executar a consulta
    $result1 = mysqli_query($link, $sql1);

    // Verificar se a consulta foi bem-sucedida
    if ($result1) {
        // Inicializar a variável $empresas_usuarios como um array para armazenar os resultados
        $usuario_selecionado = array();

        // Obter os resultados da consulta
        while ($row = mysqli_fetch_assoc($result1)) {
            // Adicionar cada linha ao array
            $usuario_selecionado[] = $row;
        }

        // $_POST['selectedPermission'] = $usuario_selecionado[0]['Permissão'];
        
        $usuario_selecionado = array_merge($usuario_selecionado, $empresas_usuarios);
            
        // Liberar o resultado da consulta
        mysqli_free_result($result1);

        // // Enviar a resposta como JSON
        // header('Content-Type: application/json');

        // Imprime o JSON
        echo json_encode($usuario_selecionado);
        exit(); // Certifique-se de sair após enviar a resposta
    } else {
        // Se a consulta falhou, exibir uma mensagem de erro
        echo json_encode(array('error' => 'Erro na consulta: ' . mysqli_error($link)));
    }
}

$sql2 = "SELECT * FROM company";

// Executar a consulta
$result2 = mysqli_query($link, $sql2);

// Verificar se a consulta foi bem-sucedida
if ($result2) {
    // Inicializar a variável $empresas_geral como um array para armazenar os resultados
    $empresas_geral = array();

    // Obter os resultados da consulta
    while ($row = mysqli_fetch_assoc($result2)) {
        // Adicionar cada linha ao array
        $empresas_geral[] = $row;
    }

    // Liberar o resultado da consulta
    mysqli_free_result($result2);
} else {
    // Se a consulta falhou, exibir uma mensagem de erro
    echo json_encode(array('error' => 'Erro na consulta: ' . mysqli_error($link)));
}

$sql3 = "SELECT * FROM permissions";

// Executar a consulta
$result3 = mysqli_query($link, $sql3);

// Verificar se a consulta foi bem-sucedida
if ($result3) {
    // Inicializar a variável $permissoes_geral como um array para armazenar os resultados
    $permissoes_geral = array();

    // Obter os resultados da consulta
    while ($row = mysqli_fetch_assoc($result3)) {
        // Adicionar cada linha ao array
        $permissoes_geral[] = $row;
    }

    // Liberar o resultado da consulta
    mysqli_free_result($result3);
} else {
    // Se a consulta falhou, exibir uma mensagem de erro
    echo json_encode(array('error' => 'Erro na consulta: ' . mysqli_error($link)));
}

// Verifica se os campos 'selectedEmpresaId' e 'usuarioSelecionadoId' estão presentes no POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selectedEmpresaId']) && isset($_SESSION['selectedUsuario'])) {
    // Obtém os valores do POST
    $selectedEmpresaId = $_POST['selectedEmpresaId'];
    $usuarioSelecionadoId = $_SESSION['selectedUsuario'];

    // Aqui você pode realizar operações no banco de dados para inserir os valores na tabela company_user
    // Substitua 'sua_tabela' pelos nomes reais das tabelas envolvidas
    $sql = "INSERT INTO company_user (id_company, id_user) VALUES ('$selectedEmpresaId', '$usuarioSelecionadoId')";

    // Executa a consulta
    if (mysqli_query($link, $sql)) {
        exit();
    } else {
        // Se houver um erro na consulta, exibe uma mensagem de erro
        echo 'Erro na inserção na tabela company_user: ' . mysqli_error($link);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selectedPermissionId']) && isset($_SESSION['selectedUsuario'])) {
    // Obtém os valores do POST
    $selectedPermissionId = $_POST['selectedPermissionId'];

    // Prepare a select statement
    $sql = "SELECT * FROM user_permissions WHERE user_id = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $usuarioSelecionadoId);

        // Set parameters
        $usuarioSelecionadoId = $_SESSION['selectedUsuario'];

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            /* store result */
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) > 0) {
                $sql = "UPDATE `minia_php`.`user_permissions` SET `permission_id` = $selectedPermissionId WHERE user_id = $usuarioSelecionadoId";
            } else {
                $sql = "INSERT INTO user_permissions (permission_id, user_id) VALUES ('$selectedPermissionId', '$usuarioSelecionadoId')";
            }
            // Executa a consulta
            if (mysqli_query($link, $sql)) {
                $_SESSION['permission_id'] = $selectedPermissionId;
                exit();
            } else {
                // Se houver um erro na consulta, exibe uma mensagem de erro
                echo 'Erro na inserção na tabela permission_user: ' . mysqli_error($link);
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        mysqli_stmt_close($stmt);
        
    }
}

// Close connection
mysqli_close($link);
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
                                                            
                                                            <td><a href="javascript: void(0);" class="text-body fw-medium" onclick="selecionarUsuario(<?php echo $usuario['id'] ?> , <?php echo $usuario['permission_id']?>)"><?php echo $usuario['id'] ?></a> </td>
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

                    <div id="boxUsuarioSelecionado" class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-start ">
                                    <!-- <div class="flex-shrink-0 me-3 align-self-center">
                                        <img src="assets/images/users/avatar-1.png" class="avatar-sm rounded-circle" alt="">
                                    </div> -->
                                    
                                    <div class="flex-grow-1" id="nomeUsuario">
                                        <!-- Nome do usuário selecionado -->
                                        <div class="d-flex flex-wrap gap-2 mt-1" id="permissao">
                                            <!-- Permissão do usuário selecionado -->
                                        </div>
                                    </div>

                                    <div class="flex-shrink-0">
                                        <div class="dropdown chat-noti-dropdown">
                                            <button class="btn dropdown-toggle p-0" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-horizontal-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#" onclick="editarUsuario()">Editar</a>
                                                <a class="dropdown-item" href="#">Excluir</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card header-->
                            <div id="dadosUsuario" class="card-body">
                                <!-- Dados do usuário selecionado -->
                            </div><!-- end card-body -->
                            <div id="editarUsuario" class="card-body">
                                <div id="vinculo_empresa" class="col-md-6">
                                    <label for="empresas_geral">Selecione a empresa para vincular:</label>
                                    <select class="form-select" id="empresas_geral" name="empresas_geral">
                                        <?php
                                        // Verifica se uma empresa foi selecionada
                                        if (isset($empresas_geral)) {
                                            // Exibe a lista de empresas_geral
                                            foreach ($empresas_geral as $empresa) {
                                                echo '<option onclick="enviarPostEmpresa('. $empresa['id']. ')" value="' . $empresa['id'] . '">' . $empresa['name'] . '</option>';
                                            }
                                        } else {
                                            // Caso nenhuma empresa tenha sido selecionada ou a empresa selecionada não exista nos dados
                                            echo '<option value="">Não existem empresas cadastradas ou não foram carregadas</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="permissoes_geral">Selecione a permissão para esse usuário:</label>
                                    <select class="form-select" id="permissoes_geral" name="permissoes_geral">
                                        <?php
                                        // Verifica se uma empresa foi selecionada
                                        if (isset($permissoes_geral)) {
                                            // Exibe a lista de permissoes_geral
                                            foreach ($permissoes_geral as $permissao) {
                                                echo '<option onclick="enviarPostpermissao('. $permissao['id']. ')" value="' . $permissao['id'] . '">' . ucfirst($permissao['description']) . '</option>';
                                            }
                                        } else {
                                            // Caso nenhuma permissao tenha sido selecionada ou a permissao selecionada não exista nos dados
                                            echo '<option value="">Não existem permissões cadastradas ou não foram carregadas</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
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

<script>
var editaUsuario = document.getElementById('editarUsuario');
// Inicialmente, ocultamos as edições
editaUsuario.style.visibility = 'hidden';

var boxUsuario = document.getElementById('boxUsuarioSelecionado');
// Inicialmente, ocultamos as edições
boxUsuario.style.visibility = 'hidden';

function selecionarUsuario(Usuario, Permission) {
    var formData = new FormData();
    formData.append('selectedUsuario', Usuario);
    formData.append('selectedPermission', Permission);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                try {
                    var responseText = xhr.responseText.trim();
                    // Suponha que responseText contenha a string JSON
                    var cleanedResponseTemp = responseText.replace(/\n/g, '').trim();
                    var cleanedResponse = cleanedResponseTemp.replace(/NULL/g, '').trim();
                    // console.log(cleanedResponse);
                    if (cleanedResponse !== '') {
                        // Tentar fazer o parse novamente
                        try {
                            console.log("Resposta JSON:", cleanedResponse);
                            var usuario_selecionado = JSON.parse(cleanedResponse);
                            // usuario_selecionado = usuario_selecionado[0];
                            console.log(usuario_selecionado);
                        } catch (error) {
                            console.error("Erro ao fazer o parse JSON:", error);
                        }
                        atualizarUsusarioSelecionado(usuario_selecionado);
                        // Exibe ou oculta a edição do uruário
                        boxUsuario.style.visibility = this.value !== '' ? 'visible' : 'hidden';
                    } else {
                        console.error('Resposta JSON vazia ou inválida.');
                    }
                } catch (error) {
                    console.error('Erro ao analisar JSON:', error);
                }
            } else {
                console.error('Erro na solicitação:', xhr.status);
            }
        }
    };
    xhr.send(formData);
}

function atualizarUsusarioSelecionado(usuario_selecionado) {
    const nomeUsuario = document.getElementById('nomeUsuario');
    nomeUsuario.innerHTML = '';

    // Ocultamos as edições
    editaUsuario.style.visibility = 'hidden';


    const nome = document.createElement('h5');
    nome.className = 'font-size-16 mb-1';
    nome.innerHTML = usuario_selecionado[0].Nome + ' ' + usuario_selecionado[0].Sobrenome;
    nomeUsuario.appendChild(nome);

    // Adiciona uma tag <span> para cada permissão na resposta
    const permissao_usuario = document.createElement('span');
    permissao_usuario.className = 'badge rounded-pill bg-primary';
    permissao_usuario.textContent = usuario_selecionado[0].Permissão.charAt(0).toUpperCase() + usuario_selecionado[0].Permissão.slice(1);
    nomeUsuario.appendChild(permissao_usuario);
    
    const vinculo_empresa = document.getElementById('vinculo_empresa');
    if (usuario_selecionado[0].Permissão != 'limitado') {
        vinculo_empresa.style.visibility = 'hidden';
    }
    
    console.log('Função atualizarUsusarioSelecionado chamada!');
    console.log('Usuário Selecionado:', usuario_selecionado);

    // Supondo que usuario_selecionado[0] seja um objeto
    var usuarioSelecionado = usuario_selecionado[0];

    // Seleciona o elemento onde você deseja adicionar as tags
    var container = document.getElementById('dadosUsuario'); // Substitua 'seuContainer' pelo ID real do seu contêiner
    // Limpa o conteúdo existente antes de adicionar novos campos
    container.innerHTML = '';
    // Itera sobre as propriedades do objeto usuarioSelecionado
    for (var propriedade in usuarioSelecionado) {
        // Cria os elementos HTML
        var divRow = document.createElement('div');
        divRow.className = 'row mb-4';

        var label = document.createElement('label');
        label.className = 'col-sm-3 col-form-label';
        label.textContent = propriedade.charAt(0).toUpperCase() + propriedade.slice(1) + ":"; // Capitaliza a primeira letra

        var divCol = document.createElement('div');
        divCol.className = 'col-sm-9';

        var p = document.createElement('p');
        p.textContent = usuarioSelecionado[propriedade];

        // Adiciona os elementos ao DOM
        divCol.appendChild(p);
        divRow.appendChild(label);
        divRow.appendChild(divCol);
        container.appendChild(divRow);
    }
    // Inicialize a variável empresas como uma string vazia
    var empresas = '';

    // Itere sobre o array a partir do índice 1
    for (var i = 1; i < usuario_selecionado.length; i++) {
    // Concatene o valor do atributo name à variável empresas
    empresas += usuario_selecionado[i].name + ', ';
    }

    // Remova a vírgula extra no final, se houver
    empresas = empresas.slice(0, -2);

    var divEmpresas = document.createElement('div');
    divEmpresas.className = 'row mb-4';

    var label = document.createElement('label');
    label.className = 'col-sm-3 col-form-label';
    label.textContent = "Empresas vinculadas:"; // Capitaliza a primeira letra

    var divCol = document.createElement('div');
    divCol.className = 'col-sm-9';

    var span = document.createElement('span');
    span.textContent = empresas;

    // Adiciona os elementos ao DOM
    divCol.appendChild(span);
    divEmpresas.appendChild(label);
    divEmpresas.appendChild(divCol);
    container.appendChild(divEmpresas);
}

function editarUsuario() {
    // Seleciona o elemento onde você deseja adicionar as tags
    var container = document.getElementById('dadosUsuario'); // Substitua 'seuContainer' pelo ID real do seu contêiner
    // Limpa o conteúdo existente antes de adicionar novos campos
    container.innerHTML = '';
    // Exibe ou oculta a edição do uruário
    editaUsuario.style.visibility = this.value !== '' ? 'visible' : 'hidden';
}

function enviarPostEmpresa(selectedEmpresaId) {
    var formData = new FormData();
    formData.append('selectedEmpresaId', selectedEmpresaId);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                location.reload();
            } else {
                console.error('Erro na solicitação:', xhr.status);
            }
        }
    };
    xhr.send(formData);
}

function enviarPostpermissao(selectedPermissionId) {
    var formData = new FormData();
    formData.append('selectedPermissionId', selectedPermissionId);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', window.location.href, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                location.reload();
            } else {
                console.error('Erro na solicitação:', xhr.status);
            }
        }
    };
    xhr.send(formData);
}

</script>

</body>

</html>