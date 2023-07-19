<?php
/**
 * Frontend uygulaması için kelime ve cümle çevirileri.
 *
 * @package GurmeHub
 */

$gpos_i18n = array(
	'default' => array(
		'payment_method'                   => __( 'Payment Method', 'gurmepos' ),
		'threed'                           => __( '3D Payment', 'gurmepos' ),
		'regular'                          => __( 'Regular Payment', 'gurmepos' ),
		'save_card'                        => __( 'Registered Card', 'gurmepos' ),
		'recurring_with_saved_card'        => __( 'Recurring Payment (Registered Card)', 'gurmepos' ),
		'recurring_with_plan'              => __( 'Recurring Payment (Payment Plan)', 'gurmepos' ),
		'installment_api'                  => __( 'Automatic Plan', 'gurmepos' ),
		'refund'                           => __( 'Return', 'gurmepos' ),
		'Completed'                        => __( 'Completed', 'gurmepos' ),
		'Processing'                       => __( 'Processing', 'gurmepos' ),
		'paynut'                           => __( 'POS Entegratör', 'gurmepos' ),
		'free'                             => __( 'Free', 'gurmepos' ),
		'update_pro'                       => __( 'Pro Upgrade', 'gurmepos' ),
		'announcements'                    => __( 'Announcements', 'gurmepos' ),
		'add_payment_comp'                 => __( 'Add Payment Method', 'gurmepos' ),
		'establishment'                    => __( 'Payment Provider', 'gurmepos' ),
		'find_comp'                        => __( 'Can`t find the payment provider you`re looking for?', 'gurmepos' ),
		'contact_us'                       => __( 'Contact Us', 'gurmepos' ),
		'features'                         => __( 'Features', 'gurmepos' ),
		'currency'                         => __( 'Currencies', 'gurmepos' ),
		'status'                           => __( 'Status', 'gurmepos' ),
		'actions'                          => __( 'Actions', 'gurmepos' ),
		'not_active_comp'                  => __( 'You do not have an active pay organization.', 'gurmepos' ),
		'test_mode'                        => __( 'Test Mode', 'gurmepos' ),
		'test_mode_content'                => __( 'It puts the entire application into test mode and allows you to test with test apis.', 'gurmepos' ),
		'help_title'                       => __( 'Application related', 'gurmepos' ),
		'help_title_link'                  => __( 'View help documents about {0}', 'gurmepos' ),
		'3d_settings'                      => __( '3D Settings', 'gurmepos' ),
		'not_3d'                           => __( 'Not 3D', 'gurmepos' ),
		'not_3d_subtitle'                  => __( 'Users complete the payment directly', 'gurmepos' ),
		'optional_3d'                      => __( 'Ask User', 'gurmepos' ),
		'optional_3d_subtitle'             => __( 'User selects 3D option at checkout', 'gurmepos' ),
		'forced_3d'                        => __( 'Forced 3D', 'gurmepos' ),
		'forced_3d_subtitle'               => __( 'Users are redirected to the 3D Screen after paying.', 'gurmepos' ),
		'other_settings'                   => __( 'Other Settings', 'gurmepos' ),
		'form_name_settings'               => __( 'Get name and surname information on the form', 'gurmepos' ),
		'form_name_settings_subtitle'      => __( 'Use the order fields for the name information on the card. If the setting is turned off, a name field will appear above the card number section.', 'gurmepos' ),
		'save_card_settings'               => __( 'Save Card', 'gurmepos' ),
		'save_card_settings_subtitle'      => __( 'With the Card Save feature, your customers can register their cards during paying.', 'gurmepos' ),
		'sub_payment_settings'             => __( 'Recurring Payment', 'gurmepos' ),
		'sub_payment_settings_subtitle'    => __( 'Sell subscription products with the WooCommerce Subscriber Plugin', 'gurmepos' ),
		'view_settings'                    => __( 'Appearance Settings', 'gurmepos' ),
		'standart_form_settings'           => __( 'Standard Payment Form', 'gurmepos' ),
		'standart_form_settings_subtitle'  => __( 'Standart WooCommerce Payment Form', 'gurmepos' ),
		'oneline_form_settings'            => __( 'One-line payment form', 'gurmepos' ),
		'online_form_settings_subtitle'    => __( 'One-line credit card form', 'gurmepos' ),
		'pay_credit_cart'                  => __( 'Payment by credit card', 'gurmepos' ),
		'save_settings'                    => __( 'Save Settings', 'gurmepos' ),
		'connect_test'                     => __( 'Test the connection', 'gurmepos' ),
		'delete_gateway'                   => __( 'Remove payment provider', 'gurmepos' ),
		'test_mode_title'                  => __( 'Test Mode Active', 'gurmepos' ),
		'gateway_screen'                   => __( 'Virtual POS Screen', 'gurmepos' ),
		'supports_features'                => __( 'Supported Features', 'gurmepos' ),
		'supports_currency'                => __( 'Supported Currencies', 'gurmepos' ),
		'empty_gateway_title'              => __( 'You have not activated a pos yet', 'gurmepos' ),
		'empty_gateway_content'            => __( 'To start receiving payments immediately, make the connection to the payment institution you are contracted with.', 'gurmepos' ),
		'method_name'                      => __( 'Method Name', 'gurmepos' ),
		'pay_button_value'                 => __( 'Payment Button Text', 'gurmepos' ),
		'pay_to_status'                    => __( 'Status of Successful Payments', 'gurmepos' ),
		'pay_form_desc'                    => __( 'Description Field of Payment Form', 'gurmepos' ),
		'soon'                             => __( 'Soon', 'gurmepos' ),
		'help'                             => __( 'Help', 'gurmepos' ),
		'feedback'                         => __( 'Feedback', 'gurmepos' ),
		'forum'                            => __( 'Forum', 'gurmepos' ),
		'transaction_details'              => __( 'Transaction Details', 'gurmepos' ),
		'request'                          => __( 'Request', 'gurmepos' ),
		'response'                         => __( 'Response', 'gurmepos' ),
		'date'                             => __( 'Date', 'gurmepos' ),
		'copy'                             => __( 'Copy', 'gurmepos' ),
		'copied'                           => __( 'Copied', 'gurmepos' ),
		'payment_gateway'                  => __( 'Payment Gateway', 'gurmepos' ),
		'platform'                         => __( 'Platform', 'gurmepos' ),
		'process_type'                     => __( 'Process Type', 'gurmepos' ),
		'details'                          => __( 'Details', 'gurmepos' ),
		'no_logs'                          => __( 'There are no logs.', 'gurmepos' ),
		'installment'                      => __( 'Installment', 'gurmepos' ),
		'rate'                             => __( 'Rate', 'gurmepos' ),
		'search_payment_gateway'           => __( 'Search Payment Institution', 'gurmepos' ),
		'default_payment'                  => __( 'Default', 'gurmepos' ),
		'make_default_payment'             => __( 'Make Default', 'gurmepos' ),
		'all_features'                     => __( 'All Features', 'gurmepos' ),
		'loading'                          => __( 'Loading...', 'gurmepos' ),
		'pro_upgrade'                      => __( 'Upgrade Pro', 'gurmepos' ),
		'check_out_pro_version'            => __( 'Check out the pro version for many pos and more available in Pro', 'gurmepos' ),
		'review_now'                       => __( 'Review Now', 'gurmepos' ),
		'table_view_settings'              => __( 'Installment Table View Settings', 'gurmepos' ),
		'table_view'                       => __( 'Table View', 'gurmepos' ),
		'table_view_desc'                  => __( 'It shows your installment options in the form of a table in the payment form.', 'gurmepos' ),
		'row_view'                         => __( 'Row View', 'gurmepos' ),
		'row_view_desc'                    => __( 'It shows your installment options in more detail in the form of rows in the payment form.', 'gurmepos' ),
		'not_for_sale_installments'        => __( 'Show Warning for Categories Not for Sale in Installments.', 'gurmepos' ),
		'not_for_sale_installments_desc'   => __( 'You can show a warning text to your customers on the checkout page for your categories that are not available for sale in installments. (WooCommerce only)', 'gurmepos' ),
		'warning_text'                     => __( 'Warning Text', 'gurmepos' ),
		'enter_desc'                       => __( 'Enter Description', 'gurmepos' ),
		'gurmehub_forum'                   => __( 'GurmeHub Forum', 'gurmepos' ),
		'gurmehub_forum_desc'              => __( 'Share your questions about Shopify, WooCommerce, Dokan and many other platforms with us and the community through the Gurmehub Forum.', 'gurmepos' ),
		'gurmehub_feedback'                => __( 'GurmeHub Feedback', 'gurmepos' ),
		'gurmehub_feedback_desc'           => __( 'Your suggestions are very valuable to us so that our applications can work better. You can support us to improve our products by giving feedback.', 'gurmepos' ),
		'give_feedback'                    => __( 'Give Feedback', 'gurmepos' ),
		'pos_entegrator_help'              => __( 'Before using our POS Entegratör application, you can use the application much more efficiently by examining our documents.', 'gurmepos' ),
		'docs'                             => __( 'Docs', 'gurmepos' ),
		'transaction_logs'                 => __( 'Transaction Logs', 'gurmepos' ),
		'transaction_logs_desc'            => __( 'On this table, you can view in detail every transaction that goes through your payment gateway.', 'gurmepos' ),
		'logs'                             => __( 'Logs', 'gurmepos' ),
		'deletion_completed'               => __( 'Deletion completed', 'gurmepos' ),
		'ok'                               => __( 'OK', 'gurmepos' ),
		'back_to'                          => __( 'Back To', 'gurmepos' ),
		'paratika_information'             => __( 'You can access the Institution/Company ID information from the top menu of your Paratika panel, under My Information > Basic Settings.', 'gurmepos' ),
		'installment_options'              => __( 'Installment Options', 'gurmepos' ),
		'activate_installment'             => __( 'Activate Installment Sale', 'gurmepos' ),
		'virtual_pos_installment_settings' => __( 'You can automatically bring your installment rates by making your installment settings from the virtual POS panel.', 'gurmepos' ),
		'get_installment_rates'            => __( 'Get Installment Rates', 'gurmepos' ),
		'payment_methods'                  => __( 'Payment Methods', 'gurmepos' ),
		'woocommerce_settings'             => __( 'WooCommerce Settings', 'gurmepos' ),
		'your_method_name'                 => __( 'Your Method Name', 'gurmepos' ),
		'icon'                             => __( 'Icon', 'gurmepos' ),
		'automatic_installment_active_pos' => __( 'Automatic Installment Active POS', 'gurmepos' ),
		'form_settings'                    => __( 'Form Settings', 'gurmepos' ),
		'all_transactions'                 => __( 'All Transactions', 'gurmepos' ),
		'customer_first_name'              => __( 'First Name', 'gurmepos' ),
		'customer_last_name'               => __( 'Last Name', 'gurmepos' ),
		'customer_id'                      => __( 'Id', 'gurmepos' ),
		'customer_email'                   => __( 'E-Mail', 'gurmepos' ),
		'customer_address'                 => __( 'Address', 'gurmepos' ),
		'customer_city'                    => __( 'City', 'gurmepos' ),
		'customer_state'                   => __( 'State', 'gurmepos' ),
		'customer_country'                 => __( 'Country', 'gurmepos' ),
		'customer_zipcode'                 => __( 'Zip Code', 'gurmepos' ),
		'customer_ip_address'              => __( 'IP Address', 'gurmepos' ),
		'customer_phone'                   => __( 'Phone', 'gurmepos' ),
		'created_date'                     => __( 'Created Date', 'gurmepos' ),
		'total'                            => __( 'Total', 'gurmepos' ),
		'type'                             => __( 'Type', 'gurmepos' ),
		'process'                          => __( 'Process', 'gurmepos' ),
		'no_records'                       => __( 'Record not found', 'gurmepos' ),
		'transaction'                      => __( 'Transaction', 'gurmepos' ),
		'transaction_with_no'              => __( 'Transaction #{0} details', 'gurmepos' ),
		'timeline'                         => __( 'Timeline', 'gurmepos' ),
		'gpos_failed'                      => __( 'Failed', 'gurmepos' ),
		'gpos_completed'                   => __( 'Completed', 'gurmepos' ),
		'gpos_redirected'                  => __( 'Redirected To 3D', 'gurmepos' ),
		'gpos_started'                     => __( 'Started', 'gurmepos' ),
		'payment_id'                       => __( 'Virtual POS Payment Id', 'gurmepos' ),
		'payment'                          => __( 'Payment', 'gurmepos' ),
		'virtual_pos'                      => __( 'Virtual POS', 'gurmepos' ),
		'plugin'                           => __( 'Plugin', 'gurmepos' ),
		'plugin_transaction_id'            => __( 'Plugin Trans. Id', 'gurmepos' ),
		'customer'                         => __( 'Customer', 'gurmepos' ),
		'card_info'                        => __( 'Card Info', 'gurmepos' ),
		'masked_card_bin'                  => __( 'Card Number', 'gurmepos' ),
		'card_type'                        => __( 'Card Type', 'gurmepos' ),
		'card_brand'                       => __( 'Card Brand', 'gurmepos' ),
		'card_family'                      => __( 'Card Family', 'gurmepos' ),
		'card_holder_name'                 => __( 'Card Holder Name', 'gurmepos' ),
		'card_country'                     => __( 'Card Country', 'gurmepos' ),
		'card_bank_name'                   => __( 'Bank Name', 'gurmepos' ),
		'saved_card'                       => __( 'Saved Card', 'gurmepos' ),
		'yes'                              => __( 'Yes', 'gurmepos' ),
		'no'                               => __( 'No', 'gurmepos' ),
		'credit_card'                      => __( 'Credit Card', 'gurmepos' ),
		'debit_card'                       => __( 'Debit Card', 'gurmepos' ),
		'process_auth'                     => __( 'Auth, Login, Token etc.', 'gurmepos' ),
		'process_start_regular'            => __( 'Regular Process', 'gurmepos' ),
		'process_start_3d'                 => __( '3D Start', 'gurmepos' ),
		'process_redirect_3d'              => __( '3D Redirect', 'gurmepos' ),
		'process_callback_3d'              => __( '3D Callback', 'gurmepos' ),
		'process_finish_3d'                => __( '3D Finish', 'gurmepos' ),
		'paratika'                         => array(
			'description' => __( 'Institution/Company ID and user information are required to integrate your Paratika POS. You can access the Institution/Company ID information on the Paratika Pos Panel by following the steps: My Information -> Basic Information. If you have not created a user before, you need to create a user by following the Users -> Add User steps in the same panel.', 'gurmepos' ),
		),
		'ozan'                             => array(
			'description' => __( 'The information required for the Ozan Virtual Pos integration will be obtained from the Ozan Virtual Pos Screen.', 'gurmepos' ),
		),
		'sipay'                            => array(
			'description' => __( 'You can get the necessary api information for the integration of your Sipay Virtual POS: You can log in to the Sipay Virtual POS Panel and get it from the Settings -> Integration & API page.', 'gurmepos' ),
		),
		'iyzico'                           => array(
			'description' => __( 'API and security key information is required for Iyzico integration. You can access your API and security keys from the Settings->Company Settings section of your Iyzico merchant panel. ', 'gurmepos' ),
		),
		'esnekpos'                         => array(
			'description' => __( 'Required information for Esnekpos integration will be provided from the Esnekpos  user panel. ', 'gurmepos' ),
		),
		'param'                            => array(
			'description' => __( 'Param API information is required for Param POS integration. To access this information, you can access the necessary information from the page that opens after logging in to Param internet branch and clicking the "My Integration Information" tab under the ParamPos Menu. ', 'gurmepos' ),
		),
		'paytr'                            => array(
			'description' => __( 'API Integration Information is required for PayTR integration. This information: PayTR user panel: Information menu -> API Integration Information is located under the heading.', 'gurmepos' ),
		),
		'akbank'                           => array(
			'description' => __( 'The information required for Akbank Virtual Pos integration will be obtained from the Akbank Virtual Pos Screen.', 'gurmepos' ),
		),
		'craftgate'                        => array(
			'description' => __( 'API Integration Information is required for Craftgate integration. This information is located in the Craftgate control panel: Admin Menu -> Merchant Settings Tab -> API Access Information.', 'gurmepos' ),
		),
		'denizbank'                        => array(
			'description' => __( 'After logging into your Denizbank Virtual Pos panel, you need to create a new API user for integration information, if you have not created one before. After logging in, you can create an API user record by logging into the User Editing and Authorization page from the User Management System menu on the left. You can provide integration by filling in the API user information you have created in the relevant places.', 'gurmepos' ),
		),
		'finansbank'                       => array(
			'description' => __( 'For integration information after logging into your Finansbank panel: If you have not created one before, create an API user with the help of User Management from the Administration Menu. Fill in the API user information you created to the relevant places in the POS Entegratör.', 'gurmepos' ),
		),
		'garanti'                          => array(
			'description' => __( 'Obtain the necessary information for the Garanti Pos integration from the Garanti Virtual Pos Screen.			', 'gurmepos' ),
		),
		'halkbank'                         => array(
			'description' => __( 'After logging into your Halkbank panel, click on the management menu. If no user has been created before, we create an "API USER" from the User list section. We take the necessary information from the menus on the left and fill it in the relevant places in the POS Entegratör.', 'gurmepos' ),
		),
		'ingbank'                          => array(
			'description' => __( 'The information required for ING Bank Pos integration will be obtained from the ING Bank Virtual Pos Screen.', 'gurmepos' ),
		),
		'isbank'                           => array(
			'description' => __( 'After logging into the İşbank virtual pos system, if no API user has been created before, an API user must be created by entering the "Add New User" section under the "Management" heading. Then, API user information should be filled in the relevant places.', 'gurmepos' ),
		),
		'kuveyt-turk'                      => array(
			'description' => __( 'Information required for Kuveyt Türk Pos integration will be obtained from the Kuveyt Türk Virtual Pos Screen.', 'gurmepos' ),
		),
		'teb'                              => array(
			'description' => __( 'After logging into your TEB bank virtual pos panel, we click on the management menu. If no user has been created before, we create an "API USER" from the User list section. We fill in the necessary information in the relevant places in the POS Entegratör. ', 'gurmepos' ),
		),
		'vakifbank'                        => array(
			'description' => __( 'We click on the "CONTRACTED MERCHANT TRANSACTIONS" section under the "MANAGEMENT" tab from the Vakıfbank Virtual Pos panel. The page that opens contains the necessary information for our company. We fill this information in the relevant places in POS Entegratör.', 'gurmepos' ),
		),
		'yapikredi'                       => array(
			'description' => __( 'The information required for the Yapı Kredi Virtual POS integration will be obtained from the Yapı Kredi Virtual POS Screen.', 'gurmepos' ),
		),
		'ziraat'                           => array(
			'description' => __( 'After logging into Ziraat Bank Virtual Pos panel, if you have not created an API user before, first we click on the "Management" tab, we define a new user by selecting "Role" API User from the "Add New User" field. Then, we fill in the "User Name" and "Password" information you have defined in this field in the relevant fields in POS Entegratör.', 'gurmepos' ),
		),
	),
);
