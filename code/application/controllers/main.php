<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class main extends BASE_Controller {
	public function __construct()
    {
        parent::__construct();
    } 
	/**
	 * 首页
	 * @return [type] [description]
	 */
	public function index()
	{
		$data=[];
		$data['checkmenu']='shouye';
		$this->display('main/index',$data);
	}	
}
