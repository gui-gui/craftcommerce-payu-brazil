<?php

namespace Craft;

class PayUBrazilPlugin extends BasePlugin
{

    private $commerceInstalled = false;

    public function init()
    {
       
        $commerce = craft()->db->createCommand()
            ->select('id')
            ->from('plugins')
            ->where("class = 'Commerce'")
            ->queryScalar();
        
        if($commerce){
            $this->commerceInstalled = true;
        }

        // craft()->on('commerce_transactions.onSaveTransaction', [craft()->pagarme, 'updateSavedBoletoTransaction']);

    }

    public function getName()
    {
        return "PayU Brazil Gateway";
    }

    /**
     * Returns the plugin’s version number.
     *
     * @return string The plugin’s version number.
     */
    public function getVersion()
    {
        return "0.1";
    }

    /**
     * Returns the plugin developer’s name.
     *
     * @return string The plugin developer’s name.
     */
    public function getDeveloper()
    {
        return "Gui Rams";
    }

    /**
     * Returns the plugin developer’s URL.
     *
     * @return string The plugin developer’s URL.
     */
    public function getDeveloperUrl()
    {
        return "#";
    }

    public function commerce_registerGatewayAdapters()
    {
        if($this->commerceInstalled) {
            require __DIR__ . '/vendor/autoload.php';
            require_once __DIR__.'/PayUBrazil_GatewayAdapter.php';
            // require_once __DIR__.'/PayUBrazil_Boleto_GatewayAdapter.php';
            require_once __DIR__.'/PayUBrazilPaymentFormModel.php';
            return [
                '\Commerce\Gateways\Omnipay\PayUBrazil_GatewayAdapter' 
                // '\Commerce\Gateways\Omnipay\PayUBrazil_Boleto_GatewayAdapter'
            ];
        }
        return [];
    }


}
