<?php
/**
 * @package ginkgos
 * @since 0.0.1
 */

namespace GINKGOS\Api\CustomControl;

use WP_Customize_Control;

/**
 * Class to create a custom layout control
 */
class GinkGos_Divider_Custom_Control extends WP_Customize_Control
{
        public function render_content() {

        ?>
        <hr><label class="customizer-text"></label>
        <?php
    }
}