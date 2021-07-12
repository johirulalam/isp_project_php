<?php 

	

	session_start();
	error_reporting(0);
	include('includes/dbconnection.php');
	if (strlen($_SESSION['clientmsaid']==0)) {
	  header('location:logout.php');
	  }
	else{
                $clientmsaid=$_SESSION['clientmsaid'];
				$id    = $_GET['Id'];
                $solve = "Solved";
				
				
				$sql="UPDATE tblcomplain SET Submission=:solve WHERE ID=:id";
				$query=$dbh->prepare($sql);
				$query->bindParam(':solve',$solve,PDO::PARAM_STR);
				$query->bindParam(':id',$id,PDO::PARAM_STR);
				$insert = $query->execute();
				
				   if ($insert) {
					     echo '<script>alert("Complain Solved.")</script>';
						 echo "<script>window.location.href ='complains.php'</script>";
				  }
				  else
				    {
				    	
				          echo '<script>alert("Something Went Wrong. Please try again")</script>';
				    }

	  
	}

?>

 