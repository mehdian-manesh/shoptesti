<?php
date_default_timezone_set("Asia/Tehran");
session_start();

include __DIR__ . '/../files.php';

$params = [
    'id' => $_POST['id'] ?? 0,
    'order_id' => $_POST['order_id'] ?? 0,
];
  
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.idpay.ir/v1.1/payment/verify');
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'X-API-KEY: 6a7f99eb-7c20-4412-a972-6dfb7cd253a4',
    'X-SANDBOX: 1',
]);

$result = curl_exec($ch);
$err = curl_error($ch);
curl_close($ch);

$result = json_decode($result, true);
?>

<!DOCTYPE html>
<html lang="fa">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>شاپ تستی</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- owl stylesheets -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<!-- body -->

<body class="main-layout ">
    <!-- loader  -->
    <div class="loader_bg">
        <div class="loader"><img src="images/loading.gif" alt="#" /></div>
        <div class="loader" style="padding-top: 150px; font-weight: bold;">در حال بارگذاری</div>
    </div>
    <!-- end loader -->
    <!-- header -->
    <header>
        <!-- header inner -->
        <div class="header">

            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                        <div class="full">
                            <div class="center-desk">
                                <div class="logo">
                                    <a href="/"><img src="images/logo.png" alt="#"></a>
                                    <div style="text-align: center;">
                                    <i>
                                        نسخه آزمایشی فروشگاه آنلاین
                                    </i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                        <div class="menu-area">
                            <div class="limit-box">
                                <nav class="main-menu">
                                    <ul class="menu-area-main">
                                        <li class="active"> <a href="/">خانه</a> </li>
                                        <li> <a href="#">در باره ما</a> </li>
                                        <li><a href="#">برندها</a></li>
                                        <li><a href="#">فروش ویژه</a></li>
                                        <li><a href="#">ارتباط با ما</a></li>
                                        <li class="last">
                                            <a href="#"><img src="images/search_icon.png" alt="icon" /></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 offset-md-6">
                        <div class="location_icon_bottum">
                            <ul>
                                <li><img src="icon/call.png" />09123456789</li>
                                <li><img src="icon/email.png" />info@email.com</li>
                                <li><img src="icon/loc.png" />آدرس</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end header inner -->
    </header>
    <!-- end header -->

    <div class="brand_color">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage" dir="rtl" style="text-align: right">
                        <h2>رسید پرداخت</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <!-- Payment receipt -->
   <div class="contact">
        <div class="container" dir="rtl" style="text-align: right">
            <?php if ($err): ?>
                <div class="card rounded border-danger">

                    <div class="card-title">
                        <h2 class="text-center bg-danger">خطا در اتصال به درگاه پرداخت</h2>
                    </div>
                    
                    <div class="card-body justify-content-center">
                        <div class="alert alert-danger" role="alert">
                            <?php echo $err; ?>
                        </div>        
                    </div>

                </div>
            <?php elseif ($result['status'] != 100): ?>
                <div class="card rounded border-danger">

                    <div class="card-title">
                        <h2 class="text-center bg-danger">خطا در انجام تراکنش!</h2>
                    </div>

                    <div class="card-body justify-content-center">
                        <div class="alert alert-danger" role="alert">
                            پیغام سیستم:
                            <div>
                                <?php echo $result['error_message']; ?>
                            </div>
                        </div>
                    </div>

                </div>
            <?php else: ?>
                <div class="card rounded border-success">
                    
                    <div class="card-title">
                        <h2 class="text-center bg-success">پرداخت با موفقیت انجام شد</h2>
                    </div>

                    <div class="card-body justify-content-center">
                        <div class="alert alert-success" role="alert">
                            <ul>
                                <li>
                                    کد رهگیری پرداخت:
                                    <?php echo $result['payment']['track_id']; ?>
                                </li>
                                <li>
                                    مبلغ:
                                    <?php echo $result['payment']['amount']; ?>
                                </li>
                                <li>
                                    شماره کارت:
                                    <?php echo $result['payment']['card_no']; ?>
                                </li>
                                <li>
                                     زمان پرداخت:
                                    <?php echo date('H:i:s', $result['payment']['date']); ?>
                                </li>
                            </ul>
                        </div>
                        <?php 
                        if ( in_array($result['order_id'], [1,2,3,4,5,6,7,8,9,10]) ): 
                            $_SESSION['validated'][] = $result['order_id'];
                            $_SESSION['date'] = time();
                        ?>
                            <div class="d-flex justify-content-center my-5">
                                <div class="border p-4 rounded text-center">
                                    <img src="images/<?php echo $result['order_id']?>.webp" alt="img" style="height: 200px;"/>
                                    <div class="text-center">
                                        <?php echo $files[$result['order_id']]; ?>
                                    </div>
                                    <a href="/download.php?id=<?php echo $result['order_id']?>" class="btn btn-success mt-5">دانلود فایل</a>
                                </div>
                            </div>
                            <div class="text-center text-primary h5 my-5">
                                لینک‌های دانلود به مدت ۳۰ دقیقه (از آخرین پرداخت) برای شما فعال خواهند بود.
                            </div>
                        <?php endif; ?>
                        <div class="text-center">
                            <i>از خرید شما متشکریم!</i>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="text-center">
                <a href="/" class="btn btn-primary mt-3">بازگشت به صفحه اصلی</a>
                </div>
            </div>
        </div>
    </div>
    <!-- end Payment receipt -->

    <!-- footer -->
    <footer>
        <div id="contact" class="footer">
            <div class="container">
                <div class="row pdn-top-30">
                    <div class="col-md-12 ">
                        <div class="footer-box">
                            <div class="headinga">
                                <h3>آدرس‌ها</h3>
                                <span>تهران - خیابان ولیعصر، کوچه ولیعصر پاساژ ولیعصر</span>
                                <p>09123456789
                                    <br>info@email.com</p>
                            </div>
                            <ul class="location_icon">
                                <li> <a href="#"><i class="fa fa-facebook-f"></i></a></li>
                                <li> <a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li> <a href="#"><i class="fa fa-instagram"></i></a></li>

                            </ul>
                            <div class="menu-bottom" dir="rtl">
                                <ul class="link">
                                    <li> <a href="#">خانه</a></li>
                                    <li> <a href="#">درباره ما</a></li>
                                    
                                    <li> <a href="#">برند‌ها </a></li>
                                    <li> <a href="#">فروش ویژه  </a></li>
                                    <li> <a href="#">ارتباط با ما</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <div class="container">
                    <p>© 2019 All Rights Reserved. Design By<a href="https://html.design/"> Free Html Templates</a></p>
                </div>
            </div>
        </div>
    </footer>
    <!-- end footer -->
    <!-- Javascript files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/plugin.js"></script>
    <!-- sidebar -->
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
    <!-- javascript -->
    <script src="js/owl.carousel.js"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".fancybox").fancybox({
                openEffect: "none",
                closeEffect: "none"
            });

            $(".zoom").hover(function() {

                $(this).addClass('transition');
            }, function() {

                $(this).removeClass('transition');
            });
        });
    </script>
</body>

</html>