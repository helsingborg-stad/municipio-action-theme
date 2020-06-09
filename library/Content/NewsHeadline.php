<?php

namespace ActionHbg\Content;

class NewsHeadline { 
    public $postTypeName = 'newsHeadline'; 
    public $postTypeArgs = array(); 
    public $defaultPauseTime = 5000;
    public $defaultFadeTime = 800; 

    public function __construct()
    {


        if (!post_type_exists($postTypeName)) {
            
            add_action('init', array(&$this, 'registerPostType'));
            add_action('rest_api_init', array($this, 'registerAcfMetadataInApi'));
            add_action('rest_api_init', array($this, 'registerRestField')); 
            add_action('rest_api_init', array($this, 'registerOptionsEndpoint')); 
        }
    }



    public function registerPostType()
    {
        $this->postTypeArgs = array (
            'public'                => true, 
            'publicly_queryable'    => true,
            'show_ui'               => true,
            'show_in_menu'          => true, 
            'show_in_nav_menus'     => true,
            'show_in_rest'          => true, 
            'query_type'            => false,
            'hierarchical'          => false,
            'supports'              => array('title', 'editor','custom-fields'),
            'capability_type'       => 'post',
            '_builtin'              => false,
            'menu_position'         => 21, 
            'has_archive'           => true,
            'labels' => array(
                'name' => __('Nyheter'),
                'singular_name' => __('Nyheter'),
                'add_new' => __('Add new'),
                'add_new_item' => __('Add a news headline')
            ),
        );  
        register_post_type($this->postTypeName, $this->postTypeArgs );
        
        add_action( 'add_meta_boxes', array($this,'addUrlMetaBox')  ); 
        add_action( 'save_post', array($this, 'saveUrl' )); 
    }

    function addUrlMetaBox()
    {
        add_meta_box($this->postTypeName . '_url', __('URL'), array($this, 'showMetaboxHtml'), $this->postTypeName , 'normal', 'high');
    }

    function showMetaboxHtml()
    {
        global $post;
        $custom = get_post_custom($post->ID);
        $function = isset($custom[$this->postTypeName . '_url'][0]) ? $custom[$this->postTypeName . '_url'][0]:'';
        echo '<input name="url" class="editor-post-text-editor" value="' . $function . '"> ';
        
    }

    function saveUrl()
    {
        if(empty($_POST)) return; //why is prefix_teammembers_save_post triggered by add new? 
        global $post;
        update_post_meta($post->ID, $this->postTypeName . '_url', $_POST["url"]);
    }   


    public function registerAcfMetadataInApi()
    {
        if (empty($this->postTypeArgs['show_in_rest'])) {
            return;
        }

        // Collect ACF field groups
        $groups = acf_get_field_groups(array('post_type' => $this->postTypeName));

        // List of field types to skip
        $skipTypes = array('tab', 'accordion');

        // Loop over field groups
        foreach ($groups as $key => $group) {
            // Get all fields
            $fields = acf_get_fields($group['key']);
            // Bail if empty
            if (empty($fields)) {
                continue;
            }
            // Loop over meta fields and register to rest response
            foreach ($fields as $key => $field) {
                if (!$field['name'] || in_array($field['type'], $skipTypes)) {
                    continue;
                }
                // Register meta as rest field
                register_rest_field(
                    $this->postTypeName,
                    $field['name'],
                    array(
                      'get_callback' => array($this, 'getCallback'),
                      'schema' => null,
                    )
                );
            }
        }
    }

    public function getCallback($object, $fieldName, $request)
    {
        if (function_exists('get_field')) {
            $fieldObj = get_field_object($fieldName);
            $type = $fieldObj['type'] ?? 'text';
            // Return different values based on field type
            switch ($type) {
              case 'true_false':
                $value = get_field($fieldName, $object['id']);
                break;

              default:
                // Return null if value is empty
                $value = !empty(get_field($fieldName, $object['id'])) ? get_field($fieldName, $object['id']) : null;
                break;
            }

            return $value;
        }

        return get_post_meta($object['id'], $fieldName, true);
    }


    function registerRestField(){
        global $post;
        $custom = get_post_custom($post->ID);
        $function = isset($custom[$this->postTypeName . '_url'][0]) ? $custom[$this->postTypeName . '_url'][0]:'';
        $args = array (
            'get_callback'  => array($this, 'getNewsUrl')
        ); 
        
        register_rest_field(strtolower($this->postTypeName) , 'url', $args ); 
    }

    function getNewsUrl($object, $field_name, $request)
    {
        $custom = get_post_custom($post->ID);
        return isset($custom[$this->postTypeName . '_url'][0]) ? $custom[$this->postTypeName . '_url'][0]:'';
    }

    function registerOptionsEndpoint(){

        $args = array(
            'methods' => 'GET',
            'callback' => array($this, 'newsOptionsEndpoint')
        );

        register_rest_route( 'wp/v2', 'newsOptions', $args );
    }

    function newsOptionsEndpoint( $request ) {
        $newsOptions = array (
            "enabled" => get_field( "newsreel_enabled", 'option' ),
            "animation_pause_time" => get_field("animation_pause_time", 'option'), 
            "animation_transition_time" => get_field("animation_transition_time", 'option')
        ); 
        return $newsOptions; 
    }

}

