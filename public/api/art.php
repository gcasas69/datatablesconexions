<?php
// SET HEADER
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

// INCLUDING DATABASE AND MAKING OBJECT
require '../config/database.php';
$db_connection = new Database();
$conn = $db_connection->dbConnection();

// CHECK GET ID PARAMETER OR NOT
if(isset($_GET['idart']))
{
    //IF HAS ID PARAMETER
    $art_id = filter_var($_GET['idart'], FILTER_VALIDATE_INT,[
        'options' => [
            'default' => 'all_posts',
            'min_range' => 1
        ]
    ]);
}
else{
    $art_id = 'all_posts';
}

// MAKE SQL QUERY
// IF GET POSTS ID, THEN SHOW POSTS BY ID OTHERWISE SHOW ALL POSTS
$sql = is_numeric($art_id) ? "SELECT * FROM `articulos` WHERE idart='$art_id'" : "SELECT * FROM `articulos`"; 

$stmt = $conn->prepare($sql);

$stmt->execute();

//CHECK WHETHER THERE IS ANY POST IN OUR DATABASE
if($stmt->rowCount() > 0){
    // CREATE POSTS ARRAY
    $posts_array = [];
    
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        
        $post_data = [
            'idart' => $row['idart'],
            'codigo' => $row['codigo'],
            'articulo' => html_entity_decode($row['articulo']),
            'categoria' => html_entity_decode($row['categoria']),
            'ubicacion' => html_entity_decode($row['ubicacion']),
            'proveedor' => html_entity_decode($row['proveedor']),
            'm1' => html_entity_decode($row['m1']),
            'v1' => html_entity_decode($row['v1']),
            'm2' => html_entity_decode($row['m2']),
            'v2' => html_entity_decode($row['v2']),
            'm3' => html_entity_decode($row['m3']),
            'v3' => html_entity_decode($row['v3'])
        ];
        // PUSH POST DATA IN OUR $posts_array ARRAY
        array_push($posts_array, $post_data);
    }
    //SHOW POST/POSTS IN JSON FORMAT
    echo json_encode($posts_array);
 

}
else{
    //IF THER IS NO POST IN OUR DATABASE
    echo json_encode(['message'=>'No post found']);
}
?>