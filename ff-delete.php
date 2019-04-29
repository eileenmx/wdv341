<?php

include("../wdv341/connect.php");

try {

    $sql = "DELETE FROM ff_dogs WHERE dog_id='$dogID'";

	$stmt = $conn->prepare($sql); 
    $stmt->execute();
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
    echo "This dog's records have been deleted successfully. <a href='ff-select.php'>Back to foster dogs list</a>";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>