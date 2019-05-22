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
		//创建测试数据
		echo $this->installModel->create_testdata();
	}
	/**
	 * 登录验证
	 * @return [type] [description]
	 */
	public function authlogin(){
		if (!IS_POST) {			
			return header('location:/home/index');	
		}
		$param=$this->input->post();
		$data=['shop_account'=>$param['shop_account'],'shop_password'=>$param['shop_password']];
		$rule=[];
		$result=$this->homeModel->login($data['shop_account'],$data['shop_password']);
		if($result){
			$this->session->set_userdata('userinfo',$result);	
			header('location:/main/index');					
		}else{
			header('location:/home/index');			
		}		
	}

	public function test(){
		print_r($_SESSION);
	}
	
}
