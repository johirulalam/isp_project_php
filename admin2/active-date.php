<?php 

	

	session_start();
	error_reporting(0);
	include('includes/dbconnection.php');
	if (strlen($_SESSION['clientmsaid']==0)) {
	  header('location:logout.php');
	  }
	else{

				$activeId    = $_GET['activeId'];
				$dateNow     = date("Y-m-d h:i:sa");
				$accountType = "Active";

				$clientmsaid=$_SESSION['clientmsaid'];
				
				$sql="UPDATE tblclient SET LastActiveDate=:dateNow, AccountType=:accountType WHERE UserID=:activeId";
				$query=$dbh->prepare($sql);
				$query->bindParam(':dateNow',$dateNow,PDO::PARAM_STR);
				$query->bindParam(':accountType',$accountType,PDO::PARAM_STR);
				$query->bindParam(':activeId',$activeId,PDO::PARAM_STR);
				$insert = $query->execute();
				
				   if ($insert) {
					     echo '<script>alert("Client has been activate.")</script>';
						 echo "<script>window.location.href ='manage-client.php'</script>";
				  }
				  else
				    {
				    	
				          echo '<script>alert("Something Went Wrong. Please try again")</script>';
				    }

	  
	}

?>

 