var KTResetPasswordGeneral = function () {
    var e, t, i;
    return {
        init: function () {
            e = document.querySelector("#form_reset"), t = document.querySelector("#button_reset"), i = FormValidation.formValidation(e, {
                fields: {
                    password: {
                        validators: {
                            notEmpty: {
                                message: "Kata sandi wajib di isi"
                            }
                        }
                    },
                    "repassword": {
						validators: {
							notEmpty: {
								message: "Konfirmasi kata sandi tidak boleh kosong!"
							},
							identical: {
								compare: function() {
									return e.querySelector('[name="password"]').value
								},
								message: "Konfirmasi kata sandi salah!"
							}
						}
					}
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger,
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            }), t.addEventListener("click", (function (n) {
                n.preventDefault(), i.validate().then((function (i) {
                    "Valid" == i ? reset_proses(t, e) : Swal.fire({
                        text: "Tidak bisa berubah sandi! terdapat kesalahan pada data yang anda masukan mohon periksa dan coba kembali",
                        icon: "error",
                        buttonsStyling: !1,
                        confirmButtonText: "ok",
                        customClass: {
                            confirmButton: css_btn_confirm
                        }
                    })
                }))
            }))
        }
    }
}();


function reset_proses(button, form) {
    var message, icon;
    var btn = $('#button_reset');
    var btn_text = btn.html();

    $.ajax({
        url: form.getAttribute('action'),
        method: form.getAttribute('method'),
        data: {
            email: form.querySelector('[name="email"]').value,
            password: form.querySelector('[name="password"]').value
        },
        dataType: 'json',
        beforeSend: function () {
            btn.html('Tunggu Sebentar...');
            btn.attr('disabled', true);
        },
        success: function (data) {
            // console.log(data);
            btn.html(btn_text);
            btn.attr('disabled', false);
            if (data.status == 200) {
                icon = 'success';
            } else if (data.status == 700) {
                icon = 'error';
            } else {
                icon = 'warning';
            }
            if (data.status == 200) {
                Swal.fire({
                    html: data.message,
                    icon: icon,
                    buttonsStyling: !1,
                    confirmButtonText: "Lanjutkan",
                    customClass: {
                        confirmButton: css_btn_confirm
                    }
                }).then((function (t) {
                    if (t.isConfirmed) {
                        form.querySelector('[name="email"]').value = "", form.querySelector('[name="password"]').value = "";
                        if (data.redirect) {
                            location.href = data.redirect;
                        }
                    }
                }))
            } else {
                Swal.fire({
                    html: data.message,
                    icon: icon,
                    buttonsStyling: !1,
                    confirmButtonText: "Lanjutkan",
                    customClass: {
                        confirmButton: css_btn_confirm
                    }
                })
            }
        }
    });
}
KTUtil.onDOMContentLoaded((function () {
    KTResetPasswordGeneral.init()
}));