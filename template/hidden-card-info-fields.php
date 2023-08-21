<?php
/**
 * Kart bilgilerini taşıyan gizli alanlar.
 *
 * @package GurmeHub
 */

foreach ( [
	'card-type',
	'card-brand',
	'card-family',
	'card-bank-name',
	'card-country',
] as $field ) : ?>

<input 
	type="hidden" 
	name="gpos-<?php echo esc_attr( $field ); ?>" 
	id="gpos-<?php echo esc_attr( $field ); ?>" 
	value=""
>

<?php endforeach; ?>

<?php wp_nonce_field( -1, 'gpos_check_bin' ); ?>
