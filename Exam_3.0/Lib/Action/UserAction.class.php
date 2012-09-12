<?php
class UserAction extends Action {

	public function check(){
		$app=$_SESSION['Login_app'];//正在执行的项目
		$uid=$_SESSION['Login_uid'];
		$user=$_SESSION['Login_user'];
		if($uid!='' && $app==APP_NAME){
			echo $user;
		}else{
			echo 0;
		}
		exit;
	}

	public function loaduser(){
		$user=D('User');
		$rs=$user->AllUser();
		if(count($rs)>0){
			header("Content-Type:text/html; charset=utf-8");
			exit(json_encode($rs));
		}else{
			echo '0';
		}
	}

	public function swith(){
		$uid=$_GET['uid'];
		$user=D('User');
		$rs=$user->SearchById($uid);
		//dump($rs);
		if($rs){
			$_SESSION['Login_app']=APP_NAME;
			$_SESSION['Login_uid']=$rs['id'];
			$_SESSION['Login_user']=$rs['username'];
			echo $rs['username'];
		}else{
			echo '0';
		}
	}

	public function add(){
		$data['username']=trim($_GET['username']);
		$mastercode=trim($_GET['mastercode']);
		if($mastercode=='123123'){
			$user=D('User');//用户
			$tiku=D('Tiku');//题库
			$tasklog=D('Tasklog');//用户数据
			$rs=$user->AddUser($data);
			if($rs){
				$list=$tiku->GetUserList();
				foreach ($list as $tk){
					$map['uid']=$rs;
					$map['tid']=$tk['id'];
					$tasklog->AddTask($map);
				}
			}
		}else{
			echo '0';
		}

	}


	public function del(){
		$data['username']=trim($_GET['username']);
		$mastercode=trim($_GET['mastercode']);
		//管理密码if($mastercode=='82207110'){
		if($mastercode=='123123'){
			$user=D('User');//用户
			$rs=$user->SearchByUsername($data['username']);
			//dump($rs);
			if($rs){
				$uid=$rs['id'];
				$tasklog=D('Tasklog');//用户数据
				$Tasktmp=D('Tasktmp');//用户数据
				$user->DeleteById($uid);
				$tasklog->DeleteById($uid);
				$Tasktmp->DeleteById($uid);
			}
			session_destroy();
		}else{
			echo '0';
		}

	}


}
?>