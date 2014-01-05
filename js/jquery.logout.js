$(function() {
   $('header nav.right #logout a').click(function() {
      $.post("/includes/logout.php", {},
         function(data) {
            location.reload(true);
         });

      return false;
   });
});