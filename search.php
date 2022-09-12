<?php
require_once 'db.php';

$query = $_POST['search'];
$query = trim(strip_tags(stripcslashes(htmlspecialchars(($query)))));

$conn = mysqli_connect(DB_Host, DB_User, DB_Password, DB_Name);
$sql = "SELECT p.id, p.title, p.body
FROM posts p 
INNER JOIN comments c ON c.post_id = p.id
WHERE c.body LIKE '%$query%'
GROUP BY p.id";
$search = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_assoc($search)) {
    echo '<li>' . $data["title"] . '</li>';
}
mysqli_free_result($search);
mysqli_close($conn);