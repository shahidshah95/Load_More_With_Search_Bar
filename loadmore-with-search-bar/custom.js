jQuery(document).ready(function () {
    /* Golbal Variable */
    search = '';
    let page = 1;
    let max_page = jQuery('#loadmore').data('page-id');

    /** On page load calling function if page is [1] */
    get_blog_data(page, max_page, search, '');

    /** Search-bar Query */
    jQuery("#search").keyup('search', function () {
        search = jQuery(this).val();

        /** calling search function*/
        search_ajax(page, max_page, search);
    });

    /* Load data on click */
    jQuery('#loadmore').on('click', function () {
        loadmore = jQuery(this);
        page++;
        // let max_page = jQuery(this).data('page-id');

        /** Calling ajax click function */
        get_blog_data(page, max_page, search, '');

    });

    // jQuery(document).on('click', '#get_cate', function () {
    //     var category_slug = jQuery(this).data('slug-name');
    //     search_ajax(page, max_page, search, category_slug);
    // })

});

/** ajax function for loadmore button */
function get_blog_data(page, max_page, search, category_slug) {
    var $button = jQuery('#loadmore');
    var $spinner = $button.find('.fa-spinner');
    jQuery.ajax({
        url: my_ajax_object.ajaxurl,
        type: 'POST',

        data: {
            action: 'loadmore_post',
            page: page,
            search: search,
            // category_slug: category_slug
        },
        beforeSend: function () {

            $spinner.show(); // Display the spinner
            $button.prop('disabled', true).html($button.data('loading-text'));
        },
        success: function (response) {

            data = jQuery.parseJSON(response);

            if (response) {

                jQuery('#apendd_blog').append(data.html);

                if (parseInt(data.max_page) == page) {
                    jQuery('#loadmore').hide();
                }
                $button.text('Load More').prop('disabled', false);
                // $spinner.hide();
            }
        }

    });
}

/** ajax function for search-bar */
function search_ajax(page, max_page, search, category_slug) {

    jQuery.ajax({

        url: my_ajax_object.ajaxurl,
        type: 'POST',

        data: {
            action: 'loadmore_post',
            page: 1,
            search: search,
            // category_slug: category_slug
        },

        success: function (response) {
            data = jQuery.parseJSON(response);
            jQuery('#apendd_blog').html(data.html);
            console.log('max_page :' + data.max_page);

            if (parseInt(data.max_page) <= 1) {
                jQuery('#loadmore').hide();
            }
        }

    });
}