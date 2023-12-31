<?php
session_start(); 
$empresas = $_SESSION['empresas'];

require_once 'layouts/config.php';

if (isset($_POST['selectedProjeto'])){
    $_SESSION['projeto_selecionado'] = $_POST['selectedProjeto'];
}

if (isset($_POST['selectedEmpresa'])){
    $_SESSION['empresa_selecionada'] = $_POST['selectedEmpresa'];
}

// Seção para carregar projetos da empresa selecionada
if (isset($_POST['selectedEmpresa']) && $_POST['selectedEmpresa'] != "null" && !isset($projetos) && !isset($_POST['selectedProjeto'])) {
    $selectedEmpresa = $_POST['selectedEmpresa'];
    
    // Consulta SQL para obter os projetos da empresa selecionada
    $sql = "SELECT * FROM project WHERE id_company = '$selectedEmpresa'";
    
    // Executar a consulta
    $result = mysqli_query($link, $sql);

    // Verificar se a consulta foi bem-sucedida
    if ($result) {
        // Inicializar a variável $projetos como um array para armazenar os resultados
        $projetos = array();

        // Obter os resultados da consulta
        while ($row = mysqli_fetch_assoc($result)) {
            // Adicionar cada linha ao array
            $projetos[] = $row;
        }

        // Liberar o resultado da consulta
        mysqli_free_result($result);

        // Enviar a resposta como JSON
        header('Content-Type: application/json');

        // Imprime o JSON
        echo json_encode($projetos);

        exit(); // Certifique-se de sair após enviar a resposta
    } else {
        // Se a consulta falhou, exibir uma mensagem de erro
        echo json_encode(array('error' => 'Erro na consulta: ' . mysqli_error($link)));
    }
}
?>

