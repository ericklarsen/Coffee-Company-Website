</div>

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>copyright &copy; <script>
                    document.write(new Date().getFullYear());
                </script>
            </span>
        </div>
    </div>
</footer>
<!-- Footer -->
</div>
</div>

<!-- Scroll to top -->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<script src="<?php echo base_url() . 'assets/'; ?>vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() . 'assets/'; ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url() . 'assets/'; ?>vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="<?php echo base_url() . 'assets/'; ?>js/ruang-admin.min.js"></script>
<!-- Page level plugins -->
<script src="<?php echo base_url() . 'assets/'; ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() . 'assets/'; ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script>

    function delete_function(param1){
        var result = confirm('Yakin Delete?');
        if(result){
            window.location = '<?= base_url();?>'+param1
        }
    }
    function proses() {
        var kota = $('#kota').val();
        var kota_penerima = $('#kota_penerima').val();
        var berat = $('#berat').val();
        var ekspedisi = $('#ekspedisi').val();

        fetch("<?= base_url() . 'staff/cost/'; ?>" + kota + "/" + kota_penerima + "/" + berat + "/" + ekspedisi, {
                method: 'GET',
            })
            .then((response) => response.text())
            .then((data) => {
                console.log(data)
                document.getElementById('data-ekspedisi').innerHTML = data
            })
    }
</script>

<script>
    document.getElementById('provinsi').addEventListener('change', function() {
        fetch("<?= base_url() . 'staff/kota/'; ?>" + this.value, {
                method: 'GET',
            })
            .then((response) => response.text())
            .then((data) => {
                console.log(data)
                document.getElementById('kota').innerHTML = data
            })
    })

    document.getElementById('provinsi_penerima').addEventListener('change', function() {
        fetch("<?= base_url() . 'staff/kota/'; ?>" + this.value, {
                method: 'GET',
            })
            .then((response) => response.text())
            .then((data) => {
                console.log(data)
                document.getElementById('kota_penerima').innerHTML = data
            })
    })
</script>


<script>
    $(document).ready(function() {
        $('#penyajian_kopi').change(function() {
            var penyajian = $('#penyajian_kopi').val();
            // var nama_barang = $("#kode_barang option:selected").text();
            if (penyajian == 'Green Bean Coffee') {
                $("#penyajian-note").append("<div class='form-group'>" +
                    "<small><i>*Note : Anda memilih Green Bean Coffee. Khusus pemesanan green bean atau biji kopi yang masih hijau akan ada biaya karantina jika pengiriman melalui udara*</i></small>" +
                    "</div>");
            } else {
                $("#penyajian-note").html("");
            }
        });
    });

    $(document).ready(function() {
        $('#roasted_level').change(function() {
            var roasted_level = $('#roasted_level').val();
            // var nama_barang = $("#kode_barang option:selected").text();
            if (roasted_level == 'Tidak, Saya Punya Permintaan Khusus') {
                $("#roasted_level-note").append("<div class='form-group'>" +
                    "<label for=''><small><i>*Note : Permintaan Khusus</i></small></label>" +
                    "<textarea name='roasted_level_note' class='form-control'></textarea>" +
                    "</div>");
            } else {
                $("#penyajian-note").html("");
            }
        });
    });
</script>


<script>
    var loadFile = function(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('output');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    };

    var rupiah1 = document.getElementById('rupiah1');
    rupiah1.addEventListener('keyup', function(e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah1.value = formatRupiah(this.value, 'Rp. ');
    });

    var rupiah2 = document.getElementById('rupiah2');
    rupiah2.addEventListener('keyup', function(e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah2.value = formatRupiah(this.value, 'Rp. ');
    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>


</body>

</html>