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
        //载入了对应的Model
        $this->load->model('goodsModel','Model');   
        //表单验证
        $this->load->library('form_validation');  
        //预先载入验证规则,如果规则有变更可在方法内再次载入  
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
     * 专门针对datatables的查询方法--重写
     * ajax get参数请参考
     * http://www.datatables.club/example/server_side/simple.html
     * @return [type] [description]
     */
    public function get_datatable_data(){       
        $getData=$this->input->get();//拿到GET参数          
        //这里加入join操作
		$getData['_join']=[
        	['goodstype','goodstype.gt_uid=goods.gt_uid','left'],
        ]; 
		//这里加入select
		$getData['_select']='goods.*,goodstype.gt_name'; 
        $this->Model->dataTables($getData);
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
		$data['checkmenu']='goods_index';
		if(!$this->hash_auth('goods','list')){
			return $this->display('sys/401',$data);        	
        }
		//页面需要加载的js文件		
		$data['load_css']=[
			"/css/plugins/dataTables/datatables.min.css",
			"/css/plugins/chosen/bootstrap-chosen.css",
			"/css/plugins/touchspin/jquery.bootstrap-touchspin.min.css"
		];
		//页面需要加载的js文件
		$data['load_js']=[
			"/js/plugins/dataTables/datatables.min.js",
			"/js/plugins/chosen/chosen.jquery.js",		
			"/js/plugins/touchspin/jquery.bootstrap-touchspin.min.js",
			'/application/js/website.goods.js',
		];	
		//输出页面
		$this->display('goods/index',$data);
	}	
	/**
	 * 获取货号 返回给page
	 * @return [type] [description]
	 */
	public function getData(){
		$result = $this->Model->selectData(array('where'=>['shop_uid'=>$this->shopuid]));
		return $this->ajaxReturn($result);
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
        $pagedata=[];
        //获取大类
		$this->load->model('goodstypeModel');
		$pagedata['typedata']=$this->goodstypeModel->selectData(array('where'=>['shop_uid'=>$this->shopuid]));
		$page=$this->load->view('goods/edit',$pagedata,true);
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
		//获取大类
		$this->load->model('goodstypeModel');
		$pagedata['typedata']=$this->goodstypeModel->selectData(array('where'=>['shop_uid'=>$this->shopuid]));
		$page=$this->load->view('goods/edit',$pagedata,true);
		return $this->ajaxReturn($page);
	}
	/**
	 * [add_goods 新增]
	 */
	public function add_goods(){
		if(!IS_POST){
			return $this->ajaxReturn(0,'请使用POST提交',0);
		}	
		if(!$this->hash_auth('goods','save')){
        	return $this->ajaxReturn(0,'您没有操作权限',0);
        }
		$param=$this->input->post();	
		$param['go_uid']=md5($param['gt_uid'].md5(time()).$this->shopuid);
		$param['shop_uid']=$this->shopuid;
		$this->form_validation->set_data($param);        
        if ($this->form_validation->run() == FALSE)
        {
            return $this->ajaxReturn(0, $this->form_validation->error_array(), 0);
        }        
        $result['data']=$this->Model->addData($param);
        $result['go_uid']=$param['go_uid'];
		return $this->ajaxReturn($result);
	}
	/**
	 * 保存数据
	 * @return [type] [description]
	 */
	public function save_goods(){		
		if(!IS_POST){
			return $this->ajaxReturn(0,'请使用POST提交',0);
		}	
		if(!$this->hash_auth('goods','save')){
        	return $this->ajaxReturn(0,'您没有操作权限',0);
        }
		$param=$this->input->post();	
		$this->form_validation->set_data($param);        
        if ($this->form_validation->run() == FALSE)
        {
            return $this->ajaxReturn(0, $this->form_validation->error_array(), 0);
        }
        $where=['go_uid'=>$param['go_uid'],'shop_uid'=>$this->shopuid];
        $result=$this->Model->saveData($where,$param);
		return $this->ajaxReturn($result);
	}	
}