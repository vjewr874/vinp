(function ($) {
    "use strict"
	
    toastr.success("Hoàn thiện hồ sơ của bạn để thực hiện giao dịch dễ dàng hơn", "Hoàn thiện hồ sơ!", {
         timeOut: 500000,
        closeButton: !0,
        debug: !1,
        newestOnTop: !0,
        progressBar: !0,
        positionClass: "toast-top-right demo_rtl_class",
        preventDuplicates: !0,
        onclick: null,
        showDuration: "300",
        hideDuration: "1000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
        tapToDismiss: !1,
        closeHtml: '<div class="circle_progress"></div><span class="progress_count"></span> <i class="la la-close"></i> <a href="#">Cập nhật ngay</a>'
    });
	
})(jQuery);