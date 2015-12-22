<?php

require_once('../includes/database.php');    
require_once('../includes/user.php');   

$user = new User($db);
$my_user = $user->find_by_id(1);

echo $my_user->get_full_name();

echo "<hr />";

$users = $user->find_all();
foreach($users as $user){
    echo "User: ". $user->username ."<br />";
    echo "Name: ". $user->get_full_name() ."<br /><br />";
    echo "<hr />";
}
?>