<?php
class TikuModel extends Model{
	protected $fields=array(
		'id',
		'obj',
		'biztype0',
		'biztype1',
		'labelid',
		'level',
		'question',
		'questioninfo',
		'answer',
		'type',
		'_pk'=>'id',
		'_autoinc'=>true
	);
	
	//找出分类的总数
	public function GetCountById($id){
		$map['labelid'] = $id;
		$result = $this->where($map)->count();
		return $result;
	}
	
	//读取所有
	public function GetUserList(){
		$m = $this->field('id')->order('id asc')->select();
		return $m;
	}
	
	//从ID找出相应记录
	public function GetOne($id){
		$map['id'] = $id;
		$result = $this->where($map)->find();
		return $result;
	}
}
?>