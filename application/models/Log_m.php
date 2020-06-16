<?php
    class Log_m extends CI_Model
    {
        function __construct(){
            //データベースへの接続(様式)
            parent::__construct();
            $this->load->database();
        }

        /*ログイン*/
        function login($logmail,$logpass){
            /*
            account確認の材料を取り出す
            メールが合っていれば
                OK => 削除フラグとパスワード
                NG => $mem_one[0]は空
            */
            $this->db->select("mem_password,mem_del");
            $mem_one = $this->db->get_where('member',array('mem_mail' => $logmail));
            $mem_one = $mem_one->result("array");
            /*
            account確認
                ①上記で返ってきた値が配列であるか
                ②mem_del（削除フラグ）が0であるか
                ③パスワードが合っているか
            */
            if(!empty($mem_one[0])){
                if($mem_one[0]['mem_del'] == 0){
                    /*
                    暗号化したパスワードを照合
                    =>各情報をcontrollerへ返す
                    */
                    $hash_pass =$mem_one[0]['mem_password'];
                    if(password_verify($logpass,$hash_pass)){
                        $this->db->select("mem_shopid,mem_name,mem_mail,master");
                        $logdata = $this->db->get_where('member', array('mem_mail' => $logmail));
                        $logdata = $logdata->result('array');
                        return $logdata;
                    }else{
                        return "error_pass";
                    }
                }else{
                    return "delete";
                }
            }
        }

        function forgot($logmail,$alt_pass,$up_time){
            $this->db->trans_start();
            $data = array(
                "mem_password" => $alt_pass,
                "mem_updatedate" => $up_time
            );
            $result = $this->db->update('member', $data, array('mem_mail' => $logmail));
            $this->db->trans_complete();
            if($this->db->trans_status() === FALSE){
                return FALSE;
            }else{
                return TRUE;
            }
        }

        //新規登録
        function entry_shop($s_name,$s_kana,$s_tel,$s_mail,$s_maga,$s_pass,$entry_time){
                // メールアドレスの重複を確認
                $this->db->select('count(*)');
                $this->db->where(array("mem_mail" => $s_mail));
                $same_mail = $this->db->get('member');
                $same_mail = $same_mail->result("array");
                $this->db->trans_start();
                if($same_mail[0]["count(*)"] == 0){
                    $data = array(
                        'mem_name' => $s_name,
                        'mem_kana' => $s_kana,
                        'mem_tel' => $s_tel,
                        'mem_mail' => $s_mail,
                        'mem_magazine' => $s_maga,
                        'mem_password' => $s_pass,
                        'mem_makedate' => $entry_time
                        );
                        $result = $this->db->insert('member', $data);
                        //トランザクション終了
                        $this->db->trans_complete();
                        // echo "ab";
                        //     exit;
                        return $result;
                }else{
                    return false;
                }
            }

        //新規登録後データ取得
        function new_info($shop_mail){
            $this->db->select(
                "mem_shopid,
                mem_name,
                mem_mail"
                );
            $mem_info = $this->db->get_where('member',array('mem_mail' => $shop_mail));
            $mem_info = $mem_info->result("array");
            return $mem_info;
        }
    }