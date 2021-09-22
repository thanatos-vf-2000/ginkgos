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
class GinkGos_Heading_Custom_Control extends WP_Customize_Control
{
    public $type = 'ginkgos-heading';
    
    public function render_content() {

        ?>
        <div class="ginkgos-heading-wrapper wp-ui-highlight null">
            <label class="customizer-text">
                <span class="customize-control-title wp-ui-text-highlight"><?php echo esc_html($this->label); ?></span>
            </label>
        </div>
        <?php
    }
}