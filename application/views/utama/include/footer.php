<section class="kicker">
    <div class="kicker-image">
        <img src="<?= base_url() . 'assets_upload/background/' . $background[0]['cover_background']; ?>" alt="">
    </div>
    <div class="kicker-letter" data-aos="zoom-in" data-aos-once="true">
        <h2>KONTAK KAMI</h2>
        <p>Berminat menjadi mitra, atau ada kendala dalam melakukan orderan, mohon diinformasikan bagaimana kami bisa membantu anda.</p>
        <a href="<?= base_url() . 'kontak-kami' ?>">Kirim Pesan</a>
    </div>
</section>

<div class="ft">
    <div class="ft-info">
        <div class="ft-nav">
            <div class="ft-nav-list">
                <h4>MAIN</h4>
                <!-- linknya -->
                <div class="ft-nav-item">
                    <div class="items">
                        <a href="<?= base_url(); ?>">Beranda</a>
                    </div>
                    <div class="items">
                        <a href="<?= base_url() . 'tentang-kami' ?>">Tentang Kami</a>
                    </div>
                    <div class="items">
                        <a href="<?= base_url() . 'toko' ?>">Toko</a>
                    </div>
                    <div class="items">
                        <a href="<?= base_url() . 'galeri' ?>">Galeri</a>
                    </div>
                    <div class="items">
                        <a href="<?= base_url() . 'kontak-kami' ?>">Kontak Kami</a>
                    </div>
                    <div class="items">
                        <a href="<?= base_url() . 'aktivitas' ?>">Aktivitas</a>
                    </div>
                </div>
            </div>

            <div class="ft-nav-list">
                <h4>SOSIAL MEDIA</h4>
                <!-- linknya -->
                <div class="ft-nav-item">
                    <div class="items">
                        <a href="<?php echo $sosmed[0]['link']?>"><i class="fa fa-instagram" aria-hidden="true"></i>&nbspInstagram</a>
                    </div>

                    <div class="items">
                        <a href="<?php echo $sosmed[1]['link']?>"><i class="fa fa-facebook" aria-hidden="true"></i>&nbspFacebook</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="ft-footer">
            <img src="<?= base_url() . 'assets_home/'; ?>img/logokopimahal-01.svg" alt="">
            <span><a href="<?= base_url(); ?>">Copyright &copy; 2020</a></span>
            <div class="sosmed">
                <a href="<?php echo $sosmed[0]['link']?>"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a href="<?php echo $sosmed[0]['link']?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>

    <div class="ft-message">
        <div class="ft-box">
            <h4>
                Etalase
            </h4>
            <p>
            Temukan berbagai promo menarik gratis ongkos kirim dengan berbelanja produk kami.
            </p>
            <a href="<?= base_url() . 'toko'; ?>">Lihat</a>
        </div>
    </div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!--  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="<?= base_url() . 'assets_home/'; ?>js/script.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script>
    function submitBtn(param1) {
        Swal.fire({
            title: '<h3>Apakah anda yakin?</h3>',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Pesan!',
            cancelButtonText: 'Cancel',
            showLoaderOnConfirm: true,
            closeOnConfirm: false,
            preConfirm: () => {
                return $.ajax({
                        method: 'POST',
                        url: '<?php echo base_url() . 'utama/' . $page_function . '/'; ?>' + param1,
                        data: $('#toko-form').serialize(),
                        dataType: 'json'
                    })
                    .then(response => {
                        console.log(response)
                        return response
                    })
                    .catch(error => {
                        swal.showValidationError(
                            `An error ocurred: ${error.status}`
                        )
                    })
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.value) {
                if (result.value.status == 'success') {
                    Swal.fire({
                        icon: result.value.status,
                        title: '<h3>' + result.value.title + '</h3>',
                        html: '<small>' + result.value.msg + '</small>',
                        confirmButtonText: 'OK',
                        showLoaderOnConfirm: true,
                        closeOnConfirm: false,
                    }).then((result2) => {
                        if (result2.value) {
                            window.location.reload();
                        }
                    })
                } else {
                    Swal.fire({
                        icon: result.value.status,
                        showConfirmButton: false,
                        title: '<h3>' + result.value.title + '</h3>',
                        html: '<small>' + result.value.msg + '</small>',
                    })
                }


            }
        })
    }
</script>

<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'id',
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE
        }, 'google_translate_element');
    }
</script>


