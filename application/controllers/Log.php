<?php
    class Log extends CI_Controller 
    {
        function __construct(){
            parent::__construct();
            // modelファイルへの接続
            $this->load->model('log_m');
            //dateヘルパーロード
            $this->load->helper('date');
        }

        /*初期ページ＝ログインページ*/
        public function index(){
            session_destroy();
            $this->load->view("loginpage");
        }

        public function forgot(){
            $this->load->view("forgot_pass");
        }

        /*ログイン認証
            ①ajax
            ②sessionセット
            ③
        */
        public function login(){
            $logmail = $this->input->post("logmail" , TRUE);
            $logpass = $this->input->post("logpass" , TRUE);
            $result = $this->log_m->login($logmail,$logpass);
            if(is_array($result)){
                $this->session->shop_id = $result[0]["mem_shopid"];
                $this->session->shop_name = $result[0]["mem_name"];
                $this->session->shop_mail= $result[0]["mem_mail"];
                $this->session->master = $result[0]["master"];
                if($result[0]["master"] == 1){
                    echo 100;
                }else{
                    echo 1;
                }
            }else{
                echo 2;
            }
        }

        public function send_pass(){
            $mail = $this->input->post("logmail",TRUE);
            //乱数生成
            $this->load->helper('string');
            $alt_pass = random_string('alnum', 7);
            $hash_pass = password_hash($alt_pass, PASSWORD_DEFAULT);
            date_default_timezone_set('Asia/Tokyo');
            $up_time = date("Y-m-d");
            $result = $this->log_m->forgot($mail,$hash_pass,$up_time);
            if($result){
                $this->load->helper('phpmailer');
                phpmailer_send(
                    //宛先(配列)
                    $mail,
                    //送信名
                    '管理者',
                    //送信アドレス
                    'sample000licenses@gmail.com',
                    //件名
                    'パスワード再発行・再登録のおしらせ',
                    //本文
                    '　いつもお世話になっております。顧客管理システム管理者です。<br>
                    <br>
                    　仮パスワード発行の申請を承り、仮パスワードを発行いたしました。<br>
                    <br>
                    　お手数ですが、下記の仮パスワードとメールアドレスでログインしていただき、
                    管理画面よりパスワードの変更を行ってください。<br>
                    <br>
                    <br>
                    仮パスワード　：　'.$alt_pass.'<br>
                    ログインページ　：　http://okano5017.work<br>
                    <br>
                    <br>
                    　なお、この仮パスワードは第三者に知られることのないよう、ご自身で大切に保管してください。<br>
                    　今後ともよろしくお願い申し上げます。',
                    NULL
                );
                echo 1;
            }else{
                echo 2;
            }
        }

        /*
        ログアウト
            全セッション削除
            ログインページへリダイレクト
        */
        public function logout(){
            session_destroy();
            $loginpage = base_url();
            redirect($loginpage);
        }

        /*店舗新規登録ページ*/
        public function regis(){
            $this->load->view("regis_v");
        }

        /*入力された店舗情報を登録する*/
        public function entry(){
            //入力基本情報(サニタイズ)
            $s_name = $this->input->post("s_name",TRUE);
            $s_kana = $this->input->post("s_kana",TRUE);
            $s_tel = $this->input->post("s_tel",TRUE);
            $s_mail = $this->input->post("s_mail",TRUE);
            $s_maga = $this->input->post("s_maga");
                if($s_maga == NULL){
                    $s_maga = 0 ;
                }
            $s_pass = $this->input->post("s_pass",TRUE);
            //パスワードハッシュ
            $s_pass = password_hash($s_pass, PASSWORD_DEFAULT);
            date_default_timezone_set('Asia/Tokyo');
            $entry_time = date("Y-m-d");
            
            //データベースに値引き渡し
            $result = $this->log_m->entry_shop($s_name,$s_kana,$s_tel,$s_mail,$s_maga,$s_pass,$entry_time);
            if($result){
                /* 店舗ページに行く
                    ①登録されたデータをとってくる
                    ②sessionをセット */
                // var_dump($result);
                // exit;
                $shop_mail = $s_mail;
                $shop_info =  $this->log_m->new_info($shop_mail);
                $this->session->shop_id = $shop_info[0]["mem_shopid"];
                $this->session->shop_name = $shop_info[0]["mem_name"];
                $this->session->shop_mail = $shop_info[0]["mem_mail"];
                redirect("shop/master_page?flag=first");
            }else{
                $back_page = base_url()."index.php/log/regis?flag=1";
                redirect($back_page);
            }
        }

    }
