<?php include __DIR__ . '/Worker.php';

echo "Countries\n";

foreach($countries as $d2 => $value) {
    echo array_search($d2, $cc) . ';' . $d2 . ';' . number_format($value, 2, ',', '.') . "\n";
}

echo "Accounts\n";

foreach($accounts as $key => $value) {
    echo $key . ';' . number_format($value, 2, ',', '.') . "\n";
}