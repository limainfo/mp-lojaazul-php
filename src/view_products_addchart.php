<?php $subtotal = 0; $indice = 0;  ?>
<div class="block">
	<div class="block_content">
		<form accept-charset="utf-8" action="controller_products.php" method="post" enctype="multipart/form-data" id="productsForm" onSubmit="return false;">
<?php foreach ($_SESSION['comprados'] as $ind=>$valor): ?>
<?php if ($valor['qty']>0): ?>
            
			<h2><img src="<?= $valor['imgsrc'] ?>" class="img-thumbnail" alt="Card image cap"><?php echo $valor['nome']; ?></h2>
			<h3><?php echo $valor['descricao']; ?></h3>
			<h3><?php echo $valor['reference']; ?></h3>
			<h3><?php echo $valor['id']; ?></h3>
			<h2><?php echo $valor['price']; ?></h2>
			Qty:<select class="custom-select" name="qty[]" id="qty<?php echo $indice; ?>" >
				  <option selected><?php echo $valor['qty']; $number_ = number_format(str_replace(',','.',str_replace('.','',str_replace('R$ ','',$valor['price']))), 2, '.', ''); $subtotal += $valor['qty']*$number_; ?></option>
				  <option value="0">0</option>
				  <option value="1">1</option>
				  <option value="2">2</option>
				  <option value="3">3</option>
				</select>
			<p></p>
			<hr>
			<input type="hidden" name="id[]" value="<?php echo $valor['id']; ?>" />
			<input type="hidden" name="nome[]" value="<?php echo $valor['nome']; ?>" />
			<input type="hidden" name="descricao[]" value="<?php echo $valor['descricao']; ?>" />
			<input type="hidden" name="imgsrc[]" value="<?php echo $valor['imgsrc']; ?>" />
			<input type="hidden" name="reference[]" value="<?php echo $valor['reference']; ?>" />
			<input type="hidden" name="price[]" value="<?php echo $valor['price']; ?>" />
			<input type="hidden" name="ip[]" value="<?php echo $valor['ip']; ?>" />



			<p><input type="submit" class="submit small lightgray" value="Change QTY" onClick="updateQty('<?php echo $valor['reference']; ?>','#qty<?php echo $indice; ?>');"/>		
			<hr>
<?php $indice++; endif;  ?>
<?php endforeach; ?>
			<input type="hidden" name="controller" id="controller" value="<?php echo $controllernome; ?>" />
			<input type="hidden" name="acao" id="acao" value="products" />
			<div class="mensagensform"  style="margin:0px;padding:0px;diplay:none;">
			<div class='message errormsg' id='erro' ><p id='txterroform'></p><span title='Dismiss' class='close' onclick="$('.mensagensform').hide('slow');"></span></div></div>
<?php if($indice==0){ ?>
	<h3>The Chart is empty.</h3>
<?php }else{ ?>
                            <h3>Cart</h3>
                            <div class="summary-item"><span class="text">Subtotal:&nbsp;&nbsp;&nbsp;&nbsp;<b></span><span class="price" id="cart-total"><?php echo $subtotal; ?></span></b></div>
                            <button class="btn btn-primary btn-lg btn-block" style="width:100%;" id="checkout-btn" onClick="envia();">PAGUE A COMPRA</button>
<?php }  ?>					
		</form>
		<?php //print_r($_SESSION);		?>
<script type="text/javascript">
//<![CDATA[
$('#erro').hide();
$('.mensagensform').hide();

function envia() {
  $('#acao').val('showchartbuy');
  var dados = $("#<?php echo $controllernome; ?>Form").serialize();

  $.ajax({
	type: 'POST',
	 processData: true,
    url: 'controller_<?php echo $controllernome; ?>.php',
    beforeSend: function(){
      $("#spinner").css({'display':'block'});
	},
    success: function(data) {
	  $('#manipulacao').html(data);
      $("#spinner").css({'display':'none'});
    },
    error: function() {},
    data: dados,
    datatype: 'html',
    contentType: 'application/x-www-form-urlencoded'
  });
 }

 
function updateQty(referencia, idQty) {
  var newValue = $(idQty).val();
  var parametros = {'controller':'<?php echo $controllernome; ?>','acao':'updateQty', 'referencia':referencia, 'qty': newValue };
  $.ajax({
	type: 'POST',
	 processData: true,
    url: 'controller_<?php echo $controllernome; ?>.php',
    beforeSend: function(){
      $("#spinner").css({'display':'block'});
	},
    success: function(data) {
	  $('#manipulacao').html(data);
      $("#spinner").css({'display':'none'});
    },
    error: function() {},
    data: parametros ,
    datatype: 'html',
    contentType: 'application/x-www-form-urlencoded'
  });
  
 }



function mudaselect(controller, campoorigem, campodestino) {
	  var valor = $('#'+origem).val();
	var parametros = {'controller':controller,'acao':'select', 'campo':campoorigem, 'valor': valor, 'campodestino':campodestino };
  $.ajax({
	type: 'POST',
	 processData: true,
    url: 'controller_<?php echo $controllernome; ?>.php',
    beforeSend: function(){
      $("#spinner").css({'display':'block'});
	},
    success: function(data) {
	  $('#'+campodestino).html(data);
      $("#spinner").css({'display':'none'});
    },
    error: function() {},
    data: parametros ,
    datatype: 'html',
    contentType: 'application/x-www-form-urlencoded'
  });
  
 }

function comutacampo(controller, origem, destino, campodestino, resposta, ordem  , tipodestino, valor) {
	  var parametros = {'controller':controller,'acao':'comuta', 'campo':origem, 'valor': valor, 'campodestino':campodestino, 'destino':destino, 'resposta':resposta, 'ordem':ordem, 'tipodestino':tipodestino };
	  $.ajax({
		type: 'POST',
		 processData: true,
	    url: 'controller_<?php echo $controllernome; ?>.php',
	    beforeSend: function(){
	      $("#spinner").css({'display':'block'});
		},
	    success: function(data) {
		    if(tipodestino == 'select'){
		  		$('#'+destino).html(data);
			}else{
				if(tipodestino == 'qtd'){
					$('#'+destino).spinner({ max: data });
					$('#'+destino).val(data);
				}else{
					$('#'+destino).val(data);
				}
			}

		    
	      $("#spinner").css({'display':'none'});
	    },
	    error: function() {},
	    data: parametros ,
	    datatype: 'html',
	    contentType: 'application/x-www-form-urlencoded'
	  });
	  
	 }
 
//]]>
</script>

	</div>		<!-- .block_content ends -->
	<div class="bendl"></div>
	<div class="bendr"></div>
</div>		<!-- .block ends -->

