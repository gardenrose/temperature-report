<?php

// dodamo neku vrijednost grada, i api key na adresu servera, inicijalizira se sesija metodom curl_init 
// kojoj se proslijedi cijeli url sa imenom grada i api kljucem, postave se defaultne opcije za url sesiju
// i output se proslijedi u metodu curl_exec koja izvodi tu sesiju i vraca true/false ovisno o rezultatu
// ako je false, dohvati info o pogresci i izadje sa stranice. Inace zatvori sesiju i sprema odgovor servera
// tj pretvori ga iz json formata u php, provejri je li mu status ERROR, i zatvara stranicu ako je, inace ispisuje
// poruku da je odgovor uspjesan,, i vraca info o dekodiranom odgovoru, tj podacima koje je pretvorio u php, var export 
// ce podatke prikazti u string formatu.
$city_name = "Zagreb";
$API_key = "6bfc891f5b46198a49cd002b8fed4a45";

$service_url = 'https://api.openweathermap.org/data/2.5/weather?q='.$city_name.'&appid='.$API_key;
$curl = curl_init($service_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$curl_response = curl_exec($curl);
if ($curl_response === false) {
    $info = curl_getinfo($curl);
    curl_close($curl);
    die('error occured during curl exec. Additioanl info: ' . var_export($info));
}
curl_close($curl);
$decoded = json_decode($curl_response);
if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
    die('error occured: ' . $decoded->response->errormessage);
}
echo 'response ok!';
var_export($decoded->response);

?>