<!-- js -->

<script src="{{ url('vendors/scripts/core.js', []) }}"></script>
<script src="{{ url('vendors/scripts/script.min.js', []) }}"></script>
<script src="{{ url('vendors/scripts/process.js', []) }}"></script>
<script src="{{ url('vendors/scripts/layout-settings.js', []) }}"></script>
<script src="{{ url('vendors/sweetalert/sweetalert2.js', []) }}"></script>

<script>

    document.getElementById('myFormBerkas').addEventListener('submit', function(event) {
        var form = this;
        event.preventDefault(); // Mencegah form untuk langsung melakukan submit
        document.getElementById('loading').style.display = 'block'; // Menampilkan loader
        document.getElementById('myButton').disabled = true; // Menampilkan loader

        // Simulasikan proses pengiriman form selama 3 detik
        setTimeout(function() {
            // Setelah proses selesai, kirim form
            form.submit();
        }, 1000);
    });

</script>
