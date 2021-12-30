<?php 


/*

Db = registro1
User = registro2
Pass = Site@12

registro1.mysql.uhserver.com

*/

include('painel/php/db.class.php');

$vis = new db();
$vis->query("SELECT * FROM usuario WHERE user_id = 1 ");
$vis->execute();
$row = $vis->object();


echo $row->user_email;

echo "<hr>";

echo phpinfo();

?>