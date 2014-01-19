$(function(){
   $array = [];
    $('.upload').each(function() {
      $btnUpload = $(this);
      $data = $btnUpload.attr('data').split(',');
      $array[$data[1]] = $(this);
      new AjaxUpload($btnUpload, {
         action: '/includes/uploadimage.php',
         name: 'uploadimage',
         data:
            {
               user_id: $data[0],
               category_id: $data[1]
            },
         onSubmit: function(file, ext){
            if (!(ext && /^(jpg|jpeg)$/.test(ext))) {
               // extension is not allowed
               alert('This extension is not allowed. Only JPG.');
               return false;
            }
         },
         onComplete: function(file, response) {
            //Add uploaded file to list
            $btn = this._settings.data.category_id;
            if(response != "error") {
               file_name = response;
               $.post(
                  "/includes/rename.php",
                  {
                    name: file_name
                  },
                  function(data){
                    $array[$btn].siblings('ul').append('<li><a href="#" class="block not_checked" title="Ваша работа не проверена"><img src="/includes/uploads/' + file_name + '_s.jpg" /></a><button class="x" data="' + file_name + '">x</button><a href="#" class="likes"></a></li>');
                  }
               );
            } else {
               alert('File cannot be download ' + file);
            }
         }
       });
    });

   $(document).on('click', '.imgs ul li button', function(){
      
	  $button = $(this);
	  
      $.post(
         "/includes/handler.Image.php",
         {
            type: 'Image',
            mode: 'Delete',
            params:
                  {
                     images_id: $button.attr('data')
                  }
         },
         function(data) {
            if (data.result) {
               $button.parent().empty().remove();
            } else {
               alert(data.message);
            }
         }, "json"
      );
   });
});