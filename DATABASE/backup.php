<?php
// Database configuration
$host = "localhost";
$username = "root";
$password = "";
$database_name = "dbpw192_18410100054";

// Connect to database
$conn = mysqli_connect($host, $username, $password, $database_name);
$conn->set_charset("utf8");

// Get all table names in the database
$tables = array();
$query = "SHOW TABLES";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_row($result)) {
    $tables[] = $row[0];
}

// Initialize empty SQL script variable
$sqlScript = "";

// Process each table
foreach ($tables as $table) {
    // Fetch table structure
    $query = "SHOW CREATE TABLE `" . $table . "`";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_row($result);
    $sqlScript .= "\n\n" . $row[1] . ";\n\n";

    // Fetch table data
    $query = "SELECT * FROM `" . $table . "`";
    $result = mysqli_query($conn, $query);
    $columnCount = mysqli_num_fields($result);

    // Generate INSERT statements for table data
    while ($row = mysqli_fetch_row($result)) {
        $sqlScript .= "INSERT INTO `" . $table . "` VALUES(";
        for ($i = 0; $i < $columnCount; $i++) {
            if (isset($row[$i])) {
                $sqlScript .= '"' . $conn->real_escape_string($row[$i]) . '"';
            } else {
                $sqlScript .= '""';
            }
            if ($i < ($columnCount - 1)) {
                $sqlScript .= ',';
            }
        }
        $sqlScript .= ");\n";
    }
    $sqlScript .= "\n";
}

// Close database connection
mysqli_close($conn);

// Save SQL script to a backup file
if (!empty($sqlScript)) {
    $backup_file_name = $database_name . '_backup_' . time() . '.sql';
    $fileHandler = fopen($backup_file_name, 'w+');
    $number_of_lines = fwrite($fileHandler, $sqlScript);
    fclose($fileHandler);

    // Download backup file via browser
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($backup_file_name));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($backup_file_name));
    ob_clean();
    flush();
    readfile($backup_file_name);

    // Delete the backup file from server
    unlink($backup_file_name);
    exit;
}
?>
