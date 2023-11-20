<?php include 'layouts/session.php'; 
session_start();
$empresas = $_SESSION['empresas'];

// Verifique se $empresas está definido antes de usar json_encode
if (isset($empresas)) {
    echo json_encode($empresas);
} else {
    // Lidere com a situação em que $empresas não está definido
    echo json_encode([]);
}
?>

<?php include 'layouts/head-main.php'; ?>

<head>

    <title>Gestão de Empresas</title>
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
                                    <table  id="datatable" class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nome da Empresa</th>
                                                <th>CNPJ</th>
                                                <th>CEP</th>
                                                <th>Endereço</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tabela-empresas">
                                            <!-- Conteúdo da tabela aqui -->
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
                                        <label for="cep" class="col-sm-3 col-form-label">CEP</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="cep" placeholder="Digite o CEP">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="numero" class="col-sm-3 col-form-label">Número</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="numero" placeholder="Digite o número">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="address" class="col-sm-3 col-form-label">Endereço</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="address" required name="address" value="<?php echo $address; ?>">
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

<!-- Adicionando JQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>

        <!-- Adicionando Javascript -->
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

<!-- Datatable init js -->
<script src="assets/js/pages/datatables.init.js"></script>

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

// Variável para armazenar a referência ao DataTable
var dataTable;

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
$('#tabela-empresas').data('datatable', dataTable);

// Verifique se o DataTable foi inicializado
if (dataTable) {
    // Limpe os dados existentes no DataTable
    dataTable.clear();

    // Adicione os novos dados ao DataTable
    <?php
    if (isset($empresas)) {
        foreach ($empresas as $empresa) {
            echo "dataTable.row.add([
                '{$empresa['id']}',
                '{$empresa['name']}',
                '{$empresa['cnpj']}',
                '{$empresa['cep']}',
                '{$empresa['address']}'
            ]);";
        }
    }
    ?>

    // Atualize o DataTable
    dataTable.draw();
} else {
    console.error('Erro: DataTable não inicializado.');
}
</script>

</body>

</html>