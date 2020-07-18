<footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; The Yummi Pizza {{ date('Y') }}</p>
    </div>

  </footer>

  @section('js')
  <script src="{{asset('/')}}vendor/jquery/jquery.min.js"></script>
  <script src="{{asset('/')}}vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  @show

</body>

</html>