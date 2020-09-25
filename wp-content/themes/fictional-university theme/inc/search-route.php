<?php 
    add_action('rest_api_init', 'universityRegisterSearch');

    function universityRegisterSearch(){
        //'methods => 'GET' or
        register_rest_route('university/v1', 'search', array(
            'methods'=> WP_REST_SERVER::READABLE,
            'callback' => 'universitySearchResults'
        ));
    }

    //wordpress automatic convert php data in json 
    //"data" is an arg that carry all  the data in the search api and this data is given by Wordpress
    function universitySearchResults($data){
        //'WP_Query create a object with the data from the wordpress core
        $mainQuery = new WP_Query(array(
            'post_type' => array('post','page','professor','program','event'),
            //sanitize function increase security
            's'=> sanitize_text_field($data['term'])
        ));

        $results = array(
            'generalInfo'=>array(),
            'professor'=>array(),
            'program'=>array(),
            'event'=>array(),
        );

        while($mainQuery->have_posts()){
            $mainQuery->the_post();

            if(get_post_type() == 'post' OR get_post_type() == 'page'){
                array_push($results['generalInfo'], array(
                    'postType'=> get_post_type(),
                    'authorName'=> get_the_author(),
                    'title' => get_the_title(),
                    'permalink'=>get_the_permalink( )
                ));
            }
            
            if(get_post_type() == 'professor'){
                array_push($results['professor'], array(
                    'title' => get_the_title(),
                    'permalink'=>get_the_permalink( ),
                    'image'=>get_the_post_thumbnail_url(0,'size')
                ));
            }

            if(get_post_type() == 'program'){
                array_push($results['program'], array(
                    'title' => get_the_title(),
                    'permalink'=>get_the_permalink( ),
                    'id'=> get_the_ID(  )
                ));
            }
            
            if(get_post_type() == 'event'){
                $eventDate = new DateTime(get_field('event_date'));
                $description = NULL;
                if(has_excerpt( )){
                    $description = get_the_excerpt(  );
                }else{
                    $description = wp_trim_words(get_the_content(), 18 );
                } 

                array_push($results['event'], array(
                    'title' => get_the_title(),
                    'permalink'=>get_the_permalink( ),
                    'month'=> $eventDate->format('M'),
                    'day'=>$eventDate->format('n'),
                    'description'=>$description

                ));
            }
        }

        if ($results['program']) {
            $programsMetaQuery = array('relation' => 'OR');
        
            foreach($results['program'] as $item) {
              array_push($programsMetaQuery, array(
                  'key' => 'related_programs',
                  'compare' => 'LIKE',
                  'value' => '"' . $item['id'] . '"'
                ));
            }
        
            $programRelationshipQuery = new WP_Query(array(
              'post_type' => array('professor', 'event'),
              'meta_query' => $programsMetaQuery
            ));
        
            while($programRelationshipQuery->have_posts()) {
              $programRelationshipQuery->the_post();
        
              if (get_post_type() == 'event') {
                $eventDate = new DateTime(get_field('event_date'));
                $description = null;
                if (has_excerpt()) {
                  $description = get_the_excerpt();
                } else {
                  $description = wp_trim_words(get_the_content(), 18);
                }
        
                array_push($results['event'], array(
                  'title' => get_the_title(),
                  'permalink' => get_the_permalink(),
                  'month' => $eventDate->format('M'),
                  'day' => $eventDate->format('d'),
                  'description' => $description
                ));
              }
        
              if (get_post_type() == 'professor') {
                array_push($results['professor'], array(
                  'title' => get_the_title(),
                  'permalink' => get_the_permalink(),
                  'image' => get_the_post_thumbnail_url(0, 'professorLandscape')
                ));
              }
        
            }
        
            $results['professor'] = array_values(array_unique($results['professor'], SORT_REGULAR));
            $results['event'] = array_values(array_unique($results['event'], SORT_REGULAR));
          }
        return $results;
}
