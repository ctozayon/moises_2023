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
                                <!-- Abas de nagvegação empresas -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#cria" role="tab">
                                            <span class="d-block d-sm-none"><i class="fas fa-building"></i></span>
                                            <span class="d-none d-sm-block">Cria</span>    
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#faza" role="tab">
                                            <span class="d-block d-sm-none"><i class="fas fa-building"></i></span>
                                            <span class="d-none d-sm-block">Faza</span>    
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#arti" role="tab">
                                            <span class="d-block d-sm-none"><i class="fas fa-building"></i></span>
                                            <span class="d-none d-sm-block">Arti</span>    
                                        </a>
                                    </li>
                                </ul>

                                <!-- Botões de projetos -->
                                <div class="tab-content p-3 text-muted">
                                    <div class="tab-pane active" id="cria" role="tabpanel">
                                        <p class="mb-0">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                    <a class="nav-link mb-2 active" id="v-pills-p1cria-tab" data-bs-toggle="pill" href="#v-pills-p1cria" role="tab" aria-controls="v-pills-p1cria" aria-selected="true">Projeto Cria 1</a>
                                                    <a class="nav-link mb-2" id="v-pills-p2cria-tab" data-bs-toggle="pill" href="#v-pills-p2cria" role="tab" aria-controls="v-pills-p2cria" aria-selected="false">Projeto Cria 2</a>
                                                    <a class="nav-link mb-2" id="v-pills-p3cria-tab" data-bs-toggle="pill" href="#v-pills-p3cria" role="tab" aria-controls="v-pills-p3cria" aria-selected="false">Projeto Cria 3</a>
                                                    <a class="nav-link" id="v-pills-novopcria-tab" data-bs-toggle="pill" href="#v-pills-novopcria" role="tab" aria-controls="v-pills-novopcria" aria-selected="false" onclick="window.location.href='form-cadastrar_projetos.php'">
                                                    <i class="bx bx-plus-circle font-size-16 align-middle me-2"></i>Novo Projeto Cria</a>
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
                                                                            <td>Garrett Winters</td>
                                                                            <td>Accountant</td>
                                                                            <td>2011/07/25</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Ashton Cox</td>
                                                                            <td>Junior Technical Author</td>
                                                                            <td>2009/01/12</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Cedric Kelly</td>
                                                                            <td>Senior Javascript Developer</td>
                                                                            <td>2012/03/29</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Airi Satou</td>
                                                                            <td>Accountant</td>
                                                                            <td>2008/11/28</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Brielle Williamson</td>
                                                                            <td>Integration Specialist</td>
                                                                            <td>2012/12/02</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Herrod Chandler</td>
                                                                            <td>Sales Assistant</td>
                                                                            <td>2012/08/06</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Rhona Davidson</td>
                                                                            <td>Integration Specialist</td>
                                                                            <td>2010/10/14</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Colleen Hurst</td>
                                                                            <td>Javascript Developer</td>
                                                                            <td>2009/09/15</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Sonya Frost</td>
                                                                            <td>Software Engineer</td>
                                                                            <td>2008/12/13</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Jena Gaines</td>
                                                                            <td>Office Manager</td>
                                                                            <td>2008/12/19</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Quinn Flynn</td>
                                                                            <td>Support Lead</td>
                                                                            <td>2013/03/03</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Charde Marshall</td>
                                                                            <td>Regional Director</td>
                                                                            <td>2008/10/16</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Haley Kennedy</td>
                                                                            <td>Senior Marketing Designer</td>
                                                                            <td>2012/12/18</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Tatyana Fitzpatrick</td>
                                                                            <td>Regional Director</td>
                                                                            <td>2010/03/17</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Michael Silva</td>
                                                                            <td>Marketing Designer</td>
                                                                            <td>2012/11/27</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Paul Byrd</td>
                                                                            <td>Chief Financial Officer (CFO)</td>
                                                                            <td>2010/06/09</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Gloria Little</td>
                                                                            <td>Systems Administrator</td>
                                                                            <td>2009/04/10</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Bradley Greer</td>
                                                                            <td>Software Engineer</td>
                                                                            <td>2012/10/13</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Dai Rios</td>
                                                                            <td>Personnel Lead</td>
                                                                            <td>2012/09/26</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Jenette Caldwell</td>
                                                                            <td>Development Lead</td>
                                                                            <td>2011/09/03</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Yuri Berry</td>
                                                                            <td>Chief Marketing Officer (CMO)</td>
                                                                            <td>2009/06/25</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Caesar Vance</td>
                                                                            <td>Pre-Sales Support</td>
                                                                            <td>2011/12/12</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Doris Wilder</td>
                                                                            <td>Sales Assistant</td>
                                                                            <td>2010/09/20</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Angelica Ramos</td>
                                                                            <td>Chief Executive Officer (CEO)</td>
                                                                            <td>2009/10/09</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Gavin Joyce</td>
                                                                            <td>Developer</td>
                                                                            <td>2010/12/22</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Jennifer Chang</td>
                                                                            <td>Regional Director</td>
                                                                            <td>2010/11/14</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Brenden Wagner</td>
                                                                            <td>Software Engineer</td>
                                                                            <td>2011/06/07</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Fiona Green</td>
                                                                            <td>Chief Operating Officer (COO)</td>
                                                                            <td>2010/03/11</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Shou Itou</td>
                                                                            <td>Regional Marketing</td>
                                                                            <td>2011/08/14</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Michelle House</td>
                                                                            <td>Integration Specialist</td>
                                                                            <td>2011/06/02</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Suki Burks</td>
                                                                            <td>Developer</td>
                                                                            <td>2009/10/22</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Prescott Bartlett</td>
                                                                            <td>Technical Author</td>
                                                                            <td>2011/05/07</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Gavin Cortez</td>
                                                                            <td>Team Leader</td>
                                                                            <td>2008/10/26</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Martena Mccray</td>
                                                                            <td>Post-Sales support</td>
                                                                            <td>2011/03/09</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Unity Butler</td>
                                                                            <td>Marketing Designer</td>
                                                                            <td>2009/12/09</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Howard Hatfield</td>
                                                                            <td>Office Manager</td>
                                                                            <td>2008/12/16</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Hope Fuentes</td>
                                                                            <td>Secretary</td>
                                                                            <td>2010/02/12</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Vivian Harrell</td>
                                                                            <td>Financial Controller</td>
                                                                            <td>2009/02/14</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Timothy Mooney</td>
                                                                            <td>Office Manager</td>
                                                                            <td>2008/12/11</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Jackson Bradshaw</td>
                                                                            <td>Director</td>
                                                                            <td>2008/09/26</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Olivia Liang</td>
                                                                            <td>Support Engineer</td>
                                                                            <td>2011/02/03</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Bruno Nash</td>
                                                                            <td>Software Engineer</td>
                                                                            <td>2011/05/03</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Sakura Yamamoto</td>
                                                                            <td>Support Engineer</td>
                                                                            <td>2009/08/19</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Thor Walton</td>
                                                                            <td>Developer</td>
                                                                            <td>2013/08/11</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Finn Camacho</td>
                                                                            <td>Support Engineer</td>
                                                                            <td>2009/07/07</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Serge Baldwin</td>
                                                                            <td>Data Coordinator</td>
                                                                            <td>2012/04/09</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Zenaida Frank</td>
                                                                            <td>Software Engineer</td>
                                                                            <td>2010/01/04</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Zorita Serrano</td>
                                                                            <td>Software Engineer</td>
                                                                            <td>2012/06/01</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Jennifer Acosta</td>
                                                                            <td>Junior Javascript Developer</td>
                                                                            <td>2013/02/01</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Cara Stevens</td>
                                                                            <td>Sales Assistant</td>
                                                                            <td>2011/12/06</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Hermione Butler</td>
                                                                            <td>Regional Director</td>
                                                                            <td>2011/03/21</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Lael Greer</td>
                                                                            <td>Systems Administrator</td>
                                                                            <td>2009/02/27</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Jonas Alexander</td>
                                                                            <td>Developer</td>
                                                                            <td>2010/07/14</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Shad Decker</td>
                                                                            <td>Regional Director</td>
                                                                            <td>2008/11/13</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Michael Bruce</td>
                                                                            <td>Javascript Developer</td>
                                                                            <td>2011/06/27</td>
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
                                    <div class="tab-pane" id="faza" role="tabpanel">
                                        <p class="mb-0">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                    <a class="nav-link mb-2 active" id="v-pills-p1faza-tab" data-bs-toggle="pill" href="#v-pills-p1faza" role="tab" aria-controls="v-pills-p1faza" aria-selected="true">Projeto Faza 1</a>
                                                    <a class="nav-link mb-2" id="v-pills-p2faza-tab" data-bs-toggle="pill" href="#v-pills-p2faza" role="tab" aria-controls="v-pills-p2faza" aria-selected="false">Projeto Faza 2</a>
                                                    <a class="nav-link mb-2" id="v-pills-p3faza-tab" data-bs-toggle="pill" href="#v-pills-p3faza" role="tab" aria-controls="v-pills-p3faza" aria-selected="false">Projeto Faza 3</a>
                                                    <a class="nav-link" id="v-pills-novopfaza-tab" data-bs-toggle="pill" href="#v-pills-novopfaza" role="tab" aria-controls="v-pills-novopfaza" aria-selected="false" onclick="window.location.href='form-cadastrar_projetos.php'">
                                                    <i class="bx bx-plus-circle font-size-16 align-middle me-2"></i>Novo Projeto Faza</a>
                                                    </div>
                                                </div><!-- end col -->
                                                <div class="col-md-9">
                                                    <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                                                        <div class="tab-pane fade show active" id="v-pills-p1faza" role="tabpanel" aria-labelledby="v-pills-p1faza-tab">
                                                            <p>
                                                                Tabela contendo os arquivos do Projeto Faza 1.
                                                            </p>
                                                        </div>
                                                        <div class="tab-pane fade" id="v-pills-p2faza" role="tabpanel" aria-labelledby="v-pills-p2faza-tab">
                                                            <p>
                                                            Tabela contendo os arquivos do Projeto Faza 2.
                                                            </p>                                                            
                                                        </div>
                                                        <div class="tab-pane fade" id="v-pills-p3faza" role="tabpanel" aria-labelledby="v-pills-p3faza-tab">
                                                            <p>
                                                            Tabela contendo os arquivos do Projeto Faza 3.
                                                            </p>
                                                        </div>                                                        
                                                    </div>
                                                </div><!--  end col -->
                                            </div><!-- end row -->
                                        </p>
                                    </div>
                                    <div class="tab-pane" id="arti" role="tabpanel">
                                        <p class="mb-0">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                    <a class="nav-link mb-2 active" id="v-pills-p1arti-tab" data-bs-toggle="pill" href="#v-pills-p1arti" role="tab" aria-controls="v-pills-p1arti" aria-selected="true">Projeto Arti 1</a>
                                                    <a class="nav-link mb-2" id="v-pills-p2arti-tab" data-bs-toggle="pill" href="#v-pills-p2arti" role="tab" aria-controls="v-pills-p2arti" aria-selected="false">Projeto Arti 2</a>
                                                    <a class="nav-link mb-2" id="v-pills-p3arti-tab" data-bs-toggle="pill" href="#v-pills-p3arti" role="tab" aria-controls="v-pills-p3arti" aria-selected="false">Projeto Arti 3</a>
                                                    <a class="nav-link" id="v-pills-novoparti-tab" data-bs-toggle="pill" href="#v-pills-novoparti" role="tab" aria-controls="v-pills-novoparti" aria-selected="false" onclick="window.location.href='form-cadastrar_projetos.php'">
                                                    <i class="bx bx-plus-circle font-size-16 align-middle me-2"></i>Novo Projeto Arti</a>
                                                    </div>
                                                </div><!-- end col -->
                                                <div class="col-md-9">
                                                    <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                                                        <div class="tab-pane fade show active" id="v-pills-p1arti" role="tabpanel" aria-labelledby="v-pills-p1arti-tab">
                                                            <p>
                                                                Tabela contendo os arquivos do Projeto Arti 1.
                                                            </p>
                                                        </div>
                                                        <div class="tab-pane fade" id="v-pills-p2arti" role="tabpanel" aria-labelledby="v-pills-p2arti-tab">
                                                            <p>
                                                                Tabela contendo os arquivos do Projeto Arti 2.
                                                            </p>                                                            
                                                        </div>
                                                        <div class="tab-pane fade" id="v-pills-p3arti" role="tabpanel" aria-labelledby="v-pills-p3arti-tab">
                                                            <p>
                                                                Tabela contendo os arquivos do Projeto Arti 3.
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


<?php include 'layouts/vendor-scripts.php'; ?>

<!-- Required datatable js -->
<script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

<!-- Responsive examples -->
<script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="assets/js/pages/datatables.init.js"></script>

<script src="assets/js/app.js"></script>

</body>

</html>