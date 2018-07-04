<?php

class sspmod_deviceauth_Auth_Process_AuthnContext extends SimpleSAML_Auth_ProcessingFilter {

	public function process(&$state) {
		assert('is_array($state)');
		assert('array_key_exists("Attributes", $state)');

		//if (!isset($state['Attributes']['eduPersonAffiliation'])) {
		if (!isset($state['Attributes']['adminContact'])) {
			/* For some reason we don't have this attribute - leave the AuthnContextClassRef as the default. */
			return;
		}else{
                        $state['saml:AuthnContextClassRef'] = 'urn:aai:ac:classes:SOKIdentityBased';
		}

	/*	$affiliation = $state['Attributes']['eduPersonAffiliation'];
		if (in_array('employee', $affiliation, TRUE)) {
			// User is employee, assume smartcard authentication. 
			//$state['saml:AuthnContextClassRef'] = 'urn:oasis:names:tc:SAML:2.0:ac:classes:Smartcard';
			$state['saml:AuthnContextClassRef'] = 'urn:aai:ac:classes:SOKIdentityBased';
		}*/
	}

}
