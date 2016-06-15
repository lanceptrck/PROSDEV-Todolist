<?php

class account
{
	public $account_id;
	public $username;
	public $password;
	public $fullname;
	public $email;

	function __construct($accid, $user, $pass, $fn, $em)
	{
		$this->account_id = $accid;
		$this->username = $user;
		$this->password = $pass;
		$this->fullname = $fn;
		$this->email = $em;

	}

	function changePass($pw)
	{
		$this->password = $pw;
	}

	function changeEmail($em)
	{
		$this->email = $em;
	}

	function getUser()
	{
		return $this->username;
	}

	function getPass()
	{
		return $this->password;
	}

	function getFullname()
	{
		return $this->fullname;
	}

	function getEmail()
	{
		return $this->email;
	}

	function getAccid()
	{
		return $this->account_id;
	}
}

class task
{
	private $task_id;
	private $owner_id;
	private $title;
	private $status;
	private $schedule;
	private $category_id;

	function __construct($tID, $oID, $t, $st, $sc, $cID)
	{
		$this->task_id = $tID;
		$this->owner_id = $oID;
		$this->title = $t;
		$this->status = $st;
		$this->schedule = $sc;
		$this->category_id = $cID;

	}

	function getTaskID()
	{
		return $this->task_id;
	}

	function getOwnerID()
	{
		return $this->owner_id;
	}

	function getTitle()
	{
		return $this->title;
	}

	function getStatus()
	{
		return $this->status;
	}

	function getSchedule()
	{
		return $this->schedule;
	}

	function getCategoryID()
	{
		return $this->category_id;
	}

	function editTitle($input)
	{
		$this->title = $input;
	}

	function editStatus($input)
	{
		 $this->status = $input;
	}


}

class category
{
	private $category_id;
	private $categoryName;

	function __construct($cID, $cN)
	{
		$this->category_id= $cID;
		$this->categoryName = $cN;
	}

	function getCategoryID()
	{
		return $this->category_id;
	}

	function getCategoryName()
	{
		return $this->categoryName;
	}

	function editCategoryName($input)
	{
		 $this->categoryName = $input;
	}





}

class DBConnection
{
	private $servername;
	private	$dbuser;
	private	$password;
	private	$dbName;
	private $conn;

	function __construct()
	{
			$this->servername = "localhost";
			$this->dbuser = "root";
			$this->password = "";
			$this->dbName = "todo";
			$this->conn = new mysqli($this->servername, $this->dbuser, $this->password, $this->dbName);
	}

	function getInstance()
	{
					/* Connect */
		if($this->conn->connect_error){
			die("Connection failed: " . $conn->connect_error);
	
		}

		else return $this->conn;
	}

}

?>