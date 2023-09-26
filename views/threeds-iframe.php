<?php
/**
 * GurmePOS 3D Popup.
 *
 * @package Gurmehub
 *
 * @var string $iframe_url
 */

?>
<div style="
	pointer-events: auto;
	background: #000;
	border-radius: inherit;
	bottom: 0;
	left: 0;
	opacity: .32;
	position: fixed;
	right: 0;
	top: 0;
	z-index: 99998;
">
</div>
<div 
	style="
		display: block;
		position: fixed;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		padding: 20px;
		background-color: white;
		box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.5);
		z-index: 99999;
		opacity: 1 !important;
	"
>
	<iframe id="gpos-iframe" width="600" height="600" src="<?php echo esc_url_raw( $iframe_url ); ?>"></iframe>
</div>
