var swalInit = swal.mixin({
   buttonsStyling: false,
   customClass: {
      confirmButton: 'btn btn-primary',
      cancelButton: 'btn btn-light',
      denyButton: 'btn btn-light',
      input: 'form-control'
   }
});

$(function() {
   $('.sidebar-control').click();
});

function preloader(selector, type) {
   $(selector).prelodr({
      prefixClass: 'prelodr',
      show: null,
      hide: null
   });

   if(type == true) {
      $(selector).prelodr('in', 'Please Wait ...');
   } else {
      $(selector).prelodr('out');
   }
}