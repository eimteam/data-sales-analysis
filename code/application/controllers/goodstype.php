<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 大类控制器
 * 
 */
class goodstype extends BASE_Controller {
	public function __construct()
    {
        parent::__construct();
        $this->load->model('goodstypeModel');
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
		$data['checkmenu']='goodstype_index';
		$data['load_css']=[
			"/css/plugins/dataTables/datatables.min.css",
			"/css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css"
		];
		//页面需要加载的js文件
		$data['load_js']=[
			"/js/plugins/dataTables/datatables.min.js",			
			"/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js",
			'/application/js/website.goodstype.js',
		];
		//查询出大类的数据并交给页面		
		$result=$this->goodstypeModel->getGoodsType(['shop_uid'=>$this->shopuid]);
		$data['goodstypeData']=$result;		
		//输出页面
		$this->display('goodstype/index',$data);
	}	

	public function getdata(){
		$result=$this->goodstypeModel->getGoodsType(['shop_uid'=>$this->shopuid]);
		$data=[];
		$data['code']=0;
		$data['msg']='';
		$data['count']=count($result);
		$data['data']=$result;
		return $this->ajaxReturn($data);
	}

	public function editpage(){
		$page=$this->load->view('goodstype/edit','',true);
		return $this->ajaxReturn($page);
	}	
}
