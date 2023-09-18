let appCreated = false;

const gposCreateApp = () => {
  if (false === appCreated) {
    window.gposCreateCheckoutApplication();
    appCreated = true;
  }
};

if (window.wc_checkout_params.is_checkout === "1") {
  jQuery(document.body).on("updated_checkout", gposCreateApp);
} else {
  jQuery(document).ready(gposCreateApp);
}


