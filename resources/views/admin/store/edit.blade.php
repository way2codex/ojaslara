@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit Store - {{ $store_data['name'] }}</div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.update_store') }}" id="add_form" name="add_form">
                        @csrf
                        <input type="hidden" name="id" value="{{ $store_data['id'] }}" id="id" />
                        <input type="hidden" name="old_logo" id="old_logo" value="{{ $store_data['logo'] }}" />
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Name</label>
                                <input type="text" class="form-control" value="{{ $store_data['name'] }}" id="name" name="name" placeholder="Name">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Website</label>
                                <input type="text" class="form-control" value="{{ $store_data['website'] }}" id="website" name="website" placeholder="Website">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Website Url</label>
                                <input type="text" class="form-control" value="{{ $store_data['website_url'] }}" id="website_url" name="website_url" placeholder="Website Url">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Category</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="0">All</option>
                                    <?php foreach ($category_data as $key => $data) { ?>
                                        <option <?php
                                            if($data['wp_id'] == $store_data['category_id']){
                                                echo "selected";
                                            }
                                            ?> value="{{$data['wp_id'] }}">{{ $data['name'] }}</option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option <?php
                                            if ($store_data['status'] == "inactive") {
                                                echo "selected";
                                            }
                                            ?> value="inactive">InActive</option>
                                    <option <?php
                                            if ($store_data['status'] == "active") {
                                                echo "selected";
                                            }
                                            ?> value="active">Active</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Fetch Mode</label>
                                <select name="data_fetch_mode" id="data_fetch_mode" class="form-control">
                                    <option <?php
                                            if ($store_data['data_fetch_mode'] == "auto") {
                                                echo "selected";
                                            }
                                            ?> value="auto">auto</option>
                                    <option <?php
                                            if ($store_data['data_fetch_mode'] == "manual") {
                                                echo "selected";
                                            }
                                            ?> value="manual">manual</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Fetch Type</label>
                                <select name="data_fetch_type" id="data_fetch_type" class="form-control">
                                    <option <?php
                                            if ($store_data['data_fetch_type'] == "latest") {
                                                echo "selected";
                                            }
                                            ?> value="latest">latest</option>
                                    <option <?php
                                            if ($store_data['data_fetch_type'] == "old") {
                                                echo "selected";
                                            }
                                            ?> value="old">old</option>
                                    <option <?php
                                            if ($store_data['data_fetch_type'] == "both") {
                                                echo "selected";
                                            }
                                            ?> value="both">both</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Rewrite ?</label>
                                <select name="is_rewrite" id="is_rewrite" class="form-control">
                                    <option <?php
                                            if ($store_data['is_rewrite'] == "true") {
                                                echo "selected";
                                            }
                                            ?> value="true">true</option>
                                    <option <?php
                                            if ($store_data['is_rewrite'] == "false") {
                                                echo "selected";
                                            }
                                            ?> value="false">false</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Frequency</label>
                                <input type="text" class="form-control" value="{{ $store_data['freq'] }}" id="freq" name="freq" placeholder="Frequency">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputEmail4">Next Frequency</label>
                                <input type="text" class="form-control" value="{{ $store_data['next_freq'] }}" id="next_freq" name="next_freq" placeholder="Next Frequency">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Notes</label>
                                <textarea class="form-control" id="notes" name="notes">{{ $store_data['notes'] }}</textarea>
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
                email: {
                    required: true,

                }
            }
        });
    });
</script>
@endsection