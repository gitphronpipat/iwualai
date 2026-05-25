<?php
$fontPrimary = 'Kanit';
$bodyBgColor = '#e7e8ea';
$footerBgColor = '#ffffff';
$textIndent = '20px';

$trNextColorBg = '#486b9d';
$trNextColorTxt = '#ffffff';

$cache = '0.1';
$csDomain = base_url();
$kvFile = 'logo.png';
$banner = $csDomain . '/assets_front/images/home/' . $kvFile . '?v=' . $cache;
$eventOwnerContact = "Iemkasikit.co.th";
$eventOwnerEmail = "sales@iemkasikit.co.th";

$title = 'ติดต่อ';
$website = 'Iemkasikit.co.th';

if (isset($_formData['pay_date']) && isset($_formData['pay_time'])) {
    $date_format = fDateTime($_formData['pay_date'] . $_formData['pay_time']);
} else {
    $date_format = '';
}

?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting"> <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title><?php echo $title; ?></title> <!-- The title tag shows in email notifications, like Android 4.4. -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=<?= $fontPrimary ?>:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <!-- CSS Reset : BEGIN -->
    <style>
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
            background: <?php echo $bodyBgColor; ?>;
        }

        /* What it does: Stops email clients resizing small text. */
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        /* What it does: Centers email on Android 4.4 */
        div[style*="margin: 16px 0"] {
            margin: 0 !important;
        }

        /* What it does: Stops Outlook from adding extra spacing to tables. */
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        /* What it does: Fixes webkit padding issue. */
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }

        /* What it does: Uses a better rendering method when resizing images in IE. */
        img {
            -ms-interpolation-mode: bicubic;
        }

        /* What it does: Prevents Windows 10 Mail from underlining links despite inline CSS. Styles for underlined links should be inline. */
        a {
            text-decoration: none;
        }

        /* What it does: A work-around for email clients meddling in triggered links. */
        *[x-apple-data-detectors],
        /* iOS */
        .unstyle-auto-detected-links *,
        .aBn {
            border-bottom: 0 !important;
            cursor: default !important;
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* What it does: Prevents Gmail from displaying a download button on large, non-linked images. */
        .a6S {
            display: none !important;
            opacity: 0.01 !important;
        }

        /* What it does: Prevents Gmail from changing the text color in conversation threads. */
        .im {
            color: inherit !important;
        }

        /* If the above doesn't work, add a .g-img class to any image in question. */
        img.g-img+div {
            display: none !important;
        }

        /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
        /* Create one of these media queries for each additional viewport size you'd like to fix */

        /* iPhone 4, 4S, 5, 5S, 5C, and 5SE */
        @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
            u~div .email-container {
                min-width: 320px !important;
            }
        }

        /* iPhone 6, 6S, 7, 8, and X */
        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
            u~div .email-container {
                min-width: 375px !important;
            }
        }

        /* iPhone 6+, 7+, and 8+ */
        @media only screen and (min-device-width: 414px) {
            u~div .email-container {
                min-width: 414px !important;
            }
        }
    </style>
    <!-- CSS Reset : END -->

    <!-- Progressive Enhancements : BEGIN -->
    <style>
        .primary {
            background: <?php echo $bodyBgColor; ?>;
        }

        .bg_white {
            background: #ffffff;
        }

        .bg_light {
            background: #fafafa;
        }

        .bg_black {
            background: #000000;
        }

        .bg_dark {
            background: rgba(0, 0, 0, .8);
        }

        .table-section {
            padding: 0px 20px 20px 20px;
        }

        /*BUTTON*/
        .btn {
            padding: 5px 15px;
            display: inline-block;
        }

        .btn.btn-primary {
            border-radius: 5px;
            background: #0d0cb5;
            color: #ffffff;
        }

        .btn.btn-white {
            border-radius: 5px;
            background: #ffffff;
            color: #000000;
        }

        .btn.btn-white-outline {
            border-radius: 5px;
            background: transparent;
            border: 1px solid #fff;
            color: #fff;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p {
            font-family: '<?php echo $fontPrimary; ?>', sans-serif;
            color: #000000;
            margin-top: 0;
        }

        body {
            font-family: '<?php echo $fontPrimary; ?>', sans-serif;
            font-weight: 400;
            font-size: 15px;
            line-height: 1.8;
            color: rgba(0, 0, 0, .4);
        }

        a {
            color: #0d0cb5;
        }

        table {}

        /*LOGO*/

        .logo h1 {
            margin: 0;
        }

        .logo h1 a {
            color: #000000;
            font-size: 20px;
            font-weight: 700;
            text-transform: uppercase;
            font-family: '<?php echo $fontPrimary; ?>', sans-serif;
        }

        .navigation {
            padding: 0;
        }

        .navigation li {
            list-style: none;
            display: inline-block;
            ;
            margin-left: 5px;
            font-size: 13px;
            font-weight: 500;
        }

        .navigation li a {
            color: rgba(0, 0, 0, .4);
        }

        /*HERO*/
        .hero {
            position: relative;
            z-index: 0;
        }

        .hero .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            content: '';
            width: 100%;
            background: #000000;
            z-index: -1;
            opacity: .3;
        }

        .hero .icon a {
            display: block;
            width: 60px;
            margin: 0 auto;
        }

        .hero .text {
            color: rgba(255, 255, 255, .8);
        }

        .hero .text h2 {
            color: #ffffff;
            font-size: 30px;
            margin-bottom: 0;
        }

        .heading-section h2 {
            color: #000000;
            font-size: 20px;
            margin-top: 0;
            line-height: 1.4;
            font-weight: 700;
            text-transform: uppercase;
        }

        .heading-section .subheading {
            margin-bottom: 20px !important;
            display: inline-block;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: rgba(0, 0, 0, .4);
            position: relative;
        }

        .heading-section .subheading::after {
            position: absolute;
            left: 0;
            right: 0;
            bottom: -10px;
            content: '';
            width: 100%;
            height: 2px;
            background: #0d0cb5;
            margin: 0 auto;
        }

        .heading-section-white {
            color: rgba(255, 255, 255, .8);
        }

        .heading-section-white h2 {
            font-family: '<?php echo $fontPrimary; ?>', sans-serif;
            line-height: 1;
            padding-bottom: 0;
        }

        .heading-section-white h2 {
            color: #ffffff;
        }

        .heading-section-white .subheading {
            margin-bottom: 0;
            display: inline-block;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: rgba(255, 255, 255, .4);
        }

        .icon {
            text-align: center;
        }

        /*SERVICES*/
        .services {
            background: rgba(0, 0, 0, .03);
        }

        .text-services {
            padding: 10px 10px 10px 10px;
        }

        .text-services h3 {
            font-size: 16px;
            font-weight: 600;
        }

        .services-list {
            padding: 0;
            margin: 0 0 20px 0;
            width: 100%;
            float: left;
        }

        .services-list img {
            float: left;
        }

        .services-list .text {
            width: calc(100% - 60px);
            float: right;
        }

        .services-list h3 {
            margin-top: 0;
            margin-bottom: 0;
        }

        .services-list p {
            margin: 0;
        }

        /*BLOG*/
        .text-services .meta {
            text-transform: uppercase;
            font-size: 14px;
        }

        /*TESTIMONY*/
        .text-testimony .name {
            margin: 0;
        }

        .text-testimony .position {
            color: rgba(0, 0, 0, .3);

        }

        /*VIDEO*/
        .img {
            width: 100%;
            height: auto;
            position: relative;
        }

        .img .icon {
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            bottom: 0;
            margin-top: -25px;
        }

        .img .icon a {
            display: block;
            width: 60px;
            position: absolute;
            top: 0;
            left: 50%;
            margin-left: -25px;
        }

        /*COUNTER*/
        .counter {
            width: 100%;
            position: relative;
            z-index: 0;
        }

        .counter .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            content: '';
            width: 100%;
            background: #000000;
            z-index: -1;
            opacity: .3;
        }

        .counter-text {
            text-align: center;
        }

        .counter-text .num {
            display: block;
            color: #ffffff;
            font-size: 34px;
            font-weight: 700;
        }

        .counter-text .name {
            display: block;
            color: rgba(255, 255, 255, .9);
            font-size: 13px;
        }

        .footer .heading {
            color: #ffffff;
            font-size: 20px;
        }

        .footer ul {
            margin: 0;
            padding: 0;
        }

        .footer ul li {
            list-style: none;
            margin-bottom: 10px;
        }

        .footer ul li a {
            color: rgba(255, 255, 255, 1);
        }


        @media screen and (max-width: 500px) {
            .text-services {
                padding-left: 10px;
                padding-right: 10px;
                text-align: left;
            }

            .email-container {
                max-width: 100%;
                word-wrap: break-word;
            }

        }

        .tableSession tr td:first-child {
            padding: 10px 20px;
            background-color: #ffffff;
            color: #000000;
            /*border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;*/

        }

        .tableSession tr td {
            padding: 10px 20px;
            border: 1px solid #cecece;
            padding: 10px 20px;
            background-color: #ffffff;
            color: white;
            /*border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
            text-align: center;*/
            color: black;
            font-family: <?php echo $fontPrimary; ?>, sans-serif;
        }

        .tbold {
            font-weight: bold;
        }

        .border-top {
            border-top: 1px solid #dedede;
        }

        .banner-section1 {
            padding: 20px 0px 10px 20px;
        }

        .banner-section2 {
            padding: 20px 0px 10px 0px;
        }
    </style>
</head>

<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: <?php echo $bodyBgColor; ?>;">
    <center style="width: 100%;">
        <!-- <div style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
            &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
        </div> -->
        <div style="max-width: 650px; margin: 0 auto;" class="email-container">
            <!-- BEGIN BODY -->
            <table align="center" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                <tr>
                    <td valign="top" class="bg_white" style="padding: 0px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td width="100%" class="logo" style="text-align: left;">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                        <tr>
                                            <td class="banner-section1">
                                                <img src="<?php echo $banner; ?>" width="40%" alt="" />
                                            </td>
                                            <td class="banner-section2">
                                                <div class="heading-section" style="text-align: center; padding: 15px 10px 0px 10px; bottom: 0px; position: relative;">
                                                    <h2 style="font-size: 20px;">ติดต่อ (Contact Us)<br>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>

                                    <div style="margin-top: -10px;">
                                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                            <tr>
                                                <td class="table-section">
                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                        <tr>
                                                            <td class="border-top" valign="top" width="100%" style="padding-top: 10px;">
                                                                <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                                                    <tr>
                                                                        <td class="text-services">
                                                                            <!-- <p>เรียน <?= (isset($_formData['ad_username'])) ? $_formData['ad_username'] : ''; ?></p>

                                                                            <p style="text-indent: 20px;">
                                                                                ทางเราได้รับคำร้องขอลืมรหัสผ่านและได้ยืนยันแล้วว่าคุณคือเจ้าของ ข้อมูลรหัสผ่านของคุณอยู่ด้านล่าง
                                                                            </p> -->

                                                                            <table class="tableRegister" cellspacing="0" cellpadding="0" width="100%">
                                                                                <tr>
                                                                                    <td style='padding: 10px 20px; font-weight: bold; color: <?php echo $trNextColorTxt; ?>;background: <?php echo $trNextColorBg; ?>;'>
                                                                                        เรื่อง (Subject) : <?php echo (isset($_formData['appeal_subject'])) ? $_formData['appeal_subject'] : ''; ?>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                            <table class="tableSession" cellspacing="0" cellpadding="0" width="100%">
                                                                                <tr>
                                                                                    <td style="font-weight: bold;" width="30%">ชื่อ (Name)</td>
                                                                                    <td><?php echo (isset($_formData['appeal_name'])) ? $_formData['appeal_name'] : ''; ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td style="font-weight: bold;">อีเมล (E-mail)</td>
                                                                                    <td><?php echo (isset($_formData['appeal_email'])) ? $_formData['appeal_email'] : ''; ?></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td style="font-weight: bold; vertical-align: top;">รายละเอียด (Message)</td>
                                                                                    <td><?php echo (isset($_formData['appeal_detail'])) ? $_formData['appeal_detail'] : '-'; ?></td>
                                                                                </tr>
                                                                            </table>
                                                                            <br>
                                                                            <p>
                                                                                หากสงสัยหรือพบปัญหาสามารถติดต่อได้ที่ (If you have any questions or encounter any issues, please contact us at) : <a href="mailto: <?= $eventOwnerEmail ?>" style="font-weight: bold;"><?= $eventOwnerEmail ?></a>
                                                                            </p>

                                                                            <p>
                                                                                เว็บไซต์ (Website): <a href="<?= base_url() ?>" style="text-decoration: underline;"><?= $website; ?></a><BR>
                                                                            </p>
                                                                            <p>
                                                                                ด้วยความเคารพ (Best regards),<BR>
                                                                                <b><?= $eventOwnerContact ?></b><BR>
                                                                            </p>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr><!-- end: tr -->
                                            <tr style="padding: 0;margin: 0;">
                                                <td style="background: <?php echo $bodyBgColor; ?> repeat-x ;text-align:center;padding: 0;margin: 0;height: 20px;">

                                                </td>
                                            </tr><!-- end: tr -->
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr><!-- end tr -->

                <tr>
                    <td class="bg_white">


                    </td>
                </tr><!-- end:tr -->
                <!-- 1 Column Text + Button : END -->
            </table>

        </div>
    </center>
</body>

</html>