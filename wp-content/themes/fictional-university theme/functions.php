<?php 

require get_theme_file_path('/inc/search-route.php');
require get_theme_file_path('/inc/like-route.php');

//creating a custum field in the rest api
function university_custom_rest(){
    register_rest_field('post','authorName', array(
        'get_callback' => function(){return get_the_author();}
    ));

    register_rest_field('note','userNoteCount', array(
        'get_callback' => function(){return count_user_posts(get_current_user_id(), 'note');}
    ));
}
add_action('rest_api_init', 'university_custom_rest');

//this fucntion display the html code wherever is called
//NULL makes the function optional, instead oof recure
function pageBanner($args = NULL){
    //if the any title argument was passed then is gonna grab the title fomr the dat base and display it
    if(!$args['title']){
        $args['title'] = get_the_title();
    }
    if(!$args['subtitle']){
        $args['subtitle'] = get_field('page_banner_subttile');
    }

    if(!$args['photo']){
        if(get_field('page_imge')){
            $args['photo'] = get_field('page_image')['sizes']['pageBanner'];
        }else{
            $args['photo'] = get_theme_file_uri('./images/ocean.jpg');}
    }
    
    ?>
    <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php 
        echo $args['photo']?>);">
    </div>
        <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php echo $args['title'];?></h1>
        <div class="page-banner__intro">
            <p><?php echo $args['subtitle']?></p>
        </div>
        </div>  
    </div>
<?php }

function university_files(){
    wp_enqueue_script('main-university-js', get_theme_file_uri('/js/scripts-bundled.js'),
    //microtime avoids caching
    NULL, microtime(), true);
    wp_enqueue_style('custome-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome','//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('university_main_styles',get_stylesheet_uri(),NULL, microtime());
    //allows theme to be loaded in any local or public computer
    wp_localize_script('main-university-js','universityData', array(
        'root_url'=> get_site_url(),
        'nonce' => wp_create_nonce('wp_rest')
    ));
}

//first argument-tell wordpress what type of instructions we are giving it
//second argument-tell the name of the function we are gonna run
add_action('wp_enqueue_scripts','university_files');


function university_features(){
    // register_nav_menu( 'headerMenuLocation', 'Header Menu Location' );
    // register_nav_menu( 'footerFirstLocation', 'Footer First Location');
    // register_nav_menu( 'footerSecondLocation', 'Footer Second Location');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    //crops the image to reduce sizes therefore the wight of the website
    add_image_size('profesorLandscape',400,260, true);
    add_image_size('profesorPortrait',480,650, true);
    add_image_size('pageBanner',1500,350, true);
}

add_action( 'after_setup_theme', 'university_features');

function university_adjust_queries($query){
    if(!is_admin() AND is_post_type_archive('program') AND $query->is_main_query()){
        $query->set('orderby','title');
        $query->set('order','ASC');
        $query->set('post_per_page', -1);
    }
    //check this query is only running in this indecated url
    if(!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()){
        $today = date('Ymd');
        $query->set('meta_key', 'event_date');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'ASC');
        $query->set('meta_query', array(
                array(
                'key' => 'event_date',
                'compare' => '>=',
                'value' => $today,
                'type' => 'numeric'
                )
            ));
        }
}

add_action('pre_get_posts', 'university_adjust_queries');

//redirect subcribers accout out of admin into home page
add_action('admin_init', 'redirectSubsToFrontend');

function redirectSubsToFrontend(){
    $ourCurrentUser = wp_get_current_user();

    if(count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber'){
        wp_redirect(site_url('/'));
        exit;
    }
}

//
add_action('wp_loaded', 'noSubAdminBAr');

function noSubAdminBAr(){
    $ourCurrentUser = wp_get_current_user();

    if(count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber'){
        show_admin_bar(false);
    }
}

remove_filter('the_content', 'wpautop');

//CUSTOMIZE LOGIN SCREEN
add_filter('login_headerurl', 'ourHeaderUrl');

function ourHeaderUrl(){
    return esc_url(site_url('/'));
}

add_action('login_enqueue_scripts', 'ourLoginCSS');
//the best way to costumize the loggin screen in wordpress is to modify/overwrite the default css style given by wordpress
function ourLoginCSS(){
    wp_enqueue_style('university_main_styles',get_stylesheet_uri(),NULL, microtime());
    wp_enqueue_style('custome-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
}

add_filter('login_headertitle', 'ourLoginTitle');

function ourLoginTitle(){
    return get_bloginfo('name');
}

//Force note posts to be private
/*for more info about this post check lesson:
 085 Per-User Post Limit */
add_filter('wp_insert_post_data' , 'makeNotePrivate', 10, 2);

function makeNotePrivate($data,$postarr){
    if($data['post_type'] == 'note'){
        if(count_user_posts(get_current_user_id(),'note') > 4 AND !$postarr['ID'] ){
            die("You have reached your note limit.");
        }

        $data['post_content'] == sanitize_textarea_field( $data['post_content'] );
        $data['post_title'] == sanitize_text_field( $data['post_title'] );
    }
    if($data['post_type'] == 'note' AND $data['post_status'] !== 'trash'){
        $data['post_status'] = "private";
    }
    return $data;
}