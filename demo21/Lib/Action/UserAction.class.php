<?php
class UserAction extends Action
{
	public function index(){
	echo "index";
	}
	public function test1(){//数据添加
		$username = "www5";
        $email    = "sdfdsf@fd.com";
        $password = "344332424243243243242342343";
 		$ip="127.0.0.1";
        $time=time();
		$getid=$this->smfbbs_add_user($username, $password, $email ,$ip, $time);
		dump($getid);
	}
	public function test2(){//数据删除
		$username = "www5";
		$getid=$this->smfbbs_delete_user($username);
		dump($getid);
		echo $getid["0"][id_member];
	}
	public function test3(){//数据更新
		$username = "www4";
        $email    = "s121212@fd.com";
        $password = "123456";
 		$ip="127.0.0.1";
        $time=time();
		$getid=$this->smfbbs_update_user($username, $password, $email ,$ip, $time);
		dump($getid);
	}
	public function test4(){//数据查询
		$username = "www4";
		$getid=$this->smfbbs_select_user($username);
		dump($getid);
		echo $getid["0"][id_member];//多维数组
	}

	//增加数据方法
protected function smfbbs_add_user($username, $password, $email ,$ip, $time){
		import('@.Ext.SMFBBS');
	    $_phpbb = new SMFBBS();
	    $_phpbb->init($username, $password, $email ,$ip, $time);
	}
	//删除数据方法
protected function smfbbs_delete_user($username){
		import('@.Ext.SMFBBS');
	    $_phpbb = new SMFBBS();
	    $getid = $_phpbb->initdelete($username);
	    return $getid;
	}
	//修改数据方法
protected function smfbbs_update_user($username, $password, $email ,$ip, $time){
		import('@.Ext.SMFBBS');
	    $_phpbb = new SMFBBS();
	    $getid = $_phpbb->initupdate($username, $password, $email ,$ip, $time);
	    return $getid;
	}
	//查询数据方法
protected function smfbbs_select_user($username){
		import('@.Ext.SMFBBS');
	    $_phpbb = new SMFBBS();
	    $getid = $_phpbb->initselect($username);
	    return $getid;
	}

}
