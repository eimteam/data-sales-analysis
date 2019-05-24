<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 初始化数据库
 */
class homeModel extends MY_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }  

    /**
     * [用户登录]
     * @param  [type]  $account      [description]
     * @param  [type]  $pwd          [description]
     * @param  boolean $shop_account [false 表示店铺登录,否则值就是就是店铺账号，表示为员工登录]
     * @return [type]                [description]
     */
    public function login($account,$pwd,$shop_account=false){
        if ($shop_account===false) {
          return $this->db->where(['shop_account'=>$account,'shop_password'=>'shop_'.md5($pwd)])->get('shoplist')->row_array();
        }        
    }
    /**
     * 密码解锁
     * @param  [type] $pwd [description]
     * @return [type]      [description]
     */
    public function unlocked($pwd){        
        if (isset($_SESSION['userinfo']['shop_password'])&&'shop_'.md5($pwd)==$_SESSION['userinfo']['shop_password']) {
            return true;
        }
        if (isset($_SESSION['userinfo']['st_pwd'])&&'st_'.md5($pwd)==$_SESSION['userinfo']['st_pwd']) {
            return true;
        }
        return false;
    }
}