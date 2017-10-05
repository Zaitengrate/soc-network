<?php

class Image {

  public static function uploadImage($formname ,$query, $params) {

    $image = base64_encode(file_get_contents($_FILES[$formname]['tmp_name']));

    $options = array('http'=>array(
      'method'=>"POST",
      'header'=>"Authorization: Bearer \n".
      "Content-Type: application/x-www-form-urlencoded",
      'content'=>$image
    ));

    $context = stream_context_create($options);

    $imgURL = "https://api.imgur.com/3/image";

    if($_FILES[$formname]['size'] > 10240000) {
      die('Image is too big, must be below 10mb');
    }

    $response = file_get_contents($imgURL, false, $context);
    $response = json_decode($response);

    $preparams = array($formname=>$response->data->link);

    $params = $preparams + $params;

    DB::query($query, $params);

  }
}
