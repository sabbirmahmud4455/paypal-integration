$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });



    $(document).on('submit','.ajax-form', function(e){
        e.preventDefault()
        $(".loading").show()

        let $this = $(this);
        let formData = new FormData(this);

        $this.find(".has-danger").removeClass('has-error');
        $this.find(".form-errors").remove();

        $.ajax({
            type: $this.attr('method'),
            url: $this.attr('action'),
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            success: function (response) {
                $(".loading").hide()

                if (response.success) {
                    swal("", `${response.success}`, "success");
                    $("#datatable").DataTable().ajax.reload();
                }
                if (response.warning) {
                    swal("", `${response.warning}`, "warning");
                    $("#datatable").DataTable().ajax.reload();
                }
                if (response.error) {
                    swal("", `${response.error}`, "error");
                    $("#datatable").DataTable().ajax.reload();
                }
                if (response.login) {
                    swal("Login Successfully Done","Redirecting Please Wait","success")
                    return window.location.href = response.login
                }

                // Employee Add Swal Message
                if (response.add_employee) {
                    swal("","Employee Added Successfully","success")
                    setTimeout(function() {
                        return window.location.href = response.add_employee
                    },1000)
                }

                // Employee Status Update Swal Message
                if (response.employee_status_update) {
                    swal('', 'Status Change Successfully', 'success');
                    setTimeout(function() {
                        return window.location.href = response.employee_status_update
                    },1000);
                }

                // Adjust Attendance
                if (response.adjust_attendance) {
                    swal("","Attendance Successfully Adjusted","success")
                    setTimeout(function() {
                        return window.location.href = response.adjust_attendance
                    },1000)
                }

                console.clear()
            },
            error: function (response) {
                $(".loading").hide()

                let data = JSON.parse(response.responseText);
                $.each(data.errors, (key, value) => {
                    swal("", `${value}`, "warning");
                    $("[name^=" + key + "]").parent().addClass('has-error')
                    $("[name^=" + key + "]").parent().append('<small class="danger text-muted form-errors">' + value[0] + '</small>');
                })

                console.clear()
            }
        })
    })


})
