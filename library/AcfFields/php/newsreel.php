<?php 

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
    'key' => 'group_5ed75801bac03',
    'title' => __('Newsreel', 'municipio-action'),
    'fields' => array(
        0 => array(
            'key' => 'field_5ed7582c311e7',
            'label' => __('Enabled', 'municipio-action'),
            'name' => 'newsreel_enabled',
            'type' => 'true_false',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'message' => __('Om nyhetsslidern är aktiverad.', 'municipio-action'),
            'default_value' => 1,
            'ui' => 0,
            'ui_on_text' => '',
            'ui_off_text' => '',
        ),
        1 => array(
            'key' => 'field_5ed75886311e8',
            'label' => __('Animation pause time', 'municipio-action'),
            'name' => 'animation_pause_time',
            'type' => 'number',
            'instructions' => __('Hur länge varje nyhetsrubrik visas på skärmen, i millisekunder (så 1000 = 1 sekund).', 'municipio-action'),
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => 5000,
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'min' => 0,
            'max' => 100000,
            'step' => '',
        ),
        2 => array(
            'key' => 'field_5ed759b9a9b8b',
            'label' => __('Animation transition time', 'municipio-action'),
            'name' => 'animation_transition_time',
            'type' => 'number',
            'instructions' => __('Hur länge det tar för en nyhetsrubrik att fada ut och in, i millisekunder.', 'municipio-action'),
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => 800,
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'min' => 0,
            'max' => 10000,
            'step' => '',
        ),
    ),
    'location' => array(
        0 => array(
            0 => array(
                'param' => 'options_page',
                'operator' => '==',
                'value' => 'acf-options-theme-options',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
));
}