<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<head>

    <title>Upload de Novos Arquivos</title>
    <?php include 'layouts/head.php'; ?>

    <!-- twitter-bootstrap-wizard css -->
    <link rel="stylesheet" href="assets/libs/twitter-bootstrap-wizard/prettify.css">

    <!-- dropzone css -->
    <link href="assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />

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
                            <h4 class="mb-sm-0 font-size-18">Upload de Novos Arquivos</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Extração</a></li>
                                    <li class="breadcrumb-item active">Carga de Dados</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Passos para envio dos arquivos</h4>
                            </div>
                            <div class="card-body">
                                <div id="basic-pills-wizard" class="twitter-bs-wizard">
                                    <ul class="twitter-bs-wizard-nav">
                                        <li class="nav-item">
                                            <a href="#empresaProjeto" class="nav-link" data-toggle="tab">
                                                <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Empresa e projeto">
                                                    <i class="fas fa-users"></i>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#uploadArquivo" class="nav-link" data-toggle="tab">
                                                <div class="step-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Upload de arquivos">
                                                    <i class="fas fa-cloud-upload-alt"></i>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- wizard-nav -->
                                    <div class="tab-content twitter-bs-wizard-tab-content">
                                        <div class="tab-pane" id="empresaProjeto">
                                            <div class="text-center mb-4">
                                                <h5>Para qual cliente deseja fazer o upload?</h5>
                                                <p class="card-title-desc">Selecione entre os clientes exibidos para enviar os arquivos para a pasta correta:</p>
                                            </div>
                                            <div class="col-md-6">
                                                <div>
                                                    <?php
                                                    // Loop para exibir os nomes das empresas   
                                                    foreach ($empresas as $empresa) {?>
                                                        <?php $empresa_minuscula = strtolower($empresa['name']);?>
                                                        <div class='form-check mb-3'>
                                                            <?php $empresa_minuscula = strtolower($empresa_minuscula); ?>
                                                            <input class='form-check-input' type='radio' name='selectedEmpresa' id='formRadios<?php echo $empresa_minuscula; ?>' value='<?php echo $empresa['id']; ?>' <?php echo (isset($_POST['selectedEmpresa']) && $_POST['selectedEmpresa'] == $empresa_minuscula) ? 'checked' : ''; ?>>
                                                            <label class='form-check-label' for='formRadios<?php echo $empresa_minuscula; ?>' data-projetos='<?php echo json_encode($projetos); ?>'>
                                                                <?php echo $empresa['name']; ?>
                                                            </label>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="projetos">Selecione o projeto:</label>
                                                <select class="form-select" id="projetos" name="projetos">
                                                    <?php
                                                    // Verifica se uma empresa foi selecionada
                                                    if (isset($_POST['selectedEmpresa']) && isset($projetos)) {
                                                        // Obtém os projetos correspondentes à empresa selecionada
                                                        // $projetos = $empresas_projetos[$_POST['selectedEmpresa']];

                                                        // Exibe a lista de projetos
                                                        foreach ($projetos as $projeto) {
                                                            echo '<option value="' . $projeto['id'] . '">' . $projeto['name'] . '</option>';
                                                        }
                                                    } else {
                                                        // Caso nenhuma empresa tenha sido selecionada ou a empresa selecionada não exista nos dados
                                                        echo '<option value="">Selecione uma empresa primeiro</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <ul class="pager wizard twitter-bs-wizard-pager-link">
                                                <li class="next"><a href="javascript: void(0);" class="btn btn-primary" onclick="nextTab()">Próximo <i class="bx bx-chevron-right ms-1"></i></a></li>
                                            </ul>
                                        </div>
                                        <!-- tab pane -->
                                        <div class="tab-pane" id="uploadArquivo">
                                          <div>
                                            <div class="text-center mb-4">
                                                <h5>Selecione os arquivos para upload:</h5>
                                                <p class="card-title-desc">Utilize apenas arquivos no formarto XML, ou outro já ajustado com arquipe técnica>
                                            </div>

                                            <div class="card-body">

                                                <div>
                                                     <!-- // Debug: verifique os valores antes do formulário -->
                                                    <form action="upload.php" method="post" enctype="multipart/form-data" class="dropzone" id="awsDropzone">
                                                        <div class="fallback">
                                                            <input name="file" type="file" multiple="multiple">
                                                        </div>
                                                        <div class="dz-message needsclick">
                                                            <div class="mb-3">
                                                                <i class="display-4 text-muted bx bx-cloud-upload"></i>
                                                            </div>

                                                            <h5>Arraste os arquivos aqui ou clique para fazer upload</h5>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <ul class="pager wizard twitter-bs-wizard-pager-link">
                                                <li class="previous"><a href="javascript: void(0);" class="btn btn-primary" onclick="nextTab()"><i class="bx bx-chevron-left me-1"></i> Voltar</a></li>
                                                <!-- <li class="next"><a href="javascript: void(0);" class="btn btn-primary">Próximo <i
                                                            class="bx bx-chevron-right ms-1"></i></a></li> -->
                                                <li class="float-end"><a href="javascript: void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".confirmModal">Concluir </a></li>
                                            </ul>
                                          </div>
                                        </div>
                                        <!-- tab pane -->
                                        <!-- <div class="tab-pane" id="bank-detail">
                                            <div>
                                                <div class="text-center mb-4">
                                                    <h5>Confira os arquivos enviados</h5>
                                                    <p class="card-title-desc">Mantenha ou exclua os arquivos que foram enviados para processamento.</p>
                                                </div>

                                                <div class="table-responsive">
                                                    <table class="table table-editable table-nowrap align-middle table-edits">
                                                        <thead>
                                                            <tr>
                                                                <th>Nome do arquivo</th>
                                                                <th>Ações</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr data-id="1">                                        
                                                                <td data-field="name">Nota Fiscal 12345678 - Rio de Janeiro - 7.jul.23</td>                                                               
                                                                <td style="width: 100px">
                                                                    <a class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                                                        <i class="fas fa-pencil-alt"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr data-id="2">                                                                
                                                                <td data-field="name">Nota Fiscal 87654321 - Belo Horizonte - 7.jul.23</td>                                                                
                                                                <td>
                                                                    <a class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                                                        <i class="fas fa-pencil-alt"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <tr data-id="3">                                                                
                                                                <td data-field="name">Nota Fiscal 13243546 - Joinville - 7.jul.23</td>                                                        
                                                                <td>
                                                                    <a class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                                                        <i class="fas fa-pencil-alt"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <ul class="pager wizard twitter-bs-wizard-pager-link">
                                                    <li class="previous"><a href="javascript: void(0);" class="btn btn-primary"><i
                                                                class="bx bx-chevron-left me-1"></i> Voltar</a></li>
                                                    <li class="float-end"><a href="javascript: void(0);" class="btn btn-primary" data-bs-toggle="modal"
                                                            data-bs-target=".confirmModal">Concluir </a></li>
                                                </ul>
                                            </div>
                                        </div>  -->
                                        <!-- tab pane -->
                                    </div>
                                    <!-- end tab content -->
                                </div>
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
        <!-- end card body -->
        <!-- Modal -->
        <div class="modal fade confirmModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <div class="mb-3">
                                <i class="bx bx-check-circle display-4 text-success"></i>
                            </div>
                            <h5>Confirma o upload de arquivos?</h5>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-light w-md" data-bs-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-primary w-md" data-bs-dismiss="modal" onclick="window.location.href='index.php';">Confirmar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal -->
        <?php include 'layouts/footer.php'; ?>
    </div>
    <!-- end Main-content -->
</div>
<!-- END layout-wrapper -->

<!-- Right Sidebar -->
<?php include 'layouts/right-sidebar.php'; ?>
<!-- /Right-bar -->

<!-- JAVASCRIPT -->

<?php include 'layouts/vendor-scripts.php'; ?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // ... (o mesmo código que acima)

        // Adiciona evento de mudança nos rádios
        var radios = document.querySelectorAll('input[type=radio][name=selectedEmpresa]');
        radios.forEach(function (radio) {
            radio.addEventListener('change', function () {
                var projetosLabel = this.nextElementSibling;
                var projetos = projetosLabel.getAttribute('data-projetos');
                
                // Envia o formulário via AJAX
                var formData = new FormData();
                formData.append('selectedEmpresa', this.value);

                var xhr = new XMLHttpRequest();
                xhr.open('POST', window.location.href, true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        // Lida com a resposta
                        handleResponse(xhr.responseText);
                    }
                projetos = xhr.responseText;
                // Atualiza a lista de projetos no dropdown
                updateProjetosDropdown(projetos);
                };

                xhr.send(formData);
            });
        });

        // Função para atualizar a lista de projetos no dropdown
        function updateProjetosDropdown(projetos) {
            var projetosDropdown = document.getElementById('projetos');
            projetosDropdown.innerHTML = ''; // Limpa a lista de projetos

            // Verifica se projetos não é nulo ou indefinido
            if (projetos !== 'null' && projetos !== undefined && projetos !== '') {
                // Adiciona os projetos ao dropdown
                JSON.parse(projetos).forEach(function (projeto) {
                    var option = document.createElement('option');
                    option.value = projeto.id;
                    option.text = projeto.name;
                    projetosDropdown.appendChild(option);
                });
            }
        }

        // Adiciona evento de mudança nos selects
        var selectProjetos = document.getElementById('projetos');
        var nextButton = document.querySelector('.pager li.next');
        // Inicialmente, ocultamos o botão
        nextButton.style.visibility = 'hidden';

        selectProjetos.addEventListener('change', function () {
            console.log('Projeto Selecionado: ' + this.value);

            // Envia o formulário via AJAX
            var formData = new FormData();
            formData.append('selectedProjeto', this.value);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', window.location.href, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Lida com a resposta
                    handleResponse(xhr.responseText);

                    // Exibe ou oculta o botão com base na seleção do projeto
                    nextButton.style.visibility = this.value !== '' ? 'visible' : 'hidden';
                }
            };

            xhr.send(formData);
        });

        // Função para lidar com a resposta do servidor
        function handleResponse(response) {
            // Aqui, você pode decidir o que fazer com a resposta.

            // Se houver uma parte específica da página que você deseja atualizar, você pode fazer algo como:
            // document.getElementById('suaDiv').innerHTML = response;
        }
    });
</script>

<!--?php include 'layouts/vendor-scripts.php'; ?> -->

<script>
    $(document).ready(function() {
        // Evento de mudança no formulário
        $('#empresaForm input[type=radio]').change(function() {
            // Obtém os projetos associados à empresa selecionada
            var projetos = $(this).next('label').data('projetos');

            // Atualiza a lista de projetos no dropdown
            updateProjetosDropdown(projetos);

            // Envie o formulário
            $('#empresaForm').submit();
        });

        
    });
</script>

<!-- twitter-bootstrap-wizard js -->
<script src="assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
<script src="assets/libs/twitter-bootstrap-wizard/prettify.js"></script>

<!-- dropzone js -->
<script src="assets/libs/dropzone/min/dropzone.min.js"></script>

<!-- faz o upload dos arquivos do dropzone para AWS no clique do botão -->
<script src="assets/js/pages/opcoesDropzone.js"></script>
<!-- <script src="assets/js/pages/botaoUpload.js"></script> -->

<!-- form wizard init -->
<script src="assets/js/pages/form-wizard.init.js"></script>

<script src="assets/js/app.js"></script>

</body>

</html>