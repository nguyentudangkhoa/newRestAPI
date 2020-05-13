<?php
//
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require('../../config/db.php');
require('../../models/Post.php');

$db = new DB();


$post = new Post($db->Connect());

$result = $post->read();

$num_rows = $result->rowCount();

if($num_rows > 0){
    $post_arr = array();
    $post_arr['users'] = array();
    while($row = $result->fetch()){
        extract($row);
        $post_item = array(
            "id"=>$row['id'],
            "username"=>$row['username'],
            "password"=>$row['password']
        );
        array_push($post_arr['users'],$post_item);
    }
    echo json_encode($post_arr);
}else{
    echo json_encode(
        array(
            "message"=>"No data"
        )
    );
}


?>