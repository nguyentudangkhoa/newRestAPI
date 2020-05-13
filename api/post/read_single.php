<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require('../../config/db.php');
require('../../models/Post.php');

$db = new DB();


$post = new Post($db->Connect());
//get id
$post->id = isset($_GET['id'])?$_GET['id']:die();

//get post
$post->read_single();


$post_arr = array(
    'id'=>$post->id,
    'username'=>$post->username,
    'password'=>$post->password
);
print_r(json_encode($post_arr));
?>