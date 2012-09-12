<?php
class TikuAction extends Action {
	public $pagenum=50;
	public function IniTikuList(){
		$type=$_GET['type'];
		$page=$_GET['page'];
		$uid=$_SESSION['Login_uid'];
		switch ($type) {//第一个tab第一列
			case '11':
				$sql="SELECT lee99_tiku.id FROM lee99_tiku WHERE lee99_tiku.type='判断'";
				break;
			case '12':
				$sql="SELECT lee99_tiku.id FROM lee99_tiku WHERE lee99_tiku.type='单选'";
				break;
			case '13':
				$sql="SELECT lee99_tiku.id FROM lee99_tiku WHERE lee99_tiku.type='多选'";
				break;
			case '31':
				$sql="SELECT lee99_tiku.id FROM lee99_tiku  JOIN lee99_tasklog ON lee99_tasklog.tid=lee99_tiku.id  WHERE lee99_tasklog.dotime=0 and lee99_tasklog.uid=$uid";
				break;
			case '41':
				$sql="SELECT lee99_tiku.id FROM lee99_tiku  JOIN lee99_tasklog ON lee99_tasklog.tid=lee99_tiku.id  WHERE lee99_tasklog.dotime>0 and lee99_tasklog.uid=$uid and lee99_tasklog.iscool=0 and lee99_tasklog.wrongtime>0";
				break;
			case '21':
				$sql="SELECT lee99_tiku.id FROM lee99_tiku  JOIN lee99_tasklog ON lee99_tasklog.tid=lee99_tiku.id  WHERE lee99_tasklog.issave=1 and lee99_tasklog.uid=$uid";
				break;
			case '22':
				$sql="SELECT lee99_tiku.id FROM lee99_tiku  JOIN lee99_tasklog ON lee99_tasklog.tid=lee99_tiku.id  WHERE lee99_tasklog.iscool=1 and lee99_tasklog.uid=$uid";
				break;
		}
		$limit=$this->getpagelimit($page);
		$dao=D();
		$rs=$dao->query($sql.$limit);
		//dump($rs);
		//exit;
		$list=$this->fomat($rs);
		$this->updatetiku($rs);
		exit(json_encode($list));
	}


	//获得详细的问题信息
	public function detail(){
		$uid=$_SESSION['Login_uid'];
		$id=$_GET['tid'];
		$Tiku=D('Tiku');
		$Tiku_rs=$Tiku->GetOne($id);
		$Tasktmp=D('Tasktmp');
		$Tasktmp_rs=$Tasktmp->GetOne($id,$uid);
		$Tasklog=D('Tasklog');
		$Tasklog_rs=$Tasklog->GetOne($id,$uid);
		$rs = array_merge($Tiku_rs,$Tasktmp_rs,$Tasklog_rs);
		exit(json_encode($rs));
	}
	//doiscool
	public function doiscool(){
		$uid=$_SESSION['Login_uid'];
		$tid=$_GET['tid'];
		$Tasklog=D('Tasklog');
		$rs=$Tasklog->GetOne($tid,$uid);
		if($rs['iscool']==1){
			$data['iscool']=0;
		}else{
			$data['iscool']=1;
		}
		$where['tid']=$tid;
		$where['uid']=$uid;
		$Tasklog->UpdateByMap($where,$data);
		echo $data['iscool'];
	}
	//doissave
	public function doissave(){
		$uid=$_SESSION['Login_uid'];
		$tid=$_GET['tid'];
		$Tasklog=D('Tasklog');
		$rs=$Tasklog->GetOne($tid,$uid);
		if($rs['issave']==1){
			$data['issave']=0;
		}else{
			$data['issave']=1;
		}
		$where['tid']=$tid;
		$where['uid']=$uid;
		$Tasklog->UpdateByMap($where,$data);
		echo $data['issave'];
	}

	public function getif(){
		$uid=$_SESSION['Login_uid'];
		$tid=$_GET['tid'];
		$answer=$_GET['an'];
		$where['tid']=$tid;
		$where['uid']=$uid;
		$Tiku=D('Tiku');
		$Tasklog=D('Tasklog');
		$Tasktmp=D('Tasktmp');
		$tk=$Tiku->GetOne($tid);
		$Tasklog->where($where)->setInc("dotime",1);
		if($tk['answer']==$answer){
			$Tasklog->where($where)->setInc("righttime",1);
			$rt='Y';
			$data2['isright']=1;
			$data2['myanswer']=$answer;
		}else{
			$Tasklog->where($where)->setInc("wrongtime",1);
			$rt='N';
			$data2['isright']=0;
			$data2['myanswer']=$answer;
		}
		$Tasktmp->UpdateByMap($where,$data2);
		echo $rt;
	}



	//算出分页的起始
	public function getpagelimit($page){
		$num=$this->pagenum;
		$start=(($page-1)*$num);
		$end=$num;
		return " LIMIT $start,$end ";
	}

	//格式化icon列表数据
	public function fomat($rs){
		foreach ($rs as $k=>$r){
			$ls[$k]['id']=$k+1;
			$ls[$k]['tid']=$r['id'];
		}
		return $ls;
	}

	//更新用户正在操作的题目
	public function updatetiku($rs){
		$uid=$_SESSION['Login_uid'];
		$Tasktmp=D('Tasktmp');
		$Tasktmp->DeleteById($uid);
		foreach ($rs as $r){
			//$ls[]=$r['id'];
			$data['uid']=$uid;
			$data['tid']=$r['id'];
			$Tasktmp->Instert($data);
		}
		//$tids=join(',',$ls);
		//$dao->query($sql.$limit);
	}

}
?>