<?php 
namespace Limainfo\MpLojaazulPhp;
require 'vendor/autoload.php';

session_start();

$ip = $_SERVER['REMOTE_ADDR'];
$host = $_SERVER['HTTP_HOST'];
$appID = '';
$status = '';


$status = 'OK';
$mensagemstatus = 'Registros ';
include("view_pagina_cabecalho.php");
include("view_pagina_menu.php");
include("view_products.php");
include("view_pagina_rodape.php");
include("view_geral_ajax.php");



?>		
