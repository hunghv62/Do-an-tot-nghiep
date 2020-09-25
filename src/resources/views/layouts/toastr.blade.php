<script>
    $(document).ready(function () {
        @if (session('success'))
        toastr.success('{{ session('success') }}');
        @endif

        @if (session('error'))
        toastr.error('{{ session('error') }}');
        @endif
    });

</script>
