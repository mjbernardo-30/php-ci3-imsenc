<?php
require_once 'connection.php';
require_once 'logger.php';
require_once 'constants.php';
require_once 'zipArchiver.class.php';

// Move rejected registrants Images to zip
logger("Start housekeep job - SID and GID images", "housekeep-".date("Y-m-d").".txt");
$sql = "SELECT * FROM registration_stg WHERE status = 2 and housekeep = 0";
$result = $conn->query($sql);

$destinationDirectory = "../assets/data/";
$destinationFolderName = "hkeep-".date("Y-m-d");
if ($result->num_rows > 0) {
    if (!file_exists($destinationDirectory.$destinationFolderName)) {
        mkdir($destinationDirectory.$destinationFolderName, 0744, true);
        logger("Folder created - ".$destinationFolderName, "housekeep-".date("Y-m-d").".txt");
    }

    $reference = array();
    $data = array();
    while($row = $result->fetch_assoc()) {
        array_push($data, array("Reference" => $row['reference'], "GID" => $row["gid"], "SID" => $row["sid"]));
    }

    if (count($data) > 0) {
        foreach ($data as $row) {
            $hgid = false;
            $hsid = false;
            if (!empty($row["GID"])) {
                if (!file_exists($row["GID"])) {
                    $hgid = moveFile($row["GID"], $destinationDirectory.$destinationFolderName);
                    if ($hgid)
                        logger("GID Archive success. Reference: ".$row["Reference"], "housekeep-".date("Y-m-d").".txt");
                }

                if (!file_exists($row["SID"])) {
                    $hsid = moveFile($row["SID"], $destinationDirectory.$destinationFolderName);
                    if ($hsid)
                        logger("SID Archive success. Reference: ".$row["Reference"], "housekeep-".date("Y-m-d").".txt");
                }
            }

            if ($hgid == true && $hsid == true)
                array_push($reference, "'".$row["Reference"]."'");
        }
    }
    
    $process = false;
    if (count($reference) > 0) {
        $update = "UPDATE registration_stg SET housekeep = 1 WHERE reference IN (".join(",", $reference).")";
        try {
            mysqli_query($conn, $update);
            $process = true;
        } catch (Exception $ex) {
            logger("Exception occur when updating table. ".$ex->getMessage(), "housekeep-".date("Y-m-d").".txt");
        }
    }

    if ($process == true) {
        try {
            $sourceZipPath = $destinationDirectory;
            $outputZip = $destinationFolderName.".zip";
            $pathInfo = pathinfo($sourceZipPath);
            $parentPath = $pathInfo['dirname'];
            $dirName = $pathInfo['basename'];

            $zipper = new ZipArchiver;
            $zip = $zipper->zipDir($sourceZipPath.$destinationFolderName, "../outputFiles/".$outputZip);
            if($zip){
                logger("Zip folder created: ".$outputZip, "housekeep-".date("Y-m-d").".txt");
                // Delete folder
                $files = glob($sourceZipPath.$destinationFolderName.'/*');
                foreach ($files as $file) {
                    if(is_file($file))
                        unlink($file);  
                }
                rmdir($sourceZipPath.$destinationFolderName);
            } else
                logger("Exception occur when zipping the folder. ".$ex->getMessage(), "housekeep-".date("Y-m-d").".txt");
        } catch (Exception $ex) {
            logger("Exception occur when zipping the folder. ".$ex->getMessage(), "housekeep-".date("Y-m-d").".txt");
        }
    }

    mysqli_close($conn);
    exit();
} else {
    logger("No data to housekeep", "housekeep-".date("Y-m-d").".txt");
}

function moveFile($fileName, $destination) {
    try {
        $source = "../assets/data/stg/";
        $sourceFile = $source.str_replace(BASE_URL."assets/data/stg/", "", $fileName);
        $destination = $destination."/".str_replace(BASE_URL."assets/data/stg/", "", $fileName);
        
        logger("Move file. Source: ".$sourceFile." Destination: ".$destination, "housekeep-".date("Y-m-d").".txt");
        if (!file_exists($sourceFile)) {
            logger("Source file not found. Source: ".$sourceFile, "housekeep-".date("Y-m-d").".txt");
            return true;
        }

        if (copy($sourceFile, $destination)) {
            if (unlink($sourceFile)) {
                return true;
            } else {
                logger("Delete file fail. Source: ".$sourceFile, "housekeep-".date("Y-m-d").".txt");
            }
        }

        logger("Copy file fail. Source: ".$sourceFile, "housekeep-".date("Y-m-d").".txt");
        return false;
    } catch (Exception $ex) {
        logger("Exception occur when moving file. ".$ex->getMessage(), "housekeep-".date("Y-m-d").".txt");
        return false;
    }
}
?>