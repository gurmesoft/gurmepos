let appCreated = false;
  jQuery(document.body).on("updated_checkout", function () {
    if (false === appCreated) {
      window.gposCreateCheckoutApplication();
      appCreated = true;
    }
  });