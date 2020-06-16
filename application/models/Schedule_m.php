<?php
    class Schedule_m extends CI_Model
    {
        function __construct(){
            //データベースへの接続(様式)
            parent::__construct();
            $this->load->database();
        }

        // 全予定を取得
        function schedules($shop_id){
            $schedules = $this->db->get_where('schedule',array('sche_shopid' => $shop_id));
            $schedules = $schedules->result("array");
            return $schedules;
        }

        // idに紐づく顧客情報を取得
        function cus_info($shop_id){
            $this->db->select(
                "cus_id,
                cus_name,
                cus_kana"
            );
            $cus_info = $this->db->get_where('customer',array('cus_shopid' => $shop_id, "cus_del" => 0));
            $cus_info = $cus_info->result("array");
            return $cus_info;
        }

        // 予定を登録
        function new_sche($id,$title,$start,$end,$sche_cus,$with,$sche_data,$type){
            $this->db->trans_start();
            $data = array(
                'sche_shopid' => $id,
                'sche_title' => $title,
                'sche_start' => $start,
                'sche_end' => $end,
                'sche_cusname' => $sche_cus,
                'sche_with' => $with,
                'sche_data' => $sche_data,
                'sche_type' => $type
            );
            $this->db->insert('schedule', $data);
            $this->db->trans_complete();
            if($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }
        //予定日時の変更
        function change_dates($ev_id,$start,$end){
            $this->db->trans_start();
            $data = array(
                'sche_start' => $start,
                'sche_end' => $end,
            );
            $this->db->where("sche_id",$ev_id);
            $result = $this->db->update('schedule', $data);
            $this->db->trans_complete();
            if($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        //削除
        function delete($ev_id){
            $this->db->trans_start();
            $this->db->where("sche_id",$ev_id);
            $this->db->delete('schedule');
            $this->db->trans_complete();
            if($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }
    }