
$host = "localhost";   // MySQL server
$username = "root";        // MySQL username
$pass = "";            // MySQL password
$db = "db_data";   // MySQL database name

// 2️⃣ Create a connection
$conn =new mysqli($host, $username, $pass, $db);

// 3️⃣ Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 4️⃣ Read raw POST data (ESP is sending JSON)
$data = file_get_contents("php://input");

// 5️⃣ Decode JSON to PHP array
$json = json_decode($data, true);

// 6️⃣ Validate JSON
if (!$json || !isset($json['temp']) || !isset($json['hum'])) {
    die("Invalid JSON data");
}

// 7️⃣ Extract temperature and humidity values
$temp = floatval($json['temp']);
$hum  = floatval($json['hum']);

// 8️⃣ Prepare SQL INSERT statement using placeholders
$stmt = $conn->prepare("INSERT INTO sensor_data (TEMPERATURE, HUMIDITY) VALUES (?, ?)");

// 9️⃣ Bind parameters: "dd" = two doubles (temperature, humidity)
$stmt->bind_param("dd", $temp, $hum);

// 🔟 Execute the statement
if ($stmt->execute()) {
    echo "OK";  // Send response back to ESP
} else {
    echo "ERROR: " . $stmt->error;
}

// 1️⃣1️⃣ Close statement and connection
$stmt->close();
$conn->close();
?>