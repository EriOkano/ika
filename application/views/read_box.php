<!DOCTYPE html>
<html lang="ja">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>IKA | READ</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>AdminLTE/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>AdminLTE/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    </head>

    <body class="hold-transition layout-top-nav">
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
                <a><img src="<?= base_url("img/ika2.png"); ?>"></a>
                <div class="container">
                    <div class="pl-sm-2">
                        <span class="brand-text font-weight-light">送信後メルマガ確認</span>
                    </div>
                    <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                        <!-- Left navbar links -->
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="<?= base_url(); ?>index.php/shop/shop_page" class="nav-link">Home</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url(); ?>index.php/shop/mem_edit" class="nav-link">店舗情報編集</a>
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
                                <!-- <h1>送信メール一覧</h1> -->
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url(); ?>index.php/shop/shop_page">Home</a></li>
                                <li class="breadcrumb-item active">メルマガ確認</li>
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
                                    <h3 class="card-title">Read Mail</h3>

                                    <div class="card-tools">
                                        <a href="#" class="btn btn-tool" data-toggle="tooltip" title="Previous"><i class="fas fa-chevron-left"></i></a>
                                        <a href="#" class="btn btn-tool" data-toggle="tooltip" title="Next"><i class="fas fa-chevron-right"></i></a>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <div class="mailbox-read-info">
                                        <h5><?= $data["mail_subject"]; ?></h5>
                                        <h6>
                                        <span class="mailbox-read-time float-right"><?= $data["send_date"]; ?></span></h6>
                                    </div>
                                    <!-- /.mailbox-read-info -->
                                    <div class="mailbox-controls with-border text-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Delete">
                                                <i class="far fa-trash-alt"></i></button>
                                            <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Reply">
                                                <i class="fas fa-reply"></i></button>
                                            <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Forward">
                                                <i class="fas fa-share"></i></button>
                                        </div>
                                        <!-- /.btn-group -->
                                        <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Print">
                                        <i class="fas fa-print"></i></button>
                                    </div>
                                    <!-- /.mailbox-controls -->
                                    <div class="mailbox-read-message">
                                        <p><?= htmlspecialchars_decode($data["mail_text"]); ?></p>
                                    </div>
                                    <!-- /.mailbox-read-message -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer bg-white">
                                    <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                                        <!-- <li>
                                        <span class="mailbox-attachment-icon"><i class="far fa-file-pdf"></i></span>
                                        <div class="mailbox-attachment-info">
                                            <a href="#" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> Sep2014-report.pdf</a>
                                                <span class="mailbox-attachment-size clearfix mt-1">
                                                <span>1,245 KB</span>
                                                <a href="#" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                                                </span>
                                        </div>
                                        </li>
                                        <li> -->

                                        <!-- <span class="mailbox-attachment-icon"><i class="far fa-file-word"></i></span>
                                        <div class="mailbox-attachment-info">
                                            <a href="#" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> App Description.docx</a>
                                                <span class="mailbox-attachment-size clearfix mt-1">
                                                <span>1,245 KB</span>
                                                <a href="#" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                                                </span>
                                        </div>
                                        </li> -->
                                        
                                        <?php 
                                        if($data["mail_files"] != NULL){
                                            $file_name = base_url("attachment/").$data["mail_files"]; ?>
                                            <li>
                                            <span class="mailbox-attachment-icon has-img"><img src="<?= $file_name ?>" alt="Attachment"></span>
                                                <!-- <div class="mailbox-attachment-info">
                                                    <a href="#" class="mailbox-attachment-name"><i class="fas fa-camera"></i> photo1.png</a>
                                                        <span class="mailbox-attachment-size clearfix mt-1">
                                                            <?php $imagesize = filesize($file_name); ?>
                                                            <span>
                                                            <?php var_dump($imagesize); ?>
                                                            </span>
                                                        <a href="#" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                                                        </span>
                                                </div> -->
                                            </li>
                                        <?php } ?>
                                        <!-- <li>
                                        <span class="mailbox-attachment-icon has-img"><img src="<?= base_url(); ?>AdminLTE/dist/img/photo2.png" alt="Attachment"></span>
                                        <div class="mailbox-attachment-info">
                                            <a href="#" class="mailbox-attachment-name"><i class="fas fa-camera"></i> photo2.png</a>
                                                <span class="mailbox-attachment-size clearfix mt-1">
                                                <span>1.9 MB</span>
                                                <a href="#" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                                                </span>
                                        </div>
                                        </li> -->
                                    </ul>
                                </div>
                                <!-- /.card-footer -->
                                <div class="card-footer">
                                    <!-- <div class="float-right">
                                        <button type="button" class="btn btn-default"><i class="fas fa-reply"></i> Reply</button>
                                        <button type="button" class="btn btn-default"><i class="fas fa-share"></i> Forward</button>
                                    </div> -->
                                    <!-- <button type="button" class="btn btn-default"><i class="far fa-trash-alt"></i> Delete</button> -->
                                    <?php 
                                        $mail_key  = $data["mail_id"];
                                        $set = array('id' => $mail_key);
                                    ?>
                                            <?= form_open("mail/delete",$set) ?>
                                                <input type="hidden" name="mail_delete" value="<?= $mail_key ?>">
                                                <button type="button" class="btn btn-default" 
                                                id = "del_button" onclick="ccc()"><i class="far fa-trash-alt"></i>削除</button>
                                            </form>
                                        </td>
                                    <!-- </tr> -->
                                    <!-- <button type="button" class="btn btn-default"><i class="fas fa-print"></i> Print</button> -->
                                </div>
                                <!-- /.card-footer -->
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
            <!-- AdminLTE for demo purposes -->
            <script src="<?= base_url(); ?>AdminLTE/dist/js/demo.js"></script>
            <!-- Sweet Alert Css -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
            <!-- Toastr -->
            <link rel="stylesheet" href="<?= base_url(); ?>AdminLTE/plugins/toastr/toastr.min.css">
            <script>
                function ccc(){
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
                                $('form').submit();
                            }
                        });
                    }
            </script>
    </body>
</html>
