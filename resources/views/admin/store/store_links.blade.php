@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Add Links - {{ $store_data['name'] }}</div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.save_store_links') }}" id="add_form" name="add_form">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <!-- <label for="inputEmail4"></label> -->
                                <input type="hidden" value="{{ $store_data['id'] }}" class="form-control" id="store_id" name="store_id" placeholder="Name">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputPassword4">Links</label>
                                <textarea id="links" name="links" rows="30" class="form-control"><?php
                                    if(count($store_data->store_links) > 0){
                                        foreach($store_data->store_links as $key => $item){ 
                                            echo $item['url'].'&#10;';
                                        }
                                    }
                                    ?></textarea>
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
        
    });
</script>
@endsection