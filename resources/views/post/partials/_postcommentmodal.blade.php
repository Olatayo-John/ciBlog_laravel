<div class="modal postCommentModal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body text-center">
                <form action="" method="post" class="edit_comment_form">
                    @csrf
                    @method('put')

                    <div class="form-group">
                        <label>Edit Comment</label><br>
                        <textarea name="comment" class="form-control edit_comment_comment" required></textarea>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-danger closeModalBtn" modalName="postCommentModal" type="button">Close</button>
                        <button class="btn btn-secondary" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

