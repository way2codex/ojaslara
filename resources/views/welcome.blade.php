@extends('layouts.web.web')

@section('title')
<title>{{ store_data()['name'] }}</title>
@endsection
@section('content')

<!-- Page Title Start -->
<!-- <div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li>Technology</li>
                </ul>
            </div>
        </div>
    </div>
</div> -->
<!-- Page title end -->


<section class="utf_block_wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="block category-listing category-style2">
                    <!-- <h3 class="utf_block_title"><span>Technology News</span></h3>
                    <ul class="subCategory unstyled">
                        <li><a href="#">Traveling</a></li>
                        <li><a href="#">Games</a></li>
                        <li><a href="#">Lifestyle</a></li>
                    </ul> -->
                    <?php foreach ($data as $key => $item) { ?>
                        <div class="utf_post_block_style post-list clearfix">
                            <div class="row">
                                <div class="col-lg-5 col-md-6">
                                    <a href="<?php echo route('article', [$item['id'], $item['slug']]); ?>">
                                        <div class="utf_post_thumb thumb-float-style">
                                            <img class="img-fluid" src="<?php echo  asset('uploads/article') . '/' . $item['image']; ?>" alt="{{ $item['name'] }}" />
                                            <!-- <a class="utf_post_cat" style="color: white;">{{ $item['category']['name'] }}</a> -->
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-7 col-md-6">
                                    <div class="utf_post_content">
                                        <a class="" style="border-radius: 4px; padding: 2px; color: white; background-color: #ff3131;">{{ $item['category']['name'] }}</a>
                                        <h2 class="utf_post_title title-large"> <a href="<?php echo route('article', [$item['id'], $item['slug']]); ?>">{{ $item['name'] }}</a> </h2>
                                        <!-- <div class="utf_post_meta"> <span class="utf_post_author"><i class="fa fa-user"></i> <a href="#">John Wick</a></span> <span class="utf_post_date"><i class="fa fa-clock-o"></i> 25 Jan, 2022</span> <span class="post-comment pull-right"><i class="fa fa-comments-o"></i> <a href="#" class="comments-link"><span>03</span></a></span> </div> -->
                                        {!! substr($item['body'], 0, 300); !!}... <a href="<?php echo route('article', [$item['id'], $item['slug']]); ?>">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <!-- <div class="paging">
                    <ul class="pagination">
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">»</a></li>
                    </ul>
                </div> -->
                {!! $data->links() !!}
            </div>

            @include('sidebar')

        </div>
    </div>
</section>

@endsection