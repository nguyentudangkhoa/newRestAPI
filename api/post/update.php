<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,
Access-Control-Allow-Methods, Authorization, X-Requested-With');

require('../../config/db.php');
require('../../models/Post.php');

$db = new DB();


$post = new Post($db->Connect());

//Get raw post data

$data = json_decode(file_get_contents("php://input"));
$post->id = $data->id;
$post->username = $data->username;
$post->password = $data->password;


//Create
if($post->update()){
    echo json_encode(
        array(
            'message'=>'Post Update'
        )
    );
}else{
    echo json_encode(
        array(
            'message'=>'Post not update'
        )
    );
}