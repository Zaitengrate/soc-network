<?php
include 'classes/DB.php';
include 'classes/Login.php';
$showTimeline = false;

if (Login::isLoggedIn()) {
  $showTimeline = true;
} else {
  echo "Not logged in";
}

$followingposts = DB::query('SELECT posts.id, posts.body, posts.likes, users.`username` FROM users, posts, followers
WHERE posts.user_id = followers.user_id
AND users.id = posts.user_id
AND follower_id = 1
ORDER BY posts.likes DESC;');

foreach ($followingposts as $post) {
  echo $post['body']." ~ ".$post['username']."<hr />";
}

 ?>
