
<?php
// Habilitar reporte de errores para depuración (deshabilitar en producción)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Log para depuración
function debug_log($message) {
    error_log(date('[Y-m-d H:i:s]') . ' ' . $message . "\n", 3, __DIR__ . '/debug.log');
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    debug_log("Received POST request.");
    debug_log("POST data: " . print_r($_POST, true)); // Log all POST data

    // Consider loading API key from environment variable for security
    $apiKey = getenv('DEEPL_API_KEY'); // Load from environment variable
    if ($apiKey === false) {
         // Fallback to hardcoded key if env var is not set (less secure)
         // Or better, throw an error or log a critical message
         $apiKey = "09d61d9d-9a9f-44d0-bb44-b97c2486034a:fx"; // Your hardcoded key
         error_log("DEEPL_API_KEY environment variable not set. Using hardcoded key.");
         debug_log("DEEPL_API_KEY environment variable not set. Using hardcoded key.");
    }


    // Expecting an array of texts in the 'texts' POST parameter
    if (!isset($_POST["texts"])) {
        debug_log("Error: 'texts' parameter not provided.");
        http_response_code(400); // Bad Request
        echo json_encode(["error" => "No texts provided."]);
        exit;
    }

    $textsJson = $_POST["texts"];
    debug_log("'texts' parameter received: " . $textsJson);

    $texts = json_decode($textsJson, true); // Decode the JSON array
    debug_log("Result of json_decode: " . print_r($texts, true)); // Log decoded data

    if (!is_array($texts)) {
        debug_log("Error: Invalid texts format. Expected JSON array.");
        http_response_code(400); // Bad Request
        echo json_encode(["error" => "Invalid texts format. Expected JSON array."]);
        exit;
    }

    $targetLang = $_POST["target_lang"] ?? "EN"; // Default to EN if not provided
    debug_log("Target language: " . $targetLang);


    $url = "https://api-free.deepl.com/v2/translate";
    $translatedTexts = [];

    // Prepare data for DeepL API - Send as JSON
    $data = array(
        "text" => $texts, // Send the array of texts
        "target_lang" => $targetLang
    );
    $dataJson = json_encode($data); // Encode data as JSON
    debug_log("Data sent to DeepL API (JSON): " . $dataJson);


    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    // Send JSON data directly
    curl_setopt($ch, CURLOPT_POSTFIELDS, $dataJson);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: DeepL-Auth-Key " . $apiKey,
        // Change Content-Type to application/json
        "Content-Type: application/json",
        "Content-Length: " . strlen($dataJson) // Set Content-Length header
    ));

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Get HTTP status code
    curl_close($ch);

    debug_log("DeepL API HTTP Code: " . $httpCode);
    debug_log("DeepL API Response: " . $response);


    $result = json_decode($response, true);

    // Check for API errors
    if ($httpCode !== 200) {
        http_response_code($httpCode); // Set response code from API
        echo json_encode(["error" => "DeepL API error: " . ($result['message'] ?? 'Unknown error'), "details" => $result]);
        // Log the error details
        error_log("DeepL API Error (HTTP Code: {$httpCode}): " . ($result['message'] ?? 'Unknown error') . " Response: " . $response);
        debug_log("DeepL API Error (HTTP Code: {$httpCode}): " . ($result['message'] ?? 'Unknown error') . " Response: " . $response);
        exit;
    }


    // Extract translated texts
    if (isset($result["translations"]) && is_array($result["translations"])) {
        foreach ($result["translations"] as $translation) {
            if (isset($translation["text"])) {
                $translatedTexts[] = $translation["text"];
            }
        }
        debug_log("Extracted translated texts: " . print_r($translatedTexts, true));
    } else {
         http_response_code(500); // Internal Server Error
         echo json_encode(["error" => "Unexpected response format from DeepL API.", "details" => $result]);
         error_log("Unexpected DeepL API response format: " . $response);
         debug_log("Unexpected DeepL API response format: " . $response);
         exit;
    }


    // Return the array of translated texts
    header('Content-Type: application/json');
    echo json_encode(["translatedTexts" => $translatedTexts]);
    debug_log("Successfully returned translated texts.");


} else {
    // Handle non-POST requests
    debug_log("Received non-POST request.");
    http_response_code(405); // Method Not Allowed
    echo json_encode(["error" => "Method not allowed."]);
}
?>
