<?php

declare(strict_types=1);

use App\EurExchangeRateRequest;
use GuzzleHttp\Client;

require_once __DIR__.'/vendor/autoload.php';

$eurExchangeRate = new EurExchangeRateRequest(new Client(['base_uri' => 'http://api.nbp.pl']));

echo 'Json Output: <pre>'.$eurExchangeRate->fetchJson()->getBody().'</pre>';

echo 'Xml Output: <pre>'.$eurExchangeRate->fetchXml()->getBody().'</pre>';

