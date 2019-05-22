<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 初始化数据库
 */
class goodstypeModel extends MY_Model
{
    function __construct()
    {
        parent::__construct();
        //数据库表名称
        $this->tableName="goodstype";
    }   
    /**
     * [getGoodsType 获取大类数据]
     * @param  [type] $param [description]
     *                       where => [] 自定义的where查询
     *                       select=> " * "  如果有过滤字段,默认查询全部
     *                       findone=> true / false 只取1条
     * @return [type]        [description]
     */
    public function getGoodsType($param=[]){
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
     * [saveGoodType 保存数据]
     * @param  [type] $where [where条件]
     * @param  [type] $value [value更新内容]
     * @return [type]        [受影响的行数]
     */
    public function saveGoodsType($where,$value){
        return $this->db->where($where)->update($this->tableName,$value);
    }
}