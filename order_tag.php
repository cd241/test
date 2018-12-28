<?php
	
	error_reporting(E_ALL);
    ini_set('display_errors', 1);

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

    echo $updatedString;

    $file = 'uploads/'.$randomString.'.txt';
	// Open the file to get existing content
	$current = file_get_contents($file);
	// Append a new person to the file
	$current .= $updatedString;
	// Write the contents back to the file
	file_put_contents($file, $current);
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