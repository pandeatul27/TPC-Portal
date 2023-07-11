<!DOCTYPE html>
<html>
  <head>
    <title>Student Details</title>
   <style>
* {
  margin: 0;
  padding: 0;
  font-family: Arial, sans-serif;
}

form:hover {
  pointer-events: none;
}

form:hover * {
  pointer-events: auto;
}


/* Style the form container */
form {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
  background-color: #f2f2f2;
  border-radius: 10px;
}

/* Style the form labels */
form label {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
}

/* Style the form inputs */
form input[type="text"],
form input[type="number"] {
  padding: 8px;
  border-radius: 5px;
  border: none;
  margin-bottom: 15px;
  width: 100%;
  box-sizing: border-box;
}

/* Style the form input in read-only mode */
form input[type="text"]:read-only,
form input[type="number"]:read-only {
  background-color: #d9d9d9;
  color: #777;
}

/* Style the form input in focus mode */
form input[type="text"]:focus,
form input[type="number"]:focus {
  outline: none;
  box-shadow: 0 0 5px #b3d4fc;
}

/* Style the form submit button */
form input[type="submit"] {
  background-color: #4CAF50;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  pointer-events: none;
}

/* Style the form submit button on hover */
form input[type="submit"]:hover {
  background-color: #3e8e41;
}
/*nav css */
nav {
			background-color: #333;
			color: #fff;
			overflow: hidden;
		}

		nav a {
			float: left;
			display: block;
			color: #fff;
			text-align: center;
			padding: 14px 16px;
			text-decoration: none;
		}

		nav a:hover {
			background-color: #ddd;
			color: #333;
		}

/* Add a responsive breakpoint for smaller screens */
@media (max-width: 600px) {
  form {
    max-width: 400px;
  }
}
</style>
<script>
       // Get all input elements
const inputs = document.querySelectorAll("input");

// Loop through each input element
inputs.forEach(function(input) {
  // If the value is null or 0, hide the element
  console.log(input.value);
  if (input.value == null || input.value =="0") {
    input.style.value = "---";
  }
});

</script>
  </head>
  <body>
    
    <?php
    // ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
      // Connect to the MySQL database
      $host = 'localhost';
    $user = 'root';
    $password = 'password123';
    $dbname = 'minipro';
      
      	$conn = mysqli_connect("localhost", "root", "password123", "minipro");
	session_start();
	
	
if(!isset($_SESSION['sess_user'])){
    header('Location: login.php');
}

$roll = $_SESSION['sess_user'];
$result = mysqli_query($conn, "select * from student_users where student_id = '$roll'"); 
$row = mysqli_fetch_array($result);

$Alumini =$row["alumini"];
if($Alumini==true)header('Location: alumini_display.php');
$result = mysqli_query($conn, "select * from studentDetails where roll = '$roll'"); 
$row = mysqli_fetch_array($result);
$name=$row["name"];
$age=$row["age"];
// $roll=$row["roll"];
$branch=$row["branch"];
$area_of_interest=$row["area_of_interest"];
$batch_year=$row["batch_year"];
$class_10_marks=$row["10marks"];
$class_12_marks=$row["12marks"];
$sem_1=$row["sem_1"];
$sem_2=$row["sem_2"];
$sem_3=$row["sem_3"];
$sem_4=$row["sem_4"];
$sem_5=$row["sem_5"];
$sem_6=$row["sem_6"];
$sem_7=$row["sem_7"];
$sem_8=$row["sem_8"];
$cum_cpi=$row["Cpi"];
$company_name=$row["Comp_name"];
$package=$row["package"];
$role=$row["role"];
// $roll = $row["roll"];
      // Retrieve the data from the students table
      // $stmt = $pdo->prepare("SELECT * FROM studentDetails WHERE roll = $roll");
      // $stmt->execute([':roll' => $roll]);
      // $student = $stmt->fetch();

      // Output the data in form fields
    ?>
    <nav>
    <a href="http://localhost/minpro/student_dashboard.php">Home</a>
		<a href="http://localhost/minpro/studentDisplay.php">Profile</a>
		<a href="http://localhost/minpro/studentUpdate.php">Update</a>
		<a href="http://localhost/minpro/EligibleJob.php">Eligible Jobs</a>
    <a href="logout.php" style="float: right; background-color: red;">Logout</a>


	</nav>

  <h1>Student Profile :</h1>

<div class="container">
    <form>
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" value="<?php echo $name; ?>" readonly>

      <label for="age">Age:</label>
      <input type="text" id="age" name="age" value="<?php echo $age; ?>" readonly>

      <label for="roll">Roll Number:</label>
      <input type="text" id="roll" name="roll" value="<?php echo $roll; ?>" readonly>

      <label for="specialization">Specialization:</label>
      <input type="text" id="specialization" name="specialization" value="<?php echo $branch; ?>" readonly>


      <label for="area_of_interest">Area of Interest:</label>
      <input type="text" id="area_of_interest" name="area_of_interest" value="<?php echo $area_of_interest; ?>" readonly>

      <label for="batch_year">Batch Year:</label>
      <input type="text" id="batch_year" name="batch_year" value="<?php echo $batch_year; ?>" readonly>

      <label for="class_10_marks">Class 10 Marks:</label>
      <input type="text" id="class_10_marks" name="class_10_marks" value="<?php echo $class_10_marks; ?>" readonly>

      <label for="class_12_marks">Class 12 Marks:</label>
      <input type="text" id="class_12_marks" name="class_12_marks" value="<?php echo $class_12_marks; ?>" readonly>
     
      <label for="sem1">Semester 1:</label>
      <input type="text" id="sem1" name="sem1" value="<?php echo $sem_1; ?>" readonly>
      <label for="sem2">Semester 2:</label>
      <input type="text" id="sem2" name="sem2" value="<?php echo $sem_2; ?>" readonly>
      <label for="sem3">Semester 3:</label>
      <input type="text" id="sem3" name="sem3" value="<?php echo $sem_3; ?>" readonly>
      <label for="sem4">Semester 4:</label>
      <input type="text" id="sem4" name="sem4" value="<?php echo $sem_4; ?>" readonly>
      <label for="sem5">Semester 5:</label>
      <input type="text" id="sem5" name="sem5" value="<?php echo $sem_5; ?>" readonly>
      <label for="sem6">Semester 6:</label>
      <input type="text" id="sem6" name="sem6" value="<?php echo $sem_6; ?>" readonly>
      <label for="sem7">Semester 7:</label>
      <input type="text" id="sem7" name="sem7" value="<?php echo $sem_7; ?>" readonly>
      <label for="sem8">Semester 8:</label>
      <input type="text" id="sem8" name="sem8" value="<?php echo $sem_8; ?>" readonly>

      <label for="cpi">Overall Cpi:</label>
      <input type="text" id="cpi" name="cpi" value="<?php echo $cum_cpi; ?>" readonly>
      
      <label for="company">Company:</label>
      <input type="text" id="company" name="company" value="<?php echo $company_name; ?>" readonly>
      <label for="package">Package:</label>
      <input type="text" id="package" name="package" value="<?php echo $package; ?>" readonly>
      <label for="role">Role:</label>
      <input type="text" id="role" name="role" value="<?php echo $role; ?>" readonly>


      
      </form>
    </div>
  </body>
</html>

