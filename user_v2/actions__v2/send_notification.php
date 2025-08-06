<?php
include '../../app/vConn.php';
include '../../firebase.php';

function sendNotification($urlPartner, $Clavedelservidor){
    $url ="https://fcm.googleapis.com/fcm/send";

    $fields=array(
        "to"=>'/topics/quinielas',
        "notification"=>array(
            "body"=>$_REQUEST['message'],
            "title"=>$_REQUEST['title'],
            "click_action"=>$urlPartner
        )
    );

    $headers=array(
        'Authorization: key=' . $Clavedelservidor,
        'Content-Type:application/json'
    );

    $ch=curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_POST,true);
    curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($fields));
    $result=curl_exec($ch);
    print_r($result);
    curl_close($ch);

    header('location:' . $urlPartner . '/panel/notify');
    
}

sendNotification($urlPartner, $Clavedelservidor);