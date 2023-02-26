
@if ($errors->any())
    @foreach($errors->all() as $message)
        <script>
            "use strict";
            toast.fire({
            icon: 'error',
            title: "{{$message}}"
          })
        </script>
    @endforeach
@endif

@if (Session::has('success'))
    <script>
        "use strict";
        toast.fire({
            icon: 'success',
            title: "{{Session::get('success')}}"
          })
    </script>
@endif

@if (Session::has('error'))
    <script>
        "use strict";
          toast.fire({
            icon: 'error',
            title: "{{Session::get('error')}}"
          })
    </script>
@endif
