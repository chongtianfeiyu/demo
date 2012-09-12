<?php
class UserModel extends Model{
	protected $fields=array(
		'id',
		'username',
		'_pk'=>'id',
		'_autoinc'=>true
		);
		
	//读取
	public function SearchById($id){
		$map['id'] = $id;
		$result = $this->where($map)->find();
		return $result;
	}
	
	//添加
	public function AddUser($data){
		$result = $this->data($data)->add();
		return $result;
	}

	//读取
	public function AllUser(){
		$result = $this->select();
		return $result;
	}		
	
	//读取
	public function SearchByUsername($id){
		$map['username'] = $id;
		$result = $this->where($map)->find();
		return $result;
	}	
	
	public function DeleteById($uid){
		$map['id'] = $uid;
		$result = $this->where($map)->delete();
		return $result;
	}
}
?>