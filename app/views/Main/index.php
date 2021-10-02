<h1>Hello world!</h1>
<?php
    echo $name;
    echo $age;
    debug($names);
    foreach ($posts as $post) {
        echo "<h3>$post->title</h3>";
    }
?>
