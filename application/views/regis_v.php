<!DOCTYPE html>
    <html lang="ja">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">

            <!-- Font Awesome -->
            <link rel="stylesheet" href="<?=base_url(); ?>AdminLTE/plugins/fontawesome-free/css/all.min.css">
            <!-- Ionicons -->
            <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
            <!-- SweetAlert2 -->
            <!-- <link rel="stylesheet" href="<?=base_url(); ?>AdminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css"> -->
            <!-- Sweet Alert Css -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
            <!-- Toastr -->
            <link rel="stylesheet" href="<?=base_url(); ?>AdminLTE/plugins/toastr/toastr.min.css">
            <!-- Theme style -->
            <link rel="stylesheet" href="<?=base_url(); ?>AdminLTE/dist/css/adminlte.min.css">
            <!-- Google Font: Source Sans Pro -->
            <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

            <title>IKA | 新規店舗登録</title>
        </head>

        <body class="hold-transition register-page">
            
                <div class="register-logo">
                    新規店舗登録
                </div>
                <div class="register-box">

            <div class="card">
                <div class="card-body register-card-body">
                    <p class="login-box-msg">以下の情報を入力してください</p>
                    <!-- <form action="<?=base_url(); ?>AdminLTE/index.html" method="post"> -->
                    <?php $set = array(
                        'id' => "quickForm",
                        'role' => "form"
                        );?>
                    <?= form_open("log/entry",$set); ?>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="s_name" placeholder="Shop name">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-store"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="s_kana" placeholder="Shop name（フリガナ）">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-store"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="tel" class="form-control" name="s_tel" placeholder="電話番号（半角数字のみ）">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-phone"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" name="s_mail" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" name="s_pass" min="5" id="pass" placeholder="パスワード">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" name="re_pass" id="re_pass" min="5" placeholder="パスワード（確認）">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                    <div class="icheck-primary">
                                        <input type="checkbox" name="s_maga" value=1>
                                        <label for="magazine">
                                            メールマガジン配信希望
                                        </label>
                                    </div>
                                </div>
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                    <label for="agreeTerms">
                                        <a href="#">利用規約</a>に同意します
                                    </label>
                                </div>
                            </div>
                    <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">登録</button>
                        </div>
                    <!-- /.col -->
                </div>
            </form>

                <a href="<?= base_url(); ?>" class="text-center">登録済みの方はこちらへ</a>
                </div>
                <!-- /.form-box -->
            </div><!-- /.card -->
            </div>
            <!-- /.register-box -->
            
        <!-- jQuery -->
        <script src="<?=base_url(); ?>AdminLTE/plugins/jquery/jquery.min.js"></script>
        <!-- jQueryのversionによる脆弱性対策 -->
            <script>
                jQuery.ajaxPrefilter( function( s ) {
                    if ( s.crossDomain ) { s.contents.script = false; }
                } );
            </script>
        <!-- jquery-validation -->
        <script src="<?= base_url(); ?>AdminLTE/plugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="<?= base_url(); ?>AdminLTE/plugins/jquery-validation/additional-methods.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="<?=base_url(); ?>AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- bs-custom-file-input -->
        <script src="<?=base_url(); ?>AdminLTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
        <!-- AdminLTE App -->
        <script src="<?=base_url(); ?>AdminLTE/dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?=base_url(); ?>AdminLTE/dist/js/demo.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                bsCustomFileInput.init();
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
                    re_pass: {
                        // required: true,
                        equalTo: "#pass"
                    },
                    terms: {
                        required: true
                    }
                },
                messages: {
                    s_name: {
                        required: "名前を入力してください"
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
                    re_pass: {
                        // required: "パスワードを入力してください",
                        equalTo: "パスワードが一致しません"
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
            <?php if(isset($_GET["flag"])){
                if($_GET["flag"] == 1){ ?>
                <script>
                    $(function() {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        Toast.fire({
                            icon: 'error',
                            title: 'このメールアドレスはすでに利用されています',
                            timer: 3000
                        })
                    });
                </script>
                <?php }; 
            };?>
        </body>
    </html>