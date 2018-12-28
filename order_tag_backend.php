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

	// Generates random 8 character long alphanumeric value
    function generateRandomString($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    $cus_name = $_POST['cus_name'];
    $cus_number = $_POST['cus_number'];
    $chasis = $_POST['chasis'];
    $host = $_POST['host'];
    $ppg = $_POST['ppg'];
    $cus_location = $_POST['cus_location'];
    $geotag = $_POST['geotag'];
    $tag = $_POST['tag'];

    if(empty($tag)) {
    	$tag = "";
    }

    if(!empty($cus_name) && !empty($cus_number) && !empty($chasis) && !empty($host) && !empty($ppg) && !empty($cus_location) && !empty($geotag)) {
    	$randomString = generateRandomString();

	    $updatedString = "CRV".$randomString."CRV";

	    $myfile = fopen("uploads/".$randomString.".txt", "w") or die("Unable to open file!");

	   	fwrite($myfile, $updatedString);

	   	fclose($myfile);

	   	$convert = exec('python /usr/local/lib/python2.7/site-packages/dna/dna.py -e /var/www/html/uploads/'.$randomString.'.txt');
	    $get_file_contents = file_get_contents("/var/www/html/uploads/".$randomString.".txt.dna");

	    $dna_string = $get_file_contents;

	    $data = array($cus_name, $randomString, $cus_number, $chasis, $host, $ppg, $cus_location, $geotag, $tag, $dna_string);

	    $stmt = $conn->prepare("INSERT INTO tag_details (cus_name, code, cus_number, chasis, host, ppg, cus_location, geo_tag, tag_type, dna_string) VALUES (?,?,?,?,?,?,?,?,?,?)");
	    $stmt->execute($data);


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