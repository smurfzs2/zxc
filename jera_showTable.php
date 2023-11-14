<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Exercise 6 - Multifilter</title>
    <?php
    
        include '../connection.php';


        // filter
        if(isset($_POST['search']))
        {
            $firstName = $_POST['firstName'];  
            $lastName = $_POST['lastName'];  
            $birthday = $_POST['birthday'];     
            $address = $_POST['address'];
            $gender = $_POST['gender'];
            $department = $_POST['department'];     


            $query = "SELECT * FROM `tbl_jeramay` INNER JOIN `hr_department` ON tbl_jeramay.departmentId=hr_department.departmentId WHERE ";

           
            if($firstName !="")
            {
                 $query .= " firstName LIKE '$firstName' AND ";
            }

            if($lastName !="")
            {
                $query .=  " lastName LIKE '$lastName' AND ";
            }

            if($birthday !="")
            {
                $query .= " birthday LIKE '$birthday' AND ";
            }

           if($address !="")
           {
                $query .= " address LIKE '$address' AND ";
           }

           if($gender !="")
           {
                $query .= " gender LIKE '$gender' AND ";
           }

           if($department !="")
           {
                $query .= " departmentName LIKE '$department' AND ";
           }

            $query = substr($query, 0, -4);

            
          
            $search_result = filterTable($query);
            
        }
        else 
        {
            $query = "SELECT * FROM `tbl_jeramay` INNER JOIN `hr_department` ON tbl_jeramay.departmentId=hr_department.departmentId";;
            $search_result = filterTable($query);

        }

        function getData($db)
        {
            $query = "SELECT * FROM `tbl_jeramay` INNER JOIN `hr_department` ON tbl_jeramay.departmentId=hr_department.departmentId";
            return $result = mysqli_query($db, $query);
        }

        function getDepartment($db)
        {
            $query = "SELECT * FROM `hr_department` ORDER BY departmentName ASC" ;
            return $result = mysqli_query($db, $query);
        }

        

        
        // function to connect and execute the query
        function filterTable($query)
        {
            $connect = mysqli_connect("localhost", "root", "arktechdb", "ojtDatabase");
            $filter_Result = mysqli_query($connect, $query);
            return $filter_Result;
        }
    ?>
</head>
<body>
    <div>        
    <div style="float: right">
            <h5><a href="jera_generateCSV.php" class="csv" ><i class="btn btn-info fas fa-file"></i> CSV</a></h5>
        </div>
        <div style="float: right">
            <h5><a href="jera_generatePDF.php" class="pdf" ><i class="btn btn-info fas fa-print"></i> PDF</a></h5>
        </div>
        <div style="float: right">
            <h5><a href="jera_inputForm.php" class="add" ><i class="fas fa-add"></i> Add</a></h5>  
        </div>
        
    </div>
    
    <div>
       
        <div></div>
        
    </div>

    <div>
        
        <form action="jera_showTable.php" method="POST" id="formSubmit"></form>
        <ul class="nav">
            <li>
                <input type="search" class="form-control rounded" placeholder="First Name" name="firstName" value="<?php if(isset($_POST['firstName'])){echo $_POST['firstName'];} ?>" form="formSubmit"/>
                                
            </li>
            <li>
                <input type="search" class="form-control rounded" placeholder="Last Name" name="lastName" value="<?php if(isset($_POST['lastName'])){echo $_POST['lastName'];} ?>"  form="formSubmit"/>
                
            </li>
            <li>
                <input type="search" class="form-control rounded" placeholder="Address" name="address"  value="<?php if(isset($_POST['address'])){echo $_POST['address'];} ?>" form="formSubmit"/>
                
            </li>
            <li>
                <input type="date" class="form-control rounded" placeholder="Birthday" name="birthday"  value="<?php if(isset($_POST['birthday'])){echo $_POST['birthday'];} ?>" form="formSubmit"/>
                
            </li>
           
            <li>
                <select class="form-control rounded" style=" width:100%;" name="gender" form="formSubmit">
                    <option value="" disabled selected hidden>
                        <?php 
                            if(isset($_POST['gender']))
                            {
                                echo $_POST['gender'] ? 'Female': 'Male';
                            } 
                            else
                            {
                                echo "Gender";
                            }
                        ?>
                    </option>
                    <option value="0">Male</option>
                    <option value="1">Female</option>
                </select>                   
            </li>
            <li>
                <select class="form-control rounded" style=" width:100%;" name="department" form="formSubmit">                            
                    <option value="" disabled selected hidden>
                    <?php 
                        if(isset($_POST['department']))
                        {
                            echo $_POST['department'] ;
                        } 
                        else
                        {
                            echo "Department";
                        }
                    ?>
                    </option>
                    <?php
                        $department = getDepartment($db);
                        
                        if(mysqli_num_rows($department)> 0)
                        {
                            foreach($department as $item)
                            {
                                ?>
                                <option> <?= $item['departmentName'];?></option>
                                <?php
                            }
                        }
                    ?>
                </select>                
            </li>
            <li><button type="submit"  class="btn btn-outline-primary" name="search" form="formSubmit">Go!</button></li>
        </ul>
        
    </div>

    <!-- table view -->
    <table>
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Birthday</th>
        <th>Address</th>
        <th>Gender</th>
        <th>Department</th>
        <th>Action</th>
    </tr>

    <form action="jera_delete.php" method="POST">
        <tbody>
        <?php
                $idAI = 0;
                $data = getData($db,"tbl_jeramay");

                if(mysqli_num_rows($data) > 0)
                {   
                while($row = mysqli_fetch_assoc($search_result))
                {
                    foreach($search_result as $row)
                    {
                        ?>
                        <tr>
                            <td><?php echo ++$idAI; ?></td>
                            <input type="hidden" name="id" value="<?php echo $row['id'];?>">
                            <td><?= $row['firstName'];?></td>
                            <td><?= $row['lastName'];?></td>
                            <td><?php echo date("F d, Y", strtotime($row['birthday'])) ;?></td>
                            <td><?= $row['address'];?></td>
                            <td><?= $row['gender'] == '0'? "Male":"Female";?></td>
                            <td value="<?= $row['departmentId'];?>"><?= $row['departmentName'];?></td>                            
                            <td>
                                <a class="edit" href="jera_updateForm.php?id=<?php echo $item['id'];?>"><i class="fas fa-edit"></i></a>   

                                <button name="delete" type="submit"><i class="delete fas fa-trash"></i></button>
                            </td>
                            
                        </tr>
                   <?php
                    }
                }
                
            }
            else
            {
                echo "No record found";
            }
            
                ?>
                           
        </tbody>
    </form>
    </table>

</body>
</html>
