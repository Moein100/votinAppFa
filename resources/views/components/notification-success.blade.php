
@if(session("success_message"))
<script>
    Swal.fire(
        {
         title: '😄',
         text : '{{session('success_message')}}',
         icon: 'success',
         confirmButtonText: 'Save',
         timer: 4000
        });
</script>
@endif


