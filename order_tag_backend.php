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

    if(!empty($cus_name = $_POST['cus_name'];) && !empty($cus_number = $_POST['cus_number'];) && !empty($chasis = $_POST['chasis'];) && !empty($host = $_POST['host'];) && !empty($ppg = $_POST['ppg'];) && !empty($cus_location = $_POST['cus_location'];) && !empty($geotag = $_POST['geotag'];) && !empty($tag = $_POST['tag'];)) {

    	$randomString = generateRandomString();

	    $updatedString = "CRV".$randomString."CRV";

	    $myfile = fopen("uploads/".$randomString.".txt", "w") or die("Unable to open file!");

	   	fwrite($myfile, $updatedString);

	   	fclose($myfile);

	   	$convert = exec('python /usr/local/lib/python2.7/site-packages/dna/dna.py -e /var/www/html/uploads/'.$randomString.'.txt');
	    $get_file_contents = file_get_contents("/var/www/html/uploads/".$randomString.".txt.dna");

	    $dna_string = $get_file_contents;

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
    }

    else {
    	echo "Enter all details";
    }

?>