<?php
/**
 * Frontend uygulaması için kelime ve cümle çevirileri.
 *
 * @package Gurmehub
 */

$gpos_i18n = array(
	'default' => array(
		'payment_method'                  => __( 'Ödeme Yöntemi', 'gurmepos' ),
		'threed'                          => __( '3D Ödeme', 'gurmepos' ),
		'regular'                         => __( 'Regular Ödeme', 'gurmepos' ),
		'save_card'                       => __( 'Kayıtlı Kart', 'gurmepos' ),
		'recurring_with_saved_card'       => __( 'Tekrarlı Ödeme (Kayıtlı Kart)', 'gurmepos' ),
		'recurring_with_plan'             => __( 'Tekrarlı Ödeme (Ödeme Planı)', 'gurmepos' ),
		'installment_api'                 => __( 'Otomatik Taksit', 'gurmepos' ),
		'refund'                          => __( 'İade', 'gurmepos' ),
		'Completed'                       => __( 'Tamamlandı', 'gurmepos' ),
		'Processing'                      => __( 'Hazırlanıyor', 'gurmepos' ),
		'paynut'                          => __( 'POS Entegratör', 'gurmepos' ),
		'free'                            => __( 'Ücretsiz', 'gurmepos' ),
		'update_pro'                      => __( 'Proya Yükselt', 'gurmepos' ),
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
		'not_3d'                          => __( "3D'siz Ödeme", 'gurmepos' ),
		'not_3d_subtitle'                 => __( 'Kullanıcılar direkt olarak ödemeyi tamamlar.', 'gurmepos' ),
		'optional_3d'                     => __( 'Kullanıcıya Sor', 'gurmepos' ),
		'optional_3d_subtitle'            => __( 'Kullanıcılar ödeme sırasında 3D seçeneğini belirler.', 'gurmepos' ),
		'forced_3d'                       => __( '3D Zorunlu', 'gurmepos' ),
		'forced_3d_subtitle'              => __( 'Kullanıcılar ödeme sonrasında 3D Ekranına yönlendirilir. ', 'gurmepos' ),
		'other_settings'                  => __( 'Diğer Ayarlar', 'gurmepos' ),
		'form_name_settings'              => __( 'Form üzerinden Ad Soyad Bilgisi Al', 'gurmepos' ),
		'form_name_settings_subtitle'     => __( 'Kart üzerindeki isim bilgisi için sipariş alanlarını kullan . Ayarın kapalı olması durumunda kart numarası bölümünü üstünde isim alanı oluşacaktır. ', 'gurmepos' ),
		'save_card_settings'              => __( 'Kart Saklama', 'gurmepos' ),
		'save_card_settings_subtitle'     => __( 'Kart Saklama özelliği ile müşterileriniz ödeme sırasında kartlarını kayıt edebilir. ', 'gurmepos' ),
		'sub_payment_settings'            => __( 'Tekrarlı Ödeme', 'gurmepos' ),
		'sub_payment_settings_subtitle'   => __( 'WooCommerce Subscriber Eklenti ile abonelikli ürün satışı yapın.', 'gurmepos' ),
		'view_settings'                   => __( 'Görünüm Ayarları', 'gurmepos' ),
		'standart_form_settings'          => __( 'Standart Ödeme Formu', 'gurmepos' ),
		'standart_form_settings_subtitle' => __( 'Standart WooCommerce ödeme formu.', 'gurmepos' ),
		'oneline_form_settings'           => __( 'Tek Satır Ödeme Formu', 'gurmepos' ),
		'online_form_settings_subtitle'   => __( 'Tek satır kredi kartı formu.', 'gurmepos' ),
		'pay_credit_cart'                 => __( 'Kredi kartı ile ödeme', 'gurmepos' ),
		'save_settings'                   => __( 'Ayarları Kaydet', 'gurmepos' ),
		'connect_test'                    => __( 'Bağlantıyı Test Et', 'gurmepos' ),
		'delete_gateway'                  => __( 'Ödeme kuruluşunu kaldır', 'gurmepos' ),
		'test_mode_title'                 => __( 'Test Modu Aktif', 'gurmepos' ),
		'test_mode_content'               => __( 'Test modu aktif iken test APIleri ile çalışmanız gerekmektedir . ', 'gurmepos' ),
		'gateway_screen'                  => __( 'Sanal POS Ekranı', 'gurmepos' ),
		'supports_features'               => __( 'Desteklenen Özellikler', 'gurmepos' ),
		'supports_currency'               => __( 'Desteklenen Para Birimleri', 'gurmepos' ),
		'empty_gateway_title'             => __( 'Henüz bir pos aktif etmediniz', 'gurmepos' ),
		'empty_gateway_content'           => __( ' Hemen ödeme almaya başlamak için anlaşmalı olduğunuz ödeme kuruluşunun bağlantısını gerçekleştirin . ', 'gurmepos' ),
		'method_name'                     => __( 'Yöntem Adı', 'gurmepos' ),
		'pay_button_value'                => __( 'Ödeme Butonu Yazısı', 'gurmepos' ),
		'pay_to_status'                   => __( 'Başarılı Ödemelerin Geçeceği Durum', 'gurmepos' ),
		'pay_form_desc'                   => __( 'Ödeme Formunun Açıklama Alanı', 'gurmepos' ),
		'soon'                            => __( 'Yakında', 'gurmepos' ),

		'paratika'                        => array(
			'description' => __( 'Paratika Posunuzun entegre edilmesi için Kurum/Firma ID ve kullanıcı bilgileri gereklidir. Kurum/Firma ID bilgisine Paratika Pos Panelinde: Bilgilerim -> Temel Bilgiler adımlarını izleyerek ulaşabilirsiniz. Eğer daha önce kullanıcı oluşturmamış iseniz yine aynı panelde Kullanıcılar -> Kullanıcı Ekle adımlarını izleyerek kullanıcı oluşturmanız gereklidir. ', 'gurmepos' ),
		),
		'ozan'                            => array(
			'description' => __( 'Ozan Sanal Pos entegrasyonu için gerekli olan bilgiler Ozan Sanal Pos Ekranından temin edilecektir. ', 'gurmepos' ),
		),
		'sipay'                           => array(
			'description' => __( 'Sipay Sanal Posunuzun entegre edilmesi için gerekli api bilgilerini:  Sipay Sanal Pos Paneline giriş sağlayıp Ayarlar -> Entegrasyon & API sayfasından elde edebilirsiniz. ', 'gurmepos' ),
		),
		'iyzico'                          => array(
			'description' => __( 'Iyzico entegrasyonu için api ve güvenlik anahtarı bilgileri gereklidir. Iyzico merchant panelinizin Ayarlar->Firma Ayarları kısmından api ve güvenlik anahtarlarınıza erişebilirsiniz. ', 'gurmepos' ),
		),
		'esnekpos'                        => array(
			'description' => __( 'Esnekpos entegrasyonu için gerekli olan bilgiler Esnekpos kullanıcı panelinden temin edilecektir. ', 'gurmepos' ),
		),
		'param'                           => array(
			'description' => __( 'Param POS  entegrasyonu içi Param API bilgileri gereklidir. Bu bilgilere erişmek için Param internet şubesi girişi yapıp, ParamPos Menüsü altında "Entegrasyon Bilgilerim" sekmesine tıkladıktan sonra  açılan sayfadan  gerekli bilgilere ulaşabilirsiniz. ', 'gurmepos' ),
		),
		'paytr'                           => array(
			'description' => __( 'PayTR entegrasyonu için API Entegrasyon Bilgileri gereklidir. Bu bilgiler : PayTR kullanıcı panelinin :  Bilgi menüsü ->  API Entergrasyon Bilgileri başlığı altında yer almaktadır.', 'gurmepos' ),
		),
		'akbank'                          => array(
			'description' => __( 'Akbank Sanal Pos entegrasyonu için gerekli olan bilgiler Akbank Sanal Pos Ekranından temin edilecektir.', 'gurmepos' ),
		),
		'craftgate'                       => array(
			'description' => __( 'Craftgate entegrasyonu için API Entegrasyon Bilgileri gereklidir. Bu bilgiler : Craftgate kontrol panelinin :  Yönetim Menüsü ->Üye İşyeri Ayarları Sekmesi ->  API Erişim Bilgileri başlığı altında yer almaktadır.', 'gurmepos' ),
		),
		'denizbank'                       => array(
			'description' => __( 'Denizbank Sanal Pos panelinize giriş yaptıktan sonra entegrasyon bilgileri için, eğer daha önce oluşturmadıysanız yeni bir api kullanıcısı oluşturmanız gereklidir. Giriş yaptıktan sonra sol tarafta bulunan Kullanıcı Yönetim Sistemi menüsünden Kullanıcı düzenleme ve yetkilendirme sayfasına giriş yaparak api kullanıcı kaydı oluşturabilirsiniz. Oluşturduğunuz APİ kullanıcı bilgilerini, ilgili yerlere doldurarak entegrasyonu sağlayabilirsiniz.', 'gurmepos' ),
		),
		'finansbank'                      => array(
			'description' => __( 'Finansbank panelinize giriş yaptıktan sonra entegrasyon bilgileri için: eğer daha önce oluşturmadıysanız Yönetim Menüsünden Kullanıcı Yönetimi yardımı ile APİ kullanıcısı oluşturunuz. Oluşturduğunuz APİ kullanıcı bilgilerini POS Entegratör’de ilgili yerlere doldurunuz. ', 'gurmepos' ),
		),
		'garanti'                         => array(
			'description' => __( 'Garanti Pos entegrasyonu için gerekli olan bilgileri Garanti Sanal Pos Ekranından temin ediniz. ', 'gurmepos' ),
		),
		'halkbank'                        => array(
			'description' => __( 'Halkbank panelinize giriş yaptıktan sonra yönetim menüsüne tıklayınız .Eğer daha önce kullanıcı oluşturulmamış ise Kullanıcı listesi bölümünden "APİ KULLANICISI" oluşturuyoruz. Gerekli bilgileri sol taraftaki menülerden alıp POS Entegratör’de ilgili yerlere dolduruyoruz.', 'gurmepos' ),
		),
		'ingbank'                         => array(
			'description' => __( 'ING Bank Pos entegrasyonu için gerekli olan bilgiler ING Bank Sanal Pos Ekranından temin edilecektir.', 'gurmepos' ),
		),
		'isbank'                          => array(
			'description' => __( 'İş bankası sanal pos sistemine giriş yapıldıktan sonra eğer daha önceden APİ kullanıcısı oluşturulmamış ise öncelikle “Yönetim” başlığı altından “Yeni Kullanıcı Ekle”  kısmına giriş yapılarak APİ kullanıcısı oluşturulmalıdır. Daha sonra  APİ kullanıcı bilgileri ilgili yerlere doldurulmalı. ', 'gurmepos' ),
		),
		'kuveyt-turk'                     => array(
			'description' => __( 'Kuveyt Türk Pos entegrasyonu için gerekli olan bilgiler Kuveyt Türk  Sanal Pos Ekranından temin edilecektir.', 'gurmepos' ),
		),
		'teb'                             => array(
			'description' => __( 'TEB bankası sanal pos panelinize giriş yaptıktan sonra yönetim menüsüne tıklıyoruz .Eğer daha önce kullanıcı oluşturulmamış ise Kullanıcı listesi bölümünden "APİ KULLANICISI" oluşturuyoruz. Gerekli bilgileri POS Entegratör’de ilgili yerlere dolduruyoruz. ', 'gurmepos' ),
		),
		'vakifbank'                       => array(
			'description' => __( 'Vakıfbankın panelinden "YÖNETİM" sekmesi altında bulunan "ÜYE İŞYERİ İŞLEMLERİ" bölümünü tıklıyoruz. Açılan sayfada firmamız için gerekli bilgiler bulunmakta. Bu bilgileri POS Entegratör’de ilgili yerlere dolduruyoruz. ', 'gurmepos' ),
		),
		'yapi-kredi'                      => array(
			'description' => __( 'Yapıkredi Sanal Pos entegrasyonu için gerekli olan bilgiler Yapıkredi Sanal Pos Ekranından temin edilecektir.', 'gurmepos' ),
		),
		'ziraat'                          => array(
			'description' => __( 'Ziraat Bankası Sanal Pos paneline giriş yapıldıktan sonra eğer daha önceden api kullanıcısı oluşturmadıysanız ilk önce “Yönetim” sekmesine basıyoruz, “Yeni Kullanıcı Ekle ” alanından "Rol" APİ Kullanıcısı seçilerek yeni kullanıcı tanımı yapıyoruz. Daha sonra  bu alanda tanımlamış olduğunuz "Kullanıcı Adı" ve "Şifre" bilgilerini POS Entegratör’de ilgili alanlara dolduruyoruz.', 'gurmepos' ),
		),
	),
);
