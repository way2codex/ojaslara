@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Add Store</div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.save_store') }}" id="add_form" name="add_form">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Website</label>
                                <input type="text" class="form-control" id="website" name="website" placeholder="Website">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Website Url</label>
                                <input type="text" class="form-control" id="website_url" name="website_url" placeholder="Website Url">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Category</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="0">All</option>
                                    <?php foreach ($category_data as $key => $data) { ?>
                                        <option value="{{$data['wp_id'] }}">{{ $data['name'] }}</option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="inactive">InActive</option>
                                    <option value="active">Active</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Fetch Mode</label>
                                <select name="data_fetch_mode" id="data_fetch_mode" class="form-control">
                                    <option value="auto">auto</option>
                                    <option value="manual">manual</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Fetch Type</label>
                                <select name="data_fetch_type" id="data_fetch_type" class="form-control">
                                    <option value="latest">latest</option>
                                    <option value="old">old</option>
                                    <option value="both">both</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Rewrite ?</label>
                                <select name="is_rewrite" id="is_rewrite" class="form-control">
                                    <option value="false">False</option>
                                    <option value="true">True</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Frequency</label>
                                <input type="text" class="form-control" id="freq" name="freq" placeholder="Frequency">
                            </div>
                            <div class="form-group col-md-4" id="">
                                <label for="inputEmail4">Next Frequency</label>
                                <input type="text" class="form-control" id="next_freq" name="next_freq" placeholder="Next Frequency">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Notes</label>
                                <textarea class="form-control" id="notes" name="notes"></textarea>
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
        $('#next_freq').datetimepicker({
            format: 'Y-m-d h:i:s',
        });

        $("#add_form").validate({
            rules: {
                name: {
                    required: true,
                },
                website: {
                    required: true,
                },
                website_url: {
                    required: true,
                }
            }
        });
    });
</script>
@endsection