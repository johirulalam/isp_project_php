<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['clientmsaid']==0)) {
  header('location:logout.php');
  } else{
   
$id = $_GET['addid'];
$clientmsaid=$_SESSION['clientmsaid'];
$sql1 = "SELECT * FROM tblconfirmclient Where ID=:id";
$query = $dbh -> prepare($sql1);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

if($query->rowCount() > 0)
{
foreach($results as $row)
{          
$name = $row->Name;
$ctNumber = $row->ContactNumber;
$address = $row->Address;
 $packageType = $row->Package;
 $ip = $row->Ip;
$password = $row->Password;
}
}
 $acctid=mt_rand(100000000, 999999999);
 $accountType = 'Inactive';
$sqld= "delete from tblconfirmclient Where ID=:id";
$query=$dbh->prepare($sqld);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->execute();
$sql="insert into tblclient(AccountID,Name,Address,Ip,Package,ContactNumber,AccountType,Password)values(:acctid,:name,:address,:ip,:packageType,:ctNumber,:accountType,:password)";
$query=$dbh->prepare($sql);
$query->bindParam(':acctid',$acctid,PDO::PARAM_STR);
$query->bindParam(':name',$name,PDO::PARAM_STR);
$query->bindParam(':address',$address,PDO::PARAM_STR);
$query->bindParam(':ip',$ip,PDO::PARAM_STR);
$query->bindParam(':packageType',$packageType,PDO::PARAM_STR);
$query->bindParam(':ctNumber',$ctNumber,PDO::PARAM_STR);
$query->bindParam(':accountType',$accountType,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$insert =  $query->execute();

   // $LastInsertId=$dbh->lastInsertId();
   if ($insert) {
    echo '<script>alert("Client has been added.")</script>';
echo "<script>window.location.href ='manage-client.php'</script>";
  }
  else
    {
         echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

  
}

?>
