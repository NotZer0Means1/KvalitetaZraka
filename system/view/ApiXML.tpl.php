<?php
$xml = simplexml_load_string($data['resources']);
if ($xml) {
    echo $xml->asXML();
} else {
    echo "Failed to load XML.";
}

?>
