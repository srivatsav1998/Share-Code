<?php
	if (isset($_GET['filename']) && isset($_GET['password'])){
		$host = "Yours host name";
		$username = "Yours database's username";
		$password = "Yours database's password";
		$link = mysqli_connect($host, $username, $password);
		mysqli_select_db($link,"hiddenduetosecurityreasons");
		$command = "select * from data where savedname = '".$_GET['filename']."' and password = '".$_GET['password']."';";
		$result = mysqli_query($link,$command);
		if (mysqli_num_rows($result) === 0){
			echo "False";
		}
		else{
			$data = mysqli_fetch_row($result);
			$filename = $data[0];
                        if (isset($_GET['getname'])){
                                echo $filename;
                                exit;
                        }
                        header('Content-Description: File Transfer');
                        header('Content-Type: application/force-download');
                        header("Content-Disposition: attachment; filename=\"" . $filename . "\";");
                        header('Content-Transfer-Encoding: binary');
                        header('Expires: 0');
                        header('Cache-Control: must-revalidate');
                        header('Pragma: public');
                        header('Content-Length: ' . filesize($name));
                        ob_clean();
                        flush();
                        readfile("files/".$_GET['filename']); //showing the path to the server where the file is to be download
		}
	}
	else{
		echo "False";
	}
?>
