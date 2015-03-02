<?php
namespace Admin\model;
use Think\Model;

class NavModel extends Model{
    //获取导航菜单
    public function getNav($id = 0){
        $map['nid'] = $id;
        return $this->field('id, text, state, url, iconCls')->where($map)->select();
    }
}
