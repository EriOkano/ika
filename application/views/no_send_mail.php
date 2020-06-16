<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> IKA | Mailbox</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?= base_url(); ?>AdminLTE/plugins/fontawesome-free/css/all.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="<?= base_url(); ?>AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?= base_url(); ?>AdminLTE/dist/css/adminlte.min.css">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
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
                                <h1>送信予約メルマガ一覧</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url(); ?>index.php/shop/shop_page">Home</a></li>
                                <li class="breadcrumb-item active">メルマガ一覧</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->
                </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-3">
                        <a href="mail_page" class="btn btn-primary btn-block mb-3">メルマガ作成</a>
                        <?php $this->load->view("mail_navi_card"); ?>
                    </div>
                    <!-- /.col -->

                    <div class="col-md-9">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Inbox</h3>
                                <div class="card-tools">
                                    <?php 
                                        $set = array('id' => 'search_form');
                                    ?>
                                    <?= form_open("",$set) ?>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control" name="search" id="search" placeholder="Search Mail">
                                            <div class="input-group-append">
                                                <div class="btn btn-primary search">
                                                <i class="fas fa-search"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <div class="mailbox-controls">
                                    <!-- Check all button -->
                                    <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i>
                                    </button>
                                    <div class="btn-group">
                                        <button type="button" onclick="button_del()" class="btn btn-default btn-sm"><i class="far fa-trash-alt"></i></button>
                                    </div>
                                    <!-- /.btn-group -->
                                        <button type="button" class="btn btn-default btn-sm" onclick='location.href = "<?= base_url(); ?>index.php/mail/no_send_mail"'><i class="fas fa-sync-alt"></i></button>
                                    <div class="float-right">
                                    <?= $page_link; ?>
                                        <!-- /.btn-group -->
                                    </div>
                                    <!-- /.float-right -->
                                </div>
                                <div class="table-responsive mailbox-messages">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>タイトル</th>
                                                <th>送信予定・送信日</th>
                                                <th>状態</th>
                                                <th>編集</th>
                                                <th>削除</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- <td class="mailbox-star"><a href="#"><i class="fas fa-star text-warning"></i></a></td> -->
                                            <?php
                                            for($i=0; $i<count($datas); $i++){ ?>
                                            <tr>
                                                <td>
                                                    <div class="icheck-primary">
                                                    <?php $n = $i + 1 ;
                                                        $check = "check".$n ; 
                                                    ?>
                                                        <input type="checkbox" value="<?= $datas[$i]["mail_id"]?>" id="<?= $check ?>">
                                                        <label for="<?php echo $check;?>"></label>
                                                    </div>
                                                </td>
                                                <?php foreach($datas[$i] as $key => $value){
                                                    if($key == "mail_subject"){ ?>
                                                        <td class="mailbox-subject"><b><?= $value ?></b></td>
                                                    <?php }elseif($key == "flag"){ ?>
                                                        <td class="mailbox-sending"><b><?= $value ?></b></td>
                                                    <?php }elseif($key == "send_date"){?>
                                                        <td class="mailbox-date"><?= $value ?></td>
                                                    <?php } ?>
                                                <?php };?>

                                                <?php if($datas[$i]["flag"] === "未送信"){ ?>
                                                    <td>
                                                        <?= form_open("mail/edit_page") ?>
                                                            <button type="submit" class="btn btn-block btn-success btn-sm" 
                                                            name="mail_edit" value="<?= $datas[$i]["mail_id"]?>">編集</button>
                                                        </form>
                                                    </td>
                                                <?php }else{?>
                                                    <td>
                                                        <?= form_open("mail/read_box") ?>
                                                            <button type="submit" class="btn btn-block btn-info btn-sm" 
                                                            name="mail_read" value="<?= $datas[$i]["mail_id"]?>">読む</button>
                                                        </form>
                                                    </td>
                                                <?php }; ?> 
                                                    <td>
                                                    <?php 
                                                        $mail_key  = $datas[$i]["mail_id"];
                                                        $set = array('id' => $mail_key);
                                                    ?>
                                                        <?= form_open("mail/delete",$set) ?>
                                                            <input type="hidden" name="mail_delete" value="<?= $mail_key ?>">
                                                            <button type="button" class="btn btn-block btn-danger btn-sm" 
                                                            onclick="ccc('<?= $mail_key; ?>')">削除</button>
                                                        </form>
                                                    </td>
                                            </tr>
                                        <?php };
                                            if(empty($datas[0])){ ?>
                                                <tr id="noresults"><td colspan="6">キーワードに該当するメルマガが見つかりませんでした。</td>
                                            <?php }; ?>
                                        </tbody>
                                    </table>
                                    <!-- /.table -->
                                </div>
                                <!-- /.mail-box-messages -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer p-0">
                                <div class="mailbox-controls">
                                    <div class="float-right">
                                        <?= $page_link; ?>
                                        <!-- /.btn-group -->
                                    </div>
                                    <!-- /.float-right -->
                                </div>
                            </div>
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

        <!-- jQuery -->
        <script src="<?= base_url(); ?>AdminLTE/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="<?= base_url(); ?>AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="<?= base_url(); ?>AdminLTE/dist/js/adminlte.min.js"></script>
        <!-- Sweet Alert Css -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <!-- Toastr -->
        <link rel="stylesheet" href="<?= base_url(); ?>AdminLTE/plugins/toastr/toastr.min.css">
        <!-- AdminLTE for demo purposes -->
        <script src="<?= base_url(); ?>AdminLTE/dist/js/demo.js"></script>
        <!-- Page Script -->
        <script>
        $(function () {
            //Enable check and uncheck all functionality
            $('.checkbox-toggle').click(function () {
                var clicks = $(this).data('clicks')
                //チェック外したら
                if (clicks) {
                    //Uncheck all checkboxes
                    $('.mailbox-messages input[type=\'checkbox\']').prop('checked', false);
                    $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square');
                    var del_check = [];
                //チェックしたら
                } else {
                //Check all checkboxes
                    $('.mailbox-messages input[type=\'checkbox\']').prop('checked', true);
                    $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square');
                }
                //クリックしてもしなくても
                $(this).data('clicks', !clicks)
            });

            $('.search').click(function() {
                $('#search_form').submit();
            });
        });

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        <?php
            if(isset($_GET["flag"])){
                if($_GET["flag"] == 2){ ?>
                    $(document).Toasts('create', {
                        class: 'bg-danger', 
                        title: 'エラー',
                        body: '指定の処理が失敗しました。<br>再度時間をおいて実行してください。'
                    });
                <?php }elseif($_GET["flag"] == 1){ ?>
                    $(document).Toasts('create', {
                        class: 'bg-success', 
                        title: '成功！',
                        body: '指定の処理は成功しました'
                    });
            <?php }; ?>
            <?php }; ?>

        function ccc(deletedid){
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
                    $('#'+deletedid).submit();
                }
            });
        };

        function button_del(){
            if ($('input[type="checkbox"]:checked').length > 0) {
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
                            var del_check = [];
                            $('input[type="checkbox"]:checked').each(function() {
                                var ches = $(this).val();
                                del_check.push(ches);
                            });
                            var hostUrl= '<?= base_url(); ?>index.php/mail/some_dels';
                                $.ajax({
                                    url: hostUrl, // URLを指定
                                    type: "POST", // GET,POSTなどを指定
                                    data: { // データを指定
                                        'delete_ids' : del_check
                                        }
                                }).done(function(data) {
                                        if(data == "success"){
                                            location.href = "<?= base_url(); ?>index.php/mail/mailbox?flag=1";
                                        }else{
                                            location.href = "<?= base_url(); ?>index.php/mail/mailbox?flag=2";
                                        }
                                }).fail(function(data) {
                                    // 通信失敗時の処理
                                    location.href = "<?= base_url(); ?>index.php/mail/mailbox?flag=2";
                                });
                        }
                });
            }else{
                alert("選択されていません");
            }
        };
        </script>
    </body>
</html>