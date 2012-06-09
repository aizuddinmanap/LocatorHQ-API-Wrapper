<?php
include_once('Locationhq.php');

$config = array(
    'ip_address' => $_SERVER['HTTP_HOST'],
    'api_key' => '',
    'username' => ''
  );

$location = new Locationhq();

print_r($location->get_result());

echo $location->get_country();