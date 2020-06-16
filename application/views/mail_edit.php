<!DOCTYPE html>
    <html lang="ja">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <!-- Tell the browser to be responsive to screen width -->
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>IKA | メール編集ページ</title>
            <!-- Font Awesome -->
            <link rel="stylesheet" href="<?= base_url(); ?>AdminLTE/plugins/fontawesome-free/css/all.min.css">
            <!-- Ionicons -->
            <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
            <!-- Theme style -->
            <link rel="stylesheet" href="<?= base_url(); ?>AdminLTE/dist/css/adminlte.min.css">
            <!-- summernote -->
            <link rel="stylesheet" href="<?= base_url(); ?>AdminLTE/plugins/summernote/summernote-bs4.css">
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
                                <h1>メルマガ編集ページ</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url(); ?>index.php/shop/shop_page">Home</a></li>
                                <li class="breadcrumb-item active">メール</li>
                                </ol>
                            </div>
                            </div>
                        </div>
                        <!-- /.container-fluid -->
                    </section>

                    <!-- Main content -->
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-3">
                                    <a href="mailbox" class="btn btn-primary btn-block mb-3">メルマガ一覧</a>
                                    <?php $this->load->view("mail_navi_card"); ?>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-9">
                                    <div class="card card-primary card-outline">
                                        <div class="card-header">
                                            <h3 class="card-title">New Message</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <?php $set = array(
                                                'id' => "mail_form",
                                                'role' => "form",
                                                'enctype' => "multipart/form-data"
                                                ); ?>
                                        <?= form_open("mail/edit",$set); ?>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>タイトル</label>
                                                <input class="form-control" type="text" name="subject" value="<?=$data["mail_subject"]?>" placeholder="Subject:">
                                                <input type="hidden" name="mail_id" value="<?= $data["mail_id"] ?>">
                                            </div>
                                            <?php
                                                $date = explode(" ", $data["send_date"]);
                                                $time = explode(":",$date[1]);
                                            ?>
                                            <div class="form-group">
                                                <label>送信予定日時</label>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <input class="form-control" value="<?= $date[0] ?>" name="date" type="date">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <select class="custom-select" name="hour">
                                                            <?php
                                                                for($i=8; $i<=20; $i++){
                                                                    if($time[0] == $i){
                                                                        echo "<option value='".$i.":00' selected>" .$i. "：00</option>";
                                                                    }else{
                                                                        echo "<option value='".$i.":00'>" .$i. "：00</option>";
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>本　文</label>
                                                <textarea id="compose-textarea" name="text" class="form-control" style="height: 300px">
                                                <?= htmlspecialchars_decode($data['mail_text']); ?>
                                                </textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputFile"><i class="fas fa-paperclip"></i>添付ファイル</label>
                                                <p>※添付ファイル送付をご希望の場合、再度ファイルを選択してください。</p>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <div class="col-sm-6">
                                                            <!-- <input type="hidden" name="MAX_FILE_SIZE" value="2097152"> -->
                                                            <input type="hidden" name="old_file" value="<?= $data["mail_files"] ?>">
                                                            <input type="file" class="custom-file-input" name="upfile" id="exampleInputFile">
                                                            <label class="custom-file-label" for="exampleInputFile">
                                                                ファイルを選択してください
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                            <div class="card-footer">
                                                <div class="float-right">
                                                    <button type="button" class="btn btn-default" name="draft"><i class="fas fa-pencil-alt"></i> 下書き</button>
                                                    <button type="button" class="btn btn-primary" onclick="mail_send()" ><i class="far fa-envelope"></i> 登録</button>
                                                </div>
                                                <button type="reset" class="btn btn-default"><i class="fas fa-times"></i> リセット</button>
                                            </div>
                                        </form>
                                        <!-- /.card-footer -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->
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
            <!-- AdminLTE for demo purposes -->
            <script src="<?= base_url(); ?>AdminLTE/dist/js/demo.js"></script>
            <!-- bs-custom-file-input -->
            <script src="<?= base_url(); ?>AdminLTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
            <!-- Summernote -->
            <script src="<?= base_url(); ?>AdminLTE/plugins/summernote/summernote-bs4.min.js"></script>
            <!-- Sweet Alert Css -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
            <!-- Page Script -->
            <script>
            $(function () {
                //Add text editor
                $('#compose-textarea').summernote()
            })

            $(document).ready(function () {
                bsCustomFileInput.init();
            });
            function mail_send (){
                Swal.fire({
                    position: 'top-end',
                    title: '登録確認',
                    text: "このメールマガジンを配信予定に登録しますか？",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'キャンセル',
                    confirmButtonText: '予約する'
                }).then((result) => {
                    if (result.value) {
                        $('#mail_form').submit();
                    }
                });
            };
            </script>
        </body>
<html>