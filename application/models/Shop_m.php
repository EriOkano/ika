<?php
    class Shop_m extends CI_Model
    {
        function __construct(){
            //データベースへの接続(様式)
            parent::__construct();
            $this->load->database();
        }

        /*
        店舗ページの情報
        各店舗の情報を配列として返す
            ！引数として渡されたidで特定する
            ！マガジンのみ表示を変える
        */
        function shop_info($shop_id){
            $this->db->select(
                "mem_shopid,
                mem_name,
                mem_kana,
                mem_tel,
                mem_mail,
                CASE mem_magazine
                    WHEN 0 THEN '不要'
                    WHEN 1 THEN '希望'
                    ELSE '不明'
                END,
                mem_makedate"
            );
            $mem_one = $this->db->get_where('member',array('mem_shopid' => $shop_id));
            $mem_one = $mem_one->result("array");
            // var_dump($mem_one);
            // exit;
            return $mem_one;
        }

        /*
        全店舗の情報（管理者用）
        */
        function all_shop(){
            $this->db->select(
                "mem_shopid,
                mem_name,
                mem_kana,
                mem_tel,
                mem_mail,
                CASE mem_magazine
                    WHEN 0 THEN '不要'
                    WHEN 1 THEN '希望'
                    ELSE '不明'
                END,
                mem_makedate,
                mem_updatedate"
            );
            $this->db->order_by('mem_shopid', 'DESC');
            $all = $this->db->get_where('member',array('master' => 0,'mem_del' => 0));
            $all = $all->result('array');
            return $all;
        }

        /*
        店舗の削除処理（管理者用）
        */
        function delete($shop_id,$update){
            $this->db->trans_start();
            $data = array(
                "mem_del" => 1,
                "mem_updatedate" => $update
            );
            $this->db->where("mem_shopid",$shop_id);
            $result = $this->db->update('member', $data);
            //トランザクション終了
            $this->db->trans_complete();
            if($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        /*
        復活処理
        */
        function back($shop_id,$update){
            $data = array(
                "mem_del" => 0,
                "mem_updatedate" => $update
            );
            $this->db->where("mem_shopid",$shop_id);
            $result = $this->db->update('member', $data);
            //トランザクション終了
            $this->db->trans_complete();
            if($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        /*
        削除店舗一覧（管理者用）
        */
        function del_shop(){
            $this->db->select(
                "mem_shopid,
                mem_name,
                mem_kana,
                mem_tel,
                mem_mail,
                CASE mem_magazine
                    WHEN 0 THEN '不要'
                    WHEN 1 THEN '希望'
                    ELSE '不明'
                END,
                mem_makedate,
                mem_updatedate"
            );
            $del_all = $this->db->get_where('member',array('master' => 0,'mem_del' => 1));
            $del_all = $del_all->result('array');
            return $del_all;
        }

        /*
        編集ページの情報
        もともと登録されている情報
        */
        function mem_edit($shop_id){
            $edit_data = $this->db->get_where('member',array('mem_shopid' => $shop_id));
            $edit_data = $edit_data->result("array");
            return $edit_data;
        }

        /*
        店舗登録情報の更新処理
            全要綱を更新
            登録日でなく更新日に時間を登録する
        */
        function mem_update($s_id,$s_name,$s_kana,$s_tel,$s_mail,$s_maga,$s_pass,$edit_time){
            $this->db->trans_start();
                $datas = array(
                    "mem_name" => $s_name,
                    "mem_kana" => $s_kana,
                    "mem_tel" => $s_tel,
                    "mem_mail" => $s_mail,
                    "mem_magazine" => $s_maga,
                    "mem_password" => $s_pass,
                    "mem_updatedate" => $edit_time
                );
                $this->db->where("mem_shopid",$s_id);
                $result = $this->db->update('member', $datas);
                $this->db->trans_complete();
                if($this->db->trans_status() === FALSE){
                    return FALSE;
                }else{
                    return TRUE;
                }
            }

            function csv(){
                $this->db->select(
                    "mem_shopid AS 店舗ID,
                    mem_name AS 登録店舗名,
                    mem_kana AS フリガナ,
                    mem_tel AS 電話番号,
                    mem_mail AS メールアドレス,
                    CASE mem_magazine
                        WHEN 0 THEN '不要'
                        WHEN 1 THEN '希望'
                        ELSE '不明'
                    END AS メルマガ配信,
                    mem_makedate AS 登録日,
                    mem_updatedate AS 更新日"
                );
                $csv = $this->db->get_where('member',array("mem_del" => 0, "master" => 0));
                return $csv;
            }

            /*
            メルマガ用
            …店舗名を取得する
            */
            function send_name($shop_id){
                $this->db->select("mem_name");
                $mem_name = $this->db->get_where('member',array('mem_shopid' => $shop_id));
                $mem_name = $mem_name->result("array");
                return $mem_name;
            }
    }