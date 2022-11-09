<?php
session_start();
ini_set('display_errors', 0);
$session_id=session_id();
define('DIR_BASE',$_SERVER['DOCUMENT_ROOT'].'/');
define('DIR_UPLOADS',DIR_BASE.'uploads/');
if($_GET['submit']==1){
	$target_dir = "uploads/";
	$target_file=DIR_UPLOADS."".$session_id.".ads";
	$date=date('YmdHis');
	$ads_name=$date."".$session_id.".ads";
	$ads_file=DIR_UPLOADS."$ads_name";
	$download_file="uploads/$ads_name";
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$uploadOk = 1;
	}

// Check if file already exists
	if (file_exists($target_file)) {
		echo "Sorry, file already exists.";
		$uploadOk = 0;
	}

// Check file size
//    if ($_FILES[$session_id]["size"] > 500000) {
//        echo "Sorry, your file is too large.";
//        $uploadOk = 0;
//    }

// Allow certain file formats
	if($imageFileType != "ads" ) {
		$upload_status="Sorry, only ADS files are allowed.";
		$uploadOk = 0;
	}

// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		$upload_status="Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES[$session_id]["tmp_name"], $target_file)) {
			$upload_status="The file ". htmlspecialchars( basename( $_FILES[$session_id]["name"])). " has been uploaded.<BR>";
		} else {
			$upload_status="Sorry, there was an error uploading your file.";
		}
	}
	$new_ads=fopen($ads_file,'a');
	$file_content=file($target_file);
	$content="";
	foreach ($file_content as $line){
		if(substr($line,0,8)=='VN880006'){
			$content.=$line."\r\n";
		}
	}
	fwrite($new_ads,$content);
	fclose($new_ads);
	unlink($target_file);
	$download_status="<br>
<a href='$download_file' download>
<h2 style='border: black;border-style: double;border-width: 5px;width: 100px;background-color: gray;'>Download</h2>

</a>
";
}
echo "<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8' name='viewport' content='width=device-width, initial-scale=1'>
<link rel='stylesheet'
      href='./css/bm-asui.css'>
</head>
<body>
	<div class='header'>
    	<H1 class='header-text'>ADS zu UMC Konverter</H1>
    	    <a href='lkv_neu.umc' download='lkv_neu.umc'>
<button class='btn'><i class='custom-file-upload'></i>HerdMetrix UMC Konfigurationsdatei</button>
</a>
    </div>

<div class='converter'>
<H2 class='header-text'>Datei Konvertieren</H2>
<form enctype='multipart/form-data' action='ads_umc.php?submit=1' method='POST'>
    <!-- MAX_FILE_SIZE muss vor dem Datei-Eingabefeld stehen -->
    <ul>
    <li>1. Laden Sie die ADS Datei ihres LKV`s auf ihren PC herunter</li>
    <li>2. Klicken Sie auf<br>
		<label for=\"fileToUpload\" class=\"custom-file-upload\">
		<i class=\"fa fa-cloud-upload\"></i> Datei zum umwandeln auswählen
		</label>
		<input type='file' name='$session_id' id='fileToUpload'><br>
		und laden die Datei hoch
		</li>
	<li>3. Klicken Sie auf <br>
	    <input type='submit' name='submit' value='Datei Konvertieren' class='custom-file-upload '></li>";
if($_GET['submit']==1){
	  echo " <li>4. $upload_status</li>
	    <li>5. Klicken Sie auf <br>$download_status<br>, laden die Datei herunter und importieren Sie die Datei über die UMC Funktion in HerdMetrix</li>";
}
echo "</ul> 
</form>
</div>
</body>
</html>";

