<?php
namespace Craft;

class PayUBrazilService extends BaseApplicationComponent
{
    public function getParentOrderReference(Commerce_TransactionModel $child)
    {   
        $parent = craft()->commerce_transactions->getTransactionById($child->parentId);
        return $parent->response['transactionResponse']['orderId'];
    }
    
}