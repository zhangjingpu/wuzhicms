<?php
// +----------------------------------------------------------------------
// | wuzhicms [ 五指互联网站内容管理系统 ]
// | Copyright (c) 2014-2015 http://www.wuzhicms.com All rights reserved.
// | Licensed ( http://www.wuzhicms.com/licenses/ )
// | Author: wangcanjia <phpip@qq.com>
// +----------------------------------------------------------------------
defined('IN_WZ') or exit('No direct script access allowed');
/**
 * 内容模版，标签解析
 */
class WUZHI_guestbook_template_parse {
	public $number = 0;//初始化查询总数
	public $pages = '';//分页
    public function __construct() {
        $this->db = load_class('db');
    }
    /**
     * 列表标签
     *
     * @param $c
     * @return array
     */
    public function listing($c) {
        $where = $c['status'];
        /*
        if(isset($c['id'])) {
            $id = intval($c['id']);
            $where = '`id`='.$id;
        } else {
            $where = '';
        }
        */
        $order = isset($c['order']) ? $c['order'] : 'id DESC';
        $result = $this->db->get_list('guestbook', $where, '*', $c['start'], $c['pagesize'], 0,$order);
        $this->number = $this->db->number;
        $GLOBALS['pagesize'] = $c['pagesize'];
        $GLOBALS['pages'] = 1;
        if($c['page']) {
            $this->pages = $this->db->pages;
            $GLOBALS['pages'] = $this->pages;
        }
        return $result;
	}
}