<?php
$row = 1;
if (($handle = fopen("/Applications/XAMPP/xamppfiles/htdocs/COMPSCI399/example.csv", "r")) !== FALSE) {
    while (($raw_data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if ($row == 1){
            $num = count($raw_data);
            for ($c=0; $c < $num; $c++) {
                if ( $c == 0){
                    $column = array(array($raw_data[$c]));
                }else{
                array_push($column, array($raw_data[$c]));
                }
            }
        }
        if ($row > 1){
            for ($c=0; $c < $num; $c++) {
               array_push($column[$c],$raw_data[$c]);
            }
        }
        $row++;
    }
    $numD = count($column[0]);
    for($d=1;$d < $numD; $d++){
        for($c=0; $c < $num; $c++){
            print_r($column[$c][0]);
            echo nl2br("\n");
            if($c == 0){
                $email = $column[$c][$d]."@aucklanduni.ac.nz";
                print_r($email);
                echo nl2br("\n");
            }else{
                print_r($column[$c][$d]);
                echo nl2br("\n");
            }
        }
        echo nl2br("\n");
    }
    fclose($handle);
}
?>
