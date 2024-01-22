<?php
require './../vendor/autoload.php';
use \Mailjet\Resources;

// Setarea calei către fișierul cacert.pem
ini_set('curl.cainfo', 'C:\wamp64\bin\php\php8.2.0\extras\ssl\cacert.pem');

// Inițializați clientul Mailjet cu setările dvs.
$mj = new \Mailjet\Client('de5b01318fcb185ab14b2a1658664399', '8992d2474f71082399479da1a6e2658c', true, ['version' => 'v3.1']);

// Corpul mesajului pentru Mailjet
$body = [
    'Messages' => [
        [
            'From' => [
                'Email' => 'negreacatalin27@gmail.com',
                'Name' => "Mailjet Pilot"
            ],
            'To' => [
                [
                    'Email' => 'negreaflorina366@yahoo.com',
                    'Name' => "passenger 1"
                ]
            ],
            'Subject' => "Your email flight plan!",
            'TextPart' => "Dear passenger 1, welcome to Mailjet! May the delivery force be with you!",
            'HTMLPart' => "<h3>Dear passenger 1, welcome to <a href=\"https://www.mailjet.com/\">Mailjet</a>!</h3><br />May the delivery force be with you!"
        ]
    ]
];

// Trimiterea cererii către Mailjet
$response = $mj->post(Resources::$Email, ['body' => $body]);

// Verificarea răspunsului și afișarea rezultatului
if ($response->success()) {
    var_dump($response->getData());
} else {
    echo 'Error: ' . $response->getStatus() . ' - ' . $response->getReasonPhrase() . PHP_EOL;
    var_dump($response->getData());
}
?>
