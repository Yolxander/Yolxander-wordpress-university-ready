<?php 
    get_header(); 
    pageBanner(array(
        'title'=>'All Event',
        'subtitle'=>'See what is going on in our world',
    ));
    ?>

    <div class="container container--narrow page-section">
    <?php 
        while(have_posts( )) {
        the_post(); 
        //when using only one arg we put the location and the name of the file
        get_template_part('template-parts/content-event');
        }
            //create pagination links whenever we get more than 10 post 
            echo paginate_links(  );
        ?>
    <hr class="section-break">

    <p>Looking fr a recap of past events? <a href="<?php echo site_url('/past-events')?>">Check out our past events page</a>
    </div>
    <?php get_footer( );
    ?>