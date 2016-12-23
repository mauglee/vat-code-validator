<?php

require_once 'VatValidator.php';

$vats = array(
	'DE115235681', // valid
	'DE115235682', // invalid
	'   FR-505.720.939.20 -__ ', // valid after sanitized
);

$validator = new VatValidator();
foreach ( $vats as $vat ) {
	var_dump( $validator->find( $vat ) );
}
