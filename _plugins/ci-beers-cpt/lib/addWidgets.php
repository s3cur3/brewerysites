<?php

if(!class_exists('CiBeersWidget')) {
    class CiBeersWidget extends WP_Widget
    {
        /**
         * Register widget with WordPress.
         */
        function __construct()
        {
            parent::__construct(
                'CiBeersWidget', // Base ID
                __('Beers List', CI_TEXT_DOMAIN), // Name
                array('description' => __('Displays your beers', CI_TEXT_DOMAIN),) // Args
            );
        }

        /**
         * Front-end display of widget.
         *
         * @see WP_Widget::widget()
         *
         * @param array $args Widget arguments.
         * @param array $instance Saved values from database.
         */
        public function widget($args, $instance)
        {
            $title = apply_filters('widget_title', $instance['title']);

            $showDesc = $instance['show_desc'] ? true : false;
            $showImg = $instance['show_img'] ? true : false;
            $max = $instance['num_posts'] ? $instance['num_posts'] : 100;
            $descLength = $instance['desc_length'] ? $instance['desc_length'] : 120;

            echo $args['before_widget'];
            if (!empty($title))
                echo $args['before_title'] . $title . $args['after_title'];
            echo ciGetBeersHTML(1, $max, 3, $descLength, !$showDesc, $showImg, false);
            echo $args['after_widget'];
        }

        /**
         * Back-end widget form.
         *
         * @see WP_Widget::form()
         *
         * @param array $instance Previously saved values from database.
         */
        public function form($instance)
        {
            if (isset($instance['title'])) {
                $title = $instance['title'];
            } else {
                $title = __('Our Beers', CI_TEXT_DOMAIN);
            }
            if (isset($instance['num_posts'])) {
                $numPosts = $instance['num_posts'];
            } else {
                $numPosts = '5';
            }
            if (isset($instance['desc_length'])) {
                $descLength = $instance['desc_length'];
            } else {
                $descLength = '120';
            }
            if (isset($instance['show_desc'])) {
                $showDesc = $instance['show_desc'];
            } else {
                $showDesc = false;
            }
            if (isset($instance['show_img'])) {
                $showImg = $instance['show_img'];
            } else {
                $showImg = false;
            }
            ?>
                <p>
                    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', CI_TEXT_DOMAIN); ?></label>
                    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                           name="<?php echo $this->get_field_name('title'); ?>" type="text"
                           value="<?php echo esc_attr($title); ?>">
                </p>
                <p>
                    <label for="<?php echo $this->get_field_id('num_posts'); ?>"><?php _e('Number of Beers to Show:', CI_TEXT_DOMAIN); ?></label>
                    <input class="widefat" id="<?php echo $this->get_field_id('num_posts'); ?>"
                           name="<?php echo $this->get_field_name('num_posts'); ?>" type="text"
                           value="<?php echo esc_attr($numPosts); ?>">
                </p>
                <p>
                    <label for="<?php echo $this->get_field_id('show_desc'); ?>"><?php _e('Show Beer Descriptions?', CI_TEXT_DOMAIN); ?></label>
                    <input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id('show_desc'); ?>" name="<?php echo $this->get_field_name('show_desc'); ?>" <?php echo $showDesc ? 'checked="true"' : ''; ?>">
                </p>
                <p>
                    <label for="<?php echo $this->get_field_id('desc_length'); ?>"><?php _e('Max Description Length (characters):', CI_TEXT_DOMAIN); ?></label>
                    <input class="widefat" id="<?php echo $this->get_field_id('desc_length'); ?>"
                           name="<?php echo $this->get_field_name('desc_length'); ?>" type="number"
                           value="<?php echo esc_attr($descLength); ?>">
                </p>
                <p>
                    <label for="<?php echo $this->get_field_id('show_img'); ?>"><?php _e('Show Beer Images?', CI_TEXT_DOMAIN); ?></label>
                    <input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id('show_img'); ?>" name="<?php echo $this->get_field_name('show_img'); ?>" <?php echo $showImg ? 'checked="true"' : ''; ?>">
                </p>
            <?php
        }

        /**
         * Sanitize widget form values as they are saved.
         *
         * @see WP_Widget::update()
         *
         * @param array $new_instance Values just sent to be saved.
         * @param array $old_instance Previously saved values from database.
         *
         * @return array Updated safe values to be saved.
         */
        public function update($new_instance, $old_instance)
        {
            $instance = array();
            $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
            $instance['num_posts'] = (!empty($new_instance['num_posts'])) ? strip_tags($new_instance['num_posts']) : '';
            $instance['desc_length'] = (!empty($new_instance['desc_length'])) ? strip_tags($new_instance['desc_length']) : '';
            $instance['show_desc'] = (!empty($new_instance['show_desc'])) ? strip_tags($new_instance['show_desc']) : '';
            $instance['show_img'] = (!empty($new_instance['show_img'])) ? strip_tags($new_instance['show_img']) : '';

            return $instance;
        }
    }
}



function ci_register_beers_widget() {
    register_widget( 'CiBeersWidget' );
}
add_action( 'widgets_init', 'ci_register_beers_widget' );
