(function ($, window) {
  // Test kredi kartlarını otomatik alanlara doldurmak için kullanılır.
  window.gpos_test = (element) => {
    const $testButton = $(element);
    $("#gpos-card-bin").val($testButton.data("bin")).trigger("input");
    $("#gpos-card-cvv").val($testButton.data("cvv"));
    $("#gpos-card-expiry-month").val($testButton.data("expiry_month"));
    $("#gpos-card-expiry-year").val($testButton.data("expiry_year"));
  };

  // Kredi kartı alanına girilen kart bilgisini bulur
  let currentEight = "";
  window.gpos_bin_input = async (field) => {
    const bin = $(field).val();
    const firstEight = await bin.replaceAll(/\s/g, "").slice(0, 8);

    if (firstEight.length === 8 && firstEight !== currentEight) {
      currentEight = firstEight;
      $.ajax({
        url: `${window.gpos.ajaxurl}?action=gpos_check_bin&_wpnonce=${$(
          "#gpos_check_bin"
        ).val()}`,

        type: "POST",
        dataType: "json",
        contentType: "application/json",
        accept: "application/json",
        data: JSON.stringify({
          bin: currentEight,
        }),
        beforeSend: () => {
          $("#place_order").prop("disabled", true);
          $(".gpos-loading").css("display", "flex");
        },
        success: (response) => {
          if (response.success) {

            // Taksitleri görüntüle
            response.data.type === "credit"
              ? $(".gpos-installment-container").show()
              : $(".gpos-installment-container").hide();

            // Kart ikonunu değiştir
            let cardSrc = `${window.gpos.assetsurl}/images/mini-card/card.svg`;
            cardSrc = ["visa", "mastercard"].includes(response.data?.scheme)
              ? `${window.gpos.assetsurl}/images/mini-card/${response.data.scheme}.svg`
              : cardSrc;
            $("#gpos-mini-card").attr('src',cardSrc);

            //Hidden verileri doldurma
            $("#gpos-card-type").val(response.data?.type);
            $("#gpos-card-brand").val(response.data?.scheme);
            $("#gpos-card-family").val(response.data?.family);
            $("#gpos-card-bank-name").val(response.data?.bank?.name);
            $("#gpos-card-country").val(response.data?.country?.name);
          }
          $("#place_order").prop("disabled", false);
          $(".gpos-loading").css("display", "none");
        },
        error: () => {
          $("#place_order").prop("disabled", false);
          $(".gpos-loading").css("display", "none");
        },
      });
    }
  };
})(jQuery, window);
