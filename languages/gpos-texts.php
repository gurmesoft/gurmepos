<?php
/**
 * Frontend uygulaması için kelime ve cümle çevirileri.
 *
 * @package GurmeHub
 */

$gpos_texts = array(
	'woocommerce_subs' 					=> 'WC Subscriptions',
	'payment_method' 					=> __( 'Payment Method', 'gurmepos' ),
	'threed'                            => __( '3D Payment', 'gurmepos' ),
	'regular'                           => __( 'Regular Payment', 'gurmepos' ),
	'save_card'                         => __( 'Save Card', 'gurmepos' ),
	'recurring_with_saved_card'         => __( 'Recurring Payment (Saved Card)', 'gurmepos' ),
	'recurring_with_plan'               => __( 'Recurring Payment (Payment Plan)', 'gurmepos' ),
	'installment_api'                   => __( 'Automatic Plan', 'gurmepos' ),
	'refund'                            => __( 'Refund', 'gurmepos' ),
	'Completed'                         => __( 'Completed', 'gurmepos' ),
	'Processing'                        => __( 'Processing', 'gurmepos' ),
	'free'                              => __( 'Free', 'gurmepos' ),
	'update_pro'                        => __( 'Pro Upgrade', 'gurmepos' ),
	'announcements'                     => __( 'Announcements', 'gurmepos' ),
	'add_payment_comp'                  => __( 'Add Payment Method', 'gurmepos' ),
	'establishment'                     => __( 'Payment Provider', 'gurmepos' ),
	'find_comp'                         => __( 'Can`t find the payment provider you`re looking for?', 'gurmepos' ),
	'contact_us'                        => __( 'Contact Us', 'gurmepos' ),
	'features'                          => __( 'Features', 'gurmepos' ),
	'currency'                          => __( 'Currencies', 'gurmepos' ),
	'status'                            => __( 'Status', 'gurmepos' ),
	'actions'                           => __( 'Actions', 'gurmepos' ),
	'not_active_comp'                   => __( 'You do not have an active pay organization.', 'gurmepos' ),
	'test_mode'                         => __( 'Test Mode', 'gurmepos' ),
	'test_mode_content'                 => __( 'It puts the entire application into test mode and allows you to test with test apis.', 'gurmepos' ),
	'help_title'                        => __( 'Application related', 'gurmepos' ),
	'help_title_link'                   => __( 'View help documents about {0}', 'gurmepos' ),
	'3d_settings'                       => __( '3D Settings', 'gurmepos' ),
	'3d_settings_note'                  => __( 'Info: If your virtual POS does not support regular transactions, the payment will be taken in 3D even if the Payment Without 3D or Ask User options are selected.', 'gurmepos' ),
	'not_3d'                            => __( 'Not 3D', 'gurmepos' ),
	'not_3d_subtitle'                   => __( 'Users complete the payment directly', 'gurmepos' ),
	'optional_3d'                       => __( 'Ask User', 'gurmepos' ),
	'optional_3d_subtitle'              => __( 'User selects 3D option at checkout', 'gurmepos' ),
	'forced_3d'                         => __( 'Forced 3D', 'gurmepos' ),
	'forced_3d_subtitle'                => __( 'Users are redirected to the 3D Screen after paying.', 'gurmepos' ),
	'other_settings'                    => __( 'Other Settings', 'gurmepos' ),
	'form_name_settings'                => __( 'Get name and surname information on the form', 'gurmepos' ),
	'form_name_settings_subtitle'       => __( 'Use the order fields for the name information on the card. If the setting is turned off, a name field will appear above the card number section.', 'gurmepos' ),
	'save_card_settings'                => __( 'Save Card', 'gurmepos' ),
	'save_card_settings_subtitle'       => __( 'With the Card Save feature, your customers can register their cards during paying.', 'gurmepos' ),
	'sub_payment_settings'              => __( 'Recurring Payment', 'gurmepos' ),
	'sub_payment_settings_subtitle'     => __( 'Sell subscription products with the WooCommerce Subscriber Plugin', 'gurmepos' ),
	'view_settings'                     => __( 'Appearance Settings', 'gurmepos' ),
	'standart_form_settings'            => __( 'Standard Payment Form', 'gurmepos' ),
	'standart_form_settings_subtitle'   => __( 'Standart three field form', 'gurmepos' ),
	'oneline_form_settings'             => __( 'One-line payment form', 'gurmepos' ),
	'online_form_settings_subtitle'     => __( 'One-line credit card form', 'gurmepos' ),
	'pay_credit_cart'                   => __( 'Payment by credit card', 'gurmepos' ),
	'save_settings'                     => __( 'Save Settings', 'gurmepos' ),
	'connect_test'                      => __( 'Test the connection', 'gurmepos' ),
	'delete_gateway'                    => __( 'Remove payment provider', 'gurmepos' ),
	'test_mode_title'                   => __( 'Test Mode Active', 'gurmepos' ),
	'gateway_screen'                    => __( 'Virtual POS Screen', 'gurmepos' ),
	'supports_features'                 => __( 'Supported Features', 'gurmepos' ),
	'supports_currency'                 => __( 'Supported Currencies', 'gurmepos' ),
	'empty_gateway_title'               => __( 'You have not activated a pos yet', 'gurmepos' ),
	'empty_gateway_content'             => __( 'To start receiving payments immediately, make the connection to the payment institution you are contracted with.', 'gurmepos' ),
	'method_name'                       => __( 'Method Name', 'gurmepos' ),
	'pay_button_value'                  => __( 'Payment Button Text', 'gurmepos' ),
	'pay_to_status'                     => __( 'Status of Successful Payments', 'gurmepos' ),
	'pay_form_desc'                     => __( 'Description Field of Payment Form', 'gurmepos' ),
	'soon'                              => __( 'Soon', 'gurmepos' ),
	'help'                              => __( 'Help', 'gurmepos' ),
	'feedback'                          => __( 'Feedback', 'gurmepos' ),
	'forum'                             => __( 'Forum', 'gurmepos' ),
	'transaction_details'               => __( 'Transaction Details', 'gurmepos' ),
	'request'                           => __( 'Request', 'gurmepos' ),
	'response'                          => __( 'Response', 'gurmepos' ),
	'date'                              => __( 'Date', 'gurmepos' ),
	'copy'                              => __( 'Copy', 'gurmepos' ),
	'copied'                            => __( 'Copied', 'gurmepos' ),
	'payment_gateway'                   => __( 'Payment Gateway', 'gurmepos' ),
	'platform'                          => __( 'Platform', 'gurmepos' ),
	'process_type'                      => __( 'Process Type', 'gurmepos' ),
	'details'                           => __( 'Details', 'gurmepos' ),
	'no_logs'                           => __( 'There are no logs.', 'gurmepos' ),
	'installment'                       => __( 'Installment', 'gurmepos' ),
	'rate'                              => __( 'Rate', 'gurmepos' ),
	'search_payment_gateway'            => __( 'Search Payment Institution', 'gurmepos' ),
	'default'                   		=> __( 'Default', 'gurmepos' ),
	'make_default'              		=> __( 'Make Default', 'gurmepos' ),
	'all_features'                      => __( 'All Features', 'gurmepos' ),
	'loading'                           => __( 'Loading...', 'gurmepos' ),
	'pro_upgrade'                       => __( 'Upgrade Pro', 'gurmepos' ),
	'check_out_pro_version'             => __( 'Check out the pro version for many pos and more available in Pro', 'gurmepos' ),
	'review_now'                        => __( 'Review Now', 'gurmepos' ),
	'table_view_settings'               => __( 'Installment Table View Settings', 'gurmepos' ),
	'table_view'                        => __( 'Table View', 'gurmepos' ),
	'table_view_desc'                   => __( 'It shows your installment options in the form of a table in the payment form.', 'gurmepos' ),
	'row_view'                          => __( 'Row View', 'gurmepos' ),
	'row_view_desc'                     => __( 'It shows your installment options in more detail in the form of rows in the payment form.', 'gurmepos' ),
	'not_for_sale_installments'         => __( 'Show Warning for Categories Not for Sale in Installments.', 'gurmepos' ),
	'not_for_sale_installments_desc'    => __( 'You can show a warning text to your customers on the checkout page for your categories that are not available for sale in installments. (WooCommerce only)', 'gurmepos' ),
	'warning_text'                      => __( 'Warning Text', 'gurmepos' ),
	'enter_desc'                        => __( 'Enter Description', 'gurmepos' ),
	'gurmehub_forum'                    => __( 'GurmeHub Forum', 'gurmepos' ),
	'gurmehub_forum_desc'               => __( 'Share your questions about Shopify, WooCommerce, Dokan and many other platforms with us and the community through the Gurmehub Forum.', 'gurmepos' ),
	'gurmehub_feedback'                 => __( 'GurmeHub Feedback', 'gurmepos' ),
	'gurmehub_feedback_desc'            => __( 'Your suggestions are very valuable to us so that our applications can work better. You can support us to improve our products by giving feedback.', 'gurmepos' ),
	'give_feedback'                     => __( 'Give Feedback', 'gurmepos' ),
	'pos_entegrator_help'               => __( 'Before using our POS Entegratör application, you can use the application much more efficiently by examining our documents.', 'gurmepos' ),
	'docs'                              => __( 'Docs', 'gurmepos' ),
	'transaction_logs'                  => __( 'Transaction Logs', 'gurmepos' ),
	'transaction_logs_desc'             => __( 'On this table, you can view in detail every transaction that goes through your payment gateway.', 'gurmepos' ),
	'logs'                              => __( 'Logs', 'gurmepos' ),
	'deletion_completed'                => __( 'Deletion completed', 'gurmepos' ),
	'ok'                                => __( 'OK', 'gurmepos' ),
	'back_to'                           => __( 'Back To', 'gurmepos' ),
	'paratika_information'              => __( 'You can access the Institution/Company ID information from the top menu of your Paratika panel, under My Information > Basic Settings.', 'gurmepos' ),
	'installment_options'               => __( 'Installment Options', 'gurmepos' ),
	'activate_installment'              => __( 'Activate Installment Sale', 'gurmepos' ),
	'virtual_pos_installment_settings'  => __( 'You can automatically bring your installment rates by making your installment settings from the virtual POS panel.', 'gurmepos' ),
	'get_installment_rates'             => __( 'Get Installment Rates', 'gurmepos' ),
	'payment_methods'                   => __( 'Payment Methods', 'gurmepos' ),
	'woocommerce'              			=> __( 'WooCommerce', 'gurmepos' ),
	'your_method_name'                  => __( 'Your Method Name', 'gurmepos' ),
	'icon'                              => __( 'Icon', 'gurmepos' ),
	'automatic_installment_active_pos'  => __( 'Automatic Installment Active POS', 'gurmepos' ),
	'form_settings'                     => __( 'Form Settings', 'gurmepos' ),
	'all_transactions'                  => __( 'All Transactions', 'gurmepos' ),
	'customer_first_name'               => __( 'First Name', 'gurmepos' ),
	'customer_last_name'                => __( 'Last Name', 'gurmepos' ),
	'customer_id'                       => __( 'Id', 'gurmepos' ),
	'customer_email'                    => __( 'E-Mail', 'gurmepos' ),
	'customer_address'                  => __( 'Address', 'gurmepos' ),
	'customer_city'                     => __( 'City', 'gurmepos' ),
	'customer_state'                    => __( 'State', 'gurmepos' ),
	'customer_country'                  => __( 'Country', 'gurmepos' ),
	'customer_zipcode'                  => __( 'Zip Code', 'gurmepos' ),
	'customer_ip_address'               => __( 'IP Address', 'gurmepos' ),
	'customer_phone'                    => __( 'Phone', 'gurmepos' ),
	'created_date'                      => __( 'Created Date', 'gurmepos' ),
	'total'                             => __( 'Total', 'gurmepos' ),
	'type'                              => __( 'Type', 'gurmepos' ),
	'process'                           => __( 'Process', 'gurmepos' ),
	'no_records'                        => __( 'Record not found', 'gurmepos' ),
	'transaction'                       => __( 'Transaction', 'gurmepos' ),
	'transaction_with_no'               => __( 'Transaction #{0} details', 'gurmepos' ),
	'timeline'                          => __( 'Timeline', 'gurmepos' ),
	'gpos_failed'                       => __( 'Failed', 'gurmepos' ),
	'gpos_completed'                    => __( 'Completed', 'gurmepos' ),
	'gpos_redirected'                   => __( 'Redirected To 3D', 'gurmepos' ),
	'gpos_common_form'                  => __( 'Redirected To Common Form', 'gurmepos' ),
	'gpos_started'                      => __( 'Started', 'gurmepos' ),
	'payment_id'                        => __( 'Virtual POS Process Id', 'gurmepos' ),
	'payment'                           => __( 'Payment', 'gurmepos' ),
	'virtual_pos'                       => __( 'Virtual POS', 'gurmepos' ),
	'plugin'                            => __( 'Plugin', 'gurmepos' ),
	'plugin_transaction_id'             => __( 'Plugin Trans. Id', 'gurmepos' ),
	'customer'                          => __( 'Customer', 'gurmepos' ),
	'card_info'                         => __( 'Card Info', 'gurmepos' ),
	'masked_card_bin'                   => __( 'Card Number', 'gurmepos' ),
	'card_type'                         => __( 'Card Type', 'gurmepos' ),
	'card_brand'                        => __( 'Card Brand', 'gurmepos' ),
	'card_family'                       => __( 'Card Family', 'gurmepos' ),
	'card_holder_name'                  => __( 'Card Holder Name', 'gurmepos' ),
	'card_country'                      => __( 'Card Country', 'gurmepos' ),
	'card_bank_name'                    => __( 'Bank Name', 'gurmepos' ),
	'saved_card'                        => __( 'Saved Card', 'gurmepos' ),
	'yes'                               => __( 'Yes', 'gurmepos' ),
	'no'                                => __( 'No', 'gurmepos' ),
	'credit_card'                       => __( 'Credit Card', 'gurmepos' ),
	'debit_card'                        => __( 'Debit Card', 'gurmepos' ),
	'process_auth'                      => __( 'Auth, Login, Token etc.', 'gurmepos' ),
	'process_start_regular'             => __( 'Regular Process', 'gurmepos' ),
	'process_start_3d'                  => __( '3D Start', 'gurmepos' ),
	'process_redirect_3d'               => __( '3D Redirect', 'gurmepos' ),
	'process_start_common_form'			=> __( 'Common Form Start', 'gurmepos' ),
	'process_callback'              	=> __( 'Callback', 'gurmepos' ),
	'process_finish'                	=> __( 'Finish', 'gurmepos' ),
	'process_notify'                	=> __( 'Notify', 'gurmepos' ),
	'full_refund'                	    => __( 'Refund Total Amount', 'gurmepos' ),
	'payment_transactions'              => __( 'Payment Transactions', 'gurmepos' ),
	'product_name'             		    => __( 'Product Name', 'gurmepos' ),
	'refundable'             		    => __( 'Refundable', 'gurmepos' ),
	'cancel_refund_status'				=> __( 'Cancel / Refund Status', 'gurmepos' ),
	'action'             		   		=> __( 'Action', 'gurmepos' ),
	'refund_it'							=> __( 'Refund It', 'gurmepos' ),
	'gpos_line_n_refunded' 				=> __( 'Not Refunded','gurmepos' ), 
	'gpos_line_refunded' 				=> __( 'Refunded','gurmepos' ),
	'gpos_line_p_refunded' 				=> __( 'Partial Refunded','gurmepos' ),
	'refund_description' 				=> __( 'Are you sure you want to refund the full <strong>{0} {1}</strong> payment?','gurmepos' ),
	'refund_note' 						=> __( 'Note: If 1 day has not passed from the date of the transaction, the cancellation will be made, otherwise the refund will be made.','gurmepos' ),
	'cancel' 							=> __( 'Cancel','gurmepos' ),
	'process_cancel' 					=> __( 'Process Cancel','gurmepos' ),
	'process_refund' 					=> __( 'Process Refund','gurmepos' ),
	'gpos_refund_status_cancelled' 		=> __( 'Cancelled','gurmepos' ),
	'gpos_refund_status_n_refunded' 	=> __( 'Not Refunded','gurmepos' ),
	'gpos_refund_status_refunded' 		=> __( 'Refunded','gurmepos' ),
	'gpos_refund_status_p_refunded' 	=> __( 'Partial Refunded','gurmepos' ),
	'line_refund_description' 			=> __( 'You can refund part of the <strong>{0} {1}</strong> payment by entering the amount you want to refund.','gurmepos' ),
	'payment_transaction_id' 			=> __( 'Payment Transaction Id','gurmepos' ),
	'general_settings' 					=> __( 'General Settings','gurmepos' ),
	'integration_settings' 				=> __( 'Integration Settings','gurmepos' ),
	'givewp' 							=> __( 'GiveWP','gurmepos' ),
	'payment_settings' 					=> __( 'Payment Settings','gurmepos' ),
	'installment_rules' 				=> __( 'Installment Rules','gurmepos' ),
	'card_save' 						=> __( 'Card Saving','gurmepos' ),
	'documents' 						=> __( 'Documents','gurmepos' ),
	'other' 							=> __( 'Other','gurmepos' ),
	'activate' 							=> __( 'Activate','gurmepos' ),
	'saved_card_active'					=> __( 'Your users with the Card Save feature, they can save their cards during payment. (If default payment gateway supports save card)','gurmepos' ),
	'save_step' 						=> __( 'Save Step','gurmepos' ),
	'at_payment' 						=> __( 'At payment','gurmepos' ),
	'at_payment_desc' 					=> __( 'Users can register their cards at payment','gurmepos' ),
	'after_payment' 					=> __( 'After payment','gurmepos' ),
	'after_payment_desc' 				=> __( 'After users complete their payment, they can save card','gurmepos' ),
	'short_code' 						=> __( 'Short Code','gurmepos' ),
	'settings' 							=> __( 'Settings','gurmepos' ),
	'export' 							=> __( 'Export','gurmepos' ),
	'save_card_short_code_desc'			=> __( 'With the help of the shortcode, you can create a page where your customers can view and remove their saved cards., they can save card','gurmepos' ),
	'form'		 						=> __( 'Form', 'gurmepos' ),
	'default_donator_desc'				=> __( 'If there are no personal information fields in the donation form, the contact information here will be used.', 'gurmepos' ),
	'default_donator' 					=> __( 'Default Donator', 'gurmepos' ),
	'first_name' 						=> __( 'First Name', 'gurmepos' ),
	'last_name' 						=> __( 'Last Name', 'gurmepos' ),
	'phone' 							=> __( 'Phone', 'gurmepos' ),
	'email' 							=> __( 'E-Mail', 'gurmepos' ),
	'address' 							=> __( 'Address', 'gurmepos' ),
	'state' 							=> __( 'State', 'gurmepos' ),
	'city' 								=> __( 'City', 'gurmepos' ),
	'country' 							=> __( 'Country', 'gurmepos' ),
	'test_mode_checkout_desc'	 		=> __( 'While the test mode is active, your payments will be made with the Test APIs.','gurmepos' ),
	'card_bin' 							=> __( 'Card Number','gurmepos' ),
	'month_year' 						=> __( 'Month/Year','gurmepos' ),
	'month' 							=> __( 'Month','gurmepos' ),
	'year' 								=> __( 'Year','gurmepos' ),
	'name_on_card' 						=> __( 'Name on the card', 'gurmepos' ),
	'threed_checkout' 					=> __( 'I want to pay with 3d secure.', 'gurmepos' ),
	'save_card_checkout'				=> __( 'Save my card for next payments.', 'gurmepos' ),
	'card_name'							=> __( 'Card name', 'gurmepos' ),
	'pay_with_diff' 					=> __( 'Pay with different card' , 'gurmepos' ),
	'pay_with_saved' 					=> __( 'Pay with my saved card' , 'gurmepos' ),
	'installment_number'				=> __( 'Installment Number' , 'gurmepos' ),
	'monthly_payment'					=> __( 'Monthly Payment' , 'gurmepos' ),
	'delete' 							=> __( 'Delete', 'gurmepos' ),
	'gateway_error' 					=> __( 'You have not activated any pos integration, please complete your settings.', 'gurmepos' ),
	'saved_card_not_found'			    => __( 'No Saved Card found.','gurmepos' ),
	'reset_settings'			    	=> __( 'Reset Settings','gurmepos' ),
	'support_settings'					=> __( 'Support Settings' , 'gurmepos' ),
	'user_can_cpm_desc'					=> __( 'When this setting is activated, users can cahange their payment method from My Account -> My Subscriptions.' , 'gurmepos' ),
	'user_can_cancel_desc'				=> __( 'When this setting is activated, users can cancel their subscriptions from My Account -> My Subscriptions.' , 'gurmepos' ),
	'save_info'							=> __( 'If there is a basket subscription product, you can write a note if you want to inform the customer that their card will be registered automatically.' , 'gurmepos' ),
	'note'								=> __( 'Note' , 'gurmepos' ),
	'use_iframe_settings'				=> __( 'Using iframe for 3D forms and Common payment forms' , 'gurmepos' ),
	'use_iframe_settings_subtitle'		=> __( 'Important! This feature is still in beta phase. Please do not open it to your customers without testing it. Your feedback is important for our development process.' , 'gurmepos' ),
	'card_name_field'					=> __( 'Card Name Field', 'gurmepos' ),
	'card_name_default'					=> __( 'Use default name', 'gurmepos' ),
	'card_name_default_desc'			=> __( 'Sample: Saved card with ending 0000', 'gurmepos' ),
	'card_name_show_field'				=> __( 'Use field', 'gurmepos' ),
	'card_name_show_field_desc'			=> __( 'Users can write name for card', 'gurmepos' ),
	'order'								=> __( 'Order', 'gurmepos' ),
	'search'							=> __( 'Search', 'gurmepos' ),
	'select'							=> __( 'Select', 'gurmepos' ),
	'select_category'					=> __( 'Select the category you want to set rules for', 'gurmepos' ),
	'disable_inst'						=> __( 'Disable inst.', 'gurmepos' ),
	'apply'								=> __( 'Apply', 'gurmepos' ),
	'category'							=> __( 'Category', 'gurmepos' ),
	'no_rules'							=> __( 'No rules found...', 'gurmepos' ),
	'remove'							=> __( 'Remove', 'gurmepos' ),
	'expiry_field_style'				=> __( 'Expiry Field Style', 'gurmepos' ),
	'select_box'						=> __( 'Select Box', 'gurmepos' ),
	'text_box'							=> __( 'Text Box', 'gurmepos' ),
	'mmyy'								=> __( 'MM / YY', 'gurmepos' ),
	'mm'								=> __( 'MM', 'gurmepos' ),
	'yy'								=> __( 'YY', 'gurmepos' ),
	'transaction_not_found'             => __( 'Transaction not found.', 'gurmepos' ),
	'cvv_helper' 						=> __( '<strong>Security Code(CVV/CVC)</strong><br>Three numbers on the back of your card', 'gurmepos' ),
);
