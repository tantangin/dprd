<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= @$page['title']; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?= $thema_folder; ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="<?= $thema_folder; ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="<?= $thema_folder; ?>assets/css/agency.min.css" rel="stylesheet">
    <link href="<?= $thema_folder; ?>assets/css/style.css" rel="stylesheet">

</head>

<body id="page-top">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="<?= base_url() ?>#page-top"><?= $this->setting->site_name ?></a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase mr-auto mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="<?= base_url() ?>#panduan">Panduan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="<?= base_url() ?>#about">About</a>
                    </li>
                    <form class="form-inline my-2 my-lg-0" action="<?= base_url('aspirasi/search') ?>" method="post">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search Inspirasi">
                        <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">Search</button>
                    </form>

                </ul>
                <div class="navbar-nav">
                    <?php if (!$this->session->userdata('masyarakat_login')) : ?>
                        <div class="my-auto mr-md-2">
                            <a class="nav-link btn btn-outline-warning btn-sm" href="<?= base_url('admin/auth') ?>">Login</a>
                        </div>
                        <div class="my-auto">
                            <a class="nav-link btn btn-danger btn-sm mx-auto text-light" href="<?= base_url('admin/auth/registration/masyarakat') ?>">Register</a>
                        </div>
                    <?php else : ?>
                        <div class="nav-item">
                            <a class="mt-2 mr-md-2 btn btn-outline-warning waves-effect waves" href="#">
                                <span class="badge badge-danger ml-2">4</span>
                                <i class="fas fa-bell"></i>
                            </a>
                        </div>
                        <div class="nav-item dropdown">
                            <a class="dropdown-toggle btn btn-primary text-left d-block mt-2" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Irsan Mansyur
                            </a>
                            <div class="dropdown-menu mt-2" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="<?= base_url('user') ?>">Profile</a>
                                <a class="dropdown-item" href="<?= base_url('user/profile') ?>">Change Profile</a>
                                <a class="dropdown-item" href="<?= base_url('user/change_password') ?>">Change Password</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" data-toggle="modal" data-target=".modal#logout" href="#">Logout</a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </nav>
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-caption">
                        <h1 class="page-title"><?= $page['title']; ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="card-section">
        <div class="container">
            <div class="rounded bg-white px-3 shadow-lg">
                <div class="row">
                    <div class="col-md-6 mr-auto ml-auto">
                        <div class="profile">
                            <div class="avatar">
                                <img src="https://www.biography.com/.image/ar_1:1%2Cc_fill%2Ccs_srgb%2Cg_face%2Cq_auto:good%2Cw_300/MTU0NjQzOTk4OTQ4OTkyMzQy/ansel-elgort-poses-for-a-portrait-during-the-baby-driver-premiere-2017-sxsw-conference-and-festivals-on-march-11-2017-in-austin-texas-photo-by-matt-winkelmeyer_getty-imagesfor-sxsw-square.jpg" alt="Circle Image" class="img-raised rounded-circle img-fluid">
                            </div>
                            <div class="name">
                                <h3 class="title">Christian Louboutin</h3>
                                <h6>Designer</h6>
                                <span class="join-in text-italic">2018-08-25</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="section-title">
                            <h2 class="">Daftar Aspirasi</h2>
                            <ul class="nav aspirasi-type nav-pills border-bottom">
                                <li class="nav-item">
                                    <a class="nav-link text-dark <?= is_active("user") ?>" href="#">Semua</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark <?= is_active("user", "ditanggapi") ?>" href="#">Ditanggapi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark <?= is_active("user", "read") ?>" href="#">Dibaca</a>
                                </li>
                            </ul>
                        </div>
                        <?php foreach ($all_aspirasi as $row) : ?>
                            <div class="card mb-1 border-0">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $row['komisi'] ?></h5>
                                    <p class="text-monospace"><?= $row['message'] ?></p>
                                    <div class="complaint-meta">
                                        <a class="meta-info mr-2" href="#uri"><i class="fas fa-reply"></i> Tanggapan <span class="align-text-bottom"> 1</span></a>
                                        <a class="meta-info mr-2" href="#uri" data-url="<?= base_url("komentar/getId/") . $row['id_aspirasi'] ?>">
                                            <i class="far fa-comments"></i> Komentar <span class="align-top"> 1</span>
                                            <a class="meta-info" href="#uri"><i class="fas fa-thumbs-up"></i> Dukun<span class="align-text-bottom"> 1</span></a>
                                    </div>
                                </div>
                            <?php endforeach ?>
                            </div>
                    </div>

                    <div class="col-md-4 border-left shadow-lg">
                        <div class="content section-title">
                            <h2 class="pb-2 border-bottom">Aspirasi Terbaru</h2>
                        </div>
                        <div class="content section-title">
                            <h2 class="pb-2 border-bottom">Aspirasi Populer</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                    Created for <a href="https://easetemplate.com/downloads/digital-marketing-website-template-hike-bold-design/" target="_blank">easetemplate</a>
                </div>
            </div>
        </div>
    </div>

    <div class="full">
        <div class="cursor">
            <div class="loader">
                <i class="fa-li fa fa-hourglass-half fa-spin"></i>
            </div>
        </div>
    </div>

    <!-- Modal 1 -->

    <?php $this->load->view($thema_load . 'template/footer.php'); ?>


    <script>
        $(".meta-info").each(function() {
            $(".full").hide();
            $(this).click(function() {
                console.log($(this).data('url'));
                $(".meta-info").removeClass("loading");
                window.addEventListener("mousemove", function(e) {
                    let x = e.clientX + 20;
                    let y = e.clientY;
                    $(".loader").css({
                        "left": x + "px",
                        "top": y + "px"
                    });
                })
                $(this).addClass("loading");
                $(".full").show();
            })
        })
    </script>

</body>

</html>