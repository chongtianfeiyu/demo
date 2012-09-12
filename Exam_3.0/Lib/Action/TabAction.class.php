<?php
class TabAction extends Action {
	public $pagenum=50;
	public function tab1(){
		$label=D();
		//$rs=$label->query('SELECT count(lee99_tiku.id) as tp_count,lee99_label.id as id,lee99_label.label as label FROM `lee99_tiku` JOIN lee99_label ON lee99_label.id=lee99_tiku.labelid GROUP BY lee99_tiku.labelid;');
		$rs=$label->query('SELECT count(1) as tp_count,lee99_tiku.type as label FROM `lee99_tiku` GROUP BY lee99_tiku.type;');
		foreach ($rs as $k=>$v){
			$list[$k]['id']=$v['id'];
			$list[$k]['label']=$v['label'];
			$list[$k]['sub']=$this->getpage($v['tp_count']);
		}
		//dump($list);
		//exit;
		$this->assign('list',$list);
		$this->display();
	}

	public function tab2(){
		$uid=$_SESSION['Login_uid'];
		$tl=D('Tasklog');
		
		//保留
		$tl_count=$tl->MyTask('uid='.$uid.' and issave=1');
		$list1=$this->getpage($tl_count);
		$this->assign('list1',$list1);
		
		//冷宫
		$tl_count=$tl->MyTask('uid='.$uid.' and iscool=1');
		$list2=$this->getpage($tl_count);
		$this->assign('list2',$list2);
		
		$this->display();
	}

	public function tab3(){
		$uid=$_SESSION['Login_uid'];
		$tl=D('Tasklog');
		//没有做过
		$tl_count=$tl->MyTask('uid='.$uid.' and dotime=0');
		$list=$this->getpage($tl_count);
		$this->assign('list',$list);
		$this->display();
	}


	public function tab4(){
		$uid=$_SESSION['Login_uid'];
		$tl=D('Tasklog');
		//没有做过
		$tl_count=$tl->MyTask('uid='.$uid.' and dotime>0 and iscool=0 and wrongtime>0');
		$list=$this->getpage($tl_count);
		$this->assign('list',$list);
		$this->display();
	}	
	
	public function getpage($count){
		$num=$this->pagenum;
		$t=ceil($count/$num);
		for ($i=1;$i<=$t;$i++){
			$rt[$i]['pageid']=$i;
		}
		return $rt;
	}
}
?>