<?php 
    get_header(); 
    pageBanner(array(
        'title'=>'Past Events',
        'subtitle'=>'Recap of the past events',
    ));
    ?>

    <div class="container container--narrow page-section">
    <?php 
            $today = date('Ymd');
            $pastEvents = new WP_Query(array(
            //this fuction make sure pagination work, cuz we are using a custume query
            'paged'=> get_query_var('paged', 1),
            'post_type' => 'event',
            'meta_key' => 'event_date',
            'orderby' => 'meta_value_num',
            'order' => 'ASC',
            //check that the passed events wont sbe display in the upcoming event section
            'meta_query' => array(
                array(
                'key' => 'event_date',
                'compare' => '<',
                'value' => $today,
                'type' => 'numeric'
                )
            )
            ));

            while($pastEvents->have_posts( )) {
                $pastEvents->the_post(); 
                get_template_part('template-parts/content-event');
            }
            //create pagination links whenever we get more than 10 post 
            echo paginate_links( array(
            //need to be use when using a custume query
                'total' => $pastEvents->max_num_pages
            ));
        ?>
        </div>
        <?php get_footer( );
        ?>