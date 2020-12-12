<?php
// This line prevents XSS attacks
$post = array_map('htmlspecialchars', $_POST);

// Opens each line to new array item, without newline characters at the end
$names = file('goodnames.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
if (in_array($post['p1name'],$names) && in_array($post['p2name'],$names)){
    session_start();
    echo "true";
    $_SESSION['p1'] = $post['p1name'];
    $_SESSION['p2'] = $post['p2name'];
    
}

else {
    if (!in_array($post['p1name'],$names)){
        echo 'Player 1\'s username is incorrect';
    }
    if (!in_array($post['p2name'],$names)) {
        echo '
Player 2\'s username is incorrect';
    }
}
?>