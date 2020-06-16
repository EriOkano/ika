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
                                <div class="col-6">
                                    <h1>登録店舗情報変更</h1>
                                </div>
                                <div class="col-6">
                                    <ol class="breadcrumb float-sm-right">
                                    <?php if($_SESSION["master"] == 1){?>
                                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>index.php/shop/master_page">Home</a></li>
                                    <?php }else{ ?>
                                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>index.php/shop/shop_page">Home</a></li>
                                    <?php }; ?>
                                    <li class="breadcrumb-item active">登録情報変更</li>
                                    </ol>
                                </div>
                            </div>
                        </div><!-- /.container-fluid -->
                    </section>

                    <!-- Main content -->
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <!-- left column -->
                                <div class="col-12">
                                    <!-- jquery validation -->
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">登録情報変更フォーム</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <!-- form start -->
                                        <!-- <form role="form" id="quickForm"> -->
                                            <?php $set = array(
                                                    'id' => "quickForm",
                                                    'role' => "form"
                                                );
                                                echo form_open("shop/do_edit",$set)?>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label>店舗名</label>
                                                        <input type="text" name="s_name" class="form-control" value="<?= $mem_info["mem_name"] ?>" placeholder="（例）株式会社　サンプル">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>フリガナ</label>
                                                        <input type="text" name="s_kana" class="form-control" value="<?= $mem_info["mem_kana"] ?>" placeholder="（例）カブシキガイシャ　サンプル">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>電話番号</label>
                                                        <input type="tel" name="s_tel" class="form-control" value="<?= $mem_info["mem_tel"] ?>" placeholder="（例）01234567890　　数字のみ">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Email アドレス</label>
                                                        <input type="email" name="s_mail" class="form-control" value="<?= $mem_info["mem_mail"] ?>" id="exampleInputEmail1" placeholder="（例）sample@sample.com">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">パスワード</label>
                                                        <input type="password" name="s_pass" class="form-control" id="exampleInputPassword1" 
                                                        placeholder="５文字以上の英数字のみ" autocomplete="off">
                                                    </div>
                                                    <div class="form-group mb-0">
                                                        <div class="custom-control custom-checkbox">
                                                        <?php if($mem_info["mem_magazine"] == "1"){ ?>
                                                            <input type="checkbox" name="s_maga" value=1 class="custom-control-input" id="exampleCheck2" checked="checked">
                                                        <?php }else{ ?> 
                                                            <input type="checkbox" name="s_maga" value=1 class="custom-control-input" id="exampleCheck2">
                                                        <?php }; ?>
                                                            <label class="custom-control-label" for="exampleCheck2">メールマガジン配信</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-0">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                                                            <label class="custom-control-label" for="exampleCheck1"><a href="#">会員規約</a>に同意します</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.card-body -->
                                                <div class="card-footer">
                                                    <input type="hidden" name="shop_id" value="<?= $mem_info["mem_shopid"] ?>">
                                                    <button type="submit" name = "mem_edit" class="btn btn-primary">変更</button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                <!--/.col (left) -->
                                <!--/.col (right) -->
                            </div>
                            <!-- /.row -->
                        </div><!-- /.container-fluid -->
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
            <!-- jquery-validation -->
            <script src="<?= base_url(); ?>AdminLTE/plugins/jquery-validation/jquery.validate.min.js"></script>
            <script src="<?= base_url(); ?>AdminLTE/plugins/jquery-validation/additional-methods.min.js"></script>
            <!-- AdminLTE App -->
            <script src="<?= base_url(); ?>AdminLTE/dist/js/adminlte.min.js"></script>
            <!-- AdminLTE for demo purposes -->
            <script src="<?= base_url(); ?>AdminLTE/dist/js/demo.js"></script>
            <script type="text/javascript">
                $(function(){
                    $('#exampleInputPassword1').focusin(function(){
                        // console.log('フォーカスされました');
                        $(this).val("");
                    });
                });

            $(document).ready(function () {
                $.validator.setDefaults({
                    submitHandler: function () {
                        // alert( "未入力の欄が残っています" );
                        form.submit();
                    }
            });
            
            //電話番号
            jQuery.validator.addMethod("tel",function(value, element) {
                    return this.optional(element) || /^(0[5-9]0[0-9]{8}|0[1-9][1-9][0-9]{7})$/.test(value.replace(/[━.*‐.*―.*－.*\-.*ー.*\-]/gi,''));
            });
            //カタカナ
            jQuery.validator.addMethod("katakana",function(value, element) {
                    return this.optional(element) ||/^([ァ-ン]|ー)+$/.test(value);
            });

            $('#quickForm').validate({
                rules: {
                    s_name: {
                        required: true
                    },
                    s_kana: {
                        required: true,
                        katakana: true
                    },
                    s_tel: {
                        required: true,
                        number: true
                    },
                    s_mail: {
                        required: true,
                        email: true,
                    },
                    s_pass: {
                        required: true,
                        minlength: 5
                    },
                    terms: {
                        required: true
                    }
                },
                messages: {
                    s_name: {
                        required: "店舗名を入力してください"
                    },
                    s_kana: {
                        required: "フリガナを入力してください",
                        katakana: "カタカナのみ有効です"
                    },
                    s_tel: {
                        required: "電話番号を入力してください",
                        tel: "半角数字のみ有効です"
                    },
                    s_mail: {
                        required: "メールアドレスを入力してください",
                        email: "有効なメールアドレスを入力してください"
                    },
                    s_pass: {
                        required: "パスワードを入力してください",
                        minlength: "5文字以上の英数字を入力してください"
                    },
                    terms: "本サービスのご提供に関しては、会員規約の同意が必須です。"
                },
                    errorElement: 'span',
                    errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                    },
                    highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                    },
                    unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                    }
                });
            });
            </script>
        </body>
<html>