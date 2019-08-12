<?php
use function GuzzleHttp\json_encode;
header('Access-Control-Allow-Origin: http://octopusmediagroup.celtra.com/*');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('content-type: application/json; charset=utf-8');
require_once __DIR__ . '/vendor/autoload.php';
define('APPLICATION_NAME', 'Nissan');
define('CLIENT_SECRET_PATH', __DIR__ . '/key.json');
define('CREDENTIALS_PATH',  __DIR__ .'/nissanform-ed5a14e568ed.json');
// If modifying these scopes, delete your previously saved credentials
// at ~/.credentials/sheets.googleapis.com-php-quickstart.json
    $client = new \Google_Client();
    $client->setApplicationName(APPLICATION_NAME);
    $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
    $client->setAccessType('offline');
    $client->setAuthConfig(CLIENT_SECRET_PATH);
  
    $service = new Google_Service_Sheets($client);
    $spreadsheetId = '1CQ7noAv4qW95M918l_3cSFNHjHgqcBcDqsd_T0Qx7uw';
    $range = 'Registros';
    $nombre = $_GET['nombre'];
    $apellido = $_GET['apellido'];
    $agencia = $_GET['agencia'];
    $email = $_GET['email'];
    $telefono = $_GET['telefono'];
    $values = [
        [$nombre,$apellido,$email,$telefono,$agencia]
    ];
    $body = new Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);
    $params = [
        'valueInputOption' => 'RAW'
    ];
    $insert = [
        "insertDataOption" => "INSERT_ROWS"
    ];
    $response = $service->spreadsheets_values->append(
        $spreadsheetId, 
        $range,
        $body,
        $params,
        $insert
    );

    return json_encode($response);
    
