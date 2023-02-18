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
  
  
      <!-- Hidden input to store your integration public key -->
    <input type="hidden" id="mercado-pago-public-key" value="{{ public_key }}">


    <!-- Payment -->
    <section class="payment-form dark">
        <div class="container__payment">
            <div class="block-heading">
                <h2>Card Payment</h2>
                <p>This is an example of a Mercado Pago integration</p>
            </div>
            <div class="form-payment">
                <div class="products">
                    <h2 class="title">Summary</h2>
                    <div class="item">
                        <span class="price" id="summary-price"></span>
                        <p class="item-name">Book x <span id="summary-quantity"></span></p>
                    </div>
                    <div class="total">Total<span class="price" id="summary-total"></span></div>
                </div>
                <div class="payment-details">
                    <form id="form-checkout">
                        <h3 class="title">Buyer Details</h3>
                        <div class="row">
                            <div class="form-group col">
                                <input id="form-checkout__cardholderEmail" name="cardholderEmail" type="email" class="form-control"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-5">
                                <select id="form-checkout__identificationType" name="identificationType" class="form-control"></select>
                            </div>
                            <div class="form-group col-sm-7">
                                <input id="form-checkout__identificationNumber" name="docNumber" type="text" class="form-control"/>
                            </div>
                        </div>
                        <br>
                        <h3 class="title">Card Details</h3>
                        <div class="row">
                            <div class="form-group col-sm-8">
                                <input id="form-checkout__cardholderName" name="cardholderName" type="text" class="form-control"/>
                            </div>
                            <div class="form-group col-sm-4">
                                <div class="input-group expiration-date">
                                    <div id="form-checkout__expirationDate" class="form-control h-40"></div>
                                </div>
                            </div>
                            <div class="form-group col-sm-8">
                                <div id="form-checkout__cardNumber" class="form-control h-40"></div>
                            </div>
                            <div class="form-group col-sm-4">
                                <div id="form-checkout__securityCode" class="form-control h-40"></div>
                            </div>
                            <div id="issuerInput" class="form-group col-sm-12 hidden">
                                <select id="form-checkout__issuer" name="issuer" class="form-control"></select>
                            </div>
                            <div class="form-group col-sm-12">
                                <select id="form-checkout__installments" name="installments" type="text" class="form-control"></select>
                            </div>
                            <div class="form-group col-sm-12">
                                <input type="hidden" id="amount" />
                                <input type="hidden" id="description" />
                                <div id="validation-error-messages">
                                </div>
                                <br>
                                <button id="form-checkout__submit" type="submit" class="btn btn-primary btn-block">Pay</button>
                                <br>
                                <p id="loading-message">Loading, please wait...</p>
                                <br>
                                <a id="go-back">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 10 10" class="chevron-left">
                                        <path fill="#009EE3" fill-rule="nonzero"id="chevron_left" d="M7.05 1.4L6.2.552 1.756 4.997l4.449 4.448.849-.848-3.6-3.6z"></path>
                                    </svg>
                                    Go back to Shopping Cart
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Result -->
    <section class="shopping-cart dark">
        <div class="container container__result">
            <div class="block-heading">
                <h2>Payment Result</h2>
                <p>This is an example of a Mercado Pago integration</p>
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="items product info product-details">
                            <div class="row justify-content-md-center">
                                <div class="col-md-4 product-detail">
                                    <div class="product-info">
                                        <div id="fail-response">
                                            <br/>
                                            <img src="img/fail.png" width="350px">
                                            <p class="text-center font-weight-bold">Something went wrong</p>
                                            <p id="error-message" class="text-center"></p>
                                            <br/>
                                        </div>

                                        <div id="success-response">
                                            <br/>
                                            <p><b>ID: </b><span id="payment-id"></span></p>
                                            <p><b>Status: </b><span id="payment-status"></span></p>
                                            <p><b>Detail: </b><span id="payment-detail"></span></p>
                                            <br/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>