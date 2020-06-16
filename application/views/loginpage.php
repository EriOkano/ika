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
            <!-- Sweet Alert Css -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
            <!-- Toastr -->
            <link rel="stylesheet" href="<?=base_url(); ?>AdminLTE/plugins/toastr/toastr.min.css">
            <!-- Theme style -->
            <link rel="stylesheet" href="<?=base_url(); ?>AdminLTE/dist/css/adminlte.min.css">
            <!-- Google Font: Source Sans Pro -->
            <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

            <title>IKA | ログイン</title>
        </head>
        <body class="hold-transition login-page">
            <div class="login-box">
                <div class="login-logo">
                    <a><img src="<?= base_url("img/ika3.png"); ?>"></a>
                </div>
                <!-- /.login-logo -->
                <div class="card">
                    <div class="card-body login-card-body">
                        <p class="login-box-msg">はいらなイカ？</p>
                        <!-- <form action="<?=base_url(); ?>AdminLTE/index3.html" method="post"> -->
                        <!-- <?= form_open("") ?> -->
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" id="mail" placeholder="Email">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" id="pass" placeholder="Password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <!-- <div class="icheck-primary">
                                        <input type="checkbox" id="remember">
                                        <label for="remember">
                                            Remember Me
                                        </label>
                                    </div> -->
                                </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block" id="submit">Go Shop!</button>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- </form> -->
                        <!-- /.social-auth-links -->

                        <p class="mb-1">
                            <a href="index.php/log/forgot">I forgot my password</a>
                        </p>
                        <p class="mb-0">
                            <a href="<?= base_url(); ?>index.php/log/regis" class="text-center">新規店舗登録</a>
                        </p>
                    </div>
                    <!-- /.login-card-body -->
                </div>
            </div>
            <!-- /.login-box -->

            <!-- jQuery -->
            <script src="<?=base_url(); ?>AdminLTE/plugins/jquery/jquery.min.js"></script>
            <!-- jQueryのversionによる脆弱性対策 -->
                <script>
                    jQuery.ajaxPrefilter( function( s ) {
                        if ( s.crossDomain ) { s.contents.script = false; }
                    } );

                    $(document).keypress(function(e){
                        if(e.keyCode === 13) {
                            $("#submit").trigger('click');
                        }
                    });

                $(function(){
                    $("#submit").click(function(){ 
                        var hostUrl= '<?= base_url(); ?>index.php/log/login';
                        $.ajax({
                            url: hostUrl, // URLを指定
                            type: "POST", // GET,POSTなどを指定
                            data: { // データを指定
                                'logmail' : $('#mail').val(),
                                'logpass' : $('#pass').val()
                            }
                    }).done(function(data) {
                        if(data == 1){
                            Swal.fire({
                                title: 'ログイン成功',
                                icon: 'success',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.value) {
                                    location.href = "<?= base_url(); ?>index.php/shop/shop_page";
                                }
                            });
                        }else if(data == 100){
                            Swal.fire({
                                title: 'ログイン成功',
                                text: '管理者ページに移動します。',
                                icon: 'success',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.value) {
                                    location.href = "<?= base_url(); ?>index.php/shop/master_page";
                                }
                            });
                        }else if(data == 2){
                            alert("メールアドレス、もしくはパスワードが間違っています");
                        }
                    }).fail(function(data) {
                        alert("通信失敗");
                    });
                })
            });
            </script>

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
            });
            
            </script>

        </body>
    </html>