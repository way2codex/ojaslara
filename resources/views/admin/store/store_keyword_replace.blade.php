@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Add Keyword - {{ $store_data['name'] }}</div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.save_store_keyword_replace') }}" id="add_form" name="add_form">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <!-- <label for="inputEmail4"></label> -->
                                <input type="hidden" value="{{ $store_data['id'] }}" class="form-control" id="store_id" name="store_id" placeholder="Name">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputEmail4">keyword</label>
                                <input value="" type="text" class="form-control" id="keyword" name="keyword" placeholder="keyword">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputEmail4">keyword replace</label>
                                <input value="" type="text" max="100" min="1" class="form-control" id="keyword_replace" name="keyword_replace" placeholder="keyword_replace">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="card-body">
                    <table class="table  table-bordered datatable">
                        <thead>
                            <tr>
                                <th>Keyword</th>
                                <th>Keyword Replace</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($store_data['store_keyword_replace'] as $key => $item) { ?>
                                <tr>
                                    <td>{{$item['keyword']}}</td>
                                    <td>{{$item['keyword_replace']}}</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
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