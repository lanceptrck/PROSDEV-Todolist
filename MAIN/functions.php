<?php

include 'classes.php';

$username = null;
$password = null;	
$accounts = array();
$loggedin = false;

function test_input($data) {
   			$data = trim($data);
   			$data = stripslashes($data);
   			$data = htmlspecialchars($data);
   			return $data;
}

function loadAll()
{
	if(isset($_SESSION["username"]))
	{
		global $username;
		$username = $_SESSION["username"];
	}

	loadAccounts();

}

function returnAccountsList()
{
	global $accounts;
	return $accounts;
}

function verify($username, $password)
{
	global $accounts;

	for($i = 0; $i<count($accounts); $i++)
	{
		$temp_user = $accounts[$i]->getUser();
		$temp_pass = $accounts[$i]->getPass();

		if(strcmp($temp_user, $username) == 0 && strcmp($temp_pass, $password) == 0)
		{
			return true;
		}

	}

	return false;

}

function usernameExists($username)
{
	global $accounts;

	for($i = 0; $i<count($accounts); $i++)
	{
		$temp_user = $accounts[$i]->getUser();
		if(strcmp($temp_user, $username) == 0)
		{
			return true;
		}
	}

	return false;
}

function emailExists($email)
{
	global $accounts;

	for($i = 0; $i<count($accounts); $i++)
	{
		$temp_email = $accounts[$i]->getEmail();
		if(strcmp($temp_email, $email) == 0)
		{
			return true;
		}
	}

	return false;
}

function getAccount($username)
{
	global $accounts;

	$acc = null;

	for($i = 0; $i<count($accounts); $i++)
	{
		$temp_user = $accounts[$i]->getUser();

		if(strcmp($temp_user, $username) == 0)
		{
			$acc = $accounts[$i];
		}

	}

	return $acc;

}

function getAccountById($id)
{
	global $accounts;

	$acc = null;

	for($i = 0; $i<count($accounts); $i++)
	{
		$temp_id = $accounts[$i]->getAccid();

		if($id == $temp_id)
		{
			$acc = $accounts[$i];
		}

	}

	return $acc;

}



function changePassword($account_id, $new_password)
{
	$connect= new DBConnection();
	$connect = $connect->getInstance();

	$sql = "UPDATE user SET password='" . $new_password . "' WHERE id='" . $account_id . "'"; 

	if ($connect->query($sql) !== TRUE) {
    			echo "ERROR: Could not able to execute $sql. " . mysqli_error($connect);
    }

    $connect->close();
}	

function getAccountName($account_id)
{
	global $accounts;

	$account_name = null;

	for($i = 0; $i<count($accounts); $i++)
	{
		$temp_accid = $accounts[$i]->getAccid();

		if(strcmp($temp_accid, $account_id) == 0)
		{
			$account_name = $accounts[$i]->getUser();
		}

	}

	return $account_name;

}

function loadAccounts()
{
	global $accounts;
	$accounts = null;
	$connect= new DBConnection();
	$connect = $connect->getInstance();

	$sql = "SELECT * FROM user";
	$result = $connect->query($sql);

	if($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$temp_acc = new account($row['id'], $row['username'], $row['password'], $row['fullname'], $row['email']);
			$accounts[count($accounts)] = $temp_acc;
			
		}

	}
	$connect->close();
}

function createAccount($id, $un, $pw, $fn, $em)
{ 

	$connect = new DBConnection();
	$connect = $connect->getInstance();

	$sql = "INSERT INTO user(id, username, password, fullname, email)
	VALUES ('$id', '$un', '$pw', '$fn', '$em')";

	if ($connect->query($sql) !== TRUE) {
    	echo "Error: " . $sql . "<br>" . $connect->error;
    }
    else loadAll();

    $connect->close();

}

function getLastAccId()
{
	$id = null;
	$connect= new DBConnection();
	$connect = $connect->getInstance();

	$sql = "SELECT MAX(id) as result FROM user";
	$result = $connect->query($sql);

	if($result->num_rows > 0)
	{
		$row = $result->fetch_assoc();
		$id = $row['result'];
	}

	$connect->close();

	return $id;
}

?>