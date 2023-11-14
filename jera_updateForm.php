<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style/style.css">

    <?php
    include '../connection.php';
    
    function getByID($table,$id){
        global $db;
        $id = $_GET['id'];
        $query= "SELECT * FROM `tbl_jeramay` INNER JOIN `hr_department` ON tbl_jeramay.departmentId=hr_department.departmentId WHERE id='$id'";
        // $query = $db->query($sql);
        return $query_run = mysqli_query($db,$query);


                //og
                // $query = "SELECT * FROM $table WHERE id='$id'";
                // return $query_run = mysqli_query($db,$query);
    }


    // function getDepartment($db)
    // {
    //     $query = "SELECT * FROM `tbl_jeramay` INNER JOIN `hr_department` ON tbl_jeramay.departmentId=hr_department.departmentId" ;
    //     return $result = mysqli_query($db, $query);
    // }
    ?>

    
</head>
<body>

<div class="container">

   
    <form action="jera_action.php" method="POST">

    <?php 

        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            $data = getByID($db, "tbl_jeramay",$id);
        
            if(mysqli_num_rows($data) > 0)
            {
                $data = mysqli_fetch_array($data);
            
            ?>
                <h2>Your details</h2>
                <input type="hidden" name="id" value="<?php echo $data['id'];?>">
                <div class="row">
                    <div class="col-25">
                    <label for="fname">First Name</label>
                    </div>
                    <div class="col-75">
                    <input required type="text" name="firstName" value="<?php echo $data['firstName'];?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                    <label for="lname">Last Name</label>
                    </div>
                    <div class="col-75">
                    <input required type="text" name="lastName" value="<?php echo $data['lastName'];?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                    <label for="address">Address</label>
                    </div>
                    <div class="col-75">
                    <textarea required name="address"  cols="30" rows="3"><?php echo $data['address'];?></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                    <label for="gender">Gender</label>
                    </div>
                    <div class="col-75">
                              <input required type="radio" name="gender" <?=$data['gender']=="0" ? "checked" : ""?> value="0" >
                              <label for="male">Male</label>
                              <input required type="radio" name="gender" <?=$data['gender']=="1" ? "checked" : ""?> value="1">
                              <label for="female">Female</label>
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                    <label for="bday">Birthday</label>
                    </div>
                    <div class="col-75">
                    <input required type="date" name="birthday" value="<?php echo date('Y-m-d',strtotime($data["birthday"]))?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                    <label for="bday">Department</label>
                    </div>
                    <div class="col-75">
                        <select class="form-control rounded" style=" width:100%;" name="department">
                                                 
                            <option value="<?php echo $data['departmentId'];?>"><?php echo $data['departmentName'];?></option>
                            <option value="1">Accounting</option>
                            <option value="2">Engineering</option>
                            <option value="3">HR</option>
                            <option value="4">IT</option>
                            <option value="5">Purchasing</option>
                            <option value="6">Production</option>
                            <option value="7">IMPEX</option>
                            <option value="8">PPIC</option>
                            <option value="9">Sales</option>
                            <option value="10">RPD</option>
                            <option value="11">Logistics</option>
                            <option value="12">FVI</option>
                            <option value="13">QC</option>
                            <option value="14">Utility</option>
                            <option value="15">Security</option>
                            <option value="16">QA</option>
                            <option value="17">Top Management</option>
                            <option value="18">DCC</option>      
                                
                        </select>    
                    
                    </div>
                </div>


                <div class="row" style="margin-top: 30px;">
                <input style="background-color: black;"  type="submit" name="update_btn" value="Update">
            </div>
                <?php
                }

            }
                else echo "error";

                ?>

    </form>
</div>

</body>
</html>


