<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style/style.css">
    <?php
    function getDepartment($db)
    {
        $query = "SELECT * FROM `hr_department` ORDER BY departmentName ASC" ;
        return $result = mysqli_query($db, $query);
    }

    ?>
</head>
<body>



<div class="container">
  <form action="jera_action.php" method="POST">
  <h2>Your details</h2>
  <div class="row">
    <div class="col-25">
      <label for="fname">First Name</label>
    </div>
    <div class="col-75">
    <input required type="text" name="firstName" placeholder="Your first name...">
    </div>
  </div>

  <div class="row">
    <div class="col-25">
      <label for="lname">Last Name</label>
    </div>
    <div class="col-75">
    <input required type="text" name="lastName" placeholder="Your last name...">
    </div>
  </div>

  <div class="row">
    <div class="col-25">
      <label for="lname">Address</label>
    </div>
    <div class="col-75">
    <textarea required name="address" placeholder="Your address..." cols="30" rows="3"></textarea>
    </div>
  </div>

  <div class="row">
    <div class="col-25">
      <label for="country">Gender</label>
    </div>
    <div class="col-75">
			  <input required type="radio" name="gender" value="0">
			  <label for="male">Male</label>
			  <input required type="radio" name="gender" value="1">
			  <label for="female">Female</label>
		</p>
    </div>
  </div>

  <div class="row">
    <div class="col-25">
      <label for="lname">Birthday</label>
    </div>
    <div class="col-75">
    <input required type="date" name="birthday">
    </div>
  </div>

  
  
  <div class="row">
    <input class="button" style="background-color: black;" type="submit" name="submit" value="Submit">
  </div>

  </form>
</div>

</body>
</html>


