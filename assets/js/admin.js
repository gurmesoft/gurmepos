jQuery(document).ready(($) => {
  $("a.gpos-target-blank").attr("target", "_blank");
  $(".gpos-hide-notice").on("click", () => {
    $.ajax({
      url: `${window.ajaxurl}?action=gpos_hide_notice`,
      data: {
        _wpnonce: $("#gpos-rating-notice #_wpnonce").val(),
      },
      success: () => {
        window.location.reload();
      },
    });
  });
});
