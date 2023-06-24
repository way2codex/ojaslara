<div class="col-lg-4 col-md-12">
    <div class="sidebar utf_sidebar_right">
        <!-- <div class="widget">
            <h3 class="utf_block_title"><span>Follow Us</span></h3>
            <ul class="social-icon">
                <li><a href="#" target="_blank"><i class="fa fa-rss"></i></a></li>
                <li><a href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                <li><a href="#" target="_blank"><i class="fa fa-vimeo-square"></i></a></li>
                <li><a href="#" target="_blank"><i class="fa fa-youtube"></i></a></li>
            </ul>
        </div> -->
        <?php if (store_data()['sidebar_script'] != "") { ?>
            <div class="widget widget-tags">
                <?php echo store_data()['sidebar_script']; ?>
            </div>
        <?php } ?>
        <div class="widget color-default">
            <h3 class="utf_block_title"><span>Popular</span></h3>
            <div class="utf_list_post_block">
                <ul class="utf_list_post">
                    <?php foreach (popular_article(5) as $key => $item) { ?>
                        <li class="clearfix">
                            <div class="utf_post_block_style post-float clearfix">
                                <a href="<?php echo route('article', [$item['id'], $item['slug']]); ?>">
                                    <div class="utf_post_thumb">
                                        <img class="img-fluid" src="<?php echo  asset('uploads/article') . '/' . $item['image']; ?>" alt="" />
                                    </div>
                                </a>
                                <div class="utf_post_content">
                                    <h2 class="utf_post_title title-small">
                                        <a href="<?php echo route('article', [$item['id'], $item['slug']]); ?>">
                                            {{ substr($item['name'], 0, 80); }}
                                        </a>
                                    </h2>
                                    <div class="utf_post_meta">
                                        <a class="" style="border-radius: 4px; padding: 2px; color: white; background-color: #ec0000;">{{ $item['category']['name'] }}</a>
                                        <!-- <span class="utf_post_author">
                                            <i class="fa fa-user"></i>
                                            <a href="#">John Wick</a>
                                        </span> -->
                                        <!-- <span class="utf_post_date"><i class="fa fa-clock-o"></i>
                                            25 Jan, 2022</span> -->
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php } ?>

                </ul>
            </div>
        </div>
        <div class="widget widget-tags">
            <h3 class="utf_block_title"><span>Categories</span></h3>
            <ul class="unstyled clearfix">
                <?php foreach (all_category() as $key => $all_category_item) { ?>
                    <li> <a href="<?php echo route('category', [$all_category_item['id'], $all_category_item['slug']]); ?>">{{ $all_category_item['name'] }}</a> </li>
                <?php } ?>
            </ul>
        </div>
        <!-- <div class="widget text-center"> <img class="banner img-fluid" src="{{ asset('web_asset/images/banner-ads/ad-sidebar.png') }}" alt="" /> </div> -->
        <div class="widget m-bottom-0">
            <h3 class="utf_block_title"><span>Newsletter</span></h3>
            <div class="utf_newsletter_block">
                <div class="utf_newsletter_introtext">
                    <h4>Subscribe Newsletter!</h4>
                    <p>Subscribe Us To Get Updates In Your MailBox!</p>
                </div>
                <div class="utf_newsletter_form">
                    <form action="<?php echo route('home'); ?>" method="post">
                        <div class="form-group">
                            <input type="email" name="email" id="utf_newsletter_form-email" class="form-control form-control-lg" placeholder="E-Mail Address" autocomplete="off">
                            <button class="btn btn-primary">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>