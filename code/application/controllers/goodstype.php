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
        $this->load->model('goodstypeModel','Model');   
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
		if(!$this->hash_auth('goodstype','list')){
			return $this->display('sys/401',$data);        	
        }
		$data['load_css']=[
			"/css/plugins/dataTables/datatables.min.css",
			"/css/plugins/dataTables/datatables.min.css",
			"/css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css"
		];
		//页面需要加载的js文件
		$data['load_js']=[
			"/js/plugins/dataTables/datatables.min.js",		
			"/js/plugins/touchspin/jquery.bootstrap-touchspin.min.js",	
			"/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js",
			'/application/js/website.goodstype.js',
		];				
		//输出页面
		$this->display('goodstype/index',$data);
	}

	public $rules=[
		 [
            'field' => 'gt_uid', 'label' => '大类UID', 'rules' => 'required|min_length[31]|max_length[32]',
         ],[
            'field' => 'shop_uid', 'label' => '店铺UID', 'rules' => 'min_length[31]|max_length[32]',
         ],[
            'field' => 'gt_name', 'label' => '类别名称', 'rules' => 'max_length[50]',
         ],[
            'field' => 'gt_size', 'label' => '尺寸', 'rules' => 'max_length[100]',
         ],[
            'field' => 'gt_color', 'label' => '颜色', 'rules' => 'max_length[100]',
         ],[
            'field' => 'sort', 'label' => '排序', 'rules' => 'is_natural',
         ],
	];
	
	/**
	 * 编辑页面
	 * @return [type] [description]
	 */
	public function editpage(){	
		if(!IS_POST){
			return $this->ajaxReturn(0,'请使用POST提交',0);
		}	
		if(!$this->hash_auth('goodstype','edit')){
        	return $this->ajaxReturn(0,'您没有操作权限',0);
        }	
		$this->form_validation->set_data($this->input->post());        
        if ($this->form_validation->run() == FALSE)
        {
            return $this->ajaxReturn(0, $this->form_validation->error_array(), 0);
        }

        //查询出大类的数据并交给页面		
		$result=$this->Model->selectData([
			'where'=>['gt_uid'=>$this->input->post('gt_uid')],
			'findone'=>1,
		]);
		$pagedata=['gt_data'=>$result];	//输出到页面上的值	
		$page=$this->load->view('goodstype/edit',$pagedata,true);
		return $this->ajaxReturn($page);
	}
	/**
	 * 新增页面
	 * @return [type] [description]
	 */
	public  function addpage(){		
		if(!IS_POST){
			return $this->ajaxReturn(0,'请使用POST提交',0);
		}
		if(!$this->hash_auth('goodstype','add')){
        	return $this->ajaxReturn(0,'您没有操作权限',0);
        }
		$page=$this->load->view('goodstype/edit','',true);
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
		if(!$this->hash_auth('goodstype','save')){
        	return $this->ajaxReturn(0,'您没有操作权限',0);
        }
		$param=$this->input->post();	
		$this->form_validation->set_data($param);        
        if ($this->form_validation->run() == FALSE)
        {
            return $this->ajaxReturn(0, $this->form_validation->error_array(), 0);
        }
        $where=['gt_uid'=>$param['gt_uid']];
        $result=$this->Model->saveData($where,$param);
		return $this->ajaxReturn($result);
	}
	/**
	 * [add_goodstype 新增大类]
	 */
	public function add_goodstype(){
		if(!IS_POST){
			return $this->ajaxReturn(0,'请使用POST提交',0);
		}	
		if(!$this->hash_auth('goodstype','save')){
        	return $this->ajaxReturn(0,'您没有操作权限',0);
        }
		$param=$this->input->post();	
		$param['gt_uid']=md5(md5(time()).$this->shopuid);
		$param['shop_uid']=$this->shopuid;
		$this->form_validation->set_data($param);        
        if ($this->form_validation->run() == FALSE)
        {
            return $this->ajaxReturn(0, $this->form_validation->error_array(), 0);
        }        
        $result=$this->Model->addData($param);
		return $this->ajaxReturn($result);
	}
	/**
	 * [del_goodstype 删除大类]
	 * @return [type] [description]
	 */
	public function del_goodstype(){
		if(!IS_POST){
			return $this->ajaxReturn(0,'请使用POST提交',0);
		}	
		if(!$this->hash_auth('goodstype','delete')){
        	return $this->ajaxReturn(0,'您没有操作权限',0);
        }
		$param=$this->input->post();	
		$this->form_validation->set_data($param);        
        if ($this->form_validation->run() == FALSE)
        {
            return $this->ajaxReturn(0, $this->form_validation->error_array(), 0);
        }
        $where=['gt_uid'=>$param['gt_uid'],'shop_uid'=>$this->shopuid];
        $result=$this->Model->delData($where);
		return $this->ajaxReturn($result);
	}
}
