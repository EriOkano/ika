<!DOCTYPE html>
    <html lang="ja">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>IKA | 顧客管理</title>
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
                <?php $this->load->view("shop-navi"); ?>

                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <section class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1><?= $_SESSION["shop_name"]; ?></h1>
                                </div>
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="">Home</a></li>
                                        <li class="breadcrumb-item active">Home</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <!-- /.container-fluid -->
                    </section>

                    <div class="col-sm-8 offset-sm-2">
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
                                <?php }elseif($_GET["flag"] == "first") {?>
                                    <div class="callout callout-success">
                                        <h5>顧客管理システム　IKA　へようこそ！！</h5>
                                        <p>会員登録に成功しました。このページは顧客情報管理ページです。</p>
                                    </div>
                            <?php }; ?>
                        <?php }; ?>
                    </div>
                        
                    <!-- Main content -->
                    <section class="content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card card-outline card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">店舗情報</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="example2" class="table table-bordered text-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>店舗ID</th>
                                                        <th>店舗名</th>
                                                        <th>店舗名（フリガナ）</th>
                                                        <th>登録電話番号</th>
                                                        <th>登録メールアドレス</th>
                                                        <th>メルマガ配信</th>
                                                        <th>開始日</th>
                                                        <th>編集</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <?php
                                                            foreach($shop as $key => $value){
                                                                    echo "<td>".$value."</td>";
                                                        }?>
                                                        <td> 
                                                            <button type='button' class='btn btn-block btn-success btn-sm' 
                                                            onclick="location.href='<?= base_url(); ?>index.php/shop/mem_edit'">編集</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
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
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card card-outline card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">顧客情報一覧</h3>
                                            <div class="float-sm-right">
                                                <div class="btn-group">
                                                    <button type="button" class="btn bg-gradient-info"
                                                    onclick="location.href='<?=base_url(); ?>index.php/mail/mailbox'">メルマガ</button>
                                                    <button type="button" class="btn bg-gradient-danger" 
                                                    onclick="location.href='<?=base_url(); ?>index.php/customer/cus_regis'">新規登録</button>
                                                    <button type="button" class="btn bg-gradient-secondary" onclick="location.href='<?=base_url();?>index.php/customer/csv'">download</button>
                                                </div>
                                            </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="example1" class="table table-bordered table-striped text-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>顧客番号</th>
                                                        <th>氏名</th>
                                                        <th>氏名（カナ）</th>
                                                        <th>性別</th>
                                                        <th>生年月日</th>
                                                        <th>電話番号</th>
                                                        <th>メールアドレス</th>
                                                        <th>メルマガ</th>
                                                        <th>登録日</th>
                                                        <th>編集</th>
                                                        <th>削除</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(is_array($cus)){
                                                        foreach($cus as $cus_datas){ ?>
                                                            <tr>
                                                            <?php foreach($cus_datas as $c_key => $c_datas){ 
                                                                if($c_key == "cus_id"){
                                                                    $cus_key = $c_datas;
                                                                }
                                                                echo "<td>".$c_datas."</td>";
                                                                } ?>
                                                                <td>
                                                                    <?= form_open("customer/edit") ?>
                                                                        <button type="submit" class="btn btn-block btn-success btn-sm" name="c_edit" value="<?= $cus_key; ?>">編集</button>
                                                                    </form>
                                                                </td>
                                                                <td>
                                                                <?php $set = array('id' => $cus_key);?>
                                                                    <?= form_open("customer/delete",$set) ?>
                                                                        <input type="hidden" name="c_delete" value="<?= $cus_key; ?>">
                                                                        <button type="button" class="btn btn-block btn-danger btn-sm" 
                                                                        onclick="deletes('<?= $cus_key; ?>')">削除</button>
                                                                    </form>
                                                                </td>
                                                                </tr>
                                                        <?php } ?>
                                                    <?php }else{ ?>
                                                        <tr>
                                                            <?php 
                                                                for($i=0; $i<10; $i++){
                                                                    echo "<td>nothing</td>";
                                                                };
                                                            ?>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>顧客番号</th>
                                                        <th>氏名</th>
                                                        <th>氏名（カナ）</th>
                                                        <th>性別</th>
                                                        <th>生年月日</th>
                                                        <th>電話番号</th>
                                                        <th>メールアドレス</th>
                                                        <th>メルマガ</th>
                                                        <th>登録日</th>
                                                        <th>編集</th>
                                                        <th>削除</th>
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
                    $('#example2').DataTable({
                    "paging": false,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": false,
                    "info": false,
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
                        title: '登録会員情報削除成功',
                        body: '指定の会員を削除しました。'
                    });
                <?php }elseif($_GET["flag"] == 3) {?>
                    $(document).Toasts('create', {
                        class: 'bg-info', 
                        title: '顧客新規登録成功',
                        body: '顧客の新規登録に成功しました。</br>顧客情報一覧をご確認ください。'
                    });
                <?php }elseif($_GET["flag"] == 4) {?>
                    $(document).Toasts('create', {
                        class: 'bg-success', 
                        title: '顧客情報変更成功',
                        body: '顧客の登録情報編集に成功しました。</br>顧客情報一覧をご確認ください。'
                    });
                <?php }; ?>
            <?php }; ?>
                    function deletes(deleteid){
                            Swal.fire({
                                title: '登録削除申請',
                                text: "本当に削除しますか",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                cancelButtonText: 'キャンセル',
                                confirmButtonText: 'はい、削除します'
                            }).then((result) => {
                                if (result.value) {
                                    $('#'+deleteid).submit();
                                }
                            });
                    }
            </script>
        </body>
</html>