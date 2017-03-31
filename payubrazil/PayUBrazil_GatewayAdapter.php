<?php 

namespace Commerce\Gateways\Omnipay;

use Commerce\Gateways\PaymentFormModels\PayUBrazilPaymentFormModel;
use Omnipay\Common\Message\AbstractRequest as OmnipayRequest;
use Craft\AttributeType;
use Craft\BaseModel;

class PayUBrazil_GatewayAdapter extends \Commerce\Gateways\CreditCardGatewayAdapter 
{
    public function handle() 
    {
        return "PayUBrazil";
    }
    
    public function getPaymentFormModel() 
    {
        return new PayUBrazilPaymentFormModel();
    }
    
    public function populateRequest(OmnipayRequest $request, BaseModel $paymentForm) 
    {
        if ($paymentForm->paymentMethod) 
        {
            $request->setPaymentMethod($paymentForm->paymentMethod);
        }

        if ($paymentForm->holderDocumentNumber) 
        {
            $request->setHolderDocumentNumber($paymentForm->holderDocumentNumber);
        }

        if ($paymentForm->holderBusinessNumber) 
        {
            $request->setHolderBusinessNumber($paymentForm->holderBusinessNumber);
        }

        if ($paymentForm->installments) 
        {
            $request->setInstallments($paymentForm->installments);
        }

        if ($paymentForm->token) 
        {
            $request->setToken($paymentForm->token);
        }
    }

    public function defineAttributes() 
    {
        $attr = array();
        $attr['apiKey'] = [AttributeType::String];
        $attr['apiKey']['label'] = $this->generateAttributeLabel('apiKey');
        $attr['publicKey'] = [AttributeType::String];
        $attr['publicKey']['label'] = $this->generateAttributeLabel('publicKey');
        $attr['apiLogin'] = [AttributeType::String];
        $attr['apiLogin']['label'] = $this->generateAttributeLabel('apiLogin');
        $attr['merchantId'] = [AttributeType::String];
        $attr['merchantId']['label'] = $this->generateAttributeLabel('merchantId');
        $attr['accountId'] = [AttributeType::String];
        $attr['accountId']['label'] = $this->generateAttributeLabel('accountId');
        $attr['boletoDaysToExpire'] = [AttributeType::Number];
        $attr['boletoDaysToExpire']['label'] = $this->generateAttributeLabel('boletoDaysToExpire');
        $attr['testMode'] = [AttributeType::Bool];
        $attr['testMode']['label'] = $this->generateAttributeLabel('testMode');

        return $attr;
    }
}