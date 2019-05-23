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
        $this->load->model('goodsModel','Model');   
        //表单验证
        $this->load->library('form_validation');    
        $this->form_validation->set_rules($this->rules); 
    } 
    public $rules=[
		 [
            'field' => 'go_uid', 'label' => '款号UID', 'rules' => 'required|min_length[31]|max_length[32]',
         ],[
            'field' => 'shop_uid', 'label' => '店铺UID', 'rules' => 'min_length[31]|max_length[32]',
         ],[
            'field' => 'go_code', 'label' => '货号', 'rules' => 'max_length[50]',
         ],[
            'field' => 'go_name', 'label' => '品名', 'rules' => 'max_length[100]',
         ],[
            'field' => 'go_price1', 'label' => '零售价', 'rules' => 'numeric',
         ],[
            'field' => 'go_price2', 'label' => '会员价', 'rules' => 'numeric',
         ],[
            'field' => 'go_price3', 'label' => '成本价', 'rules' => 'numeric',
         ],[
            'field' => 'gt_uid', 'label' => '大类UID', 'rules' => 'required|min_length[31]|max_length[32]',
         ],[
            'field' => 'sort', 'label' => '排序', 'rules' => 'is_natural',
         ],
	];
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
		if(!$this->hash_auth('goods','list')){
			return $this->display('sys/401',$data);        	
        }
		//页面需要加载的js文件		
		$data['load_css']=[
			"/css/plugins/dataTables/datatables.min.css",
			"/css/plugins/select2/select2.min.css",
			"/css/plugins/touchspin/jquery.bootstrap-touchspin.min.css"
		];
		//页面需要加载的js文件
		$data['load_js']=[
			"/js/plugins/dataTables/datatables.min.js",	
			"/js/plugins/select2/select2.full.min.js",		
			"/js/plugins/touchspin/jquery.bootstrap-touchspin.min.js",
			'/application/js/website.goods.js',
		];	
		//输出页面
		$this->display('goods/index',$data);
	}	
	/**
	 * 新增页面
	 * @return [type] [description]
	 */
	public  function addpage(){		
		if(!IS_POST){
			return $this->ajaxReturn(0,'请使用POST提交',0);
		}
		if(!$this->hash_auth('goods','add')){
        	return $this->ajaxReturn(0,'您没有操作权限',0);
        }
		$page=$this->load->view('goods/edit','',true);
		return $this->ajaxReturn($page);
	}	
	/**
	 * 编辑页面
	 * @return [type] [description]
	 */
	public function editpage(){	
		if(!IS_POST){
			return $this->ajaxReturn(0,'请使用POST提交',0);
		}	
		if(!$this->hash_auth('goods','edit')){
        	return $this->ajaxReturn(0,'您没有操作权限',0);
        }	
		$this->form_validation->set_data($this->input->post());        
        if ($this->form_validation->run() == FALSE)
        {
            return $this->ajaxReturn(0, $this->form_validation->error_array(), 0);
        }
        //查询出大类的数据并交给页面		
		$result=$this->Model->selectData([
			'where'=>['go_uid'=>$this->input->post('go_uid')],
			'findone'=>1,
		]);
		$pagedata=['go_data'=>$result];	//输出到页面上的值	
		$page=$this->load->view('goods/edit',$pagedata,true);
		return $this->ajaxReturn($page);
	}
}
