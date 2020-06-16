<!DOCTYPE html>
    <html lang="ja">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>IKA | 顧客登録</title>
            <!-- Tell the browser to be responsive to screen width -->
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <!-- Font Awesome -->
            <link rel="stylesheet" href="<?= base_url(); ?>AdminLTE/plugins/fontawesome-free/css/all.min.css">
            <!-- Ionicons -->
            <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
            <!-- DataTables -->
            <link rel="stylesheet" href="<?= base_url(); ?>AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
            <!-- daterange picker -->
            <link rel="stylesheet" href="<?= base_url(); ?>AdminLTE/plugins/daterangepicker/daterangepicker.css">
            <!-- iCheck for checkboxes and radio inputs -->
            <link rel="stylesheet" href="<?= base_url(); ?>AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
            <!-- Bootstrap Color Picker -->
            <link rel="stylesheet" href="<?= base_url(); ?>AdminLTE/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
            <!-- Tempusdominus Bbootstrap 4 -->
            <link rel="stylesheet" href="<?= base_url(); ?>AdminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
            <!-- Select2 -->
            <link rel="stylesheet" href="<?= base_url(); ?>AdminLTE/plugins/select2/css/select2.min.css">
            <link rel="stylesheet" href="<?= base_url(); ?>AdminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
            <!-- Bootstrap4 Duallistbox -->
            <link rel="stylesheet" href="<?= base_url(); ?>AdminLTE/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
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
                        <h1>顧客新規登録ページ</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>index.php/shop/shop_page">Home</a></li>
                        <li class="breadcrumb-item active">顧客新規登録</li>
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
                            <div class="card card-pink">
                            <div class="card-header">
                                <h3 class="card-title">顧客情報入力フォーム　：　登録店舗ID　</h3><?=$_SESSION["shop_id"]; ?>
                            </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <!-- <form role="form" id="quickForm"> -->
                                    <?php $set = array(
                                            'id' => "quickForm",
                                            'role' => "form"
                                        );
                                        echo form_open("customer/new_cus",$set)?>
                                            <div class="card-body">
                                            <div class="form-group">
                                                <label>氏名</label>
                                                <input type="text" name="cus_name" class="form-control"  placeholder="（例）田中　太郎">
                                            </div>
                                            <div class="form-group">
                                                <label>フリガナ</label>
                                                <input type="text" name="cus_kana" class="form-control" placeholder="（例）タナカ　タロウ">
                                            </div>
                                            <div class="form-group">
                                                <label>性　別</label>
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" type="radio" id="customRadio1" 
                                                    name="cus_gender" value=0 checked="">
                                                    <label for="customRadio1" class="custom-control-label">男性</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" type="radio" id="customRadio2" name="cus_gender" value=1>
                                                    <label for="customRadio2" class="custom-control-label">女性</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                            <label>生年月日</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="cus_birth"
                                                    data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask="" im-insert="false">
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                            <div class="form-group">
                                                <label>電話番号</label>
                                                <input type="tel" name="cus_tel" class="form-control" placeholder="（例）01234567890　　数字のみ">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email アドレス</label>
                                                <input type="email" name="cus_mail" class="form-control" id="exampleInputEmail1" placeholder="（例）sample@sample.com">
                                            </div>
                                            <div class="form-group mb-0">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="cus_maga" value=1 class="custom-control-input" id="exampleCheck2" checked="checked">
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
                                        <b><?= $_SESSION["shop_name"] ?></b>  に上記顧客情報を　　
                                        <button type="submit" name = "cus_edit" class="btn btn-primary">登録する</button>
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
                <div>ロゴは<a href="https://www.designevo.com/jp/logo-maker/" title="無料オンラインロゴメーカー">DesignEvo</a>よりロゴメーカーで制作・使用</div>
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
            <!-- Select2 -->
            <script src="<?= base_url(); ?>AdminLTE/plugins/select2/js/select2.full.min.js"></script>
            <!-- Bootstrap4 Duallistbox -->
            <script src="<?= base_url(); ?>AdminLTE/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
            <!-- InputMask -->
            <script src="<?= base_url(); ?>AdminLTE/plugins/moment/moment.min.js"></script>
            <script src="<?= base_url(); ?>AdminLTE/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
            <!-- date-range-picker -->
            <script src="<?= base_url(); ?>AdminLTE/plugins/daterangepicker/daterangepicker.js"></script>
            <!-- bootstrap color picker -->
            <script src="<?= base_url(); ?>AdminLTE/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
            <!-- Tempusdominus Bootstrap 4 -->
            <script src="<?= base_url(); ?>AdminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
            <!-- Bootstrap Switch -->
            <script src="<?= base_url(); ?>AdminLTE/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>

            <script type="text/javascript">
                $(function(){
                    $('#exampleInputPassword1').focusin(function(){
                        // console.log('フォーカスされました');
                        $(this).val("");
                    });
                });

                $(function(){
                    //Datemask dd/mm/yyyy
                    $('#datemask').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' })
                    //Datemask2 mm/dd/yyyy
                    $('#datemask2').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' })
                    //Money Euro
                    $('[data-mask]').inputmask()
                });

            $(document).ready(function () {
                $.validator.setDefaults({
                    submitHandler: function () {
                    form.submit();
                    }
            });
            
            //電話番号
            jQuery.validator.addMethod("tel",function(value, element) {
                    return this.optional(element) || /^(0[5-9]0[0-9]{8}|0[1-9][1-9][0-9]{7})$/.test(value.replace(/[━.*‐.*―.*－.*\-.*ー.*\-]/gi,''));
            });
            //カタカナ
            jQuery.validator.addMethod("katakana",function(value, element) {
                    return this.optional(element) ||/^([ァ-ン　]|ー)+$/.test(value);
            });

            $('#quickForm').validate({
                rules: {
                    cus_name: {
                        required: true
                    },
                    cus_kana: {
                        required: true,
                        katakana: true
                    },
                    cus_birth: {
                        required: true
                    },
                    cus_tel: {
                        required: true,
                        number: true
                    },
                    cus_mail: {
                        required: true,
                        email: true,
                    },
                    terms: {
                        required: true
                    }
                },
                messages: {
                    cus_name: {
                        required: "名前を入力してください"
                    },
                    cus_kana: {
                        required: "フリガナを入力してください",
                        katakana: "カタカナのみ有効です"
                    },
                    cus_birth: {
                        required: "生年月日を入力してください"
                    },
                    cus_tel: {
                        required: "電話番号を入力してください",
                        tel: "半角数字のみ有効です"
                    },
                    cus_mail: {
                        required: "メールアドレスを入力してください",
                        email: "有効なメールアドレスを入力してください"
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