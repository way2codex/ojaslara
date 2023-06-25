@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit Setting</div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.save_setting') }}" id="add_form" name="add_form">
                        @csrf
                        <input type="hidden" name="id" id="id" value="1" />
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">api url</label>
                                <input type="text" class="form-control" id="api_url" value="<?php echo $setting_data['api_url']; ?>" name="api_url" placeholder="api site url">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">api username</label>
                                <input type="text" class="form-control" id="api_username" value="<?php echo $setting_data['api_username']; ?>" name="api_username" placeholder="api username">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">api password</label>
                                <input type="text" class="form-control" id="api_password" value="<?php echo $setting_data['api_password']; ?>" name="api_password" placeholder="api password">
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
    $(document).ready(function() {
        $("#add_form").validate({
            rules: {
                id: {
                    required: true,
                }
            }
        });
    });
</script>
@endsection