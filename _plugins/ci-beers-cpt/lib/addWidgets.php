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

            echo $args['before_widget'];
            if (!empty($title))
                echo $args['before_title'] . $title . $args['after_title'];
            echo ciGetBeersHTML();
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

            return $instance;
        }
    }
}



function ci_register_beers_widget() {
    register_widget( 'CiBeersWidget' );
}
add_action( 'widgets_init', 'ci_register_beers_widget' );
