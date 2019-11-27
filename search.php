<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
<!--<header class="page-heading blog-heading archive-page">-->
<!--    <div class="container">-->
<!--        <div class="page-heading-content">-->
<!--            --><?php //if ( have_posts() ) : ?>
<!--                <h1 class="page-title">--><?php //printf( __( 'Search Results for: %s', 'twentyseventeen' ), '<span>' . get_search_query() . '</span>' ); ?><!--</h1>-->
<!--            --><?php //else : ?>
<!--                <p class="taxonomy-description">--><?php //_e( 'Nothing Found', 'twentyseventeen' ); ?><!--</p>-->
<!--            --><?php //endif; ?>
<!--        </div>-->
<!--    </div>-->
<!--</header>-->
<!-- .page-header -->


<div class="blog-body">
    <div class="wrap">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">

                <div class="row">

                    <!--Main body content-->
                    <div class="col-md-9">

                        <div class="row">
                            <?php
                            $count = 0;
                            if ( have_posts() ) :
                                /* Start the Loop */
                                while ( have_posts() ) : the_post();

                                    /**
                                     * Run the loop for the search to output the results.
                                     * If you want to overload this in a child theme then include a file
                                     * called content-search.php and that will be used instead.
                                     */
                                    get_template_part('template-parts/post/content-search', get_post_format());
                            $count ++;
                                endwhile; // End of the loop.
                                ?>
                            <div class="blog_search_count">  <?php echo $count ;?> 
                                <?php if($count<2){ ?>
                                    <span class="blog_search_result_text">result found for </span>
                                <?php }else{?>
                                    <span class="blog_search_result_text">results found for </span>
                                <?php } ?>                                         
                                <?php echo "\"". $_GET['s'] ."\"";?>
                            </div>



                        <!-- Load More Search result -->
                        <div class="post-appender" id="js-search-appender"></div>
                        <script type="text/html" id="tmpl-post-search">
                            <div class="row">
                                <# _.each(data.posts, function(post, index) { #>
                                    <div class="content-blog col-md-6 col-sm-6">
                                        <div class="blog-post">
                                            <div class="post-image">
                                                <a href="{{post.permalink}}">
                                                    {{{post.thumbnail}}}
                                                </a>
                                            </div>
                                            <div class="post-data">
                                                <div class="blog-data-top">
                                                    <span class="post-category-name">{{post.terms}}</span>
                                                </div>
                                                <h4>
                                                    <a href="{{post.permalink}}">{{post.post_title}}</a>
                                                </h4>
                                                <div class="post-meta">
                                                    <span class="post-date">{{post.date}}</span>
                                                    <span class="post-read-time">{{post.read_time}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <# }); #>
                            </div>
                        </script>
                        <!-- Load More Posts -->
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button class="link-btn js-load-more-search" data-search="<?php if(isset($_GET['s'])) : echo $_GET['s']; else: echo ''; endif; ?>">Load More </button>
                            </div>
                        </div>


                            <?php else : ?>
                                <div class="blog_search_count">  <?php echo $count ;?> 
                                    <span class="blog_search_result_text">result found for </span>
                                    <?php echo "\"". $_GET['s'] ."\"";?>
                                </div>
                                <?php
                                // get_search_form();

                            endif; ?>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="col-md-3">
                        <?php get_sidebar(); ?>
                    </div>
                </div>

            </main><!-- #main -->
        </div><!-- #primary -->
        <!-- --><?php //get_sidebar(); ?>
    </div><!-- .wrap -->
</div>

<?php get_footer();
