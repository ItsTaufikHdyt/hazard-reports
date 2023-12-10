<!DOCTYPE html>
<html lang="en">
<?= $this->include('vendor/admin/partials/htmlheader') ?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">


        <!-- Preloader -->
        <?= $this->include('vendor/admin/partials/preloader') ?>
        <!-- Navbar -->
        <?= $this->include('vendor/admin/partials/navbar') ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?= $this->include('vendor/admin/partials/sidebar') ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"> <?= $this->renderSection('h1') ?></h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#"> <?= $this->renderSection('h2') ?></a></li>
                                <li class="breadcrumb-item active"> <?= $this->renderSection('h3') ?></li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                    <?= $this->renderSection('content') ?>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <?= $this->include('vendor/admin/partials/footer') ?>
        <!-- Control Sidebar -->
        <?= $this->include('vendor/admin/partials/control_sidebar') ?>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- scripts -->
    <?= $this->include('vendor/admin/partials/scripts') ?>
    <?= $this->renderSection('custom_scipts') ?>
</body>

</html>