<?php
namespace BuildingDesigner\Frontend;

use BuildingDesigner\Config\Steps;

class FormRenderer {
    public function render() {
        $steps = Steps::get_all_steps();
        $total_steps = count($steps);
        
        ob_start();
        ?>
        <div class="building-designer-wrapper">
            <!-- Progress Bar -->
            <div class="bd-progress-container">
                <div class="bd-progress-bar">
                    <div class="bd-progress-fill" id="bdProgressFill"></div>
                </div>
                <div class="bd-progress-text">
                    <span id="bdCurrentStep">1</span> of <?php echo $total_steps; ?>
                </div>
            </div>

            <div class="bd-form-container">
                <!-- Left Panel - Form Steps -->
                <div class="bd-form-panel">
                    <div class="bd-form-header">
                        <h2>Design Your Building</h2>
                        <p>Follow the steps to create your custom building</p>
                    </div>

                    <form id="buildingDesignerForm" class="bd-form">
                        <?php foreach ($steps as $index => $step): ?>
                            <div class="bd-step" data-step="<?php echo $index + 1; ?>" style="display: <?php echo $index === 0 ? 'block' : 'none'; ?>;">
                                <h3 class="bd-step-title"><?php echo esc_html($step->get_title()); ?></h3>
                                <p class="bd-step-description"><?php echo esc_html($step->get_description()); ?></p>

                                <?php if ($step->get_id() === 'dimensions'): ?>
                                    <!-- Special handling for dimensions step -->
                                    <div class="bd-dimensions-inputs">
                                        <div class="bd-input-group">
                                            <label for="building_width">Width (feet)</label>
                                            <input type="number" id="building_width" name="building_width" min="12" max="70" required>
                                        </div>
                                        <div class="bd-input-group">
                                            <label for="building_height">Height (feet)</label>
                                            <input type="number" id="building_height" name="building_height" min="8" max="20" required>
                                        </div>
                                        <div class="bd-input-group">
                                            <label for="building_length">Length (feet)</label>
                                            <input type="number" id="building_length" name="building_length" min="8" max="70" required>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <!-- Regular options display -->
                                    <div class="bd-options-container">
                                        <?php foreach ($step->get_options() as $option): ?>
                                            <div class="bd-option" 
                                                 data-value="<?php echo esc_attr($option->get_value()); ?>"
                                                 data-image="<?php echo esc_attr($option->get_image()); ?>">
                                                <input type="radio" 
                                                       id="<?php echo esc_attr($step->get_id() . '_' . $option->get_value()); ?>"
                                                       name="<?php echo esc_attr($step->get_id()); ?>"
                                                       value="<?php echo esc_attr($option->get_value()); ?>">
                                                <label for="<?php echo esc_attr($step->get_id() . '_' . $option->get_value()); ?>">
                                                    <span class="bd-option-label"><?php echo esc_html($option->get_label()); ?></span>
                                                    <?php if ($option->get_description()): ?>
                                                        <span class="bd-option-description"><?php echo esc_html($option->get_description()); ?></span>
                                                    <?php endif; ?>
                                                </label>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>

                        <!-- Navigation Buttons -->
                        <div class="bd-navigation">
                            <button type="button" class="bd-btn bd-btn-secondary" id="bdPrevBtn" style="display: none;">
                                Previous
                            </button>
                            <button type="button" class="bd-btn bd-btn-primary" id="bdNextBtn">
                                Next
                            </button>
                            <button type="submit" class="bd-btn bd-btn-success" id="bdSubmitBtn" style="display: none;">
                                Get Quote
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Right Panel - Image Display -->
                <div class="bd-image-panel">
                    <div class="bd-image-container">
                        <img id="bdPreviewImage" 
                             src="<?php echo BUILDING_DESIGNER_URL; ?>assets/images/default.jpg" 
                             alt="Building Preview">
                    </div>
                    <div class="bd-image-caption">
                        <h4 id="bdImageTitle">Building Preview</h4>
                        <p id="bdImageDescription">Select options to see your building</p>
                    </div>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
}