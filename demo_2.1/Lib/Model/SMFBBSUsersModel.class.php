<?php
class SMFBBSUsersModel extends Model {
	protected $tableName = "members";
	protected $tablePrefix = 'smf_';
	protected $connection = array(
			'dbms'     => 'mysql',
			'username' => 'root',
			'password' => '123123',
			'hostname' => 'localhost',
			'hostport' => '3306',
			'database' => 'test1' 
			);
        /*array(
			'dbms'     => 'mysql',
			'username' => 'sfs',
			'password' => 'd3v',
			'hostname' => 'portal2',
			'hostport' => '3306',
			'database' => 'phpbb' 
			);*/
}
?>