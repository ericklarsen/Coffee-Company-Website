<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <title><?= $title; ?></title>
    <meta content="Dari kebaikan alam bumi Serambi Mekkah, kami sajikan kopi kualitas terbaik dari biji kopi pilihan ke dalam cangkir Anda." name="description" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="kopi, kopi gayo, gayo, aceh, robusta, serambi">
    <meta name="author" content="Kopi Mahal">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url() . 'assets_home/'; ?>css/bootstrap.min.css">

    <!-- ---- GLOBAL CSS ------ -->
    <link rel="stylesheet" href="<?= base_url() . 'assets_home/'; ?>css/custom.css">
    <link rel="stylesheet" href="<?= base_url() . 'assets_home/'; ?>css/custom-footer.css">
    <link rel="stylesheet" href="<?= base_url() . 'assets_home/'; ?>css/custom-nav.css">
    <link rel="stylesheet" href="<?= base_url() . 'assets_home/'; ?>css/custom-menu-kicker.css">


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Varela&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <?php
    $logo = $this->Md_logo->getDataById('1');
    ?>
    <link rel="icon" href="<?= base_url() . 'assets_upload/background/' . $logo->cover_logo; ?>" type="image/x-icon">
</head>


<body>
    <section class="navs">
        <div class="navs-header1">
            <div class="container" data-aos="fade" data-aos-duration="1000">
                <div class="">
                    <a href="mailto:biji@kopimahal.com">
                        <i class="fa fa-envelope-o" aria-hidden="true"></i> &nbspbiji@kopimahal.com
                    </a>
                </div>
                <div class="nav-header1-right">
                    <div id="google_translate_element"></div>
                    <a href="<?= base_url() . 'pesan-kopi' ?>">
                        Pesan Kopi!&nbsp <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="navs-header2">
            <div class="container">
                <div class="navs-item" data-aos="fade" data-aos-duration="1000">
                    <a href="<?= base_url() . 'toko' ?>">Etalase</a>
                    <a href="<?= base_url() . 'artikel' ?>">Artikel</a>
                    <a href="<?= base_url() . 'tentang-kami' ?>">tentang kami</a>
                </div>
                <a href="<?= base_url(); ?>" class="navs-item-logo"><img src="<?= base_url() . 'assets_upload/background/' . $logo->cover_logo; ?>" alt=""></a>
                <div class="navs-item" data-aos="fade" data-aos-duration="1000">
                    <a href="<?= base_url() . 'aktivitas' ?>">Aktivitas</a>
                    <a href="<?= base_url() . 'galeri' ?>">galeri</a>
                    <a href="<?= base_url() . 'kontak-kami' ?>">Kontak Kami</a>
                </div>
            </div>
        </div>

        <div class="try">
            <div class="navs-header3 navs-header-hidden">
                <img class="img" src="<?= base_url() . 'assets_upload/background/' . $logo->cover_logo; ?>" alt="" data-aos="fade-down" data-aos-duration="500">
                <div class="container">
                    <div class="menu-toggle">
                        <input type="checkbox">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="navs-header4">
            <ul>
                <li class="bg-red">
                    <a href="<?= base_url() . 'pesan-kopi' ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i> &nbspPesan kopi</a>
                </li>
                <li><a href="<?= base_url(); ?>">beranda</a></li>
                <li><a href="<?= base_url() . 'toko' ?>">toko</a></li>
                <li><a href="<?= base_url() . 'artikel' ?>">artikel</a></li>
                <li><a href="<?= base_url() . 'tentang-kami' ?>">tentang kami</a></li>
                <li><a href="<?= base_url() . 'aktivitas' ?>">Aktivitas</a></li>
                <li><a href="<?= base_url() . 'galeri' ?>">galeri</a></li>
                <li><a href="<?= base_url() . 'kontak-kami' ?>">Kontak Kami</a></li>
            </ul>
        </div>
    </section>