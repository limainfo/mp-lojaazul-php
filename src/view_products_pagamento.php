<style>
#form-checkout {
    display: flex;
    flex-direction: column;
    max-width: 600px;
}

.tamField {
    height: 30px;
    padding: 0px;
    margin: 0px;
    border: 1px solid gray;
    font-family: Gill Sans,Arial,sans-serif;
    font-size: 1em;
}

</style>
  <div class="form-group">
<form id="form-checkout">
<div id="form-checkout__cardNumber" class="tamField"></div>
<div id="form-checkout__expirationDate" class="tamField"></div>
<div id="form-checkout__securityCode" class="tamField"></div>
<input type="text" id="form-checkout__cardholderName" />
<select id="form-checkout__issuer"></select>
<select id="form-checkout__installments"></select>
<select id="form-checkout__identificationType"></select>
<input type="text" id="form-checkout__identificationNumber" />
<input type="email" id="form-checkout__cardholderEmail" />

<button class="btn btn-primary btn-lg btn-block" style="width:100%;" type="submit" id="form-checkout__submit">Pagar</button><br><br>
<progress value="0" class="progress-bar">Carregando...</progress>
</form>
</div>

<script>



    const formularioCartao123s = mp.cardForm({
      amount: "100.5",
      iframe: true,
      form: {
        id: "form-checkout",
        cardNumber: {
          id: "form-checkout__cardNumber",
          placeholder: "Número do cartão",
        },
        expirationDate: {
          id: "form-checkout__expirationDate",
          placeholder: "MM/YY",
        },
        securityCode: {
          id: "form-checkout__securityCode",
          placeholder: "Código de segurança",
        },
        cardholderName: {
          id: "form-checkout__cardholderName",
          placeholder: "Titular do cartão",
        },
        issuer: {
          id: "form-checkout__issuer",
          placeholder: "Banco emissor",
        },
        installments: {
          id: "form-checkout__installments",
          placeholder: "Parcelas",
        },        
        identificationType: {
          id: "form-checkout__identificationType",
          placeholder: "Tipo de documento",
        },
        identificationNumber: {
          id: "form-checkout__identificationNumber",
          placeholder: "Número do documento",
        },
        cardholderEmail: {
          id: "form-checkout__cardholderEmail",
          placeholder: "E-mail",
        },
      },
      callbacks: {
        onFormMounted: error => {
          if (error) return console.warn("Form Mounted handling error: ", error);
          console.log("Form mounted");
        },
        onSubmit: event => {
          event.preventDefault();

          const {
            paymentMethodId: payment_method_id,
            issuerId: issuer_id,
            cardholderEmail: email,
            amount,
            token,
            installments,
            identificationNumber,
            identificationType,
          } = cardForm.getCardFormData();

          fetch("/process_payment", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify({
              token,
              issuer_id,
              payment_method_id,
              transaction_amount: Number(amount),
              installments: Number(installments),
              description: "Descrição do produto",
              payer: {
                email,
                identification: {
                  type: identificationType,
                  number: identificationNumber,
                },
              },
            }),
          });
        },
        onFetching: (resource) => {
          console.log("Fetching resource: ", resource);

          // Animate progress bar
          const progressBar = document.querySelector(".progress-bar");
          progressBar.removeAttribute("value");

          return () => {
            progressBar.setAttribute("value", "0");
          };
        }
      },
    });
		
</script>