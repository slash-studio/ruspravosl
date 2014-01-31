var editType = 'Update';
var $cur_a = null;

function toogleCurCat(value) {
   if ($cur_a != null) {
      $cur_a.css('font-weight', value);
   }
};

$(document).ready(function() {
   $('#category_tree').bind("select_node.jstree", function(e, data) {
      $(this).jstree("toggle_node", data.rslt.obj);
      $(this).jstree("deselect_node", data.rslt.obj);
   })
   .jstree({
      "core" : {
         "animation" : 200
      },
      "themes" : {
         "theme" : "apple",
         "icons" : false
      },
      "plugins" : ["themes", "html_data"]
   });

   $('#edit-box #in_add').change(function() {
      toogleCurCat('normal');
      var $box = $('#edit-box');
      $box.find('#category_id option[value="-1"]').prop("selected", "selected");
      $box.find('#category_id option').prop('disabled', false);
      $box.find('button[value="Delete"]').css('display', 'none');
      $box.find('button[value="Update"]').prop('value', 'Insert').text('Добавить');
      $box.find('#in_change').prop('disabled', true);
      $box.find('input#category_name_ru').val('');
      $box.find('input#category_name_en').val('');
      $box.find('input#category_weight').val('0');
   });

   $('#edit-box #in_change').change(function() {
      var $box = $('#edit-box');
      $('#edit-box').find('button[value="Delete"]').css('display', 'inline-block');
      $box.find('button[value="Insert"]').prop('value', 'Update').text('Сохранить');
   });
});

function toggleOption(newId, parentId) {
   $('#category_id option').prop('disabled', false);
   var $box = $('#category_id');
   $box.children('option[value="'+newId+'"]').prop('disabled', true);
   $box.children('option[value="'+parentId+'"]').prop("selected", "selected");
   $('#category_tree a[data-id='+newId+']').parent('li').find('a').each(function(idx, el) {
      var id = $(this).attr('data-id');
      $('#category_id option[value="'+id+'"]').prop('disabled', true);
   });
}

$(document).on('click', '#category_tree a', function(e) {
   if ($(this).css('font-weight') == 700) {
      $("#category_tree").jstree("toggle_node", $(this));
   } else {
      $("#category_tree").jstree("open_node", $(this));
   }
   toogleCurCat('normal');
   $cur_a = $(this);
   toogleCurCat('bold');
   toggleOption();
   var $editBox = $('#edit-box');
   $editBox.find('form legend').text('Редактирование');
   $editBox.find('#in_change').removeProp('disabled');
   $editBox.find('#in_add').removeProp('checked');
   $editBox.find('#in_change').prop('checked', 'checked');
   $editBox.find('#in_id').css('display', 'block');
   var id = $(this).attr('data-id');
   var p_id = $(this).attr('data-parent-id');
   p_id = p_id != id ? p_id : -1;
   toggleOption(id, p_id);
   $('#category_name').val($(this).attr('data-name'));
   $('#id').val(id);
   $('#edit-box').find('button[value="Insert"]').text('Сохранить');
   $('#edit-box').find('button[value="Insert"]').prop('value', 'Update');
   $('#edit-box').find('button[value="Delete"]').css('display', 'inline-block');
   e.stopPropagation();
});

$(document).on('click', '#edit-box button', function(e) {
   editType = $(this).val();
});

$(document).on('submit', 'form.edit-form', function() {
   var treeOpen = [];
   $('#category_tree .jstree-open').each(function (i, v) {
      treeOpen.push($(this).attr('data-id'));
   });
   $this = $(this);
   var aid = $this.find('input[name="id"]').val();
   var pid = $this.find('#category_id option:selected').val();
   pid = editType != 'Insert' && pid == -1 ? aid : pid;
   var aname = $.trim($('#category_name').val());
   // alert(aname);
   // alert(editType);
   // alert(aid);
   // alert(pid);
   $.post(
         "/includes/handler.Category.php",
         {
            mode : editType,
            params :
                   {
                      id : aid,
                      parent_id : pid,
                      name : aname
                   }
         },
         function(data) {
            if (data.result) {
               var jtree = $.jstree._reference('#category_tree');
               jtree.destroy();
               $('#category_tree').html(data.table);
               $('#category_id').html(data.selects)
               $('#category_tree')
                  .on('loaded.jstree', function() {
                     var length = treeOpen.length;
                     for (var i = 0; i < length; i++) {
                        $("#category_tree").jstree("open_node","a[data-id="+treeOpen[i]+"]", false, true);
                     }
                     // $("#category_tree").jstree("open_node","a[data-id="+pid+"]");
                  })
                  .jstree({
                     "core" : {
                       "animation" : 200
                     },
                     "themes" : {
                       "theme" : "apple",
                       "icons" : false
                     },
                     "plugins" : ["themes", "html_data"]
                  });
                if (data.opt_param) {
                    alert(data.opt_message);
                }
               // alert('Успешно!');
            } else {
               alert(data.message);
            }
         }, "json"
      );
   return false;
});