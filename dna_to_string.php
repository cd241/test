<?php

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if file already exists
    // if (file_exists($target_file)) {
    //     echo "Sorry, file already exists.";
    //     $uploadOk = 0;
    // }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType!= "dna") {
        echo "Sorry, only .txt.dna files are allowed.";
        $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $convert = exec('python /usr/local/lib/python2.7/site-packages/dna/dna.py -d /var/www/html/'.$target_file);

            $explode = explode("/", $target_file);
            $explode1 = explode(".", $explode[1]);

            //$converted_file = glob("uploads/*decoded");
            $get_file_contents = file_get_contents("/var/www/html/uploads/".$explode1[0].".".$explode1[1].".decoded");
            //echo "Converted String: ".$get_file_contents;
            // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

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