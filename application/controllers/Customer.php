<?php
    class Customer extends CI_Controller 
    {
        function __construct(){
            parent::__construct();
            // modelファイルへの接続
            $this->load->model('customer_m');
            // セッションをロード
            $this->load->library('session');
            //dateヘルパーロード
            $this->load->helper('date');

            if(!isset($_SESSION["shop_id"])){
                $loginpage = base_url();
                redirect($loginpage);
            }
        }

        /*新規顧客登録ページ*/
        public function cus_regis(){
            $this->load->view("cus_regis");
        }

        /*登録処理*/
        public function new_cus(){
            $cus_shopid = $_SESSION["shop_id"];
            $cus_name = $this->input->post("cus_name",TRUE);
            $cus_kana = $this->input->post("cus_kana",TRUE);
            $cus_gender = $this->input->post("cus_gender");
            $cus_birth = $this->input->post("cus_birth");
            $cus_tel = $this->input->post("cus_tel",TRUE);
            $cus_mail = $this->input->post("cus_mail",TRUE);
            $cus_maga = $this->input->post("cus_maga");
                if($cus_maga == NULL){
                    $cus_maga = 0 ;
                }
            date_default_timezone_set('Asia/Tokyo');
            $entry_time = date("Y-m-d H:i:s");

            $result = $this->customer_m->new_cus($cus_shopid,$cus_name,$cus_kana,$cus_gender,$cus_birth,$cus_tel,$cus_mail,$cus_maga,$entry_time);
            if($result){
                redirect("shop/shop_page?flag=3");
            }else{
                redirect("shop/shop_page?flag=100");
            }
            
        }

        public function edit(){
            $edit_key = $this->input->post("c_edit");
            $cus_datas = $this->customer_m->edit($edit_key);
            if(is_array($cus_datas)){
                $data = array(
                    'cus_datas' => $cus_datas[0]
                );
                $this->load->view("cus_edit",$data);
            }else{
                redirect("shop/shop_page?flag=100");
            };
        }

        public function do_edit(){
            $cus_id = $this->input->post("edit_key");
            $cus_name = $this->input->post("cus_name",TRUE);
            $cus_kana = $this->input->post("cus_kana",TRUE);
            $cus_gender = $this->input->post("cus_gender");
            $cus_birth = $this->input->post("cus_birth");
            $cus_tel = $this->input->post("cus_tel",TRUE);
            $cus_mail = $this->input->post("cus_mail",TRUE);
            $cus_maga = $this->input->post("cus_maga");
                if($cus_maga == NULL){
                    $cus_maga = 0 ;
                }
            date_default_timezone_set('Asia/Tokyo');
            $edit_time = date("Y-m-d H:i:s");
            //データベースに値引き渡し
            $result = $this->customer_m->cus_update($cus_id,$cus_name,$cus_kana,$cus_gender,$cus_birth,$cus_tel,$cus_maga,$cus_mail,$edit_time);
        
            if($result){
                redirect("shop/shop_page?flag=4");
            }else{
                redirect("shop/shop_page?flag=100");
            }
        }

        /*削除処理*/
        public function delete(){
            $cus_key = $this->input->post("c_delete");
            date_default_timezone_set('Asia/Tokyo');
            $del_date = date("Y-m-d H:i:s");
            $result = $this->customer_m->delete($cus_key,$del_date);
            if($result){
                redirect("shop/shop_page?flag=2");
            }else{
                redirect("shop/shop_page?flag=100");
            }
        }

        public function csv(){
            $this->load->helper('download');
            $this->load->dbutil();
            $shop_id = $_SESSION["shop_id"];
            $data = $this->customer_m->csv($shop_id);
            $data = $this->dbutil->csv_from_result($data);
            mb_language("Japanese");
            $data = mb_convert_encoding($data, 'SJIS', 'UTF-8');
            force_download('顧客一覧.csv', $data);
            redirect("shop/shop_page");
        }
    }