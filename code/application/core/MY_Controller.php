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
    public function ajaxReturn($data, $info = [], $status = 0, $type='json') {
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
