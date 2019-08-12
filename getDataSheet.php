<?php
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
  
  // Get the API client and construct the service object.
  // $client = getClient();
  $service = new Google_Service_Sheets($client);
  $spreadsheetId = '1CQ7noAv4qW95M918l_3cSFNHjHgqcBcDqsd_T0Qx7uw';
  $range = 'Registros!A1:D5';
  $response = $service->spreadsheets_values->get($spreadsheetId, $range);
  $values = $response->getValues();

    if (count($values) == 0) {
        print "No data found.\n";
    } else {
      return json_encode($response->values);

    }