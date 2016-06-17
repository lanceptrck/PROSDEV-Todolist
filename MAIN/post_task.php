<?php

	session_start();
	
	include 'functions.php';

		loadAll();

			$loggedIn_account = getAccount($_SESSION["username"]);
			$account_id = $loggedIn_account->getAccid();

	if($_SERVER["REQUEST_METHOD"] == "POST")
	{

		$title = $ingredients = $directions = $facts = "";
		$tErr = $iErr = $dErr = $fErr = "";
		$isErr = false;

		$ownerID = $title = $status = $schedule = $categoryID = $shared = "";
		$tErr = $stErr = "";
		$isErr = false;

		/*$target_dir = "images/task/";

		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$file_type = pathinfo($target_file, PATHINFO_EXTENSION);
		$file_name = "task_" . (getLastTaskId()+1) .".".$file_type;
		$file_size = $_FILES["fileToUpload"]["size"];
		$img_file = $_FILES["fileToUpload"]["tmp_name"];*/

		$submitted = isset($_POST["submit"]);

		/*if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	    	if($check !== false) {
	        	echo "File is an image - " . $check["mime"] . ".";
	        	$uploadOk = 1;
	    	} else {
	       	 echo "File is not an image.";
   		    	 $uploadOk = 0;
    		}
		}

    if($file_size < 0)
    {
        $isErr = true;
    } */

		if (empty($_POST["taskName"])) {
     			$tErr = "Title is required";
     			$isErr = true;
   			} else {
     			$title = test_input($_POST["taskName"]);
     				// check if name only contains letters and whitespace
     			if (!preg_match("/^[a-zA-Z ]*$/", $title)) {
       				$tErr = "Only letters and white space allowed"; 
       				$isErr = true;
     			}
   			}

   			if (empty($_POST["taskDate"])) {
     			$scErr = "Schedule is required";
     			$isErr = true;
   			} else {
     			$schedule = test_input($_POST["taskDate"]);
     				// check if name only contains letters and whitespace
   			}

        echo $isErr;

     	if($isErr == false)
     	{
        //$toPost = uploadPicture($target_dir.$file_name, $file_type, $file_name, $file_size, $_FILES["fileToUpload"]["tmp_name"]);
     		$toPost = true;
     		
        $link = getLastTaskId()+1;
        if($toPost == true)
        {
          createTask(getLastTaskId()+1, $loggedIn_account->getAccid(), $title, 0, $schedule, 1, 1);
          
        }

      }

   		
	}

?>