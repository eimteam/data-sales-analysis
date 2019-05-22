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
        //表单验证
        $this->load->library('form_validation');    
        $this->form_validation->set_rules($this->rules); 
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
		$result=$this->goodstypeModel->getGoodsType(['where'=>['shop_uid'=>$this->shopuid]]);
		$data['goodstypeData']=$result;			
		//输出页面
		$this->display('goodstype/index',$data);
	}
	public $rules=[
		 [
            'field' => 'gt_uid', 'label' => 'gt_uid', 'rules' => 'required|min_length[31]|max_length[32]',
         ],
	];
	/**
	 * 编辑页面
	 * @return [type] [description]
	 */
	public function editpage(){
		if(!$this->hash_auth('goodstype','edit')){
        	return $this->ajaxReturn(0,'您没有操作权限',0);
        }
		if(!IS_POST){
			return $this->ajaxReturn(0,'请使用POST提交',0);
		}		
		$this->form_validation->set_data($this->input->post());        
        if ($this->form_validation->run() == FALSE)
        {
            return $this->ajaxReturn(0, $this->form_validation->error_array(), 0);
        }

        //查询出大类的数据并交给页面		
		$result=$this->goodstypeModel->getGoodsType([
			'where'=>['gt_uid'=>$this->input->post('gt_uid')],
			'findone'=>1,
		]);
		$pagedata=['gt_data'=>$result];	//输出到页面上的值	
		$page=$this->load->view('goodstype/edit',$pagedata,true);
		return $this->ajaxReturn($page);
	}	
	/**
	 * 保存大类数据
	 * @return [type] [description]
	 */
	public function save_goodstype(){
		if(!IS_POST){
			return $this->ajaxReturn(0,'请使用POST提交',0);
		}	
		$param=$this->input->post();	
		$this->form_validation->set_data($param);        
        if ($this->form_validation->run() == FALSE)
        {
            return $this->ajaxReturn(0, $this->form_validation->error_array(), 0);
        }
        $where=['gt_uid'=>$param['gt_uid']];
        $result=$this->goodstypeModel->saveGoodsType($where,$param);
		return $this->ajaxReturn($result);
	}
}
