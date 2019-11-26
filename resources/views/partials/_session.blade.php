@if (session()->has('success'))
    <script>
        Swal.fire({
            text: '{{session('success')}}',
            timer: 2500,
            icon:"success",
            showCancelButton: false,
            showConfirmButton: false
        });
    </script>
@endif

