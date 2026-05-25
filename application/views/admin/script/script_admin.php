<script>
    jQuery(document).ready(function() {
        var url = '<?= base_url('api/checkRegisterUsername') ?>';
        console.log($('#user').val());

        $('#user').rules("add", {
            required: true,
            remote: {
                url: url,
                type: "POST",
                dataType: "json",
                data: {
                    username: function() {
                        return $('#user').val(); // ✅ ใช้ function เพื่อดึงค่าแบบ real-time
                    }
                },
                dataFilter: function(data) {
                    var json = JSON.parse(data);
                    console.log(json);

                    if (json.success == 0) {
                        return true;
                    } else {
                        return false;
                    }
                },
                beforeSend: function(xhr, opts) {
                    //console.log( $('#payerEmail').val());
                    // console.log(opts);
                    // opts.data = "payer_email=" + $("#payerEmail").val();
                },
            },
            messages: {
                remote: "ชื่อผู้ใช้งานนี้มีอยู่ในระบบแล้ว."
            }
        });

        $('#password').rules("add", {
            required: true,
            minlength: 6,
        });

        $('#passwordCF').rules("add", {
            required: true,
            equalTo: "#password",
        });

        $('#passwordEdit').rules("add", {
            minlength: 6,
        });

        $('#passwordCFEdit').rules("add", {
            equalTo: "#passwordEdit",
        });
    });
</script>