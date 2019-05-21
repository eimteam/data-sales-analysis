<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 售罄率控制器
 * 
 */
class sold_out extends BASE_Controller {
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
		$data['checkmenu']='sold_out_index';
		//页面需要加载的js文件
		$data['load_js']=["/js/plugins/chartJs/Chart.min.js","/js/demo/chartjs-demo.js"];
		//输出页面
		$this->display('sold_out/index',$data);
	}	
}
