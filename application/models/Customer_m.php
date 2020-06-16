<?php
class Customer_m extends CI_Model
    {
        function __construct(){
            //データベースへの接続(様式)
            parent::__construct();
            $this->load->database();
        }

        /*
            顧客の新規登録
        */
        function new_cus($cus_shopid,$cus_name,$cus_kana,$cus_gender,$cus_birth,$cus_tel,$cus_mail,$cus_maga,$entry_time){
            $this->db->trans_start();
            $data = array(
                'cus_shopid' => $cus_shopid,
                'cus_name' => $cus_name,
                'cus_kana' => $cus_kana,
                'cus_gender'=> $cus_gender,
                'cus_birth'=> $cus_birth,
                'cus_tel' => $cus_tel,
                'cus_mail' => $cus_mail,
                'cus_magazine' => $cus_maga,
                'cus_makedate' => $entry_time
            );
            $result = $this->db->insert('customer', $data);
            $cus_id = $this->db->insert_id();
            //logsに登録
            $make_log =  $this->make_log($cus_id,$entry_time);
            //トランザクション終了
            $this->db->trans_complete();
            if($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        /*
            ショップのページに渡す顧客情報
        */
        function cus_info($shop_id){
            $this->db->select(
                "cus_id,
                cus_name,
                cus_kana,
                CASE cus_gender
                    WHEN 0 THEN '男性'
                    WHEN 1 THEN '女性'
                    ELSE '不明'
                END AS cus_g,
                cus_birth,
                cus_tel,
                cus_mail,
                CASE cus_magazine
                    WHEN 0 THEN '不要'
                    WHEN 1 THEN '希望'
                    ELSE '不明'
                END AS cus_maga,
                cus_makedate"
            );
            $cus_info = $this->db->get_where('customer',array('cus_shopid' => $shop_id, "cus_del" => 0));
            $cus_info = $cus_info->result("array");
            // var_dump($cus_info);
            // exit;
            return $cus_info;
        }

        /*
        顧客情報編集ページ
        */
        function edit($edit_key){
            $this->db->select(
                "cus_id,
                cus_name,
                cus_kana,
                cus_gender,
                cus_birth,
                cus_tel,
                cus_mail,
                cus_magazine"
            );
            $edit_data = $this->db->get_where('customer',array('cus_id' => $edit_key));
            $edit_data = $edit_data->result("array");
            return $edit_data;
        }

        /*登録変更処理*/
        function cus_update($cus_id,$cus_name,$cus_kana,$cus_gender,$cus_birth,$cus_tel,$cus_maga,$cus_mail,$edit_time){
            $this->db->trans_start();
            $datas = array(
                "cus_name" => $cus_name,
                "cus_kana" => $cus_kana,
                "cus_gender" => $cus_gender,
                "cus_birth" => $cus_birth,
                "cus_tel" => $cus_tel,
                "cus_mail" => $cus_mail,
                "cus_magazine" => $cus_maga,
                "cus_updatedate" => $edit_time
            );
            $this->db->where("cus_id",$cus_id);
            $result = $this->db->update('customer', $datas);

            //logsに登録
            $up_log =  $this->update_log($cus_id,$edit_time);
            //トランザクション終了
            $this->db->trans_complete();
            if($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        /*
            顧客登録削除（論理削除）
        */
        function delete($cus_key,$del_date){
            $this->db->trans_start();
            $data = array(
                "cus_del" => 1,
                "cus_updatedate" => $del_date
            );
            $this->db->where("cus_id",$cus_key);
            $result = $this->db->update('customer', $data);
            //logsに登録
            $cus_id = $cus_key;
            $edit_time = $del_date;
            $up_log =  $this->update_log($cus_id,$edit_time);
            //トランザクション終了
            $this->db->trans_complete();
            if($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        /*
        新規登録後ログ
        */
        function make_log($cus_id,$entry_time){
            $data = array(
                "log_cus_id" => $cus_id,
                "log_entry" => $entry_time
            );
            $query = $this->db->insert('logs', $data);
            return $query;
        }

        /*
        更新後ログ
        */
        function update_log($cus_id,$edit_time){
            $data = array(
                "log_cus_id" => $cus_id,
                "log_update" => $edit_time
            );
            $this->db->where("log_cus_id",$cus_id);
            $query = $this->db->update('logs', $data);
            return $query;
        }

        /*
        csv用データ
        */
        function csv($shop_id){
            $this->db->select(
                "cus_id AS 顧客ID,
                cus_name AS 名前,
                cus_kana AS フリガナ,
                CASE cus_gender
                    WHEN 0 THEN '男性'
                    WHEN 1 THEN '女性'
                    ELSE '不明'
                END AS 性別,
                cus_birth AS 生年月日,
                cus_tel AS TEL,
                cus_mail AS Eメール,
                CASE cus_magazine
                    WHEN 0 THEN '不要'
                    WHEN 1 THEN '希望'
                    ELSE '不明'
                END AS メルマガ,
                cus_makedate AS 登録日"
            );
            $csv = $this->db->get_where('customer',array('cus_shopid' => $shop_id, "cus_del" => 0));
            return $csv;
        }

        /*
        メルマガ用宛先収集
        */
        function tomails($shop_id){
            $this->db->select("cus_mail");
            $cus_mail = $this->db->get_where('customer',array('cus_shopid' => $shop_id, 'cus_magazine' => 1));
            $cus_mail = $cus_mail->result("array");
            return $cus_mail;
        }
    }
