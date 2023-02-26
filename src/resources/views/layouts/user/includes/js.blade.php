
  <script src="{{asset('assets/backend-assets/js/fontAwesome.js') }}"></script>
  <script src="{{asset('assets/backend-assets/js/sweetAlert2.js') }}"></script>
  <script src="{{asset('assets/backend-assets/js/jQuery.min.js') }}"></script>

  <script src="{{asset('assets/backend-assets/js/bootstrap.bundle.min.js') }}"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/fixedheader/3.2.4/js/dataTables.fixedHeader.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>

  <script src="{{asset('assets/backend-assets/js/script.js') }}"></script>



 @include('alert.alert')
 @stack('backend-js-include')
 @stack('backend-js-push')
