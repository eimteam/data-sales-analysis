<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 初始化数据库
 */
class installModel extends MY_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    //数据库表
    private $tables=[
        'shoplist',//店铺表
        'staff',//员工表
        'systting',//系统设置表
        'goodstype',//货品大类表
        'goods',//货号表
        'inventory',//库存表
        'inventoryorder',//入库表
        'inventoryorder_item',//入库明细表
        'outboundorder',//出库表（销售日报）
        'outboundorder_item',//出库明细表
    ];
    /**
     * 创建测试店铺
     * @return [type] [description]
     */
    public function create_testdata(){
        $shop=[];
        $shop['shop_account']='test';
        $shop['shop_uid']=md5(md5(time()).$shop['shop_account']);
        $shop['shop_password']='shop_'.md5('123456');
        $shop['shop_name']='TestShop';
        
        $goodstype=[];
        foreach (['短袖T恤','长袖T恤','休闲短衬','休闲长衬','牛仔外套','防晒衣','休闲短款夹克','休闲长款风衣'] as $value) {
            array_push($goodstype,[
              'shop_uid'=>$shop['shop_uid'],
              'gt_uid'=>md5(md5(time()).$value),
              'gt_name'=>$value,
              'gt_size'=>'M,L,XL,2XL,3XL,4XL,5XL,6XL,7XL,8XL',
              'gt_color'=>'白色,黑色,军绿色,黄色',
              'gt_data'=>''
            ]);
        }
        $goods=[];
        foreach (['1','2','3','4'] as $value) {
            array_push($goods,[
              'shop_uid'=>$shop['shop_uid'],
              'go_uid'=>md5(md5(time()).$value),
              'go_code'=>$value,
              'go_name'=>$value,
              'gt_uid'=>md5(md5(time()).$value),
              'first_time'=>date("Y-m-d h:i:s",time()),
              'last_time'=>date("Y-m-d h:i:s",time()),
            ]);
        }
        $this->db->insert('shoplist',$shop);
        $this->db->insert_batch('goodstype',$goodstype);
        $this->db->insert_batch('goods',$goods);
    }
    /**
     * 初始化数据库
     * 如果表不存在则创建新表
     * @return [type] [description]
     */
    function initdb(){    	
    	foreach ($this->tables as $table) {
    		if(!$this->db->table_exists($table)){    			
    			@call_user_func([$this,'create_'.$table]);
                echo 'create '.$table.'<br/>';
			}
    	}		
    }    
    /**
     * 创建shoplist
     * @return [type] [description]
     */
    private function create_shoplist(){
    	$sql="CREATE TABLE `shoplist` (
			  `shop_uid` varchar(32) NOT NULL,
			  `shop_account` varchar(45) NOT NULL,
			  `shop_password` varchar(125) NOT NULL,
			  `shop_name` varchar(45) NOT NULL,
			  `shop_address` varchar(255) DEFAULT NULL,
        `sort` int(10) NOT NULL DEFAULT '0',
			  PRIMARY KEY (`shop_uid`),
			  UNIQUE KEY `shop_account` (`shop_account`) USING HASH
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;";		
  		if (! $res = $this->db->query($sql)) {
  			echo 'create_table_failure shoplist';die;
  		}
    }
    private function create_staff(){
        $sql="CREATE TABLE `staff` (
              `st_uid` varchar(32) NOT NULL,
              `shop_uid` varchar(32) NOT NULL,
              `shop_account` varchar(32) NOT NULL,
              `st_name` varchar(32) NOT NULL,
              `st_pwd` varchar(32) NOT NULL,
              `st_month_task` int(11) NOT NULL DEFAULT '10000',
              `st_phone` varchar(32) DEFAULT NULL,
              `st_enable` tinyint(1) NOT NULL DEFAULT '1',
              `sort` int(10) NOT NULL DEFAULT '0',
              PRIMARY KEY (`st_uid`),
              UNIQUE KEY `shop_uid` (`shop_uid`,`shop_account`) USING HASH
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";     
        if (! $res = $this->db->query($sql)) {
            echo 'create_table_failure shoplist';die;
        }
    }
    private function create_systting(){
        $sql="CREATE TABLE `systting` (
              `sys_uid` varchar(32) NOT NULL,
              `shop_uid` varchar(32) NOT NULL,
              `sys_key` varchar(32) NOT NULL DEFAULT '',
              `sys_value` text NOT NULL,
              `sort` int(10) NOT NULL DEFAULT '0',
              PRIMARY KEY (`sys_uid`),
              UNIQUE KEY `shop_uid` (`shop_uid`,`sys_key`) USING HASH
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";     
        if (! $res = $this->db->query($sql)) {
            echo 'create_table_failure systting';die;
        }
    }
    private function create_goodstype(){
        $sql="CREATE TABLE `goodstype` (
              `shop_uid` varchar(32) NOT NULL,
              `gt_uid` varchar(32) NOT NULL,
              `gt_name` varchar(32) NOT NULL,
              `gt_size` text NOT NULL,
              `gt_color` text NOT NULL,
              `gt_data` text,
              `sort` int(10) NOT NULL DEFAULT '0',
              PRIMARY KEY (`gt_uid`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";     
        if (! $res = $this->db->query($sql)) {
            echo 'create_table_failure goodstype';die;
        }
    }
    private function create_goods(){
        $sql="CREATE TABLE `goods` (
              `shop_uid` varchar(32) NOT NULL,
              `go_uid` varchar(32) NOT NULL,
              `go_code` varchar(32) NOT NULL,
              `go_name` varchar(32) NOT NULL,
              `go_price1` decimal(10,2) NOT NULL DEFAULT '0.00',
              `go_price2` decimal(10,2) NOT NULL DEFAULT '0.00',
              `go_price3` decimal(10,2) NOT NULL DEFAULT '0.00',
              `go_discount` decimal(5,2) NOT NULL DEFAULT '0.00',
              `gt_uid` varchar(32) NOT NULL,
              `sort` int(10) NOT NULL DEFAULT '0',
              `enable` int(10) NOT NULL DEFAULT '1',
              `first_time` datetime,
              `last_time` datetime,
              `in_count` int(10) NOT NULL DEFAULT '0',
              `sell_count` int(10) NOT NULL DEFAULT '0',
              `return_count` int(10) NOT NULL DEFAULT '0',
              `count` int(10) NOT NULL DEFAULT '0',
              PRIMARY KEY (`go_uid`),
              UNIQUE KEY `shop_uid` (`shop_uid`,`go_code`) USING HASH
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";     
        if (! $res = $this->db->query($sql)) {
            echo 'create_table_failure goods';die;
        }
    }
    private function create_inventory(){
        $sql="CREATE TABLE `inventory` (
              `in_uid` varchar(32) NOT NULL,
              `shop_uid` varchar(32) NOT NULL,
              `go_uid` varchar(32) NOT NULL,
              `in_count` int(11) NOT NULL DEFAULT '0',
              `in_item` text NOT NULL,
              `gt_uid` varchar(32) NOT NULL,
              `in_createtime` int(11) NOT NULL DEFAULT '0',
              `in_lasttime` int(11) NOT NULL DEFAULT '0',
              `in_ref_ino_uid` text NOT NULL,
              `in_allcount` int(11) NOT NULL DEFAULT '0',
              `in_outcount` int(11) NOT NULL DEFAULT '0',
              `in_lasttime_out` int(11) NOT NULL DEFAULT '0',
              `sort` int(10) NOT NULL DEFAULT '0',
              PRIMARY KEY (`in_uid`),
              UNIQUE KEY `shop_uid` (`shop_uid`,`go_uid`) USING HASH
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";     
        if (! $res = $this->db->query($sql)) {
            echo 'create_table_failure inventory';die;
        }
    }
    private function create_inventoryorder(){
        $sql="CREATE TABLE `inventoryorder` (
              `shop_uid` varchar(32) NOT NULL,
              `ino_uid` varchar(32) NOT NULL,
              `ino_code` varchar(255) NOT NULL DEFAULT '',
              `ino_count` int(11) NOT NULL DEFAULT '0',
              `ino_createtime` int(11) NOT NULL DEFAULT '0',
              `ino_remark` varchar(32) DEFAULT NULL,
              `sort` int(10) NOT NULL DEFAULT '0',
              PRIMARY KEY (`ino_uid`),
              UNIQUE KEY `ino_code` (`ino_code`) USING BTREE
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";     
        if (! $res = $this->db->query($sql)) {
            echo 'create_table_failure inventoryorder';die;
        }
    }
    private function create_inventoryorder_item(){
        $sql="CREATE TABLE `inventoryorder_item` (
              `shop_uid` varchar(32) NOT NULL,
              `ino_uid` varchar(32) NOT NULL,
              `item_uid` varchar(32) NOT NULL,
              `go_uid` varchar(32) NOT NULL,
              `go_code` varchar(32) NOT NULL,
              `gt_uid` varchar(32) NOT NULL,
              `go_name` varchar(32) NOT NULL,
              `go_price3` decimal(10,2) NOT NULL DEFAULT '0.00',
              `item_count` int(11) NOT NULL DEFAULT '0',
              `item_size` text NOT NULL,
              `item_remark` varchar(32) DEFAULT NULL,
              `sort` int(10) NOT NULL DEFAULT '0',
              PRIMARY KEY (`item_uid`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";     
        if (! $res = $this->db->query($sql)) {
            echo 'create_table_failure inventoryorder_item';die;
        }
    }
    private function create_outboundorder(){
        $sql="CREATE TABLE `outboundorder` (
              `outo_uid` varchar(32) NOT NULL,
              `shop_uid` varchar(32) NOT NULL,
              `outo_code` varchar(32) NOT NULL,
              `go_count` int(11) NOT NULL DEFAULT '0',
              `go_price` decimal(10,2) NOT NULL DEFAULT '0.00',
              `st_uid` varchar(32) NOT NULL,
              `outo_createtime` int(11) NOT NULL DEFAULT '0',
              `outo_remark` varchar(32) DEFAULT NULL,
              `sort` int(10) NOT NULL DEFAULT '0',
              PRIMARY KEY (`outo_uid`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";     
        if (! $res = $this->db->query($sql)) {
            echo 'create_table_failure outboundorder';die;
        }
    }
    private function create_outboundorder_item(){
        $sql="CREATE TABLE `outboundorder_item` (
              `outo_uid` varchar(32) NOT NULL,
              `oitem_uid` varchar(32) NOT NULL,
              `go_uid` varchar(32) NOT NULL,
              `go_code` varchar(32) NOT NULL,
              `go_price` decimal(10,2) NOT NULL DEFAULT '0.00',
              `go_item` text NOT NULL,
              `outo_remark` varchar(32) DEFAULT NULL,
              `sort` int(10) NOT NULL DEFAULT '0',
              PRIMARY KEY (`oitem_uid`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";     
        if (! $res = $this->db->query($sql)) {
            echo 'create_table_failure outboundorder_item';die;
        }
    }
}