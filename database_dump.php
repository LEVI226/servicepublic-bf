<?php
// Simple PHP Database Dump Script
$host = '127.0.0.1';
$db   = 'servicepublic_bf';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

$return = "";

// Get all tables
$tables = [];
$result = $pdo->query('SHOW TABLES');
while($row = $result->fetch(PDO::FETCH_NUM)) {
    $tables[] = $row[0];
}

foreach($tables as $table) {
    $result = $pdo->query('SELECT * FROM '.$table);
    $num_fields = $result->columnCount();

    $return .= 'DROP TABLE IF EXISTS '.$table.';';
    $row2 = $pdo->query('SHOW CREATE TABLE '.$table)->fetch(PDO::FETCH_NUM);
    $return .= "\n\n".$row2[1].";\n\n";

    while($row = $result->fetch(PDO::FETCH_NUM)) {
        $return .= 'INSERT INTO '.$table.' VALUES(';
        for($j=0; $j<$num_fields; $j++) {
            $row[$j] = addslashes($row[$j]);
            $row[$j] = str_replace("\n","\\n",$row[$j]);
            if (isset($row[$j])) { $return .= '"'.$row[$j].'"' ; } else { $return .= '""'; }
            if ($j<($num_fields-1)) { $return.= ','; }
        }
        $return .= ");\n";
    }
    $return .= "\n\n\n";
}

// Save file
$handle = fopen('database/backups/servicepublic_bf_dump.sql','w+');
fwrite($handle, $return);
fclose($handle);

echo "Dump completed successfully: database/backups/servicepublic_bf_dump.sql\n";
?>
