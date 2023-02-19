

<div id="spinner" style="display:none;">
	<img src="images/loading.gif" alt="">
</div>



<div id="footer">
		<p>Developers Site:</p>
		<p><a href="https://www.mercadopago.com/developers">https://www.mercadopago.com/developers</a></p>
		<p class="left">
			<a href="#"><b>SIOP</b> <i>versão <b>1.1</b></i></a>
		</p>
		<p class="center">
		<?php 
		$tempo = microtime(TRUE) - $medidorinicio;
		echo  'Tempo:<b>'.number_format($tempo, 6) . ' s</b>';
		?>
		</p>
		<p class="right">
			<a href="mailto:limainfo@gmail.com">limainfo@gmail.com</a>
		</p>
</div>


</div>
<!-- wrapper ends -->

</div>
<!-- #hld ends -->



</div>
<div>

<div style="width: 100%;" id="manipulacao" class="ui-dialog-content ui-widget-content"></div>

</div>
</body>
</html>