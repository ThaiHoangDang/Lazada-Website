<?php
    function readcsv(string $path): array{
        $data = [];  
        $file = fopen($path, "r");
        if ($file !== false) {
            flock($file, LOCK_SH);
            $title_line = fgetcsv($file, null, ';');
            while (!feof($file)) {
                $line = fgetcsv($file, null, ';');
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
            fputcsv($file, $title_line, ";");
            foreach ($data as $fields) {
                fputcsv($file, $fields,";");
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
?>