$(document).ready(function(e) {
  if(!LIKE_WIDGET_CONFIG) {
    console.error('LIKE_WIDGET_CONFIG is not defined!')
  }
  var likeBlocks = $('[data-like-entity-id]')
  if(likeBlocks.length > 0) {
    likeBlocks.click(function(e) {
      var that = this
      $(this).attr('disabled', true)
      if($(this).attr('disabled') === 'disabled') {
        $.ajax({
          method: 'POST',
          url: LIKE_WIDGET_CONFIG.url,
          data: {
            entityId: $(this).data('like-entity-id')
          },
          success: function(response) {
            if(response.status === 'success') {
              $(that).find('[data-like-source]').html(response.count)
              $(that).data('like-count', response.count)
              $(that).attr('disabled', false)
            }
            if(response.status === 'error') {
              alert(response.message)
            }
          }// end success function
        })// end ajax
      }// endif
    })// end click handler
  }// endif
})// end ready handler