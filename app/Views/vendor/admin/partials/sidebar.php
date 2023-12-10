<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="<?= base_url('admin/dist/img/AdminLTELogo.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('admin/dist/img/user2-160x160.jpg') ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <?php if (session('logged_in') == true &&  session()->get('role') == 2) : ?>
                    <li class="nav-header">Hazard Report</li>
                    <li class="nav-item">
                        <a href="<?= url_to('userHazard') ?>" class="nav-link">
                            <i class="nav-icon fas fa-exclamation-triangle"></i>
                            <p>Report</p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (session('logged_in') == true &&  session()->get('role') == 1) : ?>
                    <li class="nav-header">Hazard Report</li>
                    <li class="nav-item">
                        <a href="<?= url_to('adminHazard') ?>" class="nav-link">
                            <i class="nav-icon fas fa-exclamation-triangle"></i>
                            <p>Report</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <form action="<?= url_to('exportHazardExcel') ?>" method="POST">
                            <button type="submit">Download Laporan</button>
                        </form>
                    </li>
                    <li class="nav-header">User</li>
                    <li class="nav-item">
                        <a href="<?= url_to('adminUser') ?>" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>Data User</p>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>