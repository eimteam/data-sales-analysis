<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 初始化数据库
 */
class goodstypeModel extends MY_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }  
    /**
     * 获取大类数据
     * @param  [type] $where  [自定义的where查询]
     * @param  string $select [如果有过滤字段,默认查询全部]
     * @return [type]         [description]
     */
    public function getGoodsType($where,$select="*"){
        if ($select!="*") {
            $this->db->select($select);
        }
        $this->db->where($where);
        return $this->db->get('goodstype')->result_array();
    }
}