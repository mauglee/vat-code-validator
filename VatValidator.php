<?php

/**
 * Class VatValidator
 * finds VAT code information at ec.europa.eu {@link http://ec.europa.eu/taxation_customs/vies/checkVatService.wsdl webservice}
 */
class VatValidator {

	public $wsdl = 'http://ec.europa.eu/taxation_customs/vies/checkVatService.wsdl';
	private $_client;

	/**
	 * SOAP client
	 *
	 * @return SoapClient
	 */
	public function getClient() {

		if ( null === $this->_client ) {
			$this->_client = new SoapClient( $this->wsdl );
		}

		return $this->_client;
	}

	/**
	 * Finds VAT information
	 *
	 * @param $vat
	 *
	 * @return null|false|stdClass
	 * <strong>null</strong> if service unavailable or smth.<br>
	 * <strong>false</strong> if VAT is invalid<br>
	 * <strong>stdClass</strong> if VAT is valid
	 */
	public function find( $vat ) {

		$vat = $this->sanitize( $vat );

		if ( ! preg_match( '%[0-9]+%', $vat ) ) {
			return false;
		}

		$countryCode = substr( $vat, 0, 2 );
		$vatNumber   = substr( $vat, 2 );

		try {

			$result = $this->getClient()->checkVat( compact( 'countryCode', 'vatNumber' ) );
			if ( ! $result->valid ) {
				return false;
			}

			return $result;

		} catch ( SoapFault $e ) {
			return null;
		}
	}

	/**
	 * @param $vat
	 *
	 * @return mixed
	 */
	public function sanitize( $vat ) {

		$vat = preg_replace( '%[^a-zA-Z0-9]+%', '', $vat );

		return $vat;
	}

}
