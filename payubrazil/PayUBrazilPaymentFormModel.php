<?php	

namespace Commerce\Gateways\PaymentFormModels;

use Craft\AttributeType;
use Craft\BaseModel;
use Omnipay\Common\Helper as OmnipayHelper;

class PayUBrazilPaymentFormModel extends CreditCardPaymentFormModel
{
	public function populateModelFromPost($post)
	{
		parent::populateModelFromPost($post);


		if (isset($post['token']))
		{
			$this->token = $post['token'];
		}       

		if (isset($post['holderDocumentNumber']))
		{
			$this->holderDocumentNumber = $post['holderDocumentNumber'];
		}

		if (isset($post['holderBusinessNumber']))
		{
			$this->holderBusinessNumber = $post['holderBusinessNumber'];
		}

		if (isset($post['paymentMethod']))
		{
			$this->paymentMethod = $post['paymentMethod'];
		}

		if(isset($post['installments']))
		{
			$this->installments = $post['installments'] ?: 1;
		}

	}

	/**
	 * @return array
	 */
	public function rules()
	{
		if ($this->token)
		{
			return [
				['paymentMethod, installments, holderDocumentNumber', 'required'],
				[
					'installments',
					'numerical',
					'integerOnly' => true,
					'min'         => 1,
					'max'         => 12
				],
				[
					'paymentMethod',
					'in',
					'range' => [
						'VISA',
						'MASTERCARD',
						'AMEX',
						'ELO',
						'HIPERCARD',
						'DINERS'
					]
				],

			];	
		}

		if(empty($this->token) && $this->paymentMethod != 'BOLETO_BANCARIO')
		{
			return array_merge(parent::rules(), ['paymentMethod, installments, holderDocumentNumber', 'required']);
		}

		return [];
	}	

	/**
	 * @return array
	 */
	protected function defineAttributes()
	{
		$parent = parent::defineAttributes();
		$custom = [
			'paymentMethod' => AttributeType::Enum,
			'installments' => [AttributeType::Number, 'default' => 1],
			'holderBusinessNumber' => AttributeType::String,
			'holderDocumentNumber' => AttributeType::String,
		];
		
		return array_merge($parent, $custom);
	}
}