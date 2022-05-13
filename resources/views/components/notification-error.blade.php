@if(session("error_message"))
    <script>
        Swal.fire(
            {
                title: '😕',
                text : '{{session("error_message")}}',
                icon: 'warning',
                confirmButtonText: 'اوکی',
                confirmButtonColor: '#3085d6',
                timer: 4000
            });
    </script>
@endif
