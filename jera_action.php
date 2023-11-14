<?php
    
   include '../connection.php';

   if(isset($_POST['submit']))
   {    
      
      $firstName = $db -> real_escape_string($_POST['firstName']);
      $lastName = $db -> real_escape_string($_POST['lastName']);
      $address = $db -> real_escape_string($_POST['address']);
      $gender = $_POST['gender'] ;
      $birthday = $_POST['birthday'];


      $sql = "INSERT INTO tbl_jeramay (firstName,lastName,address,birthday,gender)
      VALUES ('$firstName','$lastName','$address','$birthday','$gender')";
      if (mysqli_query($db, $sql)) {
         header('Location: jera_quickTable.php');
      } else {
         echo "Error: " . $sql . ":-" . mysqli_error($db);
      }
      mysqli_close($db);
   }
   else if(isset($_POST['update_btn']))
   {
      $id = $_POST['id'];
      $firstName = $db -> real_escape_string($_POST['firstName']);
      $lastName = $db -> real_escape_string($_POST['lastName']);
      $address = $db -> real_escape_string($_POST['address']);
      $gender = $_POST['gender'] ;
      $birthday = $_POST['birthday'];
      $department = $_POST['department'];
      
      $update = "UPDATE tbl_jeramay SET firstName='$firstName', lastName='$lastName', birthday='$birthday', address='$address', gender='$gender',  departmentId='$department' WHERE id='$id' ";
      $update_run = mysqli_query($db,$update);  

      if($update_run)
      {
         header('Location: jera_quickTable.php');
      }
      else
      {
         echo "error";
      }
   }
   else if(isset($_POST['search']))
   {
      $valueToSearch = $_POST['valueToSearch'];
      // search in all table columns
      // using concat mysql function
      $query = "SELECT * FROM `tbl_jeramay` WHERE CONCAT(`id`, `firstName`) LIKE '%".$valueToSearch."%'";
      $search_result = filterTable($query);
      
   }
   else {
      $query = "SELECT * FROM `tbl_jeramay`";
      $search_result = filterTable($query);
   }

   // function to connect and execute the query
   function filterTable($query)
   {
      $connect = mysqli_connect("localhost", "root","arktechdb", "ojtDatabase");
      $filter_Result = mysqli_query($connect, $query);
      return $filter_Result;
   }


?>
