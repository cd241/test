<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType!= "txt") {
        echo "Sorry, only .txt files are allowed.";
        $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $convert = exec('python /usr/local/lib/python2.7/site-packages/dna/dna.py -e /var/www/html/'.$target_file);
            $get_file_contents = file_get_contents("/var/www/html/".$target_file.".dna");
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

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


    // Generates random 8 character long alphanumeric value
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
?>

<!DOCTYPE html>
<html>
<body>

    <br>
    <label>Converted String: <?php echo $get_file_contents; ?> </label>
    <br><br><br>
    <a href="carverr.html">Go back</a>

</body>
</html>