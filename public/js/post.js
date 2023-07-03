$(document).ready(function () {
    $(document).on('click', '.addPostImage', function () {
        var rn = $(this).attr('rn');
        var rn_ = (parseInt(rn) + 1);
        $(this).attr('rn', rn_);

        $('.addedPostImages').append('<div class="addedPostImage mb-1" rowId="' + rn_ +
            '"><span class="rmvPostImage text-danger mr-3" rowId="' + rn_ +
            '"><i class="fas fa-times text-danger"></i></span><input type="file" class="" name="postImage[]"></div>'
        );

        $('.icImagesDiv').show();

        $('div.addedPostImage[rowid="' + rn_ + '"] input').trigger('click');
    });

    //remove image
    $(document).on('click', '.rmvPostImage', function (e) {
        e.preventDefault();

        var rowId = $(this).attr('rowId');

        if (rowId) {
            $('div[rowId="' + rowId + '"]').remove();
        }
    });

    // popup image in modal
    $('.postImage').on('click', function (e) {
        e.preventDefault();

        var imgsrc = $(this).attr('src');

        $('img.modalPostImage').attr('src', imgsrc);
        $('.postImageModal').modal('show');
    });

})