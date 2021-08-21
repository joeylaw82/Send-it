<?php
$row = 1;
$column = array();
if (($handle = fopen("/Applications/XAMPP/xamppfiles/htdocs/COMPSCI399/example.csv", "r")) !== FALSE) {
    while (($raw_data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if ($row == 1){
            $num = count($raw_data);
            for ($c=0; $c < $num; $c++) {
                if ( $c == 0){
                    $column = array(array(str_replace(' ', '', $raw_data[$c])));
                }else{
                array_push($column, array(str_replace(' ', '', $raw_data[$c])));
                }
            }
        }
        if ($row > 1){
            for ($c=0; $c < $num; $c++) {
               array_push($column[$c],str_replace(' ', ' ', $raw_data[$c]));
            }
        }
        $row++;
    }
    $numD = count($column[0]);
    for($d=1;$d < $numD; $d++){
        for($c=0; $c < $num; $c++){
            if($c == 0){
                $email = $column[$c][$d]."@aucklanduni.ac.nz";
            }else{
                break;
            }
        }
    }
    $header_array = array();
    for ($c =0; $c < $num; $c++){
        $header_array[] = $column[$c][0];
    }
    fclose($handle);
}
$open = "[";
$close = "]";
$template = file_get_contents("/Applications/XAMPP/xamppfiles/htdocs/COMPSCI399/exampleTemplate.txt");
$temlpate_array = array();
$all_body = array();
if ($file = fopen("/Applications/XAMPP/xamppfiles/htdocs/COMPSCI399/exampleTemplate.txt", "r")) {
    while(!feof($file)) {
        $line = fgets($file);
        $temlpate_array[] = $line;
    }
    fclose($file);
}
for($d=1;$d < $numD; $d++){
    $body = "";
    $new_line = "";
    $check = "";
    foreach ($temlpate_array as $line){
        if (str_contains($line, "[")){
            $open_pos = strpos($line, $open);
            $end_pos = strpos($line, $close);
            $length = ($end_pos - $open_pos) + 1;
            $placeholder = substr($line, $open_pos, $length);
            $header = substr($line, $open_pos+1, $length-2);
            if(in_array($header,$header_array)){
                $key = array_search($header, $header_array); 
                $new_line = str_replace($placeholder,$column[$key][$d] ,$line);
                $new_line = $new_line."<br>";
                if($check == $header && $column[$key][$d] > 0){
                    $body = $body.$new_line;
                }
                else if($check == ""){
                    $body = $body.$new_line;
                }
            }else if (str_contains($header, "ifNonNull")){
                $open_pos = strpos($line, " ");
                $end_pos = strpos($line, $close);
                $length = ($end_pos - $open_pos);
                $check = substr($line, $open_pos, $length);
                $check = str_replace(' ', '', $check);
            }
        }else{
            $new_line = $line."<br>";
            $body = $body.$new_line;
        }
    }
    array_push($all_body, $body);
}
    $e = 1;
    foreach($all_body as $body){
        echo "Email:";
        print_r($column[0][$e]."@aucklanduni.ac.nz");
        echo nl2br("\n");
        print_r($body);
        $e++;
    }
?>