<?php  
$open = "[";
$close = "]";
if ($file = fopen("/Applications/XAMPP/xamppfiles/htdocs/COMPSCI399/exampleTemplate.txt", "r")) {
    while(!feof($file)) {
        $line = fgets($file);
        echo $line;
        echo nl2br("\n");
        if (str_contains($line, "[")){
            $open_pos = strpos($line, $open);
            $end_pos = strpos($line, $close);
            $length = ($end_pos - $open_pos) + 1;
            echo substr($line, $open_pos, $length);
            echo nl2br("\n");
        }
    }
    fclose($file);
}
 ?>  