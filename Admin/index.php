<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>

<?php
if (isset($_SESSION['empresas']) && $_SESSION['empresas'] != ""){
    $empresas = $_SESSION['empresas'];
}
?>

<head>
    <title><?php echo $language["Mosyni"]; ?> | Zayon Data Mining</title>

    <?php include 'layouts/head.php'; ?>

    <link href="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    
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
                            <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->
                
                <!-- Inserir as necessidades do Dashboard a partir daqui -->
                <div class="text-center mb-4">
                    <h4>Seja bem vindo(a)!</h4>
                    <p class="card-title-desc">A ferramenta que facilita seu trabalho de análise de dados
                </div>
                
                <div class="row">
                    <div class="col-12">
                    <?php if (isset($empresas) && $empresas != ""){?>
                        <iframe title="Report Section" width="100%" height="800" src="https://app.powerbi.com/view?r=eyJrIjoiNGZjNzNiOGYtOTg3MC00NmI0LWJjNjUtZDcwMmQ5ZTM3ZmRlIiwidCI6IjY5YzQxN2QzLWRmOTAtNGM4Yy05M2RjLTZlZTNmYWNiZDQyNCJ9&embedImagePlaceholder=true&pageName=ReportSection" frameborder="0" allowFullScreen="true"></iframe>
                    <?php 
                    } else {?>
                        <div class="text-center mb-4">
                            <h4>Solicite cadastro de vinculo á empresa ao administrador para ter acesso aos recursos da ferramenta!</h4>
                        </div>
                    </div>
                    <?php 
                    }
                    ?>
                </div>
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

<!-- App js -->
<script src="assets/js/app.js"></script>

</body>

</html>