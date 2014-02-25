<?php
/*
 * Simplified version of quickstart.php found on http://developers.google.com/drive/quickstart-php
 *
 */

require_once 'google-api-php-client/src/Google_Client.php';
require_once 'google-api-php-client/src/contrib/Google_DriveService.php';

$client = new Google_Client();

// Get your credentials from the Google cloud console
$client->setClientId('');
$client->setClientSecret('');

// It is a must to redirect back to this script.
// In your case, replace www.indochili.com to your own domain name.
// On your server, put this script on e.g. /var/www (Apache) or /usr/share/nginx/www (Nginx) or etc.
$client->setRedirectUri('http://www.indochili.com/test_gdrive.php');

$client->setScopes(array('https://www.googleapis.com/auth/drive'));

$service = new Google_DriveService($client);

$authUrl = $client->createAuthUrl();

// Exchange authorization code for access token
$accessToken = $client->authenticate();
$client->setAccessToken($accessToken);

//Insert a file
$file = new Google_DriveFile();
$file->setTitle('My document');
$file->setDescription('A test document');
$file->setMimeType('text/plain');

//$data = file_get_contents('document.txt');
$data = 'Test 1 2 3';

$createdFile = $service->files->insert($file, array(
      'data' => $data,
      'mimeType' => 'text/plain',
    ));

//print_r($accessToken);
print_r($createdFile);

?>
