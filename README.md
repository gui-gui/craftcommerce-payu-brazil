# WIP

### How to use it 

```
cd payubrazil
composer update
```

Copy `payubrazil` folder to `craft/plugins`  
Configure the payment methods 

#### CreditCard 

To charge via creditcard - you need to send these values with the payment form: 
  
```
paymentMethod = card-brand  
token = Generated using Payu javascript library   
installments = 1 to 12  
holderDocumentNumber = 123.456.789-06  // CPF
```

*valid card-brands :  'VISA', 'MASTERCARD', 'AMEX', 'ELO', 'HIPERCARD', 'DINERS'* 

#### Boleto 

To charge via boleto - you need to send these values with the payment form:

```
paymentMethod = BOLETO_BANCARIO
```

*Boleto expires in `n` days.  `n` is defined via the payment method settings - within craft CP.*  


---

more docs when ready
