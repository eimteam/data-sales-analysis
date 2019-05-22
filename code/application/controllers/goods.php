<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 款号控制器
 * 
 */
class goods extends BASE_Controller {
	public function __construct()
    {
        parent::__construct();
    } 
	/**
	 * Sold out green
	 * 首页
	 * @return [type] [description]
	 */
	public function index()
	{
		$data=[];
		//选中的菜单项
		$data['checkmenu']='goods_index';
		//页面需要加载的js文件
		$data['load_css']=[
			"/css/plugins/footable/footable.core.css"
		];
		$data['load_js']=[
			"/js/plugins/footable/footable.all.min.js",
			"/application/js/website.goods.js"
		];
		//输出页面
		$this->display('goods/index',$data);
	}	
}
