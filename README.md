# VAT code validator
Finds VAT code information webservice at http://ec.europa.eu/taxation_customs/vies/checkVatService.wsdl

## Example usage
```PHP
<?php

require_once 'VatValidator.php';

$vats = array(
	'DE115235681',
	'DE115235682',
	'   FR-505.720.939.20 -__ ',
);

$validator = new VatValidator();
foreach ( $vats as $vat ) {
	var_dump( $validator->find( $vat ) );
}
```
## Returned values
`find()` method returns:
- `null` if service is unavailable
- `false` if VAT code is invalid
- `stdClass` object with VAT information. E.g.:
```
stdClass Object
(
    [countryCode] => FR
    [vatNumber] => 50572093920
    [requestDate] => 2016-12-23+01:00
    [valid] => 1
    [name] =>  SA AXA
    [address] => 25 AV MATIGNON
75008 PARIS 
)
```
