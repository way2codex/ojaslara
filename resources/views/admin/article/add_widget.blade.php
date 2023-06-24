@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Add Widget</div>
                <div class="card-body">

                    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.save_article_widget') }}" id="add_form" name="add_form">
                        @csrf
                        <input value="{{ $article_data['id'] }}" type="hidden" name="article_id" id="article_id" />
                        <div class="form-row">
                            <?php foreach ($store as $key => $store_item) { ?>
                                <?php
                                $widget_data = "";
                                // dd();
                                if($article_data['article_widget']->where('store_id',$store_item['id'])->count() > 0){
                                    $widget_data = $article_data['article_widget']->where('store_id',$store_item['id'])->first()['widget_data'];
                                }
                                ?>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4"><b>{{ $store_item['name'] }}</b></label>
                                    <textarea class="form-control" id="widget_data[{{ $store_item['id'] }}]" name="widget_data[{{ $store_item['id'] }}]"><?php echo $widget_data; ?></textarea>
                                </div>
                            <?php } ?>
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