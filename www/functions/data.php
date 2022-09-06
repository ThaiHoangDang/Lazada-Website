<?php
    function readcsv(string $path): array{
        // Create empty array and open file
        $data = [];  
        $file = fopen($path, "r");
        if ($file !== false) {
            // Read the headers of the csv
            flock($file, LOCK_SH);
            $title_line = fgetcsv($file);
            // Read all the values and assign them to the corresponding headers
            while (!feof($file)) {
                $line = fgetcsv($file);
                if (!empty($line)) {
                    $data_fields = [];
                    for ($index = 0; $index < count($title_line); $index++) {
                        $data_fields[$title_line[$index]] = $line[$index];
                    }
                    $data[] = $data_fields;
                }
            }
            flock($file, LOCK_UN);
            fclose($file);
        }
        return $data;
    }
    function writecsv(string $path, array $data): bool {
        $file = fopen($path, "w");
        if ($file !== false) {
            flock($file, LOCK_EX);
            // Create an array of headers
            $title_line = [];
            foreach ($data[0] as $title => $field) {
                $title_line[] = $title;
            }
            // Write to csv with the first line containing headers
            fputcsv($file, $title_line);
            foreach ($data as $fields) {
                fputcsv($file, $fields);
            }
            flock($file, LOCK_UN);
            fclose($file);
            return true;
        }
    return false;
    }
    function getimagearray(array $product): array{
        $string = $product["Image"];
        $data = explode("|", $string);
        return $data;
    }
    function getproductdata(array $items) {
        if (isset($_GET["id"])) {
            foreach ($items as $item) {
                if ($_GET["id"] == $item["Product ID"]) {
                    return $item;
                }
            }
        }
        return false;
    }
    function getuserbyusername(string $id, array $arr):array{
        foreach ($arr as $i){
            if ($i["username"]==$id){
                return $i;
            }
        }
        return false;
    }
    function getproductbyid(string $id, array $arr):array{
        foreach ($arr as $i){
            if ($i["Product ID"]==$id){
                return $i;
            }
        }
        return false;
    }
?>