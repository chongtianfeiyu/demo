<?php
class TasktmpModel extends Model{
	protected $fields=array(
		'id',
		'uid',
		'tid',
		'isright',
		'myanswer',
		'_pk'=>'id',
		'_autoinc'=>true
	);
	
	//删除
	public function DeleteById($uid){
		$map['uid'] = $uid;
		$result = $this->where($map)->delete();
		return $result;
	}
	//
	public function Instert($data){
		$result = $this->data($data)->add();
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

}
?>