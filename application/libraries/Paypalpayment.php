<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'dev/vendor_libraries/angelleye-paypal-class-library/includes/paypal.class.php');

class Paypalpayment {
	private $CI;
	
    public function __construct() {
    	$this->CI =& get_instance();
    	$this->CI->config->load('paypal');
    }
    
    public function payUsers($post) {
    	$receivers = array();

    	$receivers[] = array(
    			'Amount'           => $post['amount'], // Required.  Amount to be paid to the receiver.
    			'Email'            => $post['email'], 	 // Receiver's email address. 127 char max.
    			'InvoiceID'        => '', 						 // The invoice number for the payment.  127 char max.
    			'PaymentType'      => 'SERVICE', 				 // Transaction type.  Values are:  GOODS, SERVICE, PERSONAL, CASHADVANCE, DIGITALGOODS
    			'PaymentSubType'   => '', 						 // The transaction subtype for the payment.
    			'Phone'            => array('CountryCode' => '', 'PhoneNumber' => '', 'Extension' => ''),   // Receiver's phone number.   Numbers only.
    			'Primary'          => ''								          // Whether this receiver is the primary receiver.  Values are boolean:  TRUE, FALSE
    	);
    	
    	$paypal_result = $this->execute_payment('USD', 'EACHRECEIVER', $receivers, 'https://marketingbazar.com/payment');
    	
    	if($paypal_result['Ack'] == 'Failure') {
    		log_message('error', $paypal_result['Errors'][0]['Message']);
    		return FALSE;
    	}
    		
    	return $paypal_result['PayKey'];
    }
    
    public function execute_payment($currency, $fees_payer, $receivers, $return_page ) {
	
	// Create PayPal object.
	$PayPalConfig = array(
		'Sandbox' => $this->CI->config->item('sandbox'), 
		'DeveloperAccountEmail' => '', 
		'ApplicationID' => $this->CI->config->item('application_id'), 
		'DeviceID' => '', 
		'IPAddress' => $_SERVER['REMOTE_ADDR'], 
		'APIUsername' => $this->CI->config->item('api_username'), 
		'APIPassword' => $this->CI->config->item('api_password'), 
		'APISignature' => $this->CI->config->item('api_signature'), 
		'APISubject' => ''
	);
	
	$PayPal = new PayPal_Adaptive($PayPalConfig);
	
	// Prepare request arrays
	$PayRequestFields = array(
		'ActionType' => 'CREATE', 
		'CancelURL' => $return_page, 	
		'CurrencyCode' => $currency, 	
		'FeesPayer' => $fees_payer, 			
		'IPNNotificationURL' => '', 	
		'Memo' => '', 	
		'Pin' => '', 	
		'PreapprovalKey' => '', 
		'ReturnURL' => $return_page, 
		'ReverseAllParallelPaymentsOnError' => '', 
		'SenderEmail' => '',           
		'TrackingID' => ''	
	);
		
	$ClientDetailsFields = array(
		'CustomerID' => '', 		
		'CustomerType' => '', 				
		'GeoLocation' => '', 		
		'Model' => '', 				
		'PartnerName' => 'Always Give Back'
	);
							
	$FundingTypes = array('ECHECK', 'BALANCE', 'CREDITCARD');
	
	$SenderIdentifierFields = array(
		'UseCredentials' => ''			
	);
									
	$AccountIdentifierFields = array(
		'Email' => '', 			
		'Phone' => array('CountryCode' => '', 'PhoneNumber' => '', 'Extension' => '')	
	);
									
	$PayPalRequestData = array(
		'PayRequestFields' => $PayRequestFields, 
		'ClientDetailsFields' => $ClientDetailsFields, 
		'FundingTypes' => $FundingTypes, 
		'Receivers' => $receivers, 
		'SenderIdentifierFields' => $SenderIdentifierFields, 
		'AccountIdentifierFields' => $AccountIdentifierFields
	);
	
	$PayPalResult = $PayPal->Pay($PayPalRequestData);
	
	return $PayPalResult;
    }
    
}

?>