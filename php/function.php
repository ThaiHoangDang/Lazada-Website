<?php
    function readcsv(string $path): array{
        $data = [];  
        $file = fopen($path, "r");
        if ($file !== false) {
            flock($file, LOCK_SH);
            $title_line = fgetcsv($file);
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
            $title_line = [];
            foreach ($data[0] as $title => $field) {
                $title_line[] = $title;
            }
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
        $string = $product['Image'];
        $data = explode("|", $string);
        return $data;
    }
    function getproductdata(array $items) {
        if (isset($_GET["id"])) {
            foreach ($items as $item) {
                if ($_GET["id"] === $item["Product ID"]) {
                    return $item;
                }
            }
        }
        return false;
    }
    // $data = readcsv("../data/users.csv");
    // $pass = readcsv("../data/pass.csv");
    // for ($i=0;$i<count($data);$i++){
    //     // $hash = password_hash($data[$i]["password"],PASSWORD_DEFAULT);
    //     // $data[$i]["password"] = $hash;
    //     $verify = password_verify($pass[$i]["password"], $data[$i]["password"]);
    //     if ($verify) {
    //         echo 'Password Verified!';
    //     } else {
    //         echo 'Incorrect Password!';
    //     }
    // }

    // writecsv("../data/users.csv", $data);
    // echo '<pre>';
    // print_r($data);
    // echo '</pre>';

?>