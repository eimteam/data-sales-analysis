<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class MY_Model 所有 Models 的基类
 */
class MY_Model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->tableName=null;
        //自动载入数据库
        $this->load->database();
    }
    /**
     * 专门针对datatables的查询方法
	 * ajax get参数请参考
	 * http://www.datatables.club/example/server_side/simple.html
     * @param  [type] $getData [表格自动请求来的参数]
     * @return [type]          [description]
     */
    public function dataTables($getData){
    	if($this->tableName==null){
    		$result=['draw'=>2,'recordsFiltered'=>0,'recordsTotal'=>0,'data'=>[]];
    		echo json_encode($result);
    		log_message('error','dataTables方法 Error,未指定table名称');
    		die;
    	}
    	log_message('debug','SearchTable:'.$this->tableName.'dataTables:'.print_r($getData,true));	
        $where=[$this->tableName.'.shop_uid'=>$this->shopuid]; 
    	//表的总记录数 必要
		$recordsTotal = $this->db->where($where)->count_all_results($this->tableName);    	   	
    	$this->db->where($where);
		//排序		
		$order_column_index =intval($getData['order']['0']['column']);//那一列排序，从0开始
		$order_dir = $getData['order']['0']['dir'];//ase desc 升序或者降序
		$order_column=$getData['columns'][$order_column_index]['data'];//要排序的列名
		$this->db->order_by($order_column,$order_dir);
		//搜索列		
		if ($getData['search']['value']) {	
			$this->db->group_start();		
			foreach($getData['columns'] as $item){
				if(!$item['searchable']){
					continue;//不参与搜索的列
				}
				$this->db->or_like($item['data'],$getData['search']['value']);
			}
			$this->db->group_end();	
		}
		//条件过滤后记录数 必要
		$recordsFiltered = $this->db->count_all_results($this->tableName,false);
        //join 操作，这个是根据逻辑特殊的控制器而设计
        if (isset($getData['_join'])) {
            foreach($getData['_join'] as $join){
                $this->db->join($join[0],$join[1],$join[2]);
            }
        }
        //select  这个是根据逻辑特殊的控制器而设计
        if (isset($getData['_select'])) {
            $this->db->select($getData['_select']);
        }       
		//分页
		$start = isset($getData['start'])?intval($getData['start']):0;//从多少开始
		$length = intval($getData['length']);//数据长度		
		if ($length>0) {
			$this->db->limit($length,$start);
		}
		$sql=$this->db->get_compiled_select();		
		log_message('debug',$sql);
		$draw=intval($getData['draw'])+1;
		$result=['draw'=>$draw,'recordsFiltered'=>$recordsFiltered,'recordsTotal'=>$recordsTotal];		
		$tb_data=$this->db->query($sql)->result_array();
		$result['data']=$tb_data;
		echo json_encode($result);
		die;//结束此后的运行
    }
    /**
     * [selectData 获取数据]
     * @param  [type] $param [description]
     *                       where => [] 自定义的where查询
     *                       select=> " * "  如果有过滤字段,默认查询全部
     *                       findone=> true / false 只取1条
     * @return [type]        [description]
     */
    public function selectData($param=[]){
        if (key_exists('select',$param)) {
            $this->db->select($param['select']);
        }
        if(key_exists('where',$param)) {
            $this->db->where($param['where']);
        }
        if (key_exists('findone',$param)&&$param['findone']) {
            return $this->db->get($this->tableName)->row_array();
        }        
        return $this->db->get($this->tableName)->result_array();
    }
    /**
     * [saveData 保存数据]
     * @param  [type] $where [where条件]
     * @param  [type] $value [value更新内容]
     * @return [type]        [受影响的行数]
     */
    public function saveData($where,$value){
        return $this->db->where($where)->update($this->tableName,$value);
    }
    /**
     * [addData 新增数据]
     * @param [type]  $value [新增的数据,如果是批量更新,value结构是二维数组]
     * @param boolean $batch [是否批量新增]
     */
    public function addData($value,$batch=false){
        if ($batch) {
            return $this->db->insert_batch($this->tableName,$value);
        }
        return $this->db->insert($this->tableName,$value);
    }
    /**
     * [delData 删除数据]
     * @param  [type] $where [description]
     * @return [type]        [description]
     */
    public function delData($where){
        return $this->db->where($where)->delete($this->tableName);
    }
}