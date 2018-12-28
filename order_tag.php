<?php
	
	error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $servername = "localhost";
	$username = "root";
	$password = "Duelmasters241!";

	try {
	    $conn = new PDO("mysql:host=$servername;dbname=order_tag", $username, $password);
	    // set the PDO error mode to exception
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    echo "Connected successfully"; 
	}
	
	catch(PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}

	// Generates random 6 character long alphanumeric value
    function generateRandomString($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    $randomString = generateRandomString();

    $updatedString = "CRV".$randomString."CRV";

    //echo $updatedString;

    $myfile = fopen("uploads/".$randomString.".txt", "w") or die("Unable to open file!");

   	fwrite($myfile, $updatedString);

   	fclose($myfile);

?>

<!DOCTYPE html>
<html>
<body>

    <br>
    <label>Customer Name</label>
    <input type="text" name="cus_name">

    <br>

    <label>Contact Number</label>
    <input type="number" name="cus_number">

    <br>

    <label>Chasis</label>
    <input type="text" name="chasis">

    <br>

    <label>Host</label>
    <input type="text" name="host">

    <br>

    <label>PPG</label>
    <input type="PPG" name="ppg">

    <br>

    <label>Host Location</label>
    <input type="text" name="cus_location">

    <br>

    <label>Geotag</label>
    <select>
	  <option value="Yes">Yes</option>
	  <option value="No">No</option>
	</select>

	<br>

	<label>Tag Type & Number</label>
	<input type="text" name="tag">

	<br>

	<button>Order Tag</button>


    <br><br><br>
    <a href="carverr.html">Go back</a>

</body>
</html>