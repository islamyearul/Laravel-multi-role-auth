  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

  <script src="{{ asset('lib/chart/chart.min.js') }}"></script>
  <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
  <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
  <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('lib/tempusdominus/js/moment.min.js') }}"></script>
  <script src="{{ asset('lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
  <script src="{{ asset('lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

  <!-- Template Javascript -->
  <script src="{{ asset('js/main.js') }}"></script>

  {{-- delete confirm --}}
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  {{-- Sweet Alert  --}}
  <script type="text/javascript">
 
    $('.show_confirm').click(function(event) {
         var form =  $(this).closest("form");
         var name = $(this).data("name");
         event.preventDefault();
         swal({
             title: `Are you sure you want to delete this record?`,
             text: "If you delete this, it will be gone forever.",
             icon: "warning",
             buttons: true,
             dangerMode: true,
         })
         .then((willDelete) => {
           if (willDelete) {
             form.submit();
           }
         });
     });
 
</script>
  <!-- This script for delete confirm item -->

  {{-- Toastr Message --}}
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script>
      @if (Session::has('message'))
          var type = ("{{ Session::get('type') }}");
          var message = ("{{ Session::get('message') }}");
          switch (type) {
          case 'success':
          toastr.success(message);
          break;
          case 'warning':
          toastr.warning(message);
          break;
          case 'error':
          toastr.error(message);
          break;
          case 'info':
          toastr.info(message);
          break;
          }
      @endif
  </script> --}}

  {{-- Select 2 --}}
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
      $(document).ready(function() {
       $('.select2').select2();
      });
  </script>


  @livewireScripts
