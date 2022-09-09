<?php
define('DB_DSN', 'mysql:host=mysql-8;dbname=tzin');
define('DB_User', 'root');
define('DB_Password', 'root');

try {
    $dbh = new PDO(DB_DSN, DB_User, DB_Password, [PDO::ATTR_PERSISTENT => true]);
    echo "Подключились\n";
} catch (Exception $e) {
    die("Не удалось подключиться: " . $e->getMessage(). PHP_EOL) ;
}

$contentPosts = file_get_contents('https://jsonplaceholder.typicode.com/posts');
$contentComments = file_get_contents('https://jsonplaceholder.typicode.com/comments');

$posts = json_decode($contentPosts);
$comments = json_decode($contentComments);

try {
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $dbh->beginTransaction();

    $countPosts = 0;
    $countComments = 0;
    foreach ($posts as $post) {
        if ($dbh->exec("insert into posts (user_id, id, title, body) values ('$post->userId', '$post->id', '$post->title', '$post->body')")) {
            $countPosts++;
        }
    }
    foreach ($comments as $comment) {
        if ($dbh->exec("insert into comments (post_id, id, name, email, body) values ('$comment->postId', '$comment->id', '$comment->name', '$comment->email', '$comment->body')")) {
            $countComments++;
        };
    }
    $dbh->commit();
    echo "Загружено " . $countPosts . " записей и " . $countComments . " комментариев\n";
} catch (Exception $e) {
    $dbh->rollBack();
    echo "Ошибка: " . $e->getMessage() . PHP_EOL;
}

