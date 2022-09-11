<?php
extract($_POST);

//database
$conn=mysqli_connect("localhost","root");
$db=mysqli_select_db($conn,"vblock");
//insertion
if( isset($address) !="" && $phone!="" && $pyear!="" && $branch !="" && $name !="" && isset($roll) !=""){
    $q="INSERT INTO `nepali_students`(`RollNo`, `Name`, `Address`, `PhoneNo`, `PassOutYear`, `Branch`) VALUES ('$roll','$name','$address','$phone','$pyear','$branch')";
    $querry=mysqli_query($conn,$q);
    echo $roll;
}
//display
$data=' <thead>
<tr>
    <th>SN.</th>
    <th>Roll No</th>
   <th>Name</th>
   <th>Address</th>
   <th>Phone No</th>
   <th>Passing Year</th>
   <th>Branch</th>
   <th>Edit</th>
   <th>Delete</th>
</tr>
 </thead><tbody>';
//this is for displaying table 
 if(isset($display)){
     $q='select * from nepali_students';
     $querry=mysqli_query($conn,$q);
     if(mysqli_num_rows($querry)>0){
        $number=1;
        while($row=mysqli_fetch_array($querry)){
            $data.='<tr>
                <td>'.$number.'</td>
                <td>'.$row['RollNo'].'</td>
                <td>'.$row['Name'].'</td>
                <td>'.$row['Address'].'</td>
                <td>'.$row['PhoneNo'].'</td>
                <td>'.$row['PassOutYear'].'</td>
                <td>'.$row['Branch'].'</td>
                <td><button class="btn btn-primary"  onclick="editItem(\''.$row['RollNo'].'\')" id="edit">Edit</button></td>
                <td><button class="btn btn-secondary"  onclick="deleteItem(\''.$row['RollNo'].'\')" id="delete">Delete</button></td>
            </tr>';
            $number++;
                 }
     }
    echo '<table class="table table-stripe table-hover">'.$data.' </tbody></table>';     
 }
 //this is for deleting instance
 if(isset($rollNoDelete)){
   $deleteQuerry="DELETE FROM `nepali_students` WHERE RollNo='$rollNoDelete'";
   $querry=mysqli_query($conn,$deleteQuerry);
 }
 //this is for displaying content in model for updating
 if(isset($rollNoForDisplayingDataForUpdate)){
     $searchQuery="SELECT * FROM `nepali_students` WHERE RollNo = '$rollNoForDisplayingDataForUpdate'";
     $querry=mysqli_query($conn,$searchQuery);
     while($row=mysqli_fetch_array($querry)){
         $searchedResult=array($row['RollNo'],$row['Name'],$row['Address'],$row['PhoneNo'],$row['PassOutYear'],$row['Branch']);
         echo json_encode($searchedResult);
     }
 }
 //updating content of the table
 if(isset($rollNoUpdate)){
    $updateQuerry="UPDATE `nepali_students` SET `Name`='$nameUpdate',`Address`='$addressUpdate',`PhoneNo`='$phoneNoUpdate',`PassOutYear`='$passOutYearUpdate',`Branch`='$branchUpdate' WHERE RollNo = '$rollNoUpdate'";
    $querry=mysqli_query($conn,$updateQuerry);
 }
 ?>
