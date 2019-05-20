<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home extends PUBLIC_CONTROLLER {
	public function __construct()
    {
        parent::__construct();
        $this->load->model('homeModel');

    }   
	/**
	 * 登录页面
	 */
	public function index()
	{
		$this->load->view('home/login');
	}
	/**
	 * 初始化数据库
	 * @return [type] [description]
	 */
	public function initdb(){
		$this->load->model('installModel');
		$this->installModel->initdb();
		//创建测试账号
		echo $this->installModel->create_testshop();
	}
	/**
	 * 登录验证
	 * @return [type] [description]
	 */
	private function login(){
		if (!IS_POST) {
			return $this->index();
		}
		$param=$this->input->post();
		$data=['shop_account'=>$param['shop_account'],'shop_password'=>$param['shop_password']];
		$rule=[];
		$result=$this->homeModel->login($data['shop_account'],$data['shop_password']);
		if($result){
			$this->session->set_userdata('userinfo',$result);	
			$this->load->view('home/index');		
		}else{
			$this->index();
		}		
	}
	/**
	 * 主页面
	 * @return [type] [description]
	 */
	public function main(){
		$this->login();		
	}
}
