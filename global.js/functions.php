/**
 * Load More Search Posts
 * 
 * 
 */
if( !function_exists( 'eb_load_more_search_posts' ) ) : 
    function eb_load_more_search_posts() {
        if( isset( $_POST['per_page'] ) && isset( $_POST['offset'] ) ) {

            $search_str = $_POST['search_str'];

            $args = array(
                'post_type'         => 'post',
                'posts_per_page'    => intval($_POST['per_page']),
                'offset'            => intval($_POST['offset']),
                's'                 => $search_str
            );

            $query = new WP_Query($args); wp_reset_postdata();
            $posts = array();

            // var_dump($query->posts); die();
            foreach( $query->posts as $post ) {
                $terms = get_the_terms($post->ID, 'category');
                $term_names = [];
                foreach($terms as $term) {
                    $term_names[] = $term->name;
                }
                $posts[] = array(
                    'post_title'    => get_the_title($post->ID),
                    'permalink'     => get_the_permalink($post->ID),
                    'thumbnail'     => get_the_post_thumbnail($post->ID, 'full'),
                    'date'          => get_the_date( 'j F', $post->ID ),
                    'terms'         => implode(',', $term_names),
                    'read_time'     => intval(str_word_count(strip_tags($post->post_content)) / 125) . ' min read'
                );
            }

            /**
             * Count Total Posts
             */
            
            $total_posts = count($query->posts);
            // var_dump($total_posts); die();
            /**
             * Output Data
             */
            $data = array(
                'posts'     => $posts,
                'total'     => intval($total_posts),
            );

            echo wp_json_encode($data);

        }else {
            return;
        }

        wp_die();
    }
    add_action( 'wp_ajax_eb_load_more_search_posts', 'eb_load_more_search_posts' );
    add_action( 'wp_ajax_nopriv_eb_load_more_search_posts', 'eb_load_more_search_posts' );
endif;
