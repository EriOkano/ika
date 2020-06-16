<!DOCTYPE html>
    <html lang="ja">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>IKA | 削除店舗一覧</title>
            <!-- Tell the browser to be responsive to screen width -->
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <!-- Font Awesome -->
            <link rel="stylesheet" href="<?= base_url(); ?>AdminLTE/plugins/fontawesome-free/css/all.min.css">
            <!-- Ionicons -->
            <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
            <!-- DataTables -->
            <link rel="stylesheet" href="<?= base_url(); ?>AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
            <!-- Sweet Alert Css -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
            <!-- Toastr -->
            <link rel="stylesheet" href="<?= base_url(); ?>AdminLTE/plugins/toastr/toastr.min.css">
            <!-- Theme style -->
            <link rel="stylesheet" href="<?= base_url(); ?>AdminLTE/dist/css/adminlte.min.css">
            <!-- Google Font: Source Sans Pro -->
            <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
            <!-- jQuery -->
            <script src="<?= base_url(); ?>AdminLTE/plugins/jquery/jquery.min.js"></script>
        </head>

        <body class="hold-transition layout-top-nav">
            <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
                <a ><img src="<?= base_url("img/ika2.png"); ?>"></a>
            <div class="container">
                    <div class="pl-sm-2">
                        <span class="brand-text font-weight-light">削除店舗管理ページ</span>
                    </div>
                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="master_page" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url(); ?>index.php/shop/mem_edit" class="nav-link">管理者情報編集</a>
                        </li>
                    </ul>
                </div>
                
                    <!-- Right navbar links -->
                    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                        <!-- SEARCH FORM -->
                        <form class="form-inline ml-0 ml-md-3">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                </div>
                            </div>
                        </form>
                        
                        <li class="nav-item">
                            <a href="<?= base_url() ?>index.php/log/logout" class="nav-link">ログアウト</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i class="fas fa-th-large"></i></a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- /.navbar -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>削除店舗管理ページ</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="master_page">管理者ページ</a></li>
                                <li class="breadcrumb-item active">削除店舗一覧</li>
                            </ol>
                        </div>
                    </div>
                            
                </div>
                <!-- /.container-fluid -->
                </section>
                    <div class="col-8 offset-sm-2">
                        <?php if(isset($_GET["flag"])){
                            if($_GET["flag"] == 1){ ?>
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h5><i class="icon fas fa-check"></i>店舗情報更新</h5>
                                        店舗の登録情報を更新しました。
                                </div>
                            <?php }elseif($_GET["flag"] == 100) {?>
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h5><i class="icon fas fa-ban"></i> エラー報告 </h5>
                                        処理に失敗しました。時間をおいて再実行いただくか、管理者までお知らせください。
                                </div>
                            <?php }; ?>
                        <?php }; ?>
                    </div>
                <!-- Main content -->
                <section class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-outline card-danger">
                            <div class="card-header">
                                <h3 class="card-title">削除店舗一覧</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>店舗ID</th>
                                                <th>店舗名</th>
                                                <th>フリガナ</th>
                                                <th>TEL</th>
                                                <th>メールアドレス</th>
                                                <th>メルマガ</th>
                                                <th>登録日</th>
                                                <th>更新日</th>
                                                <th>編集</th>
                                                <th>復活</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                foreach($all_data as $data){ ?>
                                                    <tr>
                                                    <?php foreach($data as $shop_key => $shop_data){ 
                                                        if($shop_key == "mem_shopid"){
                                                            $shop_id = $shop_data;
                                                        }
                                                        echo "<td>".$shop_data."</td>";
                                                        } ?>
                                                        <td>
                                                            <?= form_open("shop/master_edit") ?>
                                                                <button type="submit" class="btn btn-block btn-success btn-sm" 
                                                                name="mem_edit" value="<?= $shop_id; ?>">編集</button>
                                                            </form>
                                                        </td>
                                                        <td>
                                                        <?php $set = array('id' => $shop_id);?>
                                                            <?= form_open("shop/back",$set) ?>
                                                                <input type="hidden" name="back_reserv" value="<?= $shop_id; ?>">
                                                                <button type="button" class="btn btn-block btn-danger btn-sm" 
                                                                id="delete" onclick="reserv('<?= $shop_id; ?>')">復活</button>
                                                            </form>
                                                        </td>
                                                        </tr>
                                                <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>店舗ID</th>
                                                <th>店舗名</th>
                                                <th>フリガナ</th>
                                                <th>TEL</th>
                                                <th>メールアドレス</th>
                                                <th>メルマガ</th>
                                                <th>登録日</th>
                                                <th>更新日</th>
                                                <th>編集</th>
                                                <th>復活</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.0.3-pre
                </div>
                <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
                reserved.
            </footer>
            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
            </div>
            <!-- ./wrapper -->

            <!-- Bootstrap 4 -->
            <script src="<?= base_url(); ?>AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
            <!-- DataTables -->
            <script src="<?= base_url(); ?>AdminLTE/plugins/datatables/jquery.dataTables.js"></script>
            <script src="<?= base_url(); ?>AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
            <!-- AdminLTE App -->
            <script src="<?= base_url(); ?>AdminLTE/dist/js/adminlte.min.js"></script>
            <!-- AdminLTE for demo purposes -->
            <script src="<?= base_url(); ?>AdminLTE/dist/js/demo.js"></script>
            <!-- page script -->
            <script>
                $(function () {
                    $("#example1").DataTable({
                        "oLanguage": {
                            "sLengthMenu": "_MENU_ 件表示",
                            "oPaginate": {
                                "sNext": "次のページ",
                                "sPrevious": "前のページ"
                            },
                            "sInfo": "全_TOTAL_件中 _START_件から_END_件を表示",
                            "sInfoEmpty": " 0 件中 0 から 0 件を表示",
                            "sZeroRecords": "データはありません。",
                            "sInfoFiltered": "（全 _MAX_ 件より抽出）",
                            "sSearch": "検索：",
                            
                        },
                        "paging": true,
                        "lengthChange": true,
                        "searching": true,
                        "ordering": true,
                        "info": true,
                        "autoWidth": false,
                    });
                });

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });

                <?php if(isset($_GET["flag"])){
                    if($_GET["flag"] == 2){?>
                    $(document).Toasts('create', {
                        class: 'bg-success', 
                        title: '復活処理成功',
                        body: '指定の会員を削除アカウントから通常アカウントへ差し戻しました。'
                    });
                <?php }elseif($_GET["flag"] == 4) {?>
                    $(document).Toasts('create', {
                        class: 'bg-success', 
                        title: '顧客情報変更成功',
                        body: '顧客の登録情報編集に成功しました。</br>顧客情報一覧をご確認ください。'
                    });
                <?php }; ?>
            <?php }; ?>
                    function reserv(shop_id){
                            Swal.fire({
                                title: '登録削除申請',
                                text: "本当に復活させますか？",
                                icon: 'question',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                cancelButtonText: 'キャンセル',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.value) {
                                    $('#'+shop_id).submit();
                                }
                            });
                    }
            </script>
        </body>
</html>
