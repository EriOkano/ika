<!DOCTYPE html>
    <html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>IKA | Calendar</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?= base_url() ?>AdminLTE/plugins/fontawesome-free/css/all.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Sweet Alert Css -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <!-- Toastr -->
        <link rel="stylesheet" href="<?=base_url(); ?>AdminLTE/plugins/toastr/toastr.min.css">

        <!-- daterange picker -->
        <link rel="stylesheet" href="<?=base_url(); ?>AdminLTE/plugins/daterangepicker/daterangepicker.css">
        <!-- Tempusdominus Bbootstrap 4 -->
        <link rel="stylesheet" href="<?=base_url(); ?>AdminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
        <!-- Select2 -->
        <link rel="stylesheet" href="<?=base_url(); ?>AdminLTE/plugins/select2/css/select2.min.css">
        <link rel="stylesheet" href="<?=base_url(); ?>AdminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?= base_url(); ?>AdminLTE/dist/css/adminlte.min.css">

        <!-- fullCalendar 4 css-->
        <link href='<?= base_url() ?>fullcalendar4/packages/core/main.css' rel='stylesheet' />
        <link href='<?= base_url() ?>fullcalendar4/packages/daygrid/main.css' rel='stylesheet' />
        <link href='<?= base_url() ?>fullcalendar4/packages/timegrid/main.css' rel='stylesheet' />
        <link href='<?= base_url() ?>fullcalendar4/packages/list/main.css' rel='stylesheet' />
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!-- Theme style -->
        <link rel="stylesheet" href="<?= base_url() ?>AdminLTE/dist/css/adminlte.min.css">
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
                                <h1>Calendar</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url(); ?>index.php/shop/shop_page">Home</a></li>
                                    <li class="breadcrumb-item active">Calendar</li>
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
                            <div class="col-sm-12 px-5">
                                <div class="card card-primary">
                                    <div class="card-body p-0">
                                        <!-- THE CALENDAR -->
                                        <div id="calendar"></div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <div class="col-md-3">
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->
                </section>
                <!-- /.content -->

                <!-- modal_space -->
                <div class="modal fade" id="modal-default">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">イベントを追加する</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="add_event" role="form">
                                <div class="modal-body">
                                    <section class="content">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <div class="form-group">
                                                        <label>イベントタイトル</label>
                                                        <input type="text" name="title" id="title" class="form-control" placeholder="会議" >
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>イベントタイプ</label>
                                                        <select class="form-control select2bs4" style="width: 100%;" name="types" id="types">
                                                            <option disabled selected>------</option>
                                                            <option value="#00ff7f">会議</option>
                                                            <option value="#ffa500">イベント</option>
                                                            <option value="#ffff00">業者対応</option>
                                                            <option value="#ffb6c1"">お客様対応</option>
                                                            <option value="#dcdcdc">面談</option>
                                                            <option value="#ff0000">緊急</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>開始年月日</label>
                                                        <input type="date" name="s_ymd" id="s_ymd" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-5">
                                                    <div class="form-group">
                                                        <label>開始時間</label>
                                                        <select class="form-control select2bs4" style="width: 100%;" name="start" id="start">
                                                            <option disabled selected>---開始時間---</option>
                                                                <?php for($i=8; $i<=20; $i++){ ?>
                                                                    <option value=<?= $i.":00" ?>><?= $i ?>:00</option>
                                                                    <option value=<?= $i.":30" ?>><?= $i ?>:30</option>
                                                                <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>終了年月日</label>
                                                        <input type="date" name="e_ymd" id="e_ymd" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-5">
                                                    <div class="form-group">
                                                        <label>終了時間</label>
                                                        <select class="form-control select2bs4" style="width: 100%;" name="end" id="end">
                                                            <option disabled selected>---終了時間---</option>
                                                                <?php for($i=8; $i<=20; $i++){ ?>
                                                                    <option value=<?= $i.":00" ?>><?= $i ?>:00</option>
                                                                    <option value=<?= $i.":30" ?>><?= $i ?>:30</option>
                                                                <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-5">
                                                    <div class="form-group">
                                                        <label>顧客</label>
                                                        <select class="form-control select2bs4" id="cus_with" placeholder="検索" style="width: 100%;">
                                                            <option disabled selected>---顧客名---</option>
                                                        <!-- <input type="text" id="cus_with" placeholder="keyword" value="" class="form-control"> -->
                                                                <?php foreach($cus_data as $cus){?>
                                                                        <option value=<?= $cus["cus_name"] ?>><?= $cus["cus_name"] ?></option>
                                                                    <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-5">
                                                    <div class="form-group">
                                                        <label>出席者</label>
                                                        <input type="text" id="who_with" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>イベント内容</label>
                                                        <textarea id="event_data" class="form-control" placeholder="イベント詳細"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.row -->
                                        </div>
                                        <!-- /.container-fluid -->
                                    </section>
                                    <!-- /.content -->
                                </div>
                                <!-- /.modal-body -->
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" id= "close" data-dismiss="modal">Close</button>
                                    <button type="button" id="add_submit" class="btn btn-primary">イベント追加</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
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
            <script src="<?= base_url() ?>AdminLTE/plugins/jquery/jquery.min.js"></script>

            <!-- FullCalendar4 -->
            <script src='<?= base_url() ?>fullcalendar4/packages/core/main.js'></script>
            <script src='<?= base_url() ?>fullcalendar4/packages/core/locales-all.js'></script>
            <script src='<?= base_url() ?>fullcalendar4/packages/daygrid/main.js'></script>
            <script src='<?= base_url() ?>fullcalendar4/packages/timegrid/main.js'></script>
            <script src='<?= base_url() ?>fullcalendar4/packages/interaction/main.js'></script>
            <script src='<?= base_url() ?>fullcalendar4/packages/list/main.js'></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

            <!-- Toastr -->
            <script src="<?= base_url() ?>AdminLTE/plugins/toastr/toastr.min.js"></script>
            <!-- Bootstrap -->
            <script src="<?= base_url() ?>AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
            <!-- Select2 -->
            <script src="<?= base_url(); ?>AdminLTE/plugins/select2/js/select2.full.min.js"></script>
            <!-- date-range-picker -->
            <script src="<?= base_url(); ?>AdminLTE/plugins/daterangepicker/daterangepicker.js"></script>
            <!-- bs-custom-file-input -->
            <script src="<?= base_url() ?>AdminLTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
            <!-- jQuery UI -->
            <script src="<?= base_url() ?>AdminLTE//plugins/jquery-ui/jquery-ui.min.js"></script>
            <!-- AdminLTE App -->
            <script src="<?= base_url() ?>AdminLTE/dist/js/adminlte.min.js"></script>
            <!-- AdminLTE for demo purposes -->
            <script src="<?= base_url() ?>AdminLTE/dist/js/demo.js"></script>
            <!-- jquery-validation -->
            <script src="<?= base_url(); ?>AdminLTE/plugins/jquery-validation/jquery.validate.min.js"></script>
            <script src="<?= base_url(); ?>AdminLTE/plugins/jquery-validation/additional-methods.min.js"></script>

            <script>
            $(document).ready(function () {
                    bsCustomFileInput.init();
                $.validator.setDefaults({
                    submitHandler: function () {
                        form.submit();
                    }
                });
            });
    // ---------------------------------------------------------------------------------------------------------------------------------------- //
            //以下validation と ajax
            jQuery.validator.addMethod("day_day",function(value, element, params) {
                var s_date = params[0] + " " + params[1];
                var e_date = params[2] + " " + params[3];
                return this.optional(element) || new Date(e_date) > new Date(s_date);
            });
            
            $('#add_submit').click(function(){ 
                // バリデーションルールの設定
                var dates = [$('#s_ymd').val(),$('#start').val(),$('#e_ymd').val(),$('#end').val()];
                var valid_rules = {
                    rules: {
                        title: {
                                required: true
                        },
                        types: {
                                required: true
                        },
                        start: {
                            required: true
                        },
                        e_ymd: {
                            day_day: dates
                        },
                        end: {
                            required: true
                        }
                    },
                    messages: {
                        title: {
                            required: "必須項目"
                        },
                        types: {
                            required: "必須項目"
                        },
                        start: {
                            required: "開始時間を入力してください"
                        },
                        e_ymd: {
                            day_day: "不正な日時です"
                        },
                        end: {
                            required: "終了時間を入力してください",
                        },
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
                };
                // バリデーション
                $('#add_event').validate(valid_rules);
                // 失敗したら表示 
                    if (!$("#add_event").valid()) {
                        return false;
                    };
                // ajax開始
                var hostUrl= '<?= base_url(); ?>index.php/schedule/regis';
                $.ajax({
                    url: hostUrl, // URLを指定
                    type: "POST", // GET,POSTなどを指定
                    data: { // データを指定
                        'title' : $('#title').val(),
                        'start_date' : $('#s_ymd').val() + " " + $('#start').val(),
                        'end_date' : $('#e_ymd').val() + " " + $('#end').val(),
                        'sche_cus' : $('#cus_with').val(),
                        'who_with' :$('#who_with').val(),
                        'sche_data' : $('#event_data').val(),
                        'type' : $('#types').val()
                        }
                    }).done(function(data) {
                        if(data == "success"){
                            location.href = "<?= base_url(); ?>index.php/schedule/schedule";
                        }else{
                            info.revert();
                        }
                }).fail(function(data) {
                    // 通信失敗時の処理
                    console.dir(data);
                }).always(function(data) {
                    // 常に実行する処理
                    $("#modal-default").modal('hide'); // モーダルを閉じる
                });
            });
            //validationのリセット
                $('#modal-default').on('hidden.bs.modal', function () {
                    $('#add_event')[0].reset();
                    $('option:disabled').removeAttr('disabled');
                    $('.form-control').prop("selectedIndex", 0);
                    // $('select option:selected').attr("disabled");
                    // $('#add_event').find("textarea, :text, select").val("").end().find(":checked").prop("checked", false);
                    $('input,select').removeClass('is-invalid');
                    var validator = $("#add_event").validate();
                    validator.resetForm();
                });
    // ----------------------------------------------------------------------------------------------------------------------------------------- //
            // 以下カレンダー用
            var date_now = new Date();
            var date_start = new Date(date_now.getFullYear(), date_now.getMonth(), 1);
            var date_end = new Date(date_now.getFullYear(), date_now.getMonth(), 1);
            var days = ["日", "月", "火", "水", "木", "金", "土"];
            date_end.setMonth(date_end.getMonth()+12);

            document.addEventListener('DOMContentLoaded', function() {
                //関数
                function change_sche(info){
                    var start = moment(info.event.start,'YYYY-MM-DD HH:㎜');
                    var start = start.format('YYYY-MM-DD HH:mm');
                    var end = moment(info.event.end,'YYYY-MM-DD HH:㎜');
                    var end = end.format('YYYY-MM-DD HH:mm');
                    var ev_id = info.event.id;
                    var hostUrl= '<?= base_url(); ?>index.php/schedule/change_dates';
                        $.ajax({
                            url: hostUrl, // URLを指定
                            type: "POST", // GET,POSTなどを指定
                            data: { // データを指定
                                'ev_id' : ev_id,
                                'start_date' : start,
                                'end_date' : end
                                }
                            }).done(function(data) {
                                if(data != "success"){
                                    info.revert();
                                }
                        }).fail(function(data) {
                            // 通信失敗時の処理
                            info.revert();
                        });
                };
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    plugins: [ 'interaction','dayGrid', 'timeGrid', 'list'] ,
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                    },
                    locale: 'ja', //地域設定：日本
                    navLinks: true, // can click day/week names to navigate views
                    
                    // businessHours: true, //就業時間の設定・表示
                    //     businessHours: {
                    //         // days of week. an array of zero-based day of week integers (0=Sunday)
                    //         daysOfWeek: [ 1, 2, 3, 4, 5 ],
                    //         startTime: '8:30',
                    //         endTime: '17:30'
                    //     },
                    editable: true, // イベントを編集
                    allDaySlot: true, // 終日表示の枠を表示
                    eventDurationEditable: true, // イベント期間をドラッグして変更
                    selectable: true,
                    selectHelper: true,
                    eventTimeFormat: { hour: 'numeric', minute: '2-digit' }, // カレンダーの時刻表示をhh:mm形式にする

                    /* -*-*-*-*-*-*-*-*-*--*-*-*-
                        以降カレンダー操作関連
                    -*-*-*-*-*-*-*-*-*-*-*-*-*-*- */
                    droppable: true,// イベントをドラッグできるか
                    //日付をクリックしたときの処理
                    dateClick: function(info) {
                        var nowdate1 = moment(info.dateStr,'YYYY-MM-DD');
                        var nowdate2 = nowdate1.format("YYYY年MM月DD日");
                        var nowdate3 = nowdate1.format("YYYY-MM-DD");
                        $('#modal-default').modal('show');
                        $("#s_ymd").val(nowdate3);
                        $("#e_ymd").val(nowdate3);
                    },

                    eventClick: function(info) {
                        //イベントをクリックしたときの処理
                        var start = moment(info.event.start,'YYYY-MM-DD HH:㎜');
                        var start = start.format("YYYY年MM月DD日 HH時mm分");
                        var end = moment(info.event.end,'YYYY-MM-DD HH:㎜');
                        var end = end.format("YYYY年MM月DD日 HH時mm分");
                        if(info.event.extendedProps.sche_data === ""){
                            var sche_data = "なし";
                        }else{
                            var sche_data = info.event.extendedProps.sche_data;
                        }
                        if(info.event.extendedProps.sche_cus === ""){
                            var cus = "なし";
                        }else{
                            var cus = info.event.extendedProps.sche_cus;
                        }
                        if(info.event.extendedProps.who_with === ""){
                            var who_with = "なし";
                        }else{
                            var who_with = info.event.extendedProps.who_with;
                        }
                        Swal.fire({
                            title: info.event.title,
                            html:
                                "開始：　" + start 
                                + "<br>終了：　" + end 
                                + "<br>顧客：　" + cus
                                + "<br>出席者：　" + who_with
                                + "<br>詳細：　" + sche_data,
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#008000',
                            cancelButtonText: 'OK',
                            confirmButtonText: '削除',
                            position: 'top-end',
                        }).then((result) => {
                            if (result.value) {
                                var hostUrl= '<?= base_url(); ?>index.php/schedule/del_sche';
                                var ev_id = info.event.id;
                                $.ajax({
                                    url: hostUrl, // URLを指定
                                    type: "POST", // GET,POSTなどを指定
                                    data: { // データを指定
                                        'ev_id' : ev_id
                                        }
                                }).done(function(data) {
                                        if(data == "success"){
                                            location.href = "<?= base_url(); ?>index.php/schedule/schedule";
                                        }else{
                                            info.revert();
                                        }
                                }).fail(function(data) {
                                    // 通信失敗時の処理
                                    info.revert();
                                });
                            }
                        });
                    },

                    eventDrop: function(info) {
                        change_sche(info);
                    },

                    eventResize: function(info) {
                        change_sche(info);
                    },
                });

                // 既登録イベント表示
                var sche_event = (<?= json_encode($sche_data,JSON_UNESCAPED_UNICODE) ?>);
                $.each(sche_event, function(index, value){
                    calendar.addEvent({
                        id        : value["sche_id"],
                        title     : value["sche_title"],
                        start     : value["sche_start"],
                        end       : value["sche_end"],
                        color     : value["sche_type"],
                        sche_cus  : value["sche_cusname"],
                        who_with  : value["sche_with"],
                        sche_data : value["sche_data"],
                    });
                });
                //祝日
                var holi_event = (<?= json_encode($holi_data,JSON_UNESCAPED_UNICODE) ?>);
                $.each(holi_event, function(index, value){
                    var holiday = moment(value[0],'YYYY-MM-DD HH:㎜');
                    var holiday = holiday.format('YYYY-MM-DD');
                    calendar.addEvent({
                        title     : value[1],
                        start     : holiday,
                        rendering : 'background',
                        color: '#ffff8e'
                    });
                });

                calendar.render();
            });
    // ---------------------------------------------------------------------------------------------------------------------------------------- //
            $(function() {
                //Initialize Select2 Elements
                $('.select2').select2()

                //Initialize Select2 Elements
                $('.select2bs4').select2({
                theme: 'bootstrap4'
                })
            });
        </script>
    </body>
</html>