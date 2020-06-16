<?php
    class Video extends CI_Controller 
    {
        function __construct(){
            parent::__construct();
            // modelファイルへの接続
            $this->load->model('shop_m');
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
        public function index(){

            $this->load->view("video");
        }
    }