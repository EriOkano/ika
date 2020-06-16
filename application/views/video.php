<!DOCTYPE html>
    <html lang="ja">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>IKA | VIDEO</title>
            <!-- Tell the browser to be responsive to screen width -->
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <!-- Font Awesome -->
            <link rel="stylesheet" href="<?= base_url(); ?>AdminLTE/plugins/fontawesome-free/css/all.min.css">
            <!-- Ionicons -->
            <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
            <!-- Sweet Alert Css -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
            <!-- Toastr -->
            <link rel="stylesheet" href="<?= base_url(); ?>AdminLTE/plugins/toastr/toastr.min.css">
            <!-- Theme style -->
            <link rel="stylesheet" href="<?= base_url(); ?>AdminLTE/dist/css/adminlte.min.css">
            <!-- Google Font: Source Sans Pro -->
            <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
            <!-- SkyWay CDN -->
            <script src="https://cdn.webrtc.ecl.ntt.com/skyway-latest.js"></script>
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
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">ID</label>
                                        <div class="col-4">
                                            <input type="text" class="form-control" id="my-id" disabled>
                                        </div>
                                        <div class="col-3">
                                            <button type="button"  class="btn btn-block bg-gradient-info"><i class="far fa-envelope"></i>　IDを送信</button>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-2 col-form-label">相手のID</label>
                                        <div class="col-4">
                                            <input type="text" class="form-control" id="their-id" placeholder="IDを入力してください">
                                        </div>
                                        <div class="col-3">
                                            <button type="button" id="make-call" class="btn btn-block bg-gradient-success"><i class="fas fa-video"></i>　通話を開始</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="col-6 mb-4">
                                        <button type="button" id="end-call" class="btn btn-block bg-gradient-danger"><i class="fas fa-video-slash"></i>　通話を終了</button>
                                    </div>
                                    <div class="col-6">
                                        <h3 id="clockarea">--:--</h3>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="">Home</a></li>
                                        <li class="breadcrumb-item active">Home</li>
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
                                <div class="col-md-8">
                                    <!-- Box Comment -->
                                    <div class="card card-widget">
                                        <div class="card-header">
                                            <div class="user-block">
                                            </div>
                                            <!-- /.user-block -->
                                            <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Mark as read">
                                                <i class="far fa-circle"></i></button>
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                                            </button>
                                            </div>
                                            <!-- /.card-tools -->
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <!-- video領域 -->
                                            <video id="their-video" width="600px" height="480px" autoplay muted playsinline></video>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <!-- /.col -->
                                <!-- ----------------------------------------------------------------------------------------------------------------- -->
                                <div class="col-md-4">
                                    <!-- Box Comment -->
                                    <div class="card card-widget">
                                        <div class="card-header">
                                            <div class="user-block">
                                            </div>
                                            <!-- /.user-block -->
                                            <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Mark as read">
                                                <i class="far fa-circle"></i></button>
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                                            </button>
                                            </div>
                                            <!-- /.card-tools -->
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <!-- video領域 -->
                                            <video id="my-video" width="350px" autoplay muted playsinline></video>
                                        </div>
                                        <div class="card-footer">
                                            <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i> Share</button>
                                            <button type="button" class="btn btn-default btn-sm"><i class="far fa-thumbs-up"></i> Like</button>
                                        </div>
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </section>
                </div>
                <footer class="main-footer">
                    <div class="float-right d-none d-sm-block">
                        <b>Version</b> 3.0.3-pre
                    </div>
                    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
                    reserved.
                </footer>
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

            <script type = "text/javascript">

                let localStream;
                // カメラ映像取得
                navigator.mediaDevices.getUserMedia({video: true, audio: true})
                .then( stream => {
                    // 成功時にvideo要素にカメラ映像をセットし、再生
                    const videoElm = document.getElementById('my-video')
                    videoElm.srcObject = stream;
                    videoElm.play();
                    // 着信時に相手にカメラ映像を返せるように、グローバル変数に保存しておく
                    localStream = stream;
                }).catch( error => {
                    // 失敗時にはエラーログを出力
                    alert("b");
                    console.error('mediaDevice.getUserMedia() error:', error);
                    return;
                });

                const peer = new Peer({
                    key: '9c4de85f-b3d1-4a2f-81e2-132552786d83',
                    debug: 3
                });
                peer.on('open', () => {
                    // document.getElementById('my-id').textContent = peer.id;
                    document.getElementById( "my-id" ).value = peer.id;
                });

                // 発信処理
                document.getElementById('make-call').onclick = () => {
                    const theirID = document.getElementById('their-id').value;
                    const mediaConnection = peer.call(theirID, localStream);
                    setEventListener(mediaConnection);
                };

                // イベントリスナを設置する関数
                const setEventListener = mediaConnection => {
                    mediaConnection.on('stream', stream => {
                        // video要素にカメラ映像をセットして再生
                        const videoElm = document.getElementById('their-video')
                        videoElm.srcObject = stream;
                        videoElm.play();
                    });
                };

                //着信処理
                peer.on('call', mediaConnection => {
                    mediaConnection.answer(localStream);
                    setEventListener(mediaConnection);
                });

                    //エラー
                peer.on('error', err => {
                    alert("お繋ぎできませんでした。");
                });

                peer.on('close', () => {
                    alert('通信が切断しました。');
                });

                $('#end-call').click(function(){
                    alert('通信を切断しました。');
                });
                // --------------------------------------------------------------------------- //
                function set2fig(num) {
                    // 桁数が1桁だったら先頭に0を加えて2桁に調整する
                    var ret;
                    if( num < 10 ) { 
                        ret = "0" + num; 
                    }else { 
                        ret = num; 
                    }
                    return ret;
                }
                    function showClock() {
                    var nowTime = new Date();
                    var nowHour = set2fig( nowTime.getHours() );
                    var nowMin  = set2fig( nowTime.getMinutes() );
                    var nowSec  = set2fig( nowTime.getSeconds() );
                    var msg = nowHour + ":" + nowMin + ":" + nowSec ;
                    document.getElementById("clockarea").innerHTML = msg;
                }
                setInterval('showClock()',1000);
            </script>
        </body>
    </html>