<?php
// Include config file
require_once "layouts/config.php";

// Consulta SQL
$sql = "SELECT * FROM company";

// Executar a consulta
$result = mysqli_query($link, $sql);

// Verificar se a consulta foi bem-sucedida
if ($result) {
    // Inicializar a variável empresa como um array para armazenar os resultados
    $empresas = array();

    // Obter os resultados da consulta
    while ($row = mysqli_fetch_assoc($result)) {
        // Adicionar cada linha ao array
        $empresas[] = $row;
    }

    // Liberar o resultado da consulta
    mysqli_free_result($result);

    // Exibir o conteúdo da variável empresa (pode ser removido em produção)
    var_dump($empresas);
} else {
    // Se a consulta falhou, exibir uma mensagem de erro
    echo "Erro na consulta: " . mysqli_error($link);
}

// Fechar a conexão com o banco de dados
mysqli_close($link);

// Verifica se o formulário de projeto foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selectedEmpresa']) && isset($_POST['nomeProjeto']) && $_POST['nomeProjeto'] != '') {
    $selectedEmpresa = $_POST['selectedEmpresa'];
    $nomeProjeto = $_POST['nomeProjeto'];

    // Adicione qualquer validação ou limpeza de dados necessária aqui

    // Insira os dados na tabela de projetos (exemplo simples)
    $sql = "INSERT INTO minia_php.project (id_company, name) VALUES ('$selectedEmpresa', '$nomeProjeto')";

    // Execute a consulta SQL usando a conexão com o banco de dados
    // Certifique-se de ajustar isso de acordo com sua configuração de banco de dados
    $result = mysqli_query($link, $sql);

    // Se a consulta foi bem-sucedida, você pode retornar uma resposta de sucesso
    if ($result) {
        echo "Dados do projeto inseridos com sucesso!";
    } else {
        // Se a consulta falhou, você pode retornar uma mensagem de erro
        echo "Erro ao inserir dados do projeto: " . mysqli_error($link);
    }

    // Certifique-se de fechar a conexão com o banco de dados, se aplicável
    mysqli_close($link);
}
?>

<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<head>

    <title>Novo projeto</title>
    <?php include 'layouts/head.php'; ?>
    <?php include 'layouts/head-style.php'; ?>

</head>

<?php include 'layouts/body.php'; ?>

<?php
// $empresas = array("Cria", "Faza", "Arti");
$empresas_projetos = array(
    'Cria' => array('Projeto1 Cria', 'Projeto2 Cria', 'Projeto3 Cria'),
    'Faza' => array('Projeto1 Faza', 'Projeto2 Faza', 'Projeto3 Faza'),
    'Arti' => array('Projeto1 Arti', 'Projeto2 Arti', 'Projeto3 Arti')
);
?>

