<?php get_header();
/* Template Name:blog */
?>
<?php

$args = array(
    'post_type' => 'post',
    'status' => 'publish',
    'posts_per_page' => 3,
    'order'     => 'DESC',

);
$blog_post = new WP_Query($args);

$page_num = $blog_post->max_num_pages;
?>
<section class="page-title bg-1">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="block text-center">
                    <span class="text-white">Our blog</span>
                    <h1 class="text-capitalize mb-5 text-lg">Blog articles</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section blog-wrap">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row" id="apendd_blog">
                    <?php
                    /*
                    if ($blog_post->have_posts()) :
                        while ($blog_post->have_posts()) : $blog_post->the_post(); ?>

                            <div class="col-lg-12 col-md-12 mb-5">
                                <div class="blog-item">
                                    <div class="blog-thumb">

                                        <?php $blog_img = wp_get_attachment_image_src(get_post_thumbnail_id()); ?>
                                        <?php if (!empty($blog_img)) : ?>
                                            <img src="<?php echo $blog_img[0]; ?>" alt="" class="img-fluid ">
                                        <?php endif; ?>

                                    </div>
                                    <div class="blog-item-content">

                                        <div class="blog-item-meta mb-3 mt-4">
                                            <span class="text-muted text-capitalize mr-3"><i class="icofont-comment mr-2"></i>5 Comments</span>
                                            <span class="text-black text-capitalize mr-3"><i class="icofont-calendar mr-1"></i> 28th January</span>
                                        </div>

                                        <h2 class="mt-3 mb-3"><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h2>

                                        <p class="mb-4"><?php the_content(); ?></p>

                                        <a href="blog-single.html" target="_blank" class="btn btn-main btn-icon btn-round-full">Read More <i class="icofont-simple-right ml-2  "></i></a>

                                    </div>
                                </div>
                            </div>
                    <?php endwhile;
                    endif;
                    */
                    ?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="sidebar-wrap pl-lg-4 mt-5 mt-lg-0">
                    <div class="sidebar-widget search  mb-3 ">
                        <h5>Search Here</h5>
                        <form class="search-form">
                            <input type="text" class="form-control" name="search" id="search" placeholder="search">
                            <i class="ti-search"></i>
                        </form>
                    </div>


                    <div class="sidebar-widget latest-post mb-3">
                        <h5>Popular Posts</h5>
                        <?php if ($blog_post->have_posts()) :
                            while ($blog_post->have_posts()) : $blog_post->the_post(); ?>
                                <div class="py-2">
                                    <span class="text-sm text-muted"><?php echo get_the_date('d M Y'); ?></span>
                                    <h6 class="my-2"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
                                </div>
                        <?php endwhile;
                        endif;
                        ?>
                    </div>
                    <?php $cate = get_categories();
                    // echo '<pre>';
                    // print_r($cate);
                    // echo '</pre>';

                    ?>
                    <div class="sidebar-widget category mb-3">
                        <h5 class="mb-4">Categories</h5>

                        <ul class="list-unstyled">

                            <?php foreach ($cate as $category) :
                            ?>
                                <li class="align-items-center">
                                    <a href="javascript:void(0)" data-slug-name="<?php echo $category->slug; ?>" id="get_cate"><?php echo $category->name; ?></a>
                                    <span>(<?php echo $category->count; ?>)</span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>


                    <!-- <div class="sidebar-widget tags mb-3">
                        <h5 class="mb-4">Tags</h5>

                        <a href="#">Doctors</a>
                        <a href="#">agency</a>
                        <a href="#">company</a>
                        <a href="#">medicine</a>
                        <a href="#">surgery</a>
                        <a href="#">Marketing</a>
                        <a href="#">Social Media</a>
                        <a href="#">Branding</a>
                        <a href="#">Laboratory</a>
                    </div> -->

                    <div class="sidebar-widget schedule-widget mb-3">
                        <h5 class="mb-4">Time Schedule</h5>

                        <ul class="list-unstyled">
                            <li class="d-flex justify-content-between align-items-center">
                                <a href="#">Monday - Friday</a>
                                <span>9:00 - 17:00</span>
                            </li>
                            <li class="d-flex justify-content-between align-items-center">
                                <a href="#">Saturday</a>
                                <span>9:00 - 16:00</span>
                            </li>
                            <li class="d-flex justify-content-between align-items-center">
                                <a href="#">Sunday</a>
                                <span>Closed</span>
                            </li>
                        </ul>

                        <div class="sidebar-contatct-info mt-4">
                            <p class="mb-0">Need Urgent Help?</p>
                            <h3>+23-4565-65768</h3>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-lg-8">
                <!-- <nav class="pagination py-2 d-inline-block">
                    <div class="nav-links">
                        <span aria-current="page" class="page-numbers current">1</span>
                        <a class="page-numbers" href="#">2</a>
                        <a class="page-numbers" href="#">3</a>
                        <a class="page-numbers" href="#"><i class="icofont-thin-double-right"></i></a>
                    </div>
                </nav> -->

                <!-- <button id="loadmore" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing Order" class="loadmore" data-page-id="<?php echo $page_num; ?>">LoadMore</button> -->
                <button id="loadmore" data-loading-text="<i class='fa fa-spinner fa-spin'></i>Procesing..." class="loadmore fa fa-spinner fa-spin" data-page-id="<?php echo $page_num; ?>">
                    Load More
                </button>
            </div>
        </div>
    </div>

</section>

<?php get_footer(); ?>