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
class GinkGos_Description_Custom_Control extends WP_Customize_Control
{
    public $type = 'ginkgos-description';

    public function render_content() {
        ?>
        <label class="customizer-text">
            <span class="ginkgos-description"><?php echo esc_html($this->label); ?></span>
        </label>
        <?php
    }
}