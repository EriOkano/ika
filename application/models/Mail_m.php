<?php
    class Mail_m extends CI_Model
    {
        function __construct(){
            //データベースへの接続(様式)
            parent::__construct();
            $this->load->database();
        }

        function count_new($shop_id){
            $result =  $this->db->get_where('mail_data',array('mail_shopid' => $shop_id,"mail_send_flag" => 0,"mail_del" => 0));
            $result = $result->num_rows();
            return $result;
        }

        /*
        メール一覧
        */
        function mail_datas($shop_id,$limit,$offset,$word){
            $this->db->select(
                "mail_id,
                mail_subject,
                mail_text,
                send_date,
                CASE mail_send_flag
                    WHEN 0 THEN '未送信'
                    WHEN 1 THEN '送信済み'
                    ELSE '不明'
                END AS 'flag'"
            );
            $this->db->order_by('mail_id', 'DESC');
            $this->db->where(array('mail_shopid' => $shop_id,"mail_del" => 0));
            if($word != NULL){
                $this->db->like('mail_subject', $word);
                $this->db->or_like('mail_text', $word);
            }
            $this->db->limit($limit, $offset);
            $result =  $this->db->get('mail_data');
            $result = $result->result("array");
            return $result;
        }

        /*
        送信済み一覧データ
        */
        function sent_data($shop_id,$limit,$offset,$word){
            $this->db->select(
                "mail_id,
                mail_subject,
                mail_text,
                send_date,
                CASE mail_send_flag
                    WHEN 0 THEN '未送信'
                    WHEN 1 THEN '送信済み'
                    ELSE '不明'
                END AS 'flag'"
            );
            $this->db->order_by('mail_id', 'DESC');
            $this->db->where(array('mail_shopid' => $shop_id,"mail_del" => 0,"mail_send_flag" => 1));
            if($word != NULL){
                $this->db->like('mail_subject', $word);
                $this->db->or_like('mail_text', $word);
            }
            $this->db->limit($limit, $offset);
            $result =  $this->db->get('mail_data');
            $result = $result->result("array");
            return $result;
        }

        /*
        未送信一覧データ
        */
        function no_send_data($shop_id,$limit,$offset,$word){
            $this->db->select(
                "mail_id,
                mail_subject,
                mail_text,
                send_date,
                CASE mail_send_flag
                    WHEN 0 THEN '未送信'
                    WHEN 1 THEN '送信済み'
                    ELSE '不明'
                END AS 'flag'"
            );
            if($word != NULL){
                $this->db->like('mail_subject', $word);
                $this->db->or_like('mail_text', $word);
            }
            $this->db->order_by('mail_id', 'DESC');
            $this->db->where(array('mail_shopid' => $shop_id,"mail_del" => 0,"mail_send_flag" => 0));
            $this->db->limit($limit, $offset);
            $result =  $this->db->get('mail_data');
            $result = $result->result("array");
            return $result;
        }

        /*
        メールの新規登録
        */
        function reserv($shop_id,$subject,$reserv_date,$text,$entry_time,$file){
            $data = array(
                "mail_shopid" => $shop_id,
                "mail_subject" => $subject,
                "mail_text" => $text,
                "mail_files" => $file,
                "send_date" => $reserv_date,
                "mail_makedate" => $entry_time
            );
            $this->db->trans_start();
            $result = $this->db->insert('mail_data', $data);
            $this->db->trans_complete();
            if($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }
        /*
        編集処理
        */
        function edit($mail_id,$subject,$reserv_date,$text,$file,$update_time){
            $data = array(
                "mail_subject" => $subject,
                "mail_text" => $text,
                "send_date" => $reserv_date,
                "mail_files" => $file,
                "mail_updatedate" => $update_time
            );
            $this->db->trans_start();
            $this->db->where("mail_id",$mail_id);
            $result = $this->db->update('mail_data', $data);
            $this->db->trans_complete();
            if($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        /*
        編集ページのデータ
        */
        function edit_data($mail_id){
            $this->db->select(
                "mail_id,
                mail_subject,
                mail_text,
                mail_files,
                send_date");
            $result =  $this->db->get_where('mail_data',array('mail_id' => $mail_id));
            $result = $result->result("array");
            return $result;
        }

        /*
        削除処理（論理）
        */
        function mail_del($mail_id,$del_date){
            $data = array(
                "mail_del" => 1,
                "mail_updatedate" => $del_date
            );
            $this->db->trans_start();
            $this->db->where("mail_id",$mail_id);
            $result = $this->db->update('mail_data', $data);
            $this->db->trans_complete();
            if($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        /*
        選択削除処理（論理）
        */
        function some_dels($mail_ids,$del_date){
            $data = array(
                "mail_del" => 1,
                "mail_updatedate" => $del_date
            );
            $this->db->trans_start();
            $this->db->where_in("mail_id",$mail_ids);
            $result = $this->db->update('mail_data', $data);
            $this->db->trans_complete();
            if($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        /*
        ごみ箱の詳細
        */
        function trash_data($shop_id,$limit,$offset,$word){
            $this->db->select(
                "mail_id,
                mail_subject,
                mail_text,
                mail_files,
                send_date,
                CASE mail_send_flag
                    WHEN 0 THEN '未送信'
                    WHEN 1 THEN '送信済み'
                    ELSE '不明'
                END AS 'flag'"
            );
            $this->db->order_by('mail_id', 'DESC');
            $this->db->where(array('mail_shopid' => $shop_id,"mail_del" => 1));
            if($word != NULL){
                $this->db->like('mail_subject', $word);
                $this->db->or_like('mail_text', $word);
            }
            $this->db->limit($limit, $offset);
            $result =  $this->db->get('mail_data');
            $result = $result->result("array");
            return $result;
        }

        /*
        復活処理（論理）
        */
        function mail_rebox($mail_id,$re_date){
            $data = array(
                "mail_del" => 0,
                "mail_updatedate" => $re_date
            );
            $this->db->trans_start();
            $this->db->where("mail_id",$mail_id);
            $result = $this->db->update('mail_data', $data);
            $this->db->trans_complete();
            if($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        /*
        複数復活処理（論理）
        */
        function re_boxes($mail_ids,$re_date){
            $data = array(
                "mail_del" => 0,
                "mail_updatedate" => $re_date
            );
            $this->db->trans_start();
            $this->db->where_in("mail_id",$mail_ids);
            $result = $this->db->update('mail_data', $data);
            $this->db->trans_complete();
            if($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        //cronで送るメルマガデータ（全データ）
        function mail_send(){
            $this->db->select
            ("
                send_date,
                mail_send_flag,
                mail_id,
                mail_shopid,
                mail_subject,
                mail_files,
                mail_text
            ");
            $result =  $this->db->get_where('mail_data',array("mail_del" => 0));
            $result = $result->result("array");
            return $result;
        }

        //cronで送信後、mail_send_flagを1に
        function send_flag($mail_id,$sent_time){
            $data = array(
                "mail_send_flag" => 1,
                "mail_updatedate" => $sent_time
            );
            $this->db->trans_start();
            $this->db->where("mail_id",$mail_id);
            $result = $this->db->update('mail_data', $data);
            $this->db->trans_complete();
            if($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }
    }
