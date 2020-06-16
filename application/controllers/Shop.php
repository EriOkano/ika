<?php
    class Shop extends CI_Controller 
    {
        function __construct(){
            parent::__construct();
            // modelファイルへの接続
            $this->load->model('shop_m');
            $this->load->model('customer_m');
            //dateヘルパーロード
            $this->load->helper('date');

            if(!isset($this->session->shop_id)){
                $loginpage = base_url();
                redirect($loginpage);
            }
        }

        /*
        店舗ページを表示
            =>店舗の登録情報（編集ボタン）
            =>顧客の登録一覧（ここの仕様はどうするか）
        */
        public function shop_page(){
            
                $shop_id = $this->session->shop_id;
                $shop_info =  $this->shop_m->shop_info($shop_id); 
                // var_dump($shop_info);
                // exit;
                $cus_info =  $this->customer_m->cus_info($shop_id);
                $data = array(
                    'shop' => $shop_info[0],
                    'cus' => $cus_info
                );
                $this->load->view("shop",$data);
        }

        /*
        管理者ページ
        */
        public function master_page(){
            if(isset($this->session->master)){
                if($this->session->master == 1){
                    $all_data = $this->shop_m->all_shop();
                    $data = array(
                        'all_data' => $all_data
                    );
                    $this->load->view("master_page",$data);
                }else{
                    $shop_page = base_url()."index.php/shop/shop_page";
                    redirect($shop_page);
                }
            }else{
                $loginpage = base_url();
                redirect($loginpage);
            }
        }

        /*
        削除店舗一覧ページ
        */
        public function del_page(){
            if($this->session->master == 1){
                $all_data = $this->shop_m->del_shop();
                $data = array(
                    'all_data' => $all_data
                );
                $this->load->view("del_shop",$data);
            }else{
                $shop_page = base_url()."index.php/shop/master_page";
                redirect($shop_page);
            }
        }

        /*
        削除処理
        */
        public function del_shops(){
            $shop_id = $this->input->post("delete");
            date_default_timezone_set('Asia/Tokyo');
            $update = date("Y-m-d");
            $result = $this->shop_m->delete($shop_id,$update);
            if($result){
                $shop_page = base_url()."index.php/shop/master_page?flag=2";
                redirect($shop_page);
            }else{
                $shop_page = base_url()."index.php/shop/master_page?flag=100";
                redirect($shop_page);
            }
        }

        /*
        復活処理
        */
        public function back(){
            $shop_id = $this->input->post("back_reserv");
            date_default_timezone_set('Asia/Tokyo');
            $update = date("Y-m-d");
            $result = $this->shop_m->back($shop_id,$update);
            if($result){
                $shop_page = base_url()."index.php/shop/del_page?flag=2";
                redirect($shop_page);
            }else{
                $shop_page = base_url()."index.php/shop/del_page?flag=100";
                redirect($shop_page);
            }
        }

        public function csv(){
            $this->load->helper('download');
            $this->load->dbutil();
            $data = $this->shop_m->csv();
            $data = $this->dbutil->csv_from_result($data);
            mb_language("Japanese");
            $data = mb_convert_encoding($data, 'SJIS', 'UTF-8');
            date_default_timezone_set('Asia/Tokyo');
            $download_time = date("Y/m/d");
            force_download($download_time.'店舗一覧.csv', $data);
            redirect("master_page");
        }

        /*
        店舗情報編集ページ
        */
        public function mem_edit(){
            $shop_id = $this->session->shop_id;
            $mem_info =  $this->shop_m->mem_edit($shop_id);
            $data = array(
                "mem_info" => $mem_info[0]
            );
            $this->load->view("mem_edit",$data);
        }

        /*
        管理者が店舗情報を管理する場合
        */
        public function master_edit(){
            $shop_id = $this->input->post("mem_edit");
            $mem_info =  $this->shop_m->mem_edit($shop_id);
            $data = array(
                "mem_info" => $mem_info[0]
            );
            $this->load->view("mem_edit",$data);
        }

        public function chart_page(){
            $this->load->view("chart");
        }

        /*
        店舗情報編集を実行
        */
        public function do_edit(){
            //入力基本情報(サニタイズ)
            $s_id = $this->input->post("shop_id");
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
            $edit_time = date("Y-m-d");
            
            //データベースに値引き渡し
            $result = $this->shop_m->mem_update($s_id,$s_name,$s_kana,$s_tel,$s_mail,$s_maga,$s_pass,$edit_time);

            if($result){
                if($this->session->master == 1){
                    $master_page = base_url()."index.php/shop/master_page?flag=1";
                    redirect($master_page);
                }else{
                    $this->session->shop_name = $s_name;
                    $this->session->shop_mail = $s_mail;
                    $shop_page = base_url()."index.php/shop/shop_page?flag=1";
                    redirect($shop_page);
                }
            }else{
                if($this->session->master == 1){
                    $master_page = base_url()."index.php/shop/master_page?flag=100";
                    redirect($master_page);
                }else{
                $shop_page = base_url()."index.php/shop/shop_page?flag=100";
                redirect($shop_page);
                }
            }
        }

    }
