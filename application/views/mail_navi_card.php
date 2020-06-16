<div class="card">
                        <div class="card-header">
                            <h3 class="card-title">メルマガボックス</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <ul class="nav nav-pills flex-column">
                                <li class="nav-item">
                                    <a href="mailbox" class="nav-link">
                                        <i class="fas fa-envelope"></i> メルマガ一覧
                                        <span class="badge bg-success float-right"><?= $counts ?></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="sent_mail" class="nav-link">
                                        <i class="far fa-file-alt"></i> 送信済み一覧
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="no_send_mail" class="nav-link">
                                        <i class="fas fa-inbox"></i> 送信予約中一覧
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="trash" class="nav-link">
                                        <i class="far fa-trash-alt"></i> ごみ箱
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->