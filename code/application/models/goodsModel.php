<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 初始化数据库
 */
class goodsModel extends MY_Model
{
    function __construct()
    {
        parent::__construct();
        //数据库表名称
        $this->tableName="goods";
    } 
}