$(document).ready(function() {
   $(document).on('click', 'button.accept', function(e) {
      $button = $(this);
      $.post(
         "/includes/handler.Image.php",
         {
            mode: 'Update',
            params:
                  {
                     id: $button.attr('data-id'),
                     status: 1
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
   $(document).on('click', 'button.reject', function(e) {
      $button = $(this);
      $.post(
         "/includes/handler.Image.php",
         {
            mode: 'Update',
            params:
                  {
                     id: $button.attr('data-id'),
                     status: 2
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