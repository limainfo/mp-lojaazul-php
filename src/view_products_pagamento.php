<style>
#form-checkout {
    display: flex;
    flex-direction: column;
    max-width: 600px;
}

.container {
    height: 18px;
    display: inline-block;
    border: 1px solid rgb(118, 118, 118);
    border-radius: 2px;
    padding: 1px 2px;
}
</style>
<div class="block">
	<div class="block_content">
<form id="form-checkout">
<div id="form-checkout__cardNumber" class="container"></div>
<div id="form-checkout__expirationDate" class="container"></div>
<div id="form-checkout__securityCode" class="container"></div>
<input type="text" id="form-checkout__cardholderName" />
<select id="form-checkout__issuer"></select>
<select id="form-checkout__installments"></select>
<select id="form-checkout__identificationType"></select>
<input type="text" id="form-checkout__identificationNumber" />
<input type="email" id="form-checkout__cardholderEmail" />

<button type="submit" id="form-checkout__submit">Pagar</button>
<progress value="0" class="progress-bar">Carregando...</progress>
</form>

</div></div>
<script>
const mp = new MercadoPago('TEST-d6663f9a-bf2d-4d68-95fb-6e491bfdf8bd', {
    locale: 'pt-BR'
  });


    const cardForm = mp.cardForm({
      amount: "100.5",
      iframe: true,
      form: {
        id: "form-checkout",
        cardNumber: {
          id: "form-checkout__cardNumber",
          placeholder: "N�mero do cart�o",
        },
        expirationDate: {
          id: "form-checkout__expirationDate",
          placeholder: "MM/YY",
        },
        securityCode: {
          id: "form-checkout__securityCode",
          placeholder: "C�digo de seguran�a",
        },
        cardholderName: {
          id: "form-checkout__cardholderName",
          placeholder: "Titular do cart�o",
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
          placeholder: "N�mero do documento",
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
              description: "Descri��o do produto",
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