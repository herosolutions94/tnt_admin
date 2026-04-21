$(document).on("submit", ".frmAjax", function (e) {
    e.preventDefault();
    var frm = this;
    var frmbtn = $(this).find("button[type='submit']");
    var frmIcon = $(this).find("button[type='submit'] i.spinner");
    frmbtn.attr("disabled", true);
    frmIcon.removeClass("hidden");
    $.ajax({
        url: $(this).attr('action'),
        data: new FormData(frm), // Serialize the form data
        dataType: 'JSON',
        method: 'POST',
        processData: false, // Prevent jQuery from processing the data
        contentType: false, // Prevent jQuery from overriding the content type
        error: function (rs) {
            frmbtn.attr("disabled", false);
            frmIcon.addClass("hidden");
            // console.log(rs);
            // Display an error message using a toaster or alert
            toastr.error('Error submitting form. Please try again later.');
        },
        success: function (response) {
            frmbtn.attr("disabled", false);
            frmIcon.addClass("hidden");
            if (response.status == 1 || response.success == true) {
                frm.reset();
                toastr.success(response.msg);
                if (response?.redirect_url) {
                    setTimeout(() => {
                        window.location.href = response?.redirect_url
                    }, 2000);
                }
            } else {
                toastr.error(response.msg);
            }
        },
        complete: function () {
            frmbtn.attr("disabled", false);
            frmIcon.addClass("hidden");
            // Reset form if needed
            // frm[0].reset();
        },
    });
});

function showToast(message, type) {
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right", // Top-right corner
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",  // 5 seconds
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    // Use Toastr.js to display the message as a toaster notification
    if (type === 'success') {
        toastr.success(message);
    } else {
        toastr.error(message);
    }
}


$(document).ready(function () {
    $('form').each(function () {
        // Only apply validation if the form has any required fields
        if ($(this).find('[required]').length > 0) {
            $(this).validate({
                ignore: [], // ensure all fields are validated even if hidden
                errorPlacement: function (error, element) {
                    error.insertAfter(element); // place error after input
                }
            });
        }
    });
});