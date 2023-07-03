
$(document).ready(function () {//close modal
    $(".closeModalBtn").click(function(e) {
        e.preventDefault();
        var modalName = $(this).attr("modalName");
        $('.' + modalName + '').modal('hide');
    });
});