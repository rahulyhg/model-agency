jQuery(document).ready(function(e) {
  $('.b-alert__close').click(function(e) {
    $(this).closest('.b-alert').animate({ paddingTop: 0, paddingBottom: 0, height: 0, opacity: 0 }, 200, 'swing', function() {
      $(this).remove();
    });
  });
});