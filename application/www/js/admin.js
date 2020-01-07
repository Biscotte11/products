'use strict';

$('.userRole').on('change', function(event) {
  let id = $(this).data('id');
  let value = $(this).val();
  let result = { id: id, value: value};

  $.post
  (
    getRequestUrl() + '/admin/role',
    result,
    function(res) {
      console.log(res);
    }
  );

});
