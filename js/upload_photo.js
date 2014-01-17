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
				if (!(ext && /^(jpg|png|jpeg|gif)$/.test(ext))) {
					// extension is not allowed
					alert('This extension is not allowed. Only JPG, PNG or GIF');
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
						  $array[$btn].siblings('ul').append('<li><a href="#" class="block"><img src="/includes/uploads/' + file_name + '_s.jpg" /></a><button class="x" data="' + file_name + '">x</button><a href="#" class="likes"></a></li>');
					   }
					);
				} else {
					alert('File cannot be download ' + file);
				}
			}
	    });
    });
});