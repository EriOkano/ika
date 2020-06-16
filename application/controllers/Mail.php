<?php
    class Mail extends CI_Controller 
    {
        function __construct(){
            parent::__construct();
            // modelファイルへの接続
            $this->load->model('mail_m');
            $this->load->model('shop_m');
            $this->load->model('customer_m');
            $this->load->model('shop_m');
            //dateヘルパーロード
            $this->load->helper('date');

            if(!isset($this->session->shop_id)){
                $loginpage = base_url();
                redirect($loginpage);
            }
        }

        /*
        メルマガ一覧画面 2020/05/25 明日はここからやる
        */
        public function mailbox(){
            $shop_id= $this->session->shop_id;
            $word = $this->input->post("search",TRUE);
            $result = $this->mail_m->mail_datas($shop_id,1000,0,$word);
            $counts = $this->mail_m->count_new($shop_id);
            //pagenation
            $config['base_url']= current_url();
            $config['total_rows'] = count($result);
            $config['per_page'] = 10;
            $config['use_page_numbers'] = TRUE;
            $config['page_query_string'] = TRUE;
            $config['num_links'] = 3;
            $config['query_string_segment'] = 'page';
            $config['prev_link'] = '<button type="button" class="btn btn-default btn-sm"><i class="fas fa-chevron-left"></i></button>';
            $config['next_link'] = '<button type="button" class="btn btn-default btn-sm"><i class="fas fa-chevron-right"></i></button>';
            $config['num_tag_open'] = '　';
            $config['num_tag_close'] = '　';
            if($this->input->get("page") != NULL){
                $offset = $config['per_page'] * ($this->input->get("page")-1);
            }else{
                $offset = 0;
            }
            
            $this->load->library('pagination',$config);
            $limit_datas = $this->mail_m->mail_datas($shop_id,$config['per_page'],$offset,$word);
            $data = array(
                'counts' => $counts,
                'datas' => $limit_datas,
                'page_link' => $this->pagination->create_links()
            );
            $this->load->view("mailbox",$data);
        }

        /*
        送信済みメルマガ一覧画面
        */
        public function sent_mail(){
            $shop_id= $this->session->shop_id;
            $word = $this->input->post("search",TRUE);
            $result = $this->mail_m->sent_data($shop_id,1000,0,$word);
            $counts = $this->mail_m->count_new($shop_id);
            //pagenation
            $config['base_url']= current_url();
            $config['total_rows'] = count($result);
            $config['per_page'] = 10;
            $config['use_page_numbers'] = TRUE;
            $config['page_query_string'] = TRUE;
            $config['num_links'] = 3;
            $config['query_string_segment'] = 'page';
            $config['prev_link'] = '<button type="button" class="btn btn-default btn-sm"><i class="fas fa-chevron-left"></i></button>';
            $config['next_link'] = '<button type="button" class="btn btn-default btn-sm"><i class="fas fa-chevron-right"></i></button>';
            $config['num_tag_open'] = '　';
            $config['num_tag_close'] = '　';
            if($this->input->get("page") != NULL){
                $offset = $config['per_page'] * ($this->input->get("page")-1);
            }else{
                $offset = 0;
            }
            $this->load->library('pagination',$config);
            $limit_datas = $this->mail_m->sent_data($shop_id,$config['per_page'],$offset,$word);
            $data = array(
                'counts' => $counts,
                'datas' => $limit_datas,
                'page_link' => $this->pagination->create_links()
            );
            $this->load->view("sent_mail",$data);
        }

        /*
        未送信メルマガ一覧画面
        */
        public function no_send_mail(){
            $shop_id= $this->session->shop_id;
            $word = $this->input->post("search",TRUE);
            $result = $this->mail_m->no_send_data($shop_id,1000,0,$word);
            $counts = $this->mail_m->count_new($shop_id);
            //pagenation
            $config['base_url']= current_url();
            $config['total_rows'] = count($result);
            $config['per_page'] = 10;
            $config['use_page_numbers'] = TRUE;
            $config['page_query_string'] = TRUE;
            $config['num_links'] = 3;
            $config['query_string_segment'] = 'page';
            $config['prev_link'] = '<button type="button" class="btn btn-default btn-sm"><i class="fas fa-chevron-left"></i></button>';
            $config['next_link'] = '<button type="button" class="btn btn-default btn-sm"><i class="fas fa-chevron-right"></i></button>';
            $config['num_tag_open'] = '　';
            $config['num_tag_close'] = '　';
            if($this->input->get("page") != NULL){
                $offset = $config['per_page'] * ($this->input->get("page")-1);
            }else{
                $offset = 0;
            }
            $this->load->library('pagination',$config);
            $limit_datas = $this->mail_m->no_send_data($shop_id,$config['per_page'],$offset,$word);
            $data = array(
                'counts' => $counts,
                'datas' => $limit_datas,
                'page_link' => $this->pagination->create_links()
            );
            $this->load->view("no_send_mail",$data);
        }

        /*
        新規メルマガ作成ページ
        */
        public function mail_page(){
            $shop_id= $this->session->shop_id;
            $counts = $this->mail_m->count_new($shop_id);
            $data = array(
                'counts' => $counts
            );
            $this->load->view("mail_page",$data);
        }

        /*
        新規メルマガ登録
        */
        public function reservation(){
            $shop_id= $this->session->shop_id;
            $subject = $this->input->post("subject",TRUE);
                $ymd = $this->input->post("date");
                $hour = $this->input->post("hour");
            $reserv_date = $ymd." ".$hour;
            $text = $this->input->post("text",TRUE);
                date_default_timezone_set('Asia/Tokyo');
            $entry_time = date("Y-m-d H:i:s");
            //添付ファイルの有無を確認
            if($_FILES["upfile"]["error"] === UPLOAD_ERR_OK){
                if (is_uploaded_file($_FILES["upfile"]["tmp_name"])){
                        $filename = $_FILES['upfile']['tmp_name'];
                    if(move_uploaded_file($filename, "attachment/".$entry_time.$_FILES["upfile"]["name"])){
                        chmod("attachment/".$entry_time.$_FILES["upfile"]["name"], 0755);
                        $file = $entry_time.$_FILES["upfile"]["name"];
                    }else{
                        redirect("mail/mail_page?flag=2");
                    }
                }
            }elseif($_FILES["upfile"]["error"] === UPLOAD_ERR_NO_FILE){
                $file = NULL;
            }else{
                redirect("mail/mail_page?flag=2");
            }
            $result = $this->mail_m->reserv($shop_id,$subject,$reserv_date,$text,$entry_time,$file);
            if($result){
                redirect("mail/mailbox?flag=1");
            }else{
                redirect("mail/mail_page?flag=2");
            }
        }

        /*
        (単数)削除処理
        */
        public function delete(){
            $mail_id = $this->input->post("mail_delete");
            date_default_timezone_set('Asia/Tokyo');
            $del_date = date("Y-m-d H:i:s");
            $result = $this->mail_m->mail_del($mail_id,$del_date);
            if($result){
                redirect("mail/mailbox?flag=1");
            }else{
                redirect("mail/mailbox?flag=2");
            }
        }

        /*
        (複数)削除処理
        */
        public function some_dels(){
            $mail_ids = $this->input->post("delete_ids");
            date_default_timezone_set('Asia/Tokyo');
            $del_date = date("Y-m-d H:i:s");
            $result = $this->mail_m->some_dels($mail_ids,$del_date);
            if($result){
                echo "success";
            }else{
                echo "fail";
            }
        }

        /*
        送信済みのメルマガを読む
        */
        public function read_box(){
            $this->load->helper('html');
            $shop_id= $this->session->shop_id;
            $mail_id = $this->input->post("mail_read");
            $result = $this->mail_m->edit_data($mail_id);
            $counts = $this->mail_m->count_new($shop_id);
            $data = array(
                'data' => $result[0],
                'counts' => $counts
            );
            $this->load->view("read_box",$data);
        }

        /*
        編集画面
        */
        public function edit_page(){
            $shop_id= $this->session->shop_id;
            $mail_id = $this->input->post("mail_edit");
            $result = $this->mail_m->edit_data($mail_id);
            $counts = $this->mail_m->count_new($shop_id);
            $data = array(
                'data' => $result[0],
                'counts' => $counts
            );
            $this->load->view("mail_edit",$data);
        }

        /*
        編集処理
        */
        public function edit(){
        $mail_id = $this->input->post("mail_id");
        $subject = html_escape($this->input->post("subject"));
                $ymd = $this->input->post("date");
                $hour = $this->input->post("hour");
            $reserv_date = $ymd." ".$hour;
            $text = $this->input->post("text",TRUE);
                date_default_timezone_set('Asia/Tokyo');
            $update_time = date("Y-m-d H:i:s");
            //添付ファイルの有無を確認
            if($_FILES["upfile"]["error"] === UPLOAD_ERR_OK){
                if (is_uploaded_file($_FILES["upfile"]["tmp_name"])){
                        $filename = $_FILES['upfile']['tmp_name'];
                    if(move_uploaded_file($filename, "attachment/".$update_time.$_FILES["upfile"]["name"])){
                        chmod("attachment/".$update_time.$_FILES["upfile"]["name"], 0755);
                        $file = $update_time.$_FILES["upfile"]["name"];
                    }else{
                        redirect("mail/mailbox?flag=2");
                    }
                }
            }elseif($_FILES["upfile"]["error"] === UPLOAD_ERR_NO_FILE){
                $file = NULL;
            }else{
                redirect("mail/mailbox?flag=2");
            }
            $result = $this->mail_m->edit($mail_id,$subject,$reserv_date,$text,$file,$update_time);
            if($result){
                $old_file = $this->input->post("old_file");
                chmod("attachment/".$old_file, 777);
                unlink("attachment/".$old_file);
                redirect("mail/mailbox?flag=1");
            }else{
                redirect("mail/mail_page");
            }
        }

        /*ごみばこ*/
        public function trash(){
            $shop_id = $this->session->shop_id;
            $word = $this->input->post("search",TRUE);
            $result = $this->mail_m->trash_data($shop_id,1000,0,$word);
            $counts = $this->mail_m->count_new($shop_id);
            //pagenation
            $config['base_url']= current_url();
            $config['total_rows'] = count($result);
            $config['per_page'] = 10;
            $config['use_page_numbers'] = TRUE;
            $config['page_query_string'] = TRUE;
            $config['num_links'] = 3;
            $config['query_string_segment'] = 'page';
            $config['prev_link'] = '<button type="button" class="btn btn-default btn-sm"><i class="fas fa-chevron-left"></i></button>';
            $config['next_link'] = '<button type="button" class="btn btn-default btn-sm"><i class="fas fa-chevron-right"></i></button>';
            $config['num_tag_open'] = '　';
            $config['num_tag_close'] = '　';
            if($this->input->get("page") != NULL){
                $offset = $config['per_page'] * ($this->input->get("page")-1);
            }else{
                $offset = 0;
            }
            $this->load->library('pagination',$config);
            $limit_datas = $this->mail_m->trash_data($shop_id,$config['per_page'],$offset,$word);
            $data = array(
                'counts' => $counts,
                'datas' => $limit_datas,
                'page_link' => $this->pagination->create_links()
            );
            $this->load->view("trash_mail",$data);
        }
        

        /*復帰処理*/
        public function re_box(){
            $mail_id = $this->input->post("re_mail");
            date_default_timezone_set('Asia/Tokyo');
            $re_date = date("Y-m-d H:i:s");
            $result = $this->mail_m->mail_rebox($mail_id,$re_date);
            if($result){
                redirect("mail/trash?flag=1");
            }else{
                redirect("mail/trash?flag=2");
            }
        }

        /*
        (複数)復活処理
        */
        public function some_return(){
            $mail_ids = $this->input->post("return_ids");
            date_default_timezone_set('Asia/Tokyo');
            $re_date = date("Y-m-d H:i:s");
            $result = $this->mail_m->re_boxes($mail_ids,$re_date);
            if($result){
                echo "success";
            }else{
                echo "fail";
            }
        }

        //cronで回すメルマガ
        public function mail_send(){
            //メルマガデータ
            $mail_data = $this->mail_m->mail_send();
            //データを一つずつ回す
            // var_dump($mail_data);
            // exit;
            for($i=0 ; $i<count($mail_data); $i++){
                //現在時間
                date_default_timezone_set('Asia/Tokyo');
                $nowdate = date("Y-m-d H:i:s");
                $class_date = new DateTime($nowdate);
                //予定日
                $send_time = $mail_data[$i]["send_date"];
                $send_time = new DateTime($send_time);
                //現在時間含め、送信時間が過去のもの
                if($send_time <= $class_date){
                    //送信フラグが０のもの
                    if($mail_data[$i]["mail_send_flag"] == 0){
                        $shop_id = $mail_data[$i]["mail_shopid"];
                        //店舗名
                        $send_name = $this->shop_m->send_name($shop_id);
                        $name = $send_name[0]["mem_name"];
                        //宛先
                        $tomails = $this->customer_m->tomails($shop_id);
                        $address = array();
                        //宛先アドレスを配列に入れる
                        foreach($tomails as $to){
                            foreach($to as $key => $add){
                                $address[] = $add;
                            }
                        }
                        $this->load->helper('phpmailer');
                        phpmailer_send(
                            //宛先(配列)
                            $address,
                            //送信名
                            $name,
                            //送信アドレス
                            'sample000licenses@gmail.com',
                            //件名
                            $mail_data[$i]["mail_subject"],
                            //本文
                            htmlspecialchars_decode($mail_data[$i]["mail_text"]),
                            //添付ファイル
                            $mail_data[$i]["mail_files"]
                        );
                        $this->mail_m->send_flag($mail_data[$i]["mail_id"],$nowdate);
                    }
                }
            };
        }
    }
