function gpos_test(element) {
  const $testButton = jQuery(element);
  jQuery("#gpos-card-bin").val($testButton.data("bin"));
  jQuery("#gpos-card-cvv").val($testButton.data("cvv"));
  jQuery("#gpos-card-expiry-month").val($testButton.data("expiry_month"));
  jQuery("#gpos-card-expiry-year").val($testButton.data("expiry_year"));
}