<?php
$estados = array(
    'AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS',
    'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC',
    'SP', 'SE', 'TO'
);
?>

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

                            <h4 class="mb-sm-0 font-size-18">Novo projeto</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Extração</a></li>
                                    <li class="breadcrumb-item active">Projetos</li>
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
                                <h4 class="card-title">Dados do projeto</h4>
                                <p class="card-title-desc">Preencha nos campos abaixo os dados referente ao projeto que está sendo criado.</p>
                            </div>
                            <div class="card-body p-4">
                                <div class="row">
                                    <form id="projetoForm">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="mb-3">
                                                    <label class="form-label">Empresa do projeto</label>
                                                    <?php
                                                    // Loop para exibir os nomes das empresas   
                                                    foreach ($empresas as $empresa) { ?>
                                                        <div class='form-check mb-3'>
                                                            <input class='form-check-input' type='radio' name='selectedEmpresa' id='formRadios<?php echo $empresa['name']; ?>' value='<?php echo $empresa['id']; ?>' <?php echo (isset($_POST['selectedEmpresa']) && $_POST['selectedEmpresa'] == $empresa) ? 'checked' : ''; ?>>
                                                            <label class='form-check-label' for='formRadios<?php echo $empresa['name']; ?>' data-projetos='<?php echo json_encode($empresas['name']); ?>'>
                                                                <?php echo $empresa['name']; ?>
                                                            </label>
                                                        </div>
                                                    <?php } ?> </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="mb-3">
                                                    <label for="example-text-input" class="form-label">Nome do projeto</label>
                                                    <input class="form-control" type="text" id="nomeProjeto" name="nomeProjeto" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-lg-auto">
                                                <div class="mt-4">
                                                    <button type="submit" class="btn btn-primary w-lg">Salvar projeto</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Detalhes do projeto</h4>
                                <p class="card-title-desc">Preencha nos campos abaixo os dados referente ao projeto que está sendo criado.</p>
                            </div>
                            <div class="card-body p-4">
                                <div class="row">
                                    <form id="detalhesProjetoForm">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="projetos">Selecione o projeto:</label>
                                                <select class="form-select" id="projetos" name="projetos">
                                                    <?php
                                                    // Verifica se uma empresa foi selecionada
                                                    if (isset($_POST['selectedEmpresa']) && array_key_exists($_POST['selectedEmpresa'], $empresas_projetos)) {
                                                        // Obtém os projetos correspondentes à empresa selecionada
                                                        $projetos = $empresas_projetos[$_POST['selectedEmpresa']];

                                                        // Exibe a lista de projetos
                                                        foreach ($projetos as $projeto) {
                                                            echo '<option value="' . $projeto . '">' . $projeto . '</option>';
                                                        }
                                                    } else {
                                                        // Caso nenhuma empresa tenha sido selecionada ou a empresa selecionada não exista nos dados
                                                        echo '<option value="">Selecione uma empresa primeiro</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="example-date-input" class="form-label">Data de início planejada</label>
                                                        <input class="form-control" type="date" value="2023-01-01" id="dataInicioPlanejada">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="example-date-input" class="form-label">Data de início executada</label>
                                                        <input class="form-control" type="date" value="2023-01-01" id="dataInicioExecutada">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="example-date-input" class="form-label">Data de término</label>
                                                        <input class="form-control" type="date" value="2023-01-01" id="dataTermino">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-2">
                                                    <div class="mb-3">
                                                        <label class="form-label">Estado</label>
                                                        <select class="form-select">
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
                                                        <input class="form-control" type="text" id="cidade">
                                                    </div>
                                                </div>
                                                <div class="col-lg-5">
                                                    <div class="mb-3">
                                                        <label for="example-text-input" class="form-label">Bairro</label>
                                                        <input class="form-control" type="text" id="bairro">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="example-text-input" class="form-label">Quantidade de pessoas envolvidas na produção</label>
                                                        <input class="form-control" type="text" id="qtddPessoasProducao">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="example-text-input" class="form-label">Quantidade de funções envolvidas na produção</label>
                                                        <input class="form-control" type="text" id="qtddFuncoesProducao">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="example-text-input" class="form-label">Público estimado</label>
                                                        <input class="form-control" type="text" id="publicoEstimado">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row justify-content-center">
                                                <div class="col-lg-auto">
                                                    <div class="w-lg">
                                                        <button type="submit" class="btn btn-primary w-lg">Gerar tabela pessoas x remuneração</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row justify-content-center">
                                                <div class="col-lg-auto">
                                                    <div class="mt-4">
                                                        <div class="mb-3">
                                                            <!-- Inserir aqui a estrutura que montará a tabela dinamicamente após clicar no botão -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row justify-content-center">
                                                <div class="col-lg-auto">
                                                    <div class="mt-4">
                                                        <div class="mb-3">
                                                            <label for="example-text-input" class="form-label">Remuneração média das pessoas envolvidas na produção</label>
                                                            <input class="form-control" type="text" id="remuneracaoMedia">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="example-text-input" class="form-label">Custo estimado do projeto</label>
                                                        <input class="form-control" type="text" id="custoEstimadoProjeto">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="example-text-input" class="form-label">Custo executado no projeto</label>
                                                        <input class="form-control" type="text" id="custoExecutadoProjeto">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-lg-auto">
                                                <div class="mt-4">
                                                    <button type="submit" class="btn btn-primary w-lg">Salvar detalhes do projeto</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>

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

<script src="assets/js/app.js"></script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Adiciona evento de envio no formulário de projeto
        document.getElementById('projetoForm').addEventListener('submit', function (e) {
            e.preventDefault();

            var formData = new FormData(this);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', window.location.href, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Lida com a resposta
                    handleResponse(xhr.responseText);
                }
            };
            xhr.send(formData);
        });

        // Adiciona evento de envio no formulário de detalhes do projeto
        document.getElementById('detalhesProjetoForm').addEventListener('submit', function (e) {
            e.preventDefault();

            var formData = new FormData(this);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', window.location.href, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Lida com a resposta
                    handleResponse(xhr.responseText);
                }
            };
            xhr.send(formData);
        });

        // Adiciona evento de mudança nos rádios
        var radios = document.querySelectorAll('input[type=radio][name=selectedEmpresa]');
        radios.forEach(function (radio) {
            radio.addEventListener('change', function () {
                var projetosLabel = this.nextElementSibling;
                var projetos = projetosLabel.getAttribute('data-projetos');

                // Atualiza a lista de projetos no dropdown
                updateProjetosDropdown(projetos);

                // Envia o formulário via AJAX
                var formData = new FormData(document.getElementById('projetoForm'));

                var xhr = new XMLHttpRequest();
                xhr.open('POST', window.location.href, true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        // Lida com a resposta
                        handleResponse(xhr.responseText);
                    }
                };
                xhr.send(formData);
            });
        });

        // Função para atualizar a lista de projetos no dropdown
        function updateProjetosDropdown(projetos) {
            var projetosDropdown = document.getElementById('projetos');
            projetosDropdown.innerHTML = ''; // Limpa a lista de projetos

            // Adiciona os projetos ao dropdown
            JSON.parse(projetos).forEach(function (projeto) {
                var option = document.createElement('option');
                option.value = projeto;
                option.text = projeto;
                projetosDropdown.appendChild(option);
            });
        }

        // Função para lidar com a resposta do servidor
        function handleResponse(response) {
            // Aqui, você pode decidir o que fazer com a resposta.
            // Neste exemplo, eu apenas log a resposta no console.
            console.log(response);

            // Se houver uma parte específica da página que você deseja atualizar, você pode fazer algo como:
            // document.getElementById('suaDiv').innerHTML = response;
        }
    });
</script>

</body>

</html>
