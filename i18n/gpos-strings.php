<?php
/**
 * Frontend uygulaması için kelime ve cümle çevirileri.
 *
 * @package Gurmehub
 */

$gpos_i18n = array(
	'default' => array(
		'payment_method'                  => __( 'Ödeme Yöntemi', 'gurmepos' ),
		'three_d'                         => __( '3D Ödeme', 'gurmepos' ),
		'regular'                         => __( 'Regular Ödeme', 'gurmepos' ),
		'save_card'                       => __( 'Kayıtlı Kart', 'gurmepos' ),
		'recurring_with_saved_card'       => __( 'Tekrarlı Ödeme (Kayıtlı Kart)', 'gurmepos' ),
		'recurring_with_plan'             => __( 'Tekrarlı Ödeme (Ödeme Planı)', 'gurmepos' ),
		'installment_api'                 => __( 'Otomatik Taksit', 'gurmepos' ),
		'refund'                          => __( 'İade', 'gurmepos' ),
		'Completed'                       => __( 'Tamamlandı', 'gurmepos' ),
		'Processing'                      => __( 'Hazırlanıyor', 'gurmepos' ),
		'paynut'                          => __( 'Pos Entegratör', 'gurmepos' ),
		'free'                            => __( 'Ücretsiz', 'gurmepos' ),
		'update_pro'                      => __( 'Pro Sürüm Yakında!', 'gurmepos' ),
		'announcements'                   => __( 'Duyurular', 'gurmepos' ),
		'add_payment_comp'                => __( 'Ödeme Kuruluşu Ekle', 'gurmepos' ),
		'establishment'                   => __( 'Kuruluş', 'gurmepos' ),
		'find_comp'                       => __( 'Aradığınız kuruluşu bulamıyor musunuz?', 'gurmepos' ),
		'contact_us'                      => __( 'Bizimle iletişime geçin', 'gurmepos' ),
		'features'                        => __( 'Özellikler', 'gurmepos' ),
		'currency'                        => __( 'Para Birimleri', 'gurmepos' ),
		'status'                          => __( 'Durum', 'gurmepos' ),
		'actions'                         => __( 'Aksiyonlar', 'gurmepos' ),
		'not_active_comp'                 => __( 'Aktif bir ödeme kuruluşunuz bulunmamakta.', 'gurmepos' ),
		'test_mode'                       => __( 'Test Modu', 'gurmepos' ),
		'test_mode_content'               => __( 'Tüm uygulamayı test moduna geçirir ve test apileri ile test yapmanıza yarar', 'gurmepos' ),
		'help_title'                      => __( 'Uygulama ile ilgili', 'gurmepos' ),
		'help_title_link'                 => __( 'yardım dökümanlarını inceleyin', 'gurmepos' ),
		'3d_settings'                     => __( '3D Ayarları', 'gurmepos' ),
		'not_3d'                          => __( '3Dsiz Ödeme', 'gurmepos' ),
		'not_3d_subtitle'                 => __( 'Kullanıcılar direkt olarak ödemeyi tamamlar', 'gurmepos' ),
		'optional_3d'                     => __( 'Kullanıcıya Sor', 'gurmepos' ),
		'optional_3d_subtitle'            => __( 'Kullanıcılar ödeme sırasında 3D seçeneğini belirler', 'gurmepos' ),
		'forced_3d'                       => __( '3D Zorunlu', 'gurmepos' ),
		'forced_3d_subtitle'              => __( 'Kullanıcılar ödeme sonrasında 3D Ekranına yönlendirilir.', 'gurmepos' ),
		'other_settings'                  => __( 'Diğer Ayarlar', 'gurmepos' ),
		'form_name_settings'              => __( 'Form üzerinden Ad Soyad Bilgisi Al', 'gurmepos' ),
		'form_name_settings_subtitle'     => __( 'Kart üzerindeki isim bilgisi için sipariş alanlarını kullan. Ayarın kapalı olması durumunda kart numarası bölümünü üstünde isim alanı oluşacaktır.', 'gurmepos' ),
		'save_card_settings'              => __( 'Kart Saklama', 'gurmepos' ),
		'save_card_settings_subtitle'     => __( 'Kart Saklama özelliği ile müşterileriniz ödeme sırasında kartlarını kayıt edebilir.', 'gurmepos' ),
		'sub_payment_settings'            => __( 'Tekrarlı Ödeme', 'gurmepos' ),
		'sub_payment_settings_subtitle'   => __( 'WooCommerce Subscriber Eklenti ile abonelikli ürün satışı yapın', 'gurmepos' ),
		'view_settings'                   => __( 'Görünüm Ayarları', 'gurmepos' ),
		'standart_form_settings'          => __( 'Standart Ödeme Formu', 'gurmepos' ),
		'standart_form_settings_subtitle' => __( 'Standart WooCommerce ödeme formu', 'gurmepos' ),
		'oneline_form_settings'           => __( 'Tek satır ödeme formu', 'gurmepos' ),
		'online_form_settings_subtitle'   => __( 'Tek satır kredi kartı formu', 'gurmepos' ),
		'pay_credit_cart'                 => __( 'Kredi kartı ile ödeme', 'gurmepos' ),
		'save_settings'                   => __( 'Ayarları Kaydet', 'gurmepos' ),
		'connect_test'                    => __( 'Bağlantıyı test et', 'gurmepos' ),
		'delete_gateway'                  => __( 'Ödeme kuruluşunu kaldır', 'gurmepos' ),
		'test_mode_title'                 => __( 'Test Modu Aktif', 'gurmepos' ),
		'test_mode_content'               => __( 'Test modu aktif iken test APIleri ile çalışmanız gerekmektedir.', 'gurmepos' ),
		'gateway_screen'                  => __( 'Sanal Pos Ekranı', 'gurmepos' ),
		'supports_features'               => __( 'Desteklenen Özellikler', 'gurmepos' ),
		'supports_currency'               => __( 'Desteklenen Para Birimleri', 'gurmepos' ),
		'empty_gateway_title'             => __( 'Henüz bir pos aktif etmediniz', 'gurmepos' ),
		'empty_gateway_content'           => __( ' Hemen ödeme almaya başlamak için anlaşmalı olduğunuz ödeme kuruluşunun bağlantısını gerçekleştirin.', 'gurmepos' ),
		'method_name'                     => __( 'Yöntem Adı', 'gurmepos' ),
		'pay_button_value'                => __( 'Ödeme Butonu Yazısı', 'gurmepos' ),
		'pay_to_status'                   => __( 'Başarılı Ödemelerin Geçeceği durum', 'gurmepos' ),
		'pay_form_desc'                   => __( 'Ödeme Formunun Açıklama Alanı', 'gurmepos' ),


		'paratika'                        => array(
			'description' => 'Paratika müşteri paneline giriş yapıp Kullanıcılar menüsünden api servislerini kullanabileceğiniz api kullanıcısı ve şifresi oluşturabilirsiniz.',
		),
		'ozan'                            => array(
			'description' => 'Ozan müşteri paneline giriş yapıp Kullanıcılar menüsünden api servislerini kullanabileceğiniz api kullanıcısı ve şifresi oluşturabilirsiniz.',
		),
		'sipay'                           => array(
			'description' => 'Sipay müşteri paneline giriş yapıp Kullanıcılar menüsünden api servislerini kullanabileceğiniz api kullanıcısı ve şifresi oluşturabilirsiniz.',
		),
		'iyzico'                          => array(
			'description' => 'iyzico müşteri paneline giriş yapıp Kullanıcılar menüsünden api servislerini kullanabileceğiniz api kullanıcısı ve şifresi oluşturabilirsiniz.',
		),
		'esnekpos'                        => array(
			'description' => 'Esnekpos müşteri paneline giriş yapıp Kullanıcılar menüsünden api servislerini kullanabileceğiniz api kullanıcısı ve şifresi oluşturabilirsiniz.',
		),
		'param'                           => array(
			'description' => 'Param müşteri paneline giriş yapıp Kullanıcılar menüsünden api servislerini kullanabileceğiniz api kullanıcısı ve şifresi oluşturabilirsiniz.',
		),
		'paytr'                           => array(
			'description' => 'PayTR müşteri paneline giriş yapıp Kullanıcılar menüsünden api servislerini kullanabileceğiniz api kullanıcısı ve şifresi oluşturabilirsiniz.',
		),
	),
);
