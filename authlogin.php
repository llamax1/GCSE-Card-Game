<?php
$post = $array_map('htmlspecialchars', $_POST);
$names = explode('\n', file_get_contents('goodnames.txt'));
if (in_array($post['name'],$names)){
    echo 'true';
}

else {
    echo 'false';
}
?>