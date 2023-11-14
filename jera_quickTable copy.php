<head>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
    <link rel="stylesheet" href="style/style.css">

    <title>Exercise 8 - Quick Tables</title>
    <?php
    require_once('./../connection.php');
    
    $query = "SELECT * FROM `tbl_jeramay` INNER JOIN `hr_department` ON tbl_jeramay.departmentId=hr_department.departmentId";
    $result = $db->query($query);
    $arr_users = [];
    if ($result->num_rows > 0) {
        $arr_users = $result->fetch_all(MYSQLI_ASSOC);
    }
    ?>


</head>

<table id="tblUser" style="text-align: left">
    <thead >
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Birthday</th>
        <th>Address</th>
        <th>Gender</th>
        <th>Department</th>
    </thead>
    <tbody>
        <?php if(!empty($arr_users)) { ?>
            <?php foreach($arr_users as $user) { ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['firstName']; ?></td>
                    <td><?php echo $user['lastName']; ?></td>
                    <td><?php echo date("F d, Y", strtotime($user['birthday'])) ; ?></td>
                    <td><?php echo $user['address']; ?></td>
                    <td><?php echo $user['gender']== '0'? "Male":"Female"; ?></td>
                    <td value="<?= $user['departmentId'];?>"><?= $user['departmentName'];?></td>        
                </tr>
            <?php } ?>
        <?php } ?>
    </tbody>
</table>
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/scroller/2.1.0/js/dataTables.scroller.min.js"></script>


<script>
jQuery(document).ready(function($) {
    $('#tblUser').DataTable({
        // "bPaginate": false,
        "bLengthChange": false,
        "searching": false,
        "paging": false,
        "info": false,
        "sDom": "lfrti",
        


        paging: true,
        deferRender:    true,
        scrollY:        350,
        scrollCollapse: true,
        scroller:       true,
        buttons:['createState', 'savedStates']
    });

    {}
} );
</script>