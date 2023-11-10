<?php
	/**
	 * Frontend uygulaması için kelime ve cümle çevirileri.
	 *
	 * @package GurmeHub
	 */

return array(
	'paratika'             => array(
		'description' => __( 'Institution/Company ID and user information are required to integrate your Paratika POS. You can access the Institution/Company ID information on the Paratika Pos Panel by following the steps: My Information -> Basic Information. If you have not created a user before, you need to create a user by following the Users -> Add User steps in the same panel.', 'gurmepos' ),
	),
	'ozan'                 => array(
		'description' => __( 'The information required for the Ozan Virtual Pos integration will be obtained from the Ozan Virtual Pos Screen.', 'gurmepos' ),
	),
	'sipay'                => array(
		'description' => __( 'You can get the necessary api information for the integration of your Sipay Virtual POS: You can log in to the Sipay Virtual POS Panel and get it from the Settings -> Integration & API page.', 'gurmepos' ),
	),
	'iyzico'               => array(
		'description' => __( 'API and security key information is required for Iyzico integration. You can access your API and security keys from the Settings->Company Settings section of your Iyzico merchant panel. ', 'gurmepos' ),
	),
	'esnekpos'             => array(
		'description' => __( 'Required information for Esnekpos integration will be provided from the Esnekpos  user panel. ', 'gurmepos' ),
	),
	'param'                => array(
		'description' => __( 'Param API information is required for Param POS integration. To access this information, you can access the necessary information from the page that opens after logging in to Param internet branch and clicking the "My Integration Information" tab under the ParamPos Menu. ', 'gurmepos' ),
	),
	'paytr'                => array(
		// translators: %s Site url.
		'description' => sprintf( __( 'For PayTR integration, API information and notification URL definition is required.<br><br>You can access API information from the <strong>Integration Information</strong> section under the <strong>Support & Setup</strong> menu on your panel.<br><br>Notification url: <strong> %s/gpos-paytr-callback</strong>', 'gurmepos' ), home_url() ),
	),
	'akbank'               => array(
		'description' => __( 'The information required for Akbank Virtual Pos integration will be obtained from the Akbank Virtual Pos Screen.', 'gurmepos' ),
	),
	'akode'                => array(
		'description' => __( 'The information required for AKÖde POS integration will be obtained from the AKÖde POS Screen.', 'gurmepos' ),
	),
	'craftgate'            => array(
		'description' => __( 'API Integration Information is required for Craftgate integration. This information is located in the Craftgate control panel: Admin Menu -> Merchant Settings Tab -> API Access Information.', 'gurmepos' ),
	),
	'denizbank'            => array(
		'description' => __( 'After logging into your Denizbank Virtual Pos panel, you need to create a new API user for integration information, if you have not created one before. After logging in, you can create an API user record by logging into the User Editing and Authorization page from the User Management System menu on the left. You can provide integration by filling in the API user information you have created in the relevant places.', 'gurmepos' ),
	),
	'finansbank'           => array(
		'description' => __( 'For integration information after logging into your Finansbank panel: If you have not created one before, create an API user with the help of User Management from the Administration Menu. Fill in the API user information you created to the relevant places in the POS Entegratör.', 'gurmepos' ),
	),
	'qnbfinansbank-payfor' => array(
		'description' => __( 'For integration information after logging into your Finansbank panel: If you have not created one before, create an API user with the help of User Management from the Administration Menu. Fill in the API user information you created to the relevant places in the POS Entegratör.', 'gurmepos' ),
	),
	'garanti'              => array(
		'description' => __( 'Obtain the necessary information for the Garanti Pos integration from the Garanti Virtual Pos Screen.', 'gurmepos' ),
	),
	'halkbank'             => array(
		'description' => __( 'After logging into your Halkbank panel, click on the management menu. If no user has been created before, we create an "API USER" from the User list section. We take the necessary information from the menus on the left and fill it in the relevant places in the POS Entegratör.', 'gurmepos' ),
	),
	'ingbank'              => array(
		'description' => __( 'The information required for ING Bank Pos integration will be obtained from the ING Bank Virtual Pos Screen.', 'gurmepos' ),
	),
	'isbank'               => array(
		'description' => __( 'After logging into the İşbank virtual pos system, if no API user has been created before, an API user must be created by entering the "Add New User" section under the "Management" heading. Then, API user information should be filled in the relevant places.', 'gurmepos' ),
	),
	'kuveytturk'           => array(
		'description' => __( 'Information required for Kuveyt Türk Pos integration will be obtained from the Kuveyt Türk Virtual Pos Screen.', 'gurmepos' ),
	),
	'teb'                  => array(
		'description' => __( 'After logging into your TEB bank virtual pos panel, we click on the management menu. If no user has been created before, we create an "API USER" from the User list section. We fill in the necessary information in the relevant places in the POS Entegratör. ', 'gurmepos' ),
	),
	'vakifbank'            => array(
		'description' => __( 'We click on the "CONTRACTED MERCHANT TRANSACTIONS" section under the "MANAGEMENT" tab from the Vakıfbank Virtual Pos panel. The page that opens contains the necessary information for our company. We fill this information in the relevant places in POS Entegratör.', 'gurmepos' ),
	),
	'yapikredi'            => array(
		'description' => __( 'The information required for the Yapı Kredi Virtual POS integration will be obtained from the Yapı Kredi Virtual POS Screen.', 'gurmepos' ),
	),
	'ziraat'               => array(
		'description' => __( 'After logging into Ziraat Bank Virtual Pos panel, if you have not created an API user before, first we click on the "Management" tab, we define a new user by selecting "Role" API User from the "Add New User" field. Then, we fill in the "User Name" and "Password" information you have defined in this field in the relevant fields in POS Entegratör.', 'gurmepos' ),
	),
	'paidora'              => array(
		'description' => __( 'API Integration Information is required for Paidora integration. This information: Paidora user panel: Information menu -> API Integration Information is located under the heading.', 'gurmepos' ),
	),
	'lidio'                => array(
		'description' => __( 'API values generated by Lidio, which gives you access to all service methods. This values is produced by Lidio only and transmitted to you.', 'gurmepos' ),
	),
	'dummy_payment'        => array(
		'description' => __( 'Dummy Payment is a fake payment service created to show how payment processes are carried out without API information of payment institutions.', 'gurmepos' ),
	),
);
