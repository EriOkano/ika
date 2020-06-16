<?php
    class Schedule extends CI_Controller 
    {
        function __construct(){
            parent::__construct();
            // modelファイルへの接続
            $this->load->model('shop_m');
            $this->load->model('customer_m');
            $this->load->model('schedule_m');
            // formバリデーションライブラリをロ―ド
            $this->load->library("form_validation");
            //dateヘルパーロード
            $this->load->helper('date');
            //ログインチェック
            if(!isset($this->session->shop_id)){
                $loginpage = base_url();
                redirect($loginpage);
            }
        }
        public function index(){
            echo "Hello";
        }

        public function schedule(){
            $id = $this->session->shop_id;
            $cus_data = $this->schedule_m->cus_info($id);
            $schedules = $this->schedule_m->schedules($id);
            mb_language("Japanese");
            $filepath = base_url("attachment/2020_syukujitsu.csv");
            $holi_file = new NoRewindIterator(new SplFileObject($filepath)); 
            $holi_file->setFlags(SplFileObject::READ_CSV); 
            foreach ($holi_file as $line) {
                $line = mb_convert_encoding($line, 'UTF-8', 'SJIS');
                $records[] = $line; 
            }
            array_splice($records,0,1);

            $data = array(
                "sche_data" => $schedules,
                "cus_data" => $cus_data,
                "holi_data" => $records
            );
            $this->load->view("schedule",$data);
        }

        public function regis(){
            $id = $this->session->shop_id;
            $title = $this->input->post("title",TRUE);
            $start = $this->input->post("start_date",TRUE);
            $end = $this->input->post("end_date",TRUE);
            $sche_cus = $this->input->post("sche_cus",TRUE);
            $with = $this->input->post("who_with",TRUE);
            $sche_data = $this->input->post("sche_data",TRUE);
            $type = $this->input->post("type",TRUE);

            $result = $this->schedule_m->new_sche($id,$title,$start,$end,$sche_cus,$with,$sche_data,$type);
            if($result == TRUE){
                echo "success";
            }else{
                echo "fail";
            }
        }

        public function change_dates(){
            $ev_id = $this->input->post("ev_id",TRUE);
            $start = $this->input->post("start_date",TRUE);
            $end = $this->input->post("end_date",TRUE);
            $result = $this->schedule_m->change_dates($ev_id,$start,$end);
            if($result == TRUE){
                echo "success";
            }else{
                echo "fail";
            }
        }

        public function del_sche(){
            $ev_id = $this->input->post("ev_id",TRUE);
            $result = $this->schedule_m->delete($ev_id);
            if($result == TRUE){
                echo "success";
            }else{
                echo "fail";
            }
        }
    }