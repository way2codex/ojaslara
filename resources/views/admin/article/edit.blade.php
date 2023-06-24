@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit Article</div>
                <div class="card-body">

                    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.update_article') }}" id="add_form" name="add_form">
                        @csrf
                        <input type="hidden" name="id" id="id" value="{{ $article_data['id'] }}" />
                        <input type="hidden" name="old_image" id="old_image" value="{{ $article_data['image'] }}" />

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Category</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="">Select Option</option>
                                    <?php foreach ($category as $key => $value) { ?>
                                        <option <?php
                                                if ($article_data['category_id'] == $value['id']) {
                                                    echo 'selected';
                                                }
                                                ?> value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Name</label>
                                <input type="text" value="<?php echo $article_data['name']; ?>" class="form-control" id="name" name="name" placeholder="Name">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Body</label>
                                <textarea class="form-control" id="body" name="body"><?php echo $article_data['body']; ?></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Amazon Link</label>
                                <input type="text" class="form-control" id="amazon_link" name="amazon_link" placeholder="Amazon Link">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Amazon Widget</label>
                                <textarea class="form-control" id="amazon_widget" name="amazon_widget"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var editor = CKEDITOR.replace('body', {
        toolbar: 'Basic',
        enterMode: CKEDITOR.ENTER_BR,
        shiftEnterMode: CKEDITOR.ENTER_P,
        extraPlugins: 'autogrow',
        autoGrow_minHeight: 200,
        autoGrow_maxHeight: 600,
        autoGrow_bottomSpace: 50,
        removePlugins: 'resize',

        filebrowserBrowseUrl: '{{env("APP_URL")}}/admin_asset/ckfinder/ckfinder.html',
        filebrowserUploadUrl: '{{env("APP_URL")}}/admin_asset/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'


        // filebrowserBrowseUrl: '{{env("APP_URL")}}/admin_asset/ckfinder/ckfinder.html',
        // filebrowserImageBrowseUrl: '{{env("APP_URL")}}/admin_asset/ckfinder/ckfinder.html?type=Images',
        // filebrowserUploadUrl: '{{env("APP_URL")}}/admin_asset/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        // filebrowserImageUploadUrl: '{{env("APP_URL")}}/admin_asset/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        // removeButtons: 'PasteFromWord'
    });
    CKFinder.setupCKEditor(editor);

    CKEDITOR.on("instanceReady", function(event) {
        event.editor.on("beforeCommandExec", function(event) {
            // Show the paste dialog for the paste buttons and right-click paste
            if (event.data.name == "paste") {
                event.editor._.forcePasteDialog = true;
            }
            // Don't show the paste dialog for Ctrl+Shift+V
            if (event.data.name == "pastetext" && event.data.commandData.from == "keystrokeHandler") {
                event.cancel();
            }
        })
    });
</script>

<script>
    $(document).ready(function() {
        $("#add_form").validate({
            rules: {
                category_id: {
                    required: true,
                },
                name: {
                    required: true,
                },
                // image: {
                //     required: true,
                // }
            }
        });
    });
</script>
@endsection