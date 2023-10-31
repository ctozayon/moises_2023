<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index.php" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="assets/images/logo-mosyni-principal.png" alt="" height="24">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo-mosyni-principal.png" alt="" height="24"> <span class="logo-txt">Mosýni</span>
                    </span>
                </a>

                <a href="index.php" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="assets/images/logo-mosyni-principal.png" alt="" height="24">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo-mosyni-principal.png" alt="" height="24"> <span class="logo-txt">Mosýni</span>
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

        </div>

        <div class="d-flex">
            <div class="dropdown d-none d-sm-inline-block">
                <button type="button" class="btn header-item" id="mode-setting-btn">
                    <i data-feather="moon" class="icon-lg layout-mode-dark"></i>
                    <i data-feather="sun" class="icon-lg layout-mode-light"></i>
                </button>
            </div>
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item topbar-light bg-light-subtle border-start border-end" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="assets/images/users/avatar-1.png" alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1 fw-medium"><?php echo $language["Shawn_L"]; ?>.</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <!-- <a class="dropdown-item" href="apps-contacts-profile.php"><i class="mdi mdi-face-man font-size-16 align-middle me-1"></i> <!?php echo $language["Profile"]; ?></a> -->
                    <!-- <a class="dropdown-item" href="auth-lock-screen.php"><i class="mdi mdi-lock font-size-16 align-middle me-1"></i> <!?php echo $language["Lock_screen"]; ?> </a> -->
                    <!-- <div class="dropdown-divider"></div> -->
                    <a class="dropdown-item" href="logout.php"><i class="mdi mdi-logout font-size-16 align-middle me-1"></i> <?php echo $language["Logout"]; ?></a>
                </div>
            </div>

        </div>
    </div>
</header>

<!-- ========== Left Sidebar Start ========== -->
<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu"><?php echo $language["Menu"]; ?></li>

                <li>
                    <a href="index.php">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard"><?php echo $language["Dashboard"]; ?></span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow" id="vertical-menu-btn">
                        <i data-feather="cloud-drizzle"></i>
                        <span data-key="t-apps"><?php echo $language["Extracao"]; ?></span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="javascript: void(0);" class="has-arrow" data-key="t-projetos"><?php echo $language["Projetos"]; ?></a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="form-cadastrar_projetos.php" data-key="t-cadastrarProjetos"><?php echo $language["Cadastrar_Projetos"]; ?></a></li>
                                <li><a href="exibir-projetos.php" data-key="t-exibirProjetos"><?php echo $language["Exibir_Projetos_Arquivos"]; ?></a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="form-wizard.php">
                                <span data-key="t-form-wizard">
                                    <?php echo $language["CargaDados"]; ?>
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->