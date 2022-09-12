<?php
require_once 'db.php';

$query = $_POST['search'];
$query = trim(strip_tags(stripcslashes(htmlspecialchars(($query)))));
if (strlen($query) < 3) {
    echo '<b>Слишком короткий поисковый запрос.</b>';
    die;
}

$conn = mysqli_connect(DB_Host, DB_User, DB_Password, DB_Name);
$sql = "SELECT p.id, p.title, c.body
FROM posts p 
INNER JOIN comments c ON c.post_id = p.id
WHERE c.body LIKE '%$query%'
GROUP BY c.id";
$search = mysqli_query($conn, $sql);
$numRows = mysqli_num_rows($search);

if ($numRows > 0) {
    echo '<div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                <tr>
                    <th scope="col">Post Title</th>
                    <th scope="col">Comments</th> 
                </tr>
                </thead>
                <tbody>';
    while ($data = mysqli_fetch_assoc($search)) {
        echo '<tr>
                <td>' . $data["title"] . '</td>
                <td>' . $data["body"] . '</td>
                </tr>';
    }
    echo '</tbody></table></div>';
} else {
    echo '<b>Ничего не найдено.</b>';
}
mysqli_free_result($search);
mysqli_close($conn);