<?php session_start(); 
$empresas = $_SESSION['empresas'];?>

<?php
include_once 'layouts/config.php';

// Função para obter projetos da empresa selecionada
function getProjetos($selectedEmpresa, $link) {
    $projetos = array();

    // Consulta SQL para obter os projetos da empresa selecionada
    $sql = "SELECT * FROM project WHERE id_company = '$selectedEmpresa'";
    
    // Executar a consulta
    $result = mysqli_query($link, $sql);

    // Verificar se a consulta foi bem-sucedida
    if ($result) {
        // Obter os resultados da consulta
        while ($row = mysqli_fetch_assoc($result)) {
            // Adicionar cada linha ao array
            $projetos []= $row;
        }

        // Liberar o resultado da consulta
        mysqli_free_result($result);
    } else {
        // Se a consulta falhou, exibir uma mensagem de erro
        echo json_encode(array('error' => 'Erro na consulta: ' . mysqli_error($link)));
    }

    return $projetos;
}

// Função para verificar se é uma solicitação AJAX
function is_ajax_request() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}

// Seção para carregar projetos da empresa selecionada
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selectedEmpresa'])) {
    $selectedEmpresa = $_POST['selectedEmpresa'];

    // Verifica se é uma solicitação AJAX
    if (is_ajax_request()) {
        // Consulta SQL para obter os projetos da empresa selecionada
        $sql = "SELECT * FROM project WHERE id_company = '$selectedEmpresa'";

        // Executar a consulta
        $result = mysqli_query($link, $sql);

        // Verificar se a consulta foi bem-sucedida
        if ($result) {
            $projetos = array();

            while ($row = mysqli_fetch_assoc($result)) {
                $projetos []= $row;
            }

            mysqli_free_result($result);

            // Envia a resposta como JSON
            header('Content-Type: application/json');
            echo json_encode($projetos);

            exit();
        } else {
            // Se a consulta falhou, envie uma resposta JSON com erro
            header('Content-Type: application/json');
            echo json_encode(array('error' => 'Erro na consulta: ' . mysqli_error($link)));

            exit();
        }
    }
}

// Seção para carregar arquivos do projeto selecionado
if (isset($_POST['selectedProjeto'])) {
    $selectedProjeto = $_POST['selectedProjeto'];

        // Consulta SQL para obter os projetos da Projeto selecionada
        $sql = "SELECT * FROM file WHERE id_project = '$selectedProjeto'";
        
        // Executar a consulta
        $result = mysqli_query($link, $sql);

        // Verificar se a consulta foi bem-sucedida
        if ($result) {
            // Inicializar a variável $arquivos como um array para armazenar os resultados
            $arquivos = array();

            // Obter os resultados da consulta
            while ($row = mysqli_fetch_assoc($result)) {
                // Adicionar cada linha ao array
                $arquivos[] = $row;
            }

            // Liberar o resultado da consulta
            mysqli_free_result($result);

            // Enviar a resposta como JSON
            header('Content-Type: application/json');

            // Imprime o JSON
            echo json_encode($arquivos);

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

    <title>Lista de projetos e arquivos</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>

    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

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
                            <h4 class="mb-sm-0 font-size-18">Lista de projetos e arquivos</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Projetos</a></li>
                                    <li class="breadcrumb-item active">Lista e arquivos</li>
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
                                <h4 class="card-title">Empresas</h4>
                                <p class="card-title-desc">Selecione a empresa para exibir seus respectivos projetos e os arquivos vinculados a estes projetos.</p>
                            </div><!-- end card header -->
                        
                            <div class="card-body">
                                <ul class="nav nav-tabs" role="tablist">
                                    <?php foreach ($empresas as $empresa) { ?>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#<?php echo strtolower($empresa['name']) ?>" role="tab" onclick="selecionarEmpresa(<?php echo $empresa['id']; ?>)">
                                                <span class="d-block d-sm-none"><i class="fas fa-building"></i></span>
                                                <span class="d-none d-sm-block"><?php echo $empresa['name'] ?></span>    
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>

                                <!-- Botões de projetos -->
                                <div class="tab-content p-3 text-muted">
                                    <div class="tab-pane active" id="cria" role="tabpanel">
                                        <p class="mb-0">
                                            <div class="row">
                                                <div class="col-md-3">
                                                <div id="lista-projetos" class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
                                                    <a class="nav-link" id="v-pills-novo-tab" data-bs-toggle="pill" href="#v-pills-novo" role="tab" aria-controls="v-pills-novo" aria-selected="false" onclick="window.location.href='form-cadastrar_projetos.php'">
                                                    <i class="bx bx-plus-circle font-size-16 align-middle me-2"></i>Novo Projeto</a>
                                                </div>
                                                </div><!-- end col -->
                                                <div class="col-md-9">
                                                    <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                                                        <div class="tab-pane fade show active" id="v-pills-p1cria" role="tabpanel" aria-labelledby="v-pills-p1cria-tab">
                                                            <p>
                                                            <div class="table-responsive" id="lista-arquivos">
                                                                <table id="datatable" class="table table-bordered dt-responsive w-100">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Nome do arquivo</th>
                                                                            <th>Link (URL)</th>
                                                                            <th>Data do Upload</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="tabela-arquivos">
                                                                        <!-- Conteúdo da tabela aqui -->
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div><!--  end col -->
                                            </div><!-- end row -->
                                        </p>
                                    </div>
                                </div>
                            </div><!-- end card-body -->
                        </div><!-- end card -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Detalhes do projeto</h4>
                                        <p class="card-title-desc">Veja detalhes do projeto e sub-projetos nos campos abaixo.</p>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="row">
                                            <form id="detalhesProjetoForm">
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="label_projeto">Projeto selecionado: </label>
                                                        <button type="button" class="btn btn-primary btn-rounded waves-effect waves-light" disabled>Show Simone Matos</button>
                                                        <!-- <span class="badge rounded-pill badge-soft-primary">Selecione o projeto no quadro anterior para exibir aqui</span> -->
                                                    <!-- <label for="projeto_selecionado">Selecione o projeto para exibir o nome aqui</label> -->
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 mb-3">
                                                        <label for="label_projeto">Turnês cadastradas para este projeto (selecione para exibir detalhes nos campos abaixo): </label>
                                                    </div>
                                                    <div class="col-md-12 mb-5">
                                                        <button type="button" class="btn btn-soft-success btn-rounded waves-effect waves-light">Turnê Centro-Canasvieiras-SC-01/01/23-01/02/23</button>
                                                        <button type="button" class="btn btn-soft-success btn-rounded waves-effect waves-light">Turnê Centro Histórico-Diamantina-MG-10/02/23-25/02/23</button>
                                                        <button type="button" class="btn btn-soft-success btn-rounded waves-effect waves-light">Turnê Zona Norte-Maringá-PR-25/06/23-18/07/23</button>
                                                        <button type="button" class="btn btn-soft-success btn-rounded waves-effect waves-light">Turnê Bandeirantes-São Luis-MA-12/10/23-22/11/23</button>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="example-date-input" class="form-label">Data de início planejada</label>
                                                            <input class="form-control" type="date" value="2023-01-01" id="dataInicioPlanejada" name="dataInicioPlanejada" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="example-date-input" class="form-label">Data de início executada</label>
                                                            <input class="form-control" type="date" value="2023-01-01" id="dataInicioExecutada" name="dataInicioExecutada" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="example-date-input" class="form-label">Data de término</label>
                                                            <input class="form-control" type="date" value="2023-01-01" id="dataTermino" name="dataTermino" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <div class="mb-3">
                                                            <label class="form-label">Estado</label>
                                                            <select class="form-select" id="estado" name="estado" disabled>
                                                                <?php
                                                                foreach ($estados as $estado) { ?>
                                                                    <option> <?php echo $estado ?> </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <div class="mb-3">
                                                            <label for="example-text-input" class="form-label">Cidade</label>
                                                            <input class="form-control" type="text" id="cidade" name="cidade" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <div class="mb-3">
                                                            <label for="example-text-input" class="form-label">Bairro</label>
                                                            <input class="form-control" type="text" id="bairro" name="bairro" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="example-text-input" class="form-label">Quantidade de pessoas envolvidas na produção</label>
                                                            <input class="form-control" type="text" id="qtddPessoasProducao" name="qtddPessoasProducao" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="example-text-input" class="form-label">Quantidade de funções envolvidas na produção</label>
                                                            <input class="form-control" type="text" id="qtddFuncoesProducao" name="qtddFuncoesProducao" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-3">
                                                            <label for="example-text-input" class="form-label">Público estimado</label>
                                                            <input class="form-control" type="text" id="publicoEstimado" name="publicoEstimado" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row justify-content-center">
                                                    <div class="col-lg-auto">
                                                        <div class="mt-4">
                                                            <div class="mb-3">
                                                                <label for="example-text-input" class="form-label">Remuneração média das pessoas envolvidas na produção</label>
                                                                <input class="form-control" type="text" id="remuneracaoMedia" name="remuneracaoMedia" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="example-text-input" class="form-label">Custo estimado do projeto</label>
                                                            <input class="form-control" type="text" id="custoEstimadoProjeto" name="custoEstimadoProjeto" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="example-text-input" class="form-label">Custo executado no projeto</label>
                                                            <input class="form-control" type="text" id="custoExecutadoProjeto" name="custoExecutadoProjeto" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row justify-content-end">
                                                    <div class="col-lg-auto">
                                                        <div class="mt-4">
                                                            <button type="button" class="btn btn-danger w-lg" data-bs-toggle="modal" data-bs-target="#modalExcluirProjeto">Excluir projeto</button>
                                                            <div id="modalExcluirProjeto" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="myModalLabel">Deseja excluir o projeto?</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">                                                                            
                                                                            <p>Confirmando a exclusão do projeto,
                                                                                todas as informações referentes ao projeto serão deletadas
                                                                                e arquivos referentes a estes projetos também serão removidos do banco.</p>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cancelar</button>
                                                                            <button type="button" class="btn btn-danger waves-effect waves-light">Excluir permanentemente!</button>
                                                                        </div>
                                                                    </div><!-- /.modal-content -->
                                                                </div><!-- /.modal-dialog -->
                                                            </div><!-- /.modal -->
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-auto">
                                                        <div class="mt-4">
                                                            <button type="button" class="btn btn-danger w-lg" data-bs-toggle="modal" data-bs-target="#modalExcluirTurne">Excluir turnê</button>
                                                            <div id="modalExcluirTurne" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="myModalLabel">Deseja excluir a turnê?</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">                                                                            
                                                                            <p>Confirmando a exclusão da turnê,
                                                                                todas as informações referentes
                                                                                à turnê serão deletadas do banco.</p>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cancelar</button>
                                                                            <button type="button" class="btn btn-danger waves-effect waves-light">Excluir permanentemente!</button>
                                                                        </div>
                                                                    </div><!-- /.modal-content -->
                                                                </div><!-- /.modal-dialog -->
                                                            </div><!-- /.modal -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>

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

<script src="assets/js/app.js"></script>
<script src="assets/libs/jquery/jquery.min.js"></script>
<script src="assets/libs/metismenu/metisMenu.min.js"></script>
<script src="assets/libs/simplebar/simplebar.min.js"></script>
<script src="assets/libs/node-waves/waves.min.js"></script>
<script src="assets/libs/feather-icons/feather.min.js"></script>
<!-- pace js -->
<script src="assets/libs/pace-js/pace.min.js"></script>

<!-- Required datatable js -->
<script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

<!-- Responsive examples -->
<script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<!-- Buttons examples -->
<script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="assets/libs/jszip/jszip.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

<!-- DataTables -->
<link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

<!-- Datatable init js -->
<script src="assets/js/pages/datatables.init.js"></script>

<script src="assets/js/app.js"></script>

<script>
    async function selecionarEmpresa(idEmpresa) {
        try {
            const response = await fetch('<?php echo $_SERVER['PHP_SELF']; ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: 'selectedEmpresa=' + encodeURIComponent(idEmpresa),
            });

            if (!response.ok) {
                throw new Error('Erro ao selecionar empresa: ' + response.statusText);
            }


            const responseData = await response.json();

            if (responseData.error) {
                throw new Error('Erro na resposta do servidor: ' + responseData.error);
            }

            atualizarListaProjetos(responseData);
        } catch (error) {
            console.error('Erro:', error.message);
        }
    }

    function atualizarListaProjetos(projetos) {
        const listaProjetos = document.getElementById('lista-projetos');
        listaProjetos.innerHTML = '';

        // Adiciona uma tag <a> para cada projeto na resposta
        projetos.forEach(projeto => {
            const linkProjeto = document.createElement('a');
            linkProjeto.className = 'nav-link mb-2';
            linkProjeto.href = '#';
            linkProjeto.onclick = selecionarProjeto(projeto.id); // Use a função como um callback
            linkProjeto.textContent = projeto.name;

            listaProjetos.appendChild(linkProjeto);
        });


        // Adiciona o link "Novo Projeto"
        const linkNovoProjeto = document.createElement('a');
        linkNovoProjeto.className = 'nav-link mb-2';
        linkNovoProjeto.id = 'v-pills-novo-tab';
        linkNovoProjeto.setAttribute('data-bs-toggle', 'pill');
        linkNovoProjeto.setAttribute('role', 'tab');
        linkNovoProjeto.setAttribute('aria-controls', 'v-pills-novo');
        linkNovoProjeto.setAttribute('aria-selected', 'false');
        linkNovoProjeto.setAttribute('onclick', "window.location.href='form-cadastrar_projetos.php'");
        
        const iconNovoProjeto = document.createElement('i');
        iconNovoProjeto.className = 'bx bx-plus-circle font-size-16 align-middle me-2';

        linkNovoProjeto.appendChild(iconNovoProjeto);
        linkNovoProjeto.appendChild(document.createTextNode('Novo Projeto'));

        listaProjetos.appendChild(linkNovoProjeto);
    }

    function selecionarProjeto(idProjeto) {
        return function () {
            // Envia o formulário via AJAX
            var formData = new FormData();
            formData.append('selectedProjeto', idProjeto);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', window.location.href, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        try {
                            var responseText = xhr.responseText.trim();
                            var cleanedResponse = responseText.replace(/\n/g, '').trim();
                            // console.log(cleanedResponse);
                            if (cleanedResponse !== '') {
                                // Tentar fazer o parse novamente
                                try {
                                    var arquivos = JSON.parse(cleanedResponse);
                                    // console.log("Array parseado:", arquivos);
                                } catch (error) {
                                    console.error("Erro ao fazer o parse JSON:", error);
                                }
                                atualizarListaArquivos(arquivos);
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
        };
    }

    // Variável para armazenar a referência ao DataTable
    var dataTable;

    $(document).ready(function() {
        // Inicialize o DataTable se ainda não foi inicializado
        if (!$.fn.DataTable.isDataTable('#datatable')) {
            dataTable = $('#datatable').DataTable({
                "paging": true,
                "info": true
                // Adicione outras opções conforme necessário
            });
        } else {
            // Se já estiver inicializado, apenas atualize a referência
            dataTable = $('#datatable').DataTable();
        }

        // Salve a referência ao DataTable para uso posterior
        $('#tabela-arquivos').data('datatable', dataTable);
    });

    function atualizarListaArquivos(arquivos) {
        // Obtenha a referência ao DataTable salva
        var dataTable = $('#tabela-arquivos').data('datatable');

        // Verifique se o DataTable foi inicializado
        if (dataTable) {
            // Limpe os dados existentes no DataTable
            dataTable.clear();

            // Adicione os novos dados ao DataTable
            arquivos.forEach(arquivo => {
                dataTable.row.add([
                    arquivo.name,
                    arquivo.link,
                    arquivo.upload_date
                ]);
            });

            // Atualize o DataTable
            dataTable.draw();
        } else {
            console.error('Erro: DataTable não inicializado.');
        }
    }

</script>
</body>

</html>
