<?php
error_reporting(E_ALL);
session_start();




$nometitulo = 'Product';
$controllernome = 'products';
$controllernomeplural = 'products';


if ( isset($_POST['controller']) &&($_POST['controller']=='products') && ($_POST['acao']=='addchart') ){

	if(!empty($_SESSION['comprados'])){
		$exists = 0;
		foreach ($_SESSION['comprados'] as $ind=>$valor){
			if($valor['reference']==$_POST['reference']){
				$_SESSION['comprados'][$ind]['qty']=$_SESSION['comprados'][$ind]['qty']+1;
				$exists = 1;
			}
		}
		if(!$exists){
			$_SESSION['comprados'][$_SESSION['itens_chart']]['id']=$_POST['id'];
			$_SESSION['comprados'][$_SESSION['itens_chart']]['nome']=$_POST['nome'];
			$_SESSION['comprados'][$_SESSION['itens_chart']]['descricao']=$_POST['descricao'];
			$_SESSION['comprados'][$_SESSION['itens_chart']]['imgsrc']=$_POST['imgsrc'];
			$_SESSION['comprados'][$_SESSION['itens_chart']]['price']=$_POST['price'];
			$_SESSION['comprados'][$_SESSION['itens_chart']]['reference']=$_POST['reference'];		
			if(empty($_SESSION['comprados'][$_SESSION['itens_chart']]['qty'])){
			  $_SESSION['comprados'][$_SESSION['itens_chart']]['qty']=1;
			}
			$_SESSION['comprados'][$_SESSION['itens_chart']]['ip']=$_POST['ip'];			
			$_SESSION['itens_chart'] = $_SESSION['itens_chart']+1;	
		}
	}else{	
		$_SESSION['comprados'][$_SESSION['itens_chart']]['id']=$_POST['id'];
		$_SESSION['comprados'][$_SESSION['itens_chart']]['nome']=$_POST['nome'];
		$_SESSION['comprados'][$_SESSION['itens_chart']]['descricao']=$_POST['descricao'];
		$_SESSION['comprados'][$_SESSION['itens_chart']]['imgsrc']=$_POST['imgsrc'];
		$_SESSION['comprados'][$_SESSION['itens_chart']]['price']=$_POST['price'];
		$_SESSION['comprados'][$_SESSION['itens_chart']]['reference']=$_POST['reference'];
		if(empty($_SESSION['comprados'][$_SESSION['itens_chart']]['qty'])){
		  $_SESSION['comprados'][$_SESSION['itens_chart']]['qty']=1;
		}		
		$_SESSION['comprados'][$_SESSION['itens_chart']]['qty']=$_SESSION['comprados'][$_SESSION['itens_chart']]['qty'];
		$_SESSION['comprados'][$_SESSION['itens_chart']]['ip']=$_POST['ip'];
		$_SESSION['itens_chart'] = $_SESSION['itens_chart']+1;
	}
	include("view_products_addchart.php");
}

if ( isset($_POST['controller']) &&($_POST['controller']=='products') && ($_POST['acao']=='updateQty') ){

		foreach ($_SESSION['comprados'] as $ind=>$valor){
			if($valor['reference']==$_POST['referencia']){
				$_SESSION['comprados'][$ind]['qty']=$_POST['qty'];
			}
		}

	include("view_products_addchart.php");
}



if ( isset($_POST['controller']) &&($_POST['controller']=='products') && ($_POST['acao']=='showchart') ){

	if(!empty($_SESSION['comprados'])){
		include("view_products_addchart.php");
	}else{	
		echo ("<h3>The Chart is empty.</h3>");
	}
}



if ( isset($_POST['controller']) &&($_POST['controller']=='products') && ($_POST['acao']=='showchartbuy') ){
	include("view_products_pagamento.php");
}


if ( isset($_POST['controller']) &&($_POST['controller']=='usuario') && ($_POST['acao']=='exclui') ){
	$status = '';
	$mensagemstatus = '';
	$comeco = ($_POST['pagina']-1) * $maximoregistros;
	$camposcondicao = '';
	$condicao = '"'.$_POST[$campochave].'"';
	if(count($campochave)>1){
		$camposcondicao='concat('.implode(',', $campochave).')';
	}else{
		$camposcondicao=' '.$campochave[0].'';
	}
		
	//if($db->query("delete from app_usuario where $camposcondicao=replace('{$_POST['id']}','#del','') ")){
	if(false){
		$status = 'OK';
		$mensagemstatus = 'Registro excluído com sucesso!';
	}else{
		$status = 'ERRO';
		$mensagemstatus = 'Houve problema para excluir o registro!';
	}
	
	header('Content-type: application/x-json');
	
	echo '{"status":"'.$status.'", "mensagemstatus":"'.$mensagemstatus.'", "conteudo":"'.($conteudo).'"}';
	
}


if ( isset($_POST['controller']) &&($_POST['controller']=='usuario') && ($_POST['acao']=='verfiltro') ){
	//header('Content-type: application/x-json');

	include("view_geral_filtro.php");
	//exit();
}


?>		
