<?php
include ('products.php');

?>



<div class="container">
  <div class="row align-items-start  justify-content-center">
  
  <?php foreach ($products as $value):  ?>
    <div class="col-sm-4">
	
        <div class="card text-center  border-dark mb-3">
          <img  id="imgsrc<?= $value['id'] ?>" src="<?= $value['imgsrc'] ?>" alt="Card image cap"  >
          <div class="card-body">
            <h6 class="card-title" id="nome<?= $value['id'] ?>"><?= $value['nome'] ?></h6>
            <h7 class="card-title" id="descricao<?= $value['id'] ?>"><?= $value['descricao'] ?></h7>
            <p class="card-text" id="price<?= $value['id'] ?>">R$ <?= number_format($value['price'], 2, ',', '') ?></p>
          <ul class="list-group list-group-flush">
            <li class="list-group-item" id="id<?= $value['id'] ?>"><?= $value['id'] ?></li>
          </ul>
			<input type="hidden" id="reference<?= $value['id'] ?>" value="<?php echo $value['reference']; ?>" />
            <a href="#" class="btn btn-primary" onclick="addchart('<?= $value['id'] ?>');">Add to Cart</a>
          </div>
        </div>	
	
	</div>
  <?php  endforeach;  ?>
	
  </div>
  <br><br><br><br>
  
    
</div>