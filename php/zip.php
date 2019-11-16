<?php
    if(!isset($_SESSION["centre"])){
        header("Location: ../index.php");
    }
    function getPhotos($id){
        require("bdd.php");
        
        $files = array();
        $req = $bdd->prepare("SELECT `url` FROM `photo` WHERE `id_Event`=:id");
        $req->execute(array(
            ':id'=>$id
        ));
        while($result = $req->fetch(PDO::FETCH_BOTH)){
            $files[]=$result[0];
        }
        # create new zip object
        if(!empty($files)){
        $zip = new ZipArchive();

        # create a temp file & open it
        $tmp_file = tempnam('.', '');
        $zip->open($tmp_file, ZipArchive::CREATE);

        # loop through each file
        foreach ($files as $file) {
            # download file
            $download_file = file_get_contents($file);

            #add it to the zip
            $zip->addFromString(basename($file), $download_file);
        }

        # close zip
        $zip->close();

        # send the file to the browser as a download
        header('Content-disposition: attachment; filename="my file.zip"');
        header('Content-type: application/zip');
        readfile($tmp_file);
        unlink($tmp_file);
    }
    }
?>