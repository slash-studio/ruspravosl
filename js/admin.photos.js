$(document).ready(function() {
   $(document).on('click', 'button.edit_status', function(e) {
      $button = $(this);
      $.post(
         "/includes/handler.Image.php",
         {
            mode: 'Update',
            params:
                  {
                     id: $button.attr('data-id'),
                     status: $button.attr('data-value')
                  }
         },
         function(data) {
            if (data.result) {
               location.reload();
            } else {
               alert(data.message);
            }
         },
         "json"
      );
   });
   $(document).on('click', 'button.delete', function(e) {
      $button = $(this);
      $.post(
         "/includes/handler.Image.php",
         {
            mode: 'Delete',
            params:
                  {
                     id: $button.attr('data-id')
                  }
         },
         function(data) {
            if (data.result) {
               location.reload();
            } else {
               alert(data.message);
            }
         },
         "json"
      );
   });
});