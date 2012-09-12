<?php
class SMFBBS extends Think {
	protected $_users_db;

	
	function __construct(){
		$this->_users_db = D('SMFBBSUsers');
	
	}
	
	function init($user, $pwd ,$uemail,$uip,$utime){
		$pwd = sha1($user.$pwd);
		$password_salt = substr(md5(mt_rand()), 0, 4);
		$data = array('member_name' => $user,'real_name' => strtolower($user), 'passwd' => $pwd ,'email_address'=> $uemail ,'validation_code'=> '' ,'is_activated'=> '1' ,'lngfile'=> '' ,'member_ip'=>$uip,'member_ip2'=>$uip,'date_registered'=>$utime,'buddy_list'=> '','message_labels'=> '','openid_uri'=> '','signature'=> '','ignore_boards'=> '','password_salt'=> $password_salt);
		/*$insertId = $this->_users_db->add($data);
		 * INSERT INTO `test`.`smf_members` (`id_member`, `member_name`, `date_registered`, `posts`, `id_group`, `lngfile`, `last_login`, `real_name`, `instant_messages`, `unread_messages`, `new_pm`, `buddy_list`, `pm_ignore_list`, `pm_prefs`, `mod_prefs`, `message_labels`, `passwd`, `openid_uri`, `email_address`, `personal_text`, `gender`, `birthdate`, `website_title`, `website_url`, `location`, `icq`, `aim`, `yim`, `msn`, `hide_email`, `show_online`, `time_format`, `signature`, `time_offset`, `avatar`, `pm_email_notify`, `karma_bad`, `karma_good`, `usertitle`, `notify_announcements`, `notify_regularity`, `notify_send_body`, `notify_types`, `member_ip`, `member_ip2`, `secret_question`, `secret_answer`, `id_theme`, `is_activated`, `validation_code`, `id_msg_last_visit`, `additional_groups`, `smiley_set`, `id_post_group`, `total_time_logged_in`, `password_salt`, `ignore_boards`, `warning`, `passwd_flood`, `pm_receive_from`, `fbname`, `fbid`, `fbpw`) VALUES (NULL, 'robert4', '1323146948', '0', '0', '', '0', 'robert4', '0', '0', '0', '', '', '0', '', '', '344332424243243243242342343', '', 'efdd@fd.com', '', '0', '0001-01-01', '', '', '', '', '', '', '', '0', '1', '', '', '0', '', '0', '0', '0', '', '1', '1', '0', '2', '127.0.0.1', '127.0.0.1', '', '', '0', '1', '', '0', '', '', '0', '0', '', '', '0', '', '1', '0', '0', '0');
		 * INSERT INTO `test`.`smf_members` (`member_name`, `date_registered`, `lngfile`, `real_name`, `passwd`, `email_address`,  `member_ip`, `member_ip2`, `is_activated`, `validation_code`, `buddy_list`, `message_labels`, `openid_uri`, `signature`, `ignore_boards`) VALUES ('robert4', '1323146948', '', 'robert4', '344332424243243243242342343', 'efdd@fd.com', '127.0.0.1', '127.0.0.1', '1', '', '', '', '', '', '');*/
		$this->_users_db->add($data);
		return true;
	}
	function initdelete($user){
        $this->_users_db->where("member_name='".$user."'")->delete();
		return true;
	}
	function initupdate($user, $pwd ,$uemail,$uip,$utime){
		$pwd = sha1($user.$pwd);
		$password_salt = substr(md5(mt_rand()), 0, 4);
		$data = array('member_name' => $user,'real_name' => strtolower($user), 'passwd' => $pwd ,'email_address'=> $uemail ,'validation_code'=> '' ,'is_activated'=> '1' ,'lngfile'=> '' ,'member_ip'=>$uip,'member_ip2'=>$uip,'date_registered'=>$utime,'buddy_list'=> '','message_labels'=> '','openid_uri'=> '','signature'=> '','ignore_boards'=> '','password_salt'=> $password_salt);
		/*$insertId = $this->_users_db->add($data);
		 * INSERT INTO `test`.`smf_members` (`id_member`, `member_name`, `date_registered`, `posts`, `id_group`, `lngfile`, `last_login`, `real_name`, `instant_messages`, `unread_messages`, `new_pm`, `buddy_list`, `pm_ignore_list`, `pm_prefs`, `mod_prefs`, `message_labels`, `passwd`, `openid_uri`, `email_address`, `personal_text`, `gender`, `birthdate`, `website_title`, `website_url`, `location`, `icq`, `aim`, `yim`, `msn`, `hide_email`, `show_online`, `time_format`, `signature`, `time_offset`, `avatar`, `pm_email_notify`, `karma_bad`, `karma_good`, `usertitle`, `notify_announcements`, `notify_regularity`, `notify_send_body`, `notify_types`, `member_ip`, `member_ip2`, `secret_question`, `secret_answer`, `id_theme`, `is_activated`, `validation_code`, `id_msg_last_visit`, `additional_groups`, `smiley_set`, `id_post_group`, `total_time_logged_in`, `password_salt`, `ignore_boards`, `warning`, `passwd_flood`, `pm_receive_from`, `fbname`, `fbid`, `fbpw`) VALUES (NULL, 'robert4', '1323146948', '0', '0', '', '0', 'robert4', '0', '0', '0', '', '', '0', '', '', '344332424243243243242342343', '', 'efdd@fd.com', '', '0', '0001-01-01', '', '', '', '', '', '', '', '0', '1', '', '', '0', '', '0', '0', '0', '', '1', '1', '0', '2', '127.0.0.1', '127.0.0.1', '', '', '0', '1', '', '0', '', '', '0', '0', '', '', '0', '', '1', '0', '0', '0');
		 * INSERT INTO `test`.`smf_members` (`member_name`, `date_registered`, `lngfile`, `real_name`, `passwd`, `email_address`,  `member_ip`, `member_ip2`, `is_activated`, `validation_code`, `buddy_list`, `message_labels`, `openid_uri`, `signature`, `ignore_boards`) VALUES ('robert4', '1323146948', '', 'robert4', '344332424243243243242342343', 'efdd@fd.com', '127.0.0.1', '127.0.0.1', '1', '', '', '', '', '', '');*/
		$this->_users_db->where("member_name='".$user."'")->save($data);
		return true;
	}
	function initselect($user){
        $list  = $this->_users_db->where("member_name='".$user."'")->select();
		return $list;
	}
}