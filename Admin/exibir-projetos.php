<?php include 'layouts/session.php'; ?>
<?php include_once 'layouts/config.php'; ?>

<?php session_start(); 
$empresas = $_SESSION['empresas'];?>

<?php
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
?>

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
                                                    <a class="nav-link" id="v-pills-novopcria-tab" data-bs-toggle="pill" href="#v-pills-novopcria" role="tab" aria-controls="v-pills-novopcria" aria-selected="false" onclick="window.location.href='form-cadastrar_projetos.php'">
                                                    <i class="bx bx-plus-circle font-size-16 align-middle me-2"></i>Novo Projeto</a>
                                                </div>
                                                </div><!-- end col -->
                                                <div class="col-md-9">
                                                    <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                                                        <div class="tab-pane fade show active" id="v-pills-p1cria" role="tabpanel" aria-labelledby="v-pills-p1cria-tab">
                                                            <p>
                                                                <table id="datatable" class="table table-bordered dt-responsive w-100">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Nome do arquivo</th>
                                                                            <th>Link (URL)</th>
                                                                            <th>Data do Upload</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>Tiger Nixon</td>
                                                                            <td>https://s3.console.aws.amazon.com/s3/object/mosynicria?region=us-east-1&prefix=001-000015.xml</td>
                                                                            <td>2011/04/25</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Donna Snider</td>
                                                                            <td>Customer Support</td>
                                                                            <td>2011/01/25</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>

                                                            </p>
                                                        </div>
                                                        <div class="tab-pane fade" id="v-pills-p2cria" role="tabpanel" aria-labelledby="v-pills-p2cria-tab">
                                                            <p>
                                                                Tabela contendo os arquivos do Projeto Cria 2.
                                                            </p>                                                            
                                                        </div>
                                                        <div class="tab-pane fade" id="v-pills-p3cria" role="tabpanel" aria-labelledby="v-pills-p3cria-tab">
                                                            <p>
                                                                Tabela contendo os arquivos do Projeto Cria 3.
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

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

<!-- DataTables Buttons CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">

<!-- DataTables Buttons JS -->
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

<!-- Your custom script -->
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
            linkProjeto.textContent = projeto.name; // Certifique-se de que 'name' seja a propriedade correta

            listaProjetos.appendChild(linkProjeto);
        });

        // Adiciona o link "Novo Projeto"
        const linkNovoProjeto = document.createElement('a');
        linkNovoProjeto.className = 'nav-link mb-2';
        linkNovoProjeto.id = 'v-pills-novopcria-tab';
        linkNovoProjeto.setAttribute('data-bs-toggle', 'pill');
        linkNovoProjeto.href = '#v-pills-novopcria';
        linkNovoProjeto.setAttribute('role', 'tab');
        linkNovoProjeto.setAttribute('aria-controls', 'v-pills-novopcria');
        linkNovoProjeto.setAttribute('aria-selected', 'false');
        linkNovoProjeto.setAttribute('onclick', "window.location.href='form-cadastrar_projetos.php'");
        
        const iconNovoProjeto = document.createElement('i');
        iconNovoProjeto.className = 'bx bx-plus-circle font-size-16 align-middle me-2';

        linkNovoProjeto.appendChild(iconNovoProjeto);
        linkNovoProjeto.appendChild(document.createTextNode('Novo Projeto'));

        listaProjetos.appendChild(linkNovoProjeto);
    }
</script>
</body>

</html>
