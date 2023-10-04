<?php
/**
 * WordPress mağazasında puanlamaya davet eden yönetici mesajı.
 *
 * @package GurmeHub
 */

?>
<div id="app" class="gpos-app">
	<div class="gpos-ring">
		<div></div><div></div><div></div><div></div>
	</div>
	<h5> <?php esc_html_e( 'Loading...', 'gurmepos' ); ?> </h5>
	<p onclick="window.location.reload(true);"> <?php esc_html_e( 'If the payment form is not loaded, please click this text.', 'gurmepos' ); ?> </p>
	<style>
	.gpos-app{
		display: flex;
		width: 100%;
		align-items: center;
		justify-content: center;
		flex-direction: column;
	}
	.gpos-app p{
		cursor: pointer;
	}
	.gpos-app p:hover{
		color:rgb(29 78 216);
	}
	.gpos-ring {
		display: inline-block;
		position: relative;
		width: 80px;
		height: 80px;
	}
	.gpos-ring div {
		box-sizing: border-box;
		display: block;
		position: absolute;
		width: 64px;
		height: 64px;
		margin: 8px;
		border: 8px solid #fff;
		border-radius: 50%;
		animation: gpos-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
		border-color: rgb(29 78 216) transparent transparent transparent;
	}
	.gpos-ring div:nth-child(1) {
		animation-delay: -0.45s;
	}
	.gpos-ring div:nth-child(2) {
		animation-delay: -0.3s;
	}
	.gpos-ring div:nth-child(3) {
		animation-delay: -0.15s;
	}
	@keyframes gpos-ring {
		0% {
			transform: rotate(0deg);
		}
		100% {
			transform: rotate(360deg);
		}
	}
	</style>
</div>
