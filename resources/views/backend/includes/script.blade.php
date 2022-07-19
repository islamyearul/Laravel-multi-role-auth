  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('lib/chart/chart.min.js')}}"></script>
  <script src="{{ asset('lib/easing/easing.min.js')}}"></script>
  <script src="{{ asset('lib/waypoints/waypoints.min.js')}}"></script>
  <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js')}}"></script>
  <script src="{{ asset('lib/tempusdominus/js/moment.min.js')}}"></script>
  <script src="{{ asset('lib/tempusdominus/js/moment-timezone.min.js')}}"></script>
  <script src="{{ asset('lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')}}"></script>

  <!-- Template Javascript -->
  <script src="{{ asset('js/main.js')}}"></script>
  {{-- data table --}}
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>

    <script>
      $('#exampledatatable').DataTable( {
    buttons: [
        'copy', 'excel', 'pdf'
    ]
} );
    </script>
  {{-- data table --}}
  @livewireScripts
