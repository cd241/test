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
	    //echo "Connected successfully"; 
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

    $myfile = fopen("uploads/".$randomString.".txt", "w") or die("Unable to open file!");

   	fwrite($myfile, $updatedString);

   	fclose($myfile);

   	$convert = exec('python /usr/local/lib/python2.7/site-packages/dna/dna.py -e /var/www/html/uploads/'.$randomString.'.txt');
    $get_file_contents = file_get_contents("/var/www/html/uploads/".$randomString.".txt.dna");

    $length = strlen($get_file_contents);

    if($length > 50 && $length < 120) {
        echo "Good String length";
    }

    if($length > 120) {
        echo "String length over 120 characters";
    }

    if($length < 50) {
        echo "String length less than 50 characters";
    }

    $a = "AAA";
    $c = "CCC";
    $g = "GGG";
    $t = "TTT";

    if(substr_count($get_file_contents, $a) > 0) {
        echo "AAA is present";
    }

    if(substr_count($get_file_contents, $c) > 0) {
        echo "CCC is present";
    }

    if(substr_count($get_file_contents, $g) > 0) {
        echo "GGG is present";
    }

    if(substr_count($get_file_contents, $t) > 0) {
        echo "TTT is present";
    }

    $cus_name = $_GET['cus_name'];
    $cus_number = $_GET['cus_number'];
    $chasis = $_GET['chasis'];
    $host = $_GET['host'];
    $ppg = $_GET['ppg'];
    $cus_location = $_GET['cus_location'];
    $geotag = $_GET['geotag'];
    $tag = $_GET['tag'];

?>

<!DOCTYPE html>
<html>
<body>

    <br>

    <form action="order_tag.php" method="GET">
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
	    <select name="geotag">
		  <option value="Yes">Yes</option>
		  <option value="No">No</option>
		</select>

		<br>

		<label>Tag Type & Number</label>
		<input type="text" name="tag">

		<br><br>

		<input type="submit" value="Order Tag" name="submit">
    </form>
    


    <br><br><br>
    <a href="carverr.html">Go back</a>

</body>
</html>