<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ระบบจัดการบุคลากร</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Sarabun&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/png" href="<?= base_url('assets/images/icons/favicon.png'); ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/app.css'); ?>">
    <!-- JQ  Validate-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <style>
        body {
            background: linear-gradient(to right, #0f172a, #5c1a1a);
            font-family: 'Sarabun', sans-serif;
        }

        .login-wrapper {
            max-width: 900px;
            margin: 60px auto;
            display: flex;
            background: white;
            border-radius: 20px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.12);
            overflow: hidden;
        }

        .login-left {
            flex: 1;
            background: linear-gradient(135deg, #1a1e34 0%, #552424 100%);
            color: #fef2f2	;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }

        .login-left::before {
            content: '';
            position: absolute;
            bottom: -60px;
            left: -60px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(220, 38, 38, 0.10);
            pointer-events: none;
        }

        /* วงกลมเล็ก บนขวา */
        .login-left::after {
            content: '';
            position: absolute;
            top: -40px;
            right: -40px;
            width: 140px;
            height: 140px;
            border-radius: 50%;
            background: rgba(220, 38, 38, 0.15);
            pointer-events: none;
        }

        .login-left h2 {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .login-left p {
            font-size: 14px;
            color:  #fff;
        }

        .login-right {
            flex: 1;
            padding: 40px;
        }

        .btn-primary {
            background: linear-gradient(to right, #252222, #252222, #252222);
            border: none;
            border-radius: 10px;
        }

        .btn-primary:hover {
            opacity: 0.9;
        }

        .test-account {
            background: #f1f5f9;
            border-radius: 10px;
            padding: 15px;
            margin-top: 20px;
        }

        .test-account small {
            color: #64748b;
        }

        .form-control-icon {
            z-index: 50;
        }

        .form-group[class*="has-icon-"] .form-control-icon {
            top: 13%;
        }

        .form-group[class*="has-icon-"] .form-control.is-invalid~.form-control-icon {
            top: 10%;
        }

        .form-control {
            padding-top: 0.65rem;
            padding-bottom: 0.65rem;
        }

        @media (max-width: 768px) {
            .login-wrapper {
                flex-direction: column;
            }

            .login-left,
            .login-right {
                flex: unset;
                width: 100%;
            }

            .login-left {
                display: none;
                padding: 30px 20px;
            }

            .login-right {
                padding: 30px 20px;
            }
        }

        @media (max-width: 576px) {
            .login-left h2 {
                font-size: 20px;
            }

            .login-left p {
                font-size: 12px;
            }

            .btn {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="login-wrapper">
            <!-- LEFT SIDE -->
            <div class="login-left text-center">
                <img src="<?= base_url('assets/images/logo/logo3.png') ?>" alt="" srcset="" class="img-fluid" style="width: 75%;">
                <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="#ffffff" height="80" width="80" viewBox="0 0 640 512">
                    <path d="M308.5 135.3c7.1-6.3 9.9-16.2 6.2-25c-2.3-5.3-4.8-10.5-7.6-15.5L304 89.4c-3-5-6.3-9.9-9.8-14.6c-5.7-7.6-15.7-10.1-24.7-7.1l-28.2 9.3c-10.7-8.8-23-16-36.2-20.9L199 27.1c-1.9-9.3-9.1-16.7-18.5-17.8C173.9 8.4 167.2 8 160.4 8l-.7 0c-6.8 0-13.5 .4-20.1 1.2c-9.4 1.1-16.6 8.6-18.5 17.8L115 56.1c-13.3 5-25.5 12.1-36.2 20.9L50.5 67.8c-9-3-19-.5-24.7 7.1c-3.5 4.7-6.8 9.6-9.9 14.6l-3 5.3c-2.8 5-5.3 10.2-7.6 15.6c-3.7 8.7-.9 18.6 6.2 25l22.2 19.8C32.6 161.9 32 168.9 32 176s.6 14.1 1.7 20.9L11.5 216.7c-7.1 6.3-9.9 16.2-6.2 25c2.3 5.3 4.8 10.5 7.6 15.6l3 5.2c3 5.1 6.3 9.9 9.9 14.6c5.7 7.6 15.7 10.1 24.7 7.1l28.2-9.3c10.7 8.8 23 16 36.2 20.9l6.1 29.1c1.9 9.3 9.1 16.7 18.5 17.8c6.7 .8 13.5 1.2 20.4 1.2s13.7-.4 20.4-1.2c9.4-1.1 16.6-8.6 18.5-17.8l6.1-29.1c13.3-5 25.5-12.1 36.2-20.9l28.2 9.3c9 3 19 .5 24.7-7.1c3.5-4.7 6.8-9.5 9.8-14.6l3.1-5.4c2.8-5 5.3-10.2 7.6-15.5c3.7-8.7 .9-18.6-6.2-25l-22.2-19.8c1.1-6.8 1.7-13.8 1.7-20.9s-.6-14.1-1.7-20.9l22.2-19.8zM112 176a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zM504.7 500.5c6.3 7.1 16.2 9.9 25 6.2c5.3-2.3 10.5-4.8 15.5-7.6l5.4-3.1c5-3 9.9-6.3 14.6-9.8c7.6-5.7 10.1-15.7 7.1-24.7l-9.3-28.2c8.8-10.7 16-23 20.9-36.2l29.1-6.1c9.3-1.9 16.7-9.1 17.8-18.5c.8-6.7 1.2-13.5 1.2-20.4s-.4-13.7-1.2-20.4c-1.1-9.4-8.6-16.6-17.8-18.5L583.9 307c-5-13.3-12.1-25.5-20.9-36.2l9.3-28.2c3-9 .5-19-7.1-24.7c-4.7-3.5-9.6-6.8-14.6-9.9l-5.3-3c-5-2.8-10.2-5.3-15.6-7.6c-8.7-3.7-18.6-.9-25 6.2l-19.8 22.2c-6.8-1.1-13.8-1.7-20.9-1.7s-14.1 .6-20.9 1.7l-19.8-22.2c-6.3-7.1-16.2-9.9-25-6.2c-5.3 2.3-10.5 4.8-15.6 7.6l-5.2 3c-5.1 3-9.9 6.3-14.6 9.9c-7.6 5.7-10.1 15.7-7.1 24.7l9.3 28.2c-8.8 10.7-16 23-20.9 36.2L315.1 313c-9.3 1.9-16.7 9.1-17.8 18.5c-.8 6.7-1.2 13.5-1.2 20.4s.4 13.7 1.2 20.4c1.1 9.4 8.6 16.6 17.8 18.5l29.1 6.1c5 13.3 12.1 25.5 20.9 36.2l-9.3 28.2c-3 9-.5 19 7.1 24.7c4.7 3.5 9.5 6.8 14.6 9.8l5.4 3.1c5 2.8 10.2 5.3 15.5 7.6c8.7 3.7 18.6 .9 25-6.2l19.8-22.2c6.8 1.1 13.8 1.7 20.9 1.7s14.1-.6 20.9-1.7l19.8 22.2zM464 304a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
                </svg>
                <h2 class="mt-4">ระบบจัดการข้อมูลเว็บไซต์</h2> -->
                <!-- <p>ระบบบริหารจัดการบุคลากรภายในองค์กร</p> -->
            </div>

            <!-- RIGHT SIDE -->
            <div class="login-right">
                <div class="text-center  pt-4">
                    <h4 class="mb-3">เข้าสู่ระบบ</h4>
                    <p class="text-muted mb-4">กรุณาเข้าสู่ระบบเพื่อใช้งาน</p>
                </div>

                <form id="formLogin" method="post">
                    <div class="mb-2 pt-4">
                        <label class="form-label">ชื่อผู้ใช้</label>
                        <div class="form-group position-relative has-icon-left">
                            <input type="text" class="form-control" name="username" placeholder="ชื่อผู้ใช้งาน">
                            <div class="form-control-icon text-center d-flex justify-content-center align-items-center">
                                <i class="fa-regular fa-user" style="font-size: 1rem;"></i>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">รหัสผ่าน</label>
                        <div class="form-group position-relative has-icon-left">
                            <div class="input-group">
                                <input type="password" class="form-control" name="password" placeholder="รหัสผ่าน">
                                <button type="button" class="btn btn-light"><i class="fa-solid fa-eye"></i></button>
                            </div>
                            <div class="form-control-icon text-center d-flex justify-content-center align-items-center">
                                <i class="fa-solid fa-lock" style="font-size: 1rem;"></i>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid mt-5 pb-5">
                        <button type="submit" class="btn btn-primary py-3"><i class="fa-solid fa-right-to-bracket"></i> เข้าสู่ระบบ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    jQuery.extend(jQuery.validator.messages, {
        required: "โปรดกรอกข้อมูลช่องนี้.",
        remote: "Please fix this field.",
        email: "Please enter a valid email address.",
        url: "Please enter a valid URL.",
        date: "Please enter a valid date.",
        dateISO: "Please enter a valid date (ISO).",
        number: "Please enter a number only.",
        digits: "Please enter only digits.",
        creditcard: "Please enter a valid credit card number.",
        equalTo: "Please enter the same value again.",
        accept: "Please enter a value with a valid extension.",
        maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
        minlength: jQuery.validator.format("Please enter at least {0} characters."),
        rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
        range: jQuery.validator.format("Please enter a value between {0} and {1}."),
        max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
        min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
    });

    //Validation
    jQuery(document).ready(function() {
        $.validator.setDefaults({
            ignore: []
        });
        var form = $('#formLogin');
        form.each(function() {
            var elem = $(this);
            elem.validate({
                errorClass: 'is-invalid',
                validClass: 'is-valid',
                errorElement: "div",
                focusInvalid: true,
                rules: {
                    username: {
                        required: true,
                    },
                    password: {
                        required: true,
                    }
                },
                validHandler: function(elem, validator) {
                    console.log('1');
                },
                errorPlacement: function(error, element) {
                    if (element.attr("type") === "file") {
                        const formGroup = element.closest(".form-group");
                        if (formGroup.length) {
                            formGroup.find("div.error").remove();
                            error.addClass("error d-block mt-1");
                            formGroup.append(error);
                        } else {
                            element.after(error);
                        }
                    } else if (element.closest('.input-group').length) {
                        // ✅ ถ้าอยู่ใน input-group ให้แสดง error หลัง input-group
                        error.addClass("error d-block mt-1");
                        element.closest('.input-group').after(error);
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function(form) {
                    $("#formLogin input,textarea,select").attr('readonly', 'readonly');
                    //form.submit();
                    return true;
                },
            });
        });
    });

    $('.btn-light').on('click', function() {
        const $btn = $(this);
        const $input = $btn.siblings('input');
        const $eyeIcon = $btn.find('i');

        // toggle password visibility
        const isPassword = $input.attr('type') === 'password';
        $input.attr('type', isPassword ? 'text' : 'password');

        // toggle eye icon
        $eyeIcon.toggleClass('fa-eye fa-eye-slash');

        // toggle lock icon (fa-lock <-> fa-unlock)
        const $formGroup = $btn.closest('.form-group');
        const $lockIcon = $formGroup.find('.form-control-icon i');

        $lockIcon.toggleClass('fa-lock fa-unlock-keyhole');
    });
</script>


<?php if ($this->session->flashdata('result') == 'true') {
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'ดำเนินการสำเร็จ',
            text: '" . $this->session->flashdata('message') . "', 
            confirmButtonColor: '#198754',
        })

    </script>";
} ?>
<?php if ($this->session->flashdata('result') == 'false') {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'ผิดพลาด',
            text: '" . $this->session->flashdata('message') . "',
            confirmButtonColor: '#198754',
        })
            
    </script>";
} ?>
<?php if ($this->session->flashdata('result') == 'duplicate') {
    echo "<script>
        Swal.fire({
            icon: 'warning',
            title: 'ดำเนินการไม่สำเร็จ',
            text: '" . $this->session->flashdata('message') . "',
            confirmButtonColor: '#198754',
        })
    </script>";
} ?>


</html>