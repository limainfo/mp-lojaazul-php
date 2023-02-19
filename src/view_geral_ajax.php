<!--<script type="text/javascript" src="js/ui/js/jquery-ui-1.10.4.min.js"></script>-->
<script
  src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"
  integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0="
  crossorigin="anonymous"></script>
<!--<script type="text/javascript" src="js/ui/js/jquery-ui-1.13.2/jquery-ui.min.js"></script>-->

<script type="text/javascript">
$("#productmsg").hide();
$("#pagmsg").hide();
$("#notifymsg").hide();


const mp = new MercadoPago('TEST-d6663f9a-bf2d-4d68-95fb-6e491bfdf8bd', {
    locale: 'pt-BR'
  });

$.fx.speeds._default = 1000;
	$(function() {
		$( "#manipulacao" ).dialog({autoOpen: false,modal: true, widht: window.innerWidth * 7/10, show: 'highlight',hide: 'fade'
});
	});	

function addchart(id) {
	var qt = $("#productmsg").text();
	var sum = eval(qt)+1;
	$("#productmsg").text(sum.toString());
	$("#productmsg").show();

	$( "#manipulacao" ).dialog({
		autoOpen: false,
		title:'Insert product on chart',
		position: { my: "center", at: "center", of: window },
		width: 'auto', 
    	maxWidth: 600,
    	height: 'auto',
		fluid: true,
		buttons: {},
		modal: true,
		closeText: "",
		close: function() {
			$( this ).dialog( "close" );
		}
	}); 
  var parametros = {'controller':'products','acao':'addchart', 'id':id, 'nome': $('#nome'+id).text(), 'descricao': $('#descricao'+id).text(), 'imgsrc': $('#imgsrc'+id).attr('src'), 'price': $('#price'+id).text(), 'reference': $('#reference'+id).val(), 'qty': $('#qty'+id).text(),'ip': '<?php  echo $_SERVER['REMOTE_ADDR'] ?>'};
  var dados = parametros;
  $.ajax({
	type: 'POST',
	 processData: true,
    url: 'controller_products.php',
    beforeSend: function(){
      $("#spinner").css({'display':'block'});
	},
    success: function(data) {
      $("#manipulacao").html(data);
      //$("#cadastrados").html('Testando');
      $("#spinner").css({'display':'none'});
      $( "#manipulacao" ).dialog( "open" );

    },
    error: function() {},
    data: dados ,
    datatype: 'html',
    contentType: 'application/x-www-form-urlencoded'
  });
 }


function showchart() {
	$( "#manipulacao" ).dialog({
		autoOpen: false,
		title:'Current Chart',
		position: { my: "center", at: "center", of: window },
		width: 'auto', 
    	maxWidth: 600,
    	height: 'auto',
		fluid: true,
		buttons: {},
		modal: true,
		closeText: "",
		close: function() {
			$( this ).dialog( "close" );
		}
	}); 
  var parametros = {'controller':'products','acao':'showchart','ip': '<?php  echo $_SERVER['REMOTE_ADDR'] ?>'};
  var dados = parametros;
  $.ajax({
	type: 'POST',
	 processData: true,
    url: 'controller_products.php',
    beforeSend: function(){
      $("#spinner").css({'display':'block'});
	},
    success: function(data) {
      $("#manipulacao").html(data);
      //$("#cadastrados").html('Testando');
      $("#spinner").css({'display':'none'});
      $( "#manipulacao" ).dialog( "open" );

    },
    error: function() {},
    data: dados ,
    datatype: 'html',
    contentType: 'application/x-www-form-urlencoded'
  });
 }

 
$(function() {
	 $( ".datepicker" ).datepicker( $.datepicker.regional[ "pt-BR" ] ); 
	 //$( ".datepicker" ).datepicker("option","dateFormat","yy-mm-dd"); 
	 $( ".datepicker" ).datepicker({
		 showButtonPanel: true,
		 buttonImage: "images/calendario.png",
		 buttonImageOnly: true
		}); 
		 $( ".datepicker" ).datepicker();
});






	function convertbr2usa (campo, id){
		var nome = '#'+campo+id;
		var dadocampo = eval("$('"+nome+"').val()");
		if($.isNumeric(dadocampo)){
			return Math.round(dadocampo * 100) / 100;
		}
		dadocampo = dadocampo.replace('.','');
		dadocampo = dadocampo.replace(',','.');
		if(!$.isNumeric(dadocampo)){
			dadocampo = 0;
			eval("$('"+nome+"').val(0);");
		}else{
			eval("$('"+nome+"').val('"+dadocampo+"')");
		}
		return Math.round(dadocampo * 100) / 100;
	}

	function convertmoeda (valor){
		var dadocampo = valor;
		if($.isNumeric(dadocampo)){
			return Math.round(dadocampo * 100) / 100;
		}
		dadocampo = dadocampo.replace('.','');
		dadocampo = dadocampo.replace(',','.');
		if(!$.isNumeric(dadocampo)){
			dadocampo = 0;
		}
		return Math.round(dadocampo * 100) / 100;
	}


	
</script>
