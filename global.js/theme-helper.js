/**
 * Load More Search Posts
 * 
 * 
 */
const loadMoreSearchPosts = function() {
    var loadMoreBtn2 = '.js-load-more-search';
    var postsPerPage = 6;
    var postOffset = postsPerPage;

    $(document.body).on('click', loadMoreBtn2, function(e) {
        e.preventDefault();
        $(loadMoreBtn2).text('Loading...');
        var $_self = $(this);
        var search_str = $(this).data('search');
        var appendTo = $('#js-search-appender');
        var template = wp.template('post-search');
        $.ajax({
            url: theme_localizer.ajax_url,
            type: 'post',
            data: {
                action: 'eb_load_more_search_posts', // in functions.php
                per_page: postsPerPage,
                search_str: search_str,
                offset: postOffset
            },
            success: function(res) {
                var data = JSON.parse(res);
                console.log(data);
                postOffset = parseInt( postOffset, 10 ) + parseInt( postsPerPage, 10 );

                // Append Results
                appendTo.append(template(data));

                if(data.total <= postOffset || data.total == postsPerPage) {
                    $(loadMoreBtn2).remove();
                }
                $(loadMoreBtn2).text('Load More Events');
            }
        });

    })
}
loadMoreSearchPosts ();
