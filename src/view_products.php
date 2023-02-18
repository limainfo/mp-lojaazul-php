<?php
include ('products.php');

?>



<div class="container">
  <div class="row align-items-start  justify-content-center">
  
  <?php foreach ($products as $value):  ?>
    <div class="col-sm-4">
	
        <div class="card text-center  border-dark mb-3">
          <img src="<?= $value['imgsrc'] ?>" alt="Card image cap"  class="card-img-top" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title" id="product<?= $value['id'] ?>"><?= $value['product'] ?></h5>
            <p class="card-text" id="price<?= $value['id'] ?>"><?= $value['price'] ?></p>
          <ul class="list-group list-group-flush">
            <li class="list-group-item" id="reference<?= $value['id'] ?>"><?= $value['reference'] ?></li>
          </ul>
            <a href="#" class="btn btn-primary" onclick="addchart('<?= $value['id'] ?>');">Add to Cart</a>
          </div>
        </div>	
	
	</div>
  <?php  endforeach;  ?>
	
  </div>
  <br><br><br><br>
  
    
</div>