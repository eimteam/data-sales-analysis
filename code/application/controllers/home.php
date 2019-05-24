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
		//是否已登录
        if ($this->is_login()) {
            header('location:/main/index');	   
        }else{
        	$this->load->view('home/login');
        }
		
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

	/**
	 * 锁定页面
	 * @return [type] [description]
	 */
	public function userlocked(){		
		if ($this->is_login()){
			//标记为锁定状态
			$this->session->set_userdata('userlocked',true);
			$this->load->helper(array('form', 'url'));
			$this->load->view('sys/locksreen');
		}
		else{
			header('location:/home/index');
		}
	}
	/**
	 * 解锁
	 * @return [type] [description]
	 */
	public function userunlocked(){
        $this->load->library('form_validation');
        $this->form_validation->set_message('lsqunlocked','{field}不正确');        
        $this->form_validation->set_rules('pwd', '密码',[
        	'trim','required',
        	//自定义的规则名称,去调用了model中的验证方法
        	array('lsqunlocked', array($this->homeModel, 'unlocked'))
        ]);
        if ($this->form_validation->run() == FALSE)
        {
            return $this->load->view('sys/locksreen');
        }  
        unset($_SESSION['userlocked']);
		header('location:/main/index');		
	}
	/**
	 * 安全退出
	 * @return [type] [description]
	 */
	public function logout(){
		session_destroy();		
		header('location:/home/index');			
	}

	public function test(){
		print_r($_SESSION);
	}
	
}
