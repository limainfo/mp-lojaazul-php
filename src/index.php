<?php 
//namespace Limainfo\MpLojaazulPhp;
require __DIR__ .  '/../vendor/autoload.php';

session_start();
//MercadoPago\SDK::setAccessToken('PROD_ACCESS_TOKEN');
MercadoPago\SDK::setAccessToken('APP_USR-6437218142285656-021419-b6b0aa82f68b1567b87a8ad237733646-24743188');
// Cria um objeto de preferência
$preference = new MercadoPago\Preference();

// Cria um item na preferência
$item = new MercadoPago\Item();
$item->title = 'Meu produto';
$item->quantity = 1;
$item->unit_price = 75.56;
$preference->items = array($item);
$preference->save();
// SDK MercadoPago.js

$status = 'OK';
$mensagemstatus = 'Registros ';
include("view_pagina_cabecalho.php");
include("view_pagina_menu.php");
include("view_products.php");
include("view_pagina_rodape.php");
include("view_geral_ajax.php");



?>		
