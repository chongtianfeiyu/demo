<?php
class LabelModel extends Model{
	protected $fields=array(
	'id',
	'label',
	'_pk'=>'id',
	'_autoinc'=>true
	);
	
	//从ID找出相应记录
	public function GetOne($id){
		$map['id'] = $id;
		$result = $this->where($map)->find();
		return $result;
	}
	
	//找出所有记录
	public function GetAll(){
		$result = $this->where($map)->select();
		return $result;
	}
}
?>