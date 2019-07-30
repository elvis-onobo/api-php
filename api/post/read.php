<?php
/*
This section reads all the data in the database
*/
// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

// Instatiate DB and connect
$database = new Database();
$db = $database->connect();

// Instatiate blog post object
$post = new Post($db);

// blog post query
$result = $post->read();
// Get row count
$num = $result->rowCount();

// check if any posts
if($num > 0){
    // post array
    $post_arr = array();
    $post_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $post_item = array(
            'id' => $id,
            'title' => $title,
            'body' => $body,
            'author' => $author,
            'category_id' => $category_id,
            'category_name' => $category_name
        );

        // push to the data array
        array_push($post_arr['data'], $post_item);
    }

    // convert to JSON and output
    echo json_encode($post_arr);
}else{
    echo json_encode(array('message'=> 'No Posts Found'));
}

