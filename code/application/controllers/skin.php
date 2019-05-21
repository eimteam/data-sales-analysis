<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *主页面主题配置 防止在其他地方调用报错,专门写了个控制器
 */
class skin extends BASE_Controller {
	public function __construct()
    {
        parent::__construct();
    } 
	/**
	 * [主页面配置]
	 * @return [type] [description]
	 */
	public function index()
	{
		$this->skin();
	}
}
