<?php
add_action('wp_ajax_loadmore_post', 'loadmore_post');
add_action('wp_ajax_nopriv_loadmore_post', 'loadmore_post');

function loadmore_post()
{
    $page = isset($_POST['page']) ? $_POST['page'] : '';
    $search = isset($_POST['search']) ? $_POST['search'] : '';
    $cate = isset($_POST['category_slug']) ? $_POST['category_slug'] : '';

    $args = array(
        'post_type' => 'post',
        'status' => 'publish',
        'paged' => $page,
        'posts_per_page' => 3,
    );

    if (isset($search) && !empty($search)) {
        $args['s'] = $search;
    }

    // if (isset($cate) && !empty($cate)) {
    // $args['tax_query'] = array(
    // array(
    // 'taxonomy' => 'category',
    // 'field' => 'slug',
    // 'terms' => $cate,
    // ),
    // );
    // }

    $blog_post = new WP_Query($args);
    $pageid = $blog_post->max_num_pages;

    $response = array(); // Create an array for the response

    if ($blog_post->have_posts()) {

        while ($blog_post->have_posts()) {
            $blog_post->the_post();
            $blog_img = wp_get_attachment_image_src(get_post_thumbnail_id());
            // Start storing the HTML content in a variable
            $response['html'] .= '<div class="col-lg-12 col-md-12 mb-5" id="new_data">
    <div class="blog-item">
        <div class="blog-thumb">';
            if (!empty($blog_img)) :
                $response['html'] .= '<img src="' . $blog_img[0] . '" alt="" class="img-fluid ">';
            endif;
            $response['html'] .= '</div>
        <div class="blog-item-content">
            <div class="blog-item-meta mb-3 mt-4">
                <span class="text-muted text-capitalize mr-3"><i class="icofont-comment mr-2"></i>5 Comments</span>
                <span class="text-black text-capitalize mr-3"><i class="icofont-calendar mr-1"></i> 28th January</span>
            </div>
            <h2 class="mt-3 mb-3"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h2>
            ' . get_the_content() . '
            <a href="blog-single.html" target="_blank" class="btn btn-main btn-icon btn-round-full">Read More <i class="icofont-simple-right ml-2  "></i></a>

        </div>
    </div>
</div>';
        }
    }

    $response['max_page'] = $pageid;
    echo json_encode($response); // Convert the response array to JSON

    die();
}
