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
