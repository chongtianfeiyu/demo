<?php
class TasklogModel extends Model{
	protected $fields=array(
		'id',
		'uid',
		'tid',
		'dotime',
		'righttime',
		'wrongtime',
		'issave',
		'iscool',
		'_pk'=>'id',
		'_autoinc'=>true
	);
	
	//添加
	public function AddTask($data){
		$result = $this->data($data)->add();
		return $result;
	}
	
	//添加
	public function MyTask($where){
		$result = $this->where($where)->count();
		return $result;
	}
	//从ID找出相应记录
	public function GetOne($id,$uid){
		$map['tid'] = $id;
		$map['uid'] = $uid;
		$result = $this->where($map)->find();
		return $result;
	}
	//更新
	public function UpdateByMap($map,$data){
		$result = $this->where($map)->save($data);
		return $result;
	}
	//删除
	public function DeleteById($uid){
		$map['uid'] = $uid;
		$result = $this->where($map)->delete();
		return $result;
	}
}
?>