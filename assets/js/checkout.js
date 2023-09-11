if (window.gpos.plugin === "woocommerce") {
  let appCreated = false;
  jQuery(document.body).on("updated_checkout", function () {
    if (false === appCreated) {
      window.gposCreateCheckoutApplication();
      appCreated = true;
    }
  });
} else if (window.gpos.plugin === "givewp") {
  jQuery(document).ready(() => {
    window.gposCreateCheckoutApplication();
  });
}
