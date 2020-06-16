                <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
                    <a><img src="<?= base_url("img/ika2.png"); ?>"></a>
                    <div class="container">
                            <div class="pl-sm-2">
                                <!-- <span class="brand-text font-weight-light">iKaシステム</span> -->
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
                                <li class="nav-item">
                                    <a href="<?= base_url(); ?>index.php/mail/mailbox" class="nav-link">メルマガ</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url(); ?>index.php/schedule/schedule" class="nav-link">カレンダー</a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a href="<?= base_url(); ?>index.php/video" class="nav-link">ビデオ</a>
                                </li> -->
                            </ul>
                        </div>
                    
                        <!-- Right navbar links -->
                        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                            <li class="nav-item">
                                <a href="<?= base_url() ?>index.php/log/logout" class="nav-link">ログアウト</a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- /.navbar -->