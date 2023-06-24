@extends('layouts.web.web')

@section('content')
<section class="utf_block_wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <h2>About Us!</h2>
                <h3 style="text-align: center;">Welcome To <span id="W_Name1">{{ $store_data['name'] }}</span></h3>
                <p><span id="W_Name2">{{ $store_data['name'] }}</span> is a Professional <span id="W_Type1"></span> Platform.
                    Here we will provide you only interesting content, which you will like very much.
                    We're dedicated to providing you the best <span id="W_Type2">Content</span>,
                    with a focus on dependability and <span id="W_Spec">{{ $store_data['about_us_tag'] }}</span>.
                    We're working to turn our passion into a booming online website.
                    We hope you enjoy our <span id="W_Type4">Content</span> as much as we enjoy offering them to you.</p>
                <p>I will keep posting more important posts on my Website for all of you. Please give your support and love.</p>
                <p style="font-weight: bold; text-align: center;">Thanks For Visiting Our Site<br><br>
                    <span style="color: blue; font-size: 16px; font-weight: bold; text-align: center;">Have a nice day!</span>
                </p>
            </div>
            @include('sidebar')
        </div>
    </div>
</section>
@endsection