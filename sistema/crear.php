<?php
    $com =  strip_tags($_POST['ewretweret']);
    $raiz = file_get_contents("js/com.json");
    $raiz = json_decode($raiz);
    $array = array("con" => $com, "fecha"  => "null");
    $raiz[sizeof($raiz)] =  $array;
    echo json_encode( $raiz);
    $f = fopen("js/com.json","w");
    fwrite($f,json_encode($raiz));
    fclose($f);
?>	