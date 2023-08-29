<?php
/**
 * GurmePOS Form Data
 *
 * @package GurmeHub
 *
 * @var string $action
 * @var array $form_data
 */

?>
<form id="gpos-form" action="<?php echo $action; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>" method="<?php echo isset( $method ) ? esc_attr( $method ) : 'POST'; ?>"> 
<?php foreach ( $form_data as $name => $value ) : ?>
	<input type="hidden" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $value ); ?>" />
<?php endforeach; ?>
</form>
<script>
	document.getElementById("gpos-form").submit() 
</script>