<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script>
    $(document).ready(function() {
        $('#opsiPesanan').change(function() {
            var opsiPesanan = $('#opsiPesanan').val();
            if (opsiPesanan == 0) {
                document.getElementById("pesanSendiri").style.display = "flex";
                document.getElementById("opsiPesanan-form").style.display = "none";
            } else if (opsiPesanan == 1) {
                document.getElementById("pesanOrangLain").style.display = "flex";
                document.getElementById("opsiPesanan-form").style.display = "none";
            }
        });
    });

    $(document).ready(function() {
        $('#check-btn2').click(function() {
            var opsiPesanan = $('#opsiPesanan2').val();
            var volume_kopi = document.getElementById("volume_kopi").value;
            var biji_kopi = document.getElementById("biji_kopi").value;
            var penyajian_kopi = document.getElementById("penyajian_kopi").value;
            var brewing_method = document.getElementById("brewing_method").value;
            var roasted_level = document.getElementById("roasted_level").value;

            if (volume_kopi === "" || biji_kopi === "" || penyajian_kopi === "" || brewing_method === "" || roasted_level === "" || opsiPesanan === "none") {
                Swal.fire({
                    icon: 'error',
                    title: '<h3>Gagal</h3>',
                    html: '<small> Harap melengkapi seluruh form data! </small>',
                })
            } else {
                if (opsiPesanan == 0) {
                    document.getElementById("pesanSendiri-sm").style.display = "flex";
                    document.getElementById("opsiPesanan-form2").style.display = "none";
                    document.querySelector(".form-button-small").style.display = "none";
                } else if (opsiPesanan == 1) {
                    document.getElementById("pesanOrangLain-sm").style.display = "flex";
                    document.getElementById("opsiPesanan-form2").style.display = "none";
                    document.querySelector(".form-button-small").style.display = "none";
                }
            }

        });
    });

    $(document).ready(function() {
        $('#check-btn-toko').click(function() {
            var opsiPesanan = $('#opsiPesanan2').val();
            var jumlah = document.getElementById("jumlah").value;

            if (jumlah === "" || opsiPesanan === "none") {
                Swal.fire({
                    icon: 'error',
                    title: '<h3>Gagal</h3>',
                    html: '<small> Harap melengkapi seluruh form data! </small>',
                })
            } else {
                if (opsiPesanan == 0) {
                    document.getElementById("pesanSendiri-sm").style.display = "flex";
                    document.getElementById("opsiPesanan-form2").style.display = "none";
                    document.querySelector(".form-button-small").style.display = "none";
                } else if (opsiPesanan == 1) {
                    document.getElementById("pesanOrangLain-sm").style.display = "flex";
                    document.getElementById("opsiPesanan-form2").style.display = "none";
                    document.querySelector(".form-button-small").style.display = "none";
                }
            }

        });
    });

    $(document).ready(function() {
        $('#brewing_method').change(function() {
            var brewing = $('#brewing_method').val();
            fetch("<?= base_url() . 'utama/brewingKopi/'; ?>" + brewing, {
                    method: 'GET',
                })
                .then((response) => response.text())
                .then((data) => {
                    document.getElementById('brewing-note').innerHTML = data
                    document.getElementById("name_brewing_method").value = $('#brewing_method option:selected').text()
                })
        });
    });

    $(document).ready(function() {
        $('#penyajian_kopi').change(function() {
            var penyajian = $('#penyajian_kopi').val();
            fetch("<?= base_url() . 'utama/penyajianKopi/'; ?>" + penyajian, {
                    method: 'GET',
                })
                .then((response) => response.text())
                .then((data) => {
                    document.getElementById('penyajian-note').innerHTML = data
                    document.getElementById("name_penyajian_kopi").value = $('#penyajian_kopi option:selected').text()
                })
        });
    });

    $(document).ready(function() {
        $('#biji_kopi').change(function() {
            var biji = $('#biji_kopi').val();
            fetch("<?= base_url() . 'utama/bijiKopi/'; ?>" + biji, {
                    method: 'GET',
                })
                .then((response) => response.text())
                .then((data) => {
                    document.getElementById('biji-note').innerHTML = data
                    document.getElementById("name_biji_kopi").value = $('#biji_kopi option:selected').text()
                })
        });
    });

    $(document).ready(function() {
        $('#roasted_level').change(function() {
            var biji = $('#roasted_level').val();
            document.getElementById("name_roasted_level").value = $('#roasted_level option:selected').text()
        });
    });

    $(document).ready(function() {
        $('#filter').change(function() {
            var filter = $('#filter').val();
            var id_itemKind = $("#filter option:selected").text();
            window.location.href = "<?= base_url() . 'toko/filter/'; ?>" + filter;
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#roasted_level').change(function() {
            var roasted_level = $('#roasted_level').val();
            // var nama_barang = $("#kode_barang option:selected").text();
            if (roasted_level == 'Tidak, Saya Punya Permintaan Khusus') {
                $("#roasted_level-note").append("<div class='form-long'>" +
                    "<label for=''><small><i>*Note : Permintaan Khusus</i></small></label>" +
                    "<textarea name='roasted_level_note' class='form-control'></textarea>" +
                    "</div>");
            } else {
                $("#roasted_level-note").html("");
            }
        });
    });
</script>
<script>
    AOS.init();
</script>
</body>

</html>