<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
PUBLIC_CONTROLLER
控制器基类
不需要登录验证
 */
class PUBLIC_CONTROLLER extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
    }  

    /**
     * 返回数据到前端JS
     * @param  [type]  $data   [description]
     * @param  [type]  $info   [description]
     * @param  integer $status [description]
     * @param  string  $type   [description]
     * @return [type]          [description]
     */
    public function ajaxReturn($data, $info = [], $status = 1, $type='json') {
		$ret =[
			'data' => $data,
			'info' => $info,
			'status' => $status
		];
		if( 'jsonp' == $type ) {
			// @TODO: 支持 jsonp ...
		}
		else if( 'xml' == $type ) {
			// @TODO: 支持 xml ...
		}
		else {
			// 默认 json
			// 注意 json_encode 处理较大数据时会有问题
			echo json_encode($ret);
		}
	}
}
/**
 * 验证身份的基类
 */
class BASE_Controller extends PUBLIC_CONTROLLER{
	public function __construct()
    {
        parent::__construct();
        //当前店铺的uid
        $this->shopuid=$this->get_shopuid();
        
    } 

    /**
     * 验证权限是否合法
     * @param  [type] $groupName    [控制器页面权限名称]
     * @param  [type] $authName [页面操作权限名称]
     * @return [type]           [true 存在 false不存在]
     */
    public function hash_auth($groupName,$authName){
        //这里的权限在用户登录成功后进行缓存
        $group=[
            'goodstype'=>[
                'child'=>['list','edit','delete','add']
            ]
        ];
        return key_exists($groupName,$group) && in_array($authName,$group[$groupName]['child']);        
    }
    /**
     * 获取当前店铺的uid
     * @return [type] [description]
     */
    public function get_shopuid(){
        return $this->session->userdata('userinfo')['shop_uid'];
    }
    /**
     * 皮肤配置页面
     * @return [type] [description]
     */
    public function skin(){
        $this->load->view('sys/skin-config');
    } 
    /**
     * 基类封装输出页面函数
     * @param  [type] $page [页面路径]
     * @return [type]       [description]
     */
    public function display($page,$data=[]){   
        //将this变量传入到view中,以便view调用controller的方法
        $data['controller']=$this;
        $this->set_menu_page($data);     
        //头部
        $this->template->set(
            'main_top', 
            $this->load->view('sys/top','',true));  
        $this->template->load('sys/index',$page,$data);
    }
    /**
     * 生成左侧菜单
     * @param [type] &$data [需要传递给页面上的数组,指针方式传递,慎用]
     */
    private function set_menu_page(&$data){
        $_menu=$this->getmenu();       
        //左侧菜单激活 
        if (empty($data['checkmenu'])) {
            //默认激活首页
            $data['checkmenu']='shouye'; 
        }
        //导航栏上要显示的菜单名称
        $data['navname']=$data['checkmenu'];
        $data['nav_g_name']=$data['navname'];    
        //分组页面
        $data['parentmenu']=array_keys($_menu)[0];//默认选中第一个
        foreach ($_menu as $key => $value) {
            if (isset($value['child'])&&in_array($data['checkmenu'],array_keys($value['child']))) {
                $data['parentmenu']=$key;
                //拼接一下标题
                $data['main_title']=$_menu[$key]['name'].'-'.$_menu[$key]['child'][$data['checkmenu']]['name'];   
                //导航栏上要显示的菜单名称
                $data['navname']=$_menu[$key]['child'][$data['checkmenu']]['name'];   
                $data['nav_g_name']=$_menu[$key]['name'];    
                break;
            }
        }
        //菜单 parentmenu标识选中的父级菜单  checkmenu 标识选中的子集菜单  页面上需要标记为选中状态
        $this->template->set('main_menu', 
            $this->load->view('sys/menu',
                            ['menu'=>$_menu,
                            'checkmenu'=>$data['checkmenu'],
                            'parentmenu'=>$data['parentmenu']],
                            true)
        ); 
    }
    
    /**
     * 获取当前用户的有效菜单
     * @return [type] [description]
     */
    private function getmenu(){
        $_menu= [
            'xiaoshou_menu'=>[
                'key'=>'xiaoshou_menu',//菜单唯一标识
                'name'=>'销售分析',//菜单名称
                'icon'=>'fa fa-th-large',//图标
                'href'=>'',//如果没有子菜单,直接跳转的URL
                'right_icon'=>'fa arrow',//菜单右侧 可以是下拉箭头 也可以是一个标签 label label-warning pull-right
                'right_icon_value'=>'',//菜单右侧 如果是一个标签,标签的值: 10、最新
                'child'=>[
                    'shouye'=>[
                        'name'=>'首页',//子菜单名称                    
                        'href'=>'/main/index',//子菜单URL
                    ],
                    'sold_out_index'=>[
                        'name'=>'售罄率',//子菜单名称                    
                        'href'=>'/sold_out/index',//子菜单URL
                    ],
                    'qushifenxi'=>[
                        'name'=>'趋势分析 ',//子菜单名称                    
                        'href'=>'',//子菜单URL
                    ],
                    'zhoufenxi'=>[
                        'name'=>'周分析 ',//子菜单名称                    
                        'href'=>'',//子菜单URL
                    ]
                ]
            ],
            'inventory_menu'=>[
                'key'=>'kucun_menu',//菜单唯一标识
                'name'=>'库存分析',//菜单名称
                'icon'=>'fa fa-bar-chart-o',//图标
                'href'=>'',//如果没有子菜单,直接跳转的URL
                'right_icon'=>'fa arrow',//菜单右侧 可以是下拉箭头 也可以是一个标签 label label-warning pull-right
                'right_icon_value'=>'',//菜单右侧 如果是一个标签,标签的值: 10、最新
                'child'=>[
                    'kucunzhoufenxi'=>[
                        'name'=>'周分析',//子菜单名称                    
                        'href'=>'',//子菜单URL                        
                    ],
                    'kufendanpinfenxi'=>[
                        'name'=>'单品分析 ',//子菜单名称                    
                        'href'=>'',//子菜单URL
                    ],
                    'inventory_index'=>[
                        'name'=>'库存查询 ',//子菜单名称                    
                        'href'=>'/inventory/index',//子菜单URL
                    ]
                ]
            ],
            'goods_menu'=>[
                'key'=>'goods_menu',//菜单唯一标识
                'name'=>'货品管理',//菜单名称
                'icon'=>'fa fa-bar-chart-o',//图标
                'href'=>'',//如果没有子菜单,直接跳转的URL
                'right_icon'=>'fa arrow',//菜单右侧 可以是下拉箭头 也可以是一个标签 label label-warning pull-right
                'right_icon_value'=>'',//菜单右侧 如果是一个标签,标签的值: 10、最新
                'child'=>[
                    'goods_index'=>[
                        'name'=>'款号管理',//子菜单名称                    
                        'href'=>'/goods/index',//子菜单URL                        
                    ],
                    'goodstype_index'=>[
                        'name'=>'大类管理 ',//子菜单名称                    
                        'href'=>'/goodstype/index',//子菜单URL
                    ]
                ]
            ]
        ]; 
        $this->session->set_userdata('sysmenu',$_menu);  
        return $_menu;     
    }    
}
