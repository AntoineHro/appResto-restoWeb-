<?php


/**
 * Retourne une adresse IP
 *
 * @return void
 */
function get_ip()
{
  $ip = $_SERVER['HTTP_CLIENT_IP']
    ?? $_SERVER["HTTP_CF_CONNECTING_IP"] # when behind cloudflare
    ?? $_SERVER['HTTP_X_FORWARDED']
    ?? $_SERVER['HTTP_X_FORWARDED_FOR']
    ?? $_SERVER['HTTP_FORWARDED']
    ?? $_SERVER['HTTP_FORWARDED_FOR']
    ?? $_SERVER['REMOTE_ADDR']
    ?? '0.0.0.0';
return $ip; 
}

// fonction de loging
function logToDisk($login, $password, $resultat, $message, $operation)
{
  // Horodatage
  $date = new DateTime('now',new DateTimeZone('Europe/Paris'));
  $laDate = $date->format("Y-m-d H:i:s.u");
  $root = dirname(__FILE__); // Dossier courant
  $chaine = $login . " | " . $password . " | " . $laDate . " | " . get_ip() . " | " . $operation . " | " . $resultat . " | " . $message . " | " . PHP_EOL;

  if ($operation == "connexion" || $operation == "tentative-connexion"){
    $filename = $root . DIRECTORY_SEPARATOR . 'filesCO'. DIRECTORY_SEPARATOR . 'log.txt';
    file_put_contents($filename, $chaine, FILE_APPEND);
  } 
  if ($operation == "inscription" || $operation == "tentative-inscription"){
    $filename = $root . DIRECTORY_SEPARATOR . 'filesIN'. DIRECTORY_SEPARATOR . 'log.txt';
    file_put_contents($filename, $chaine, FILE_APPEND);
  } 
}

?>