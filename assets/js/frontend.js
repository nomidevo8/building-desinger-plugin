(function($) {
    'use strict';

    class BuildingDesignerForm {
        constructor() {
            this.currentStep = 1;
            this.totalSteps = $('.bd-step').length;
            this.formData = {};
            
            this.init();
        }

        init() {
            this.bindEvents();
            this.updateProgress();
        }

        bindEvents() {
            $('#bdNextBtn').on('click', () => this.nextStep());
            $('#bdPrevBtn').on('click', () => this.prevStep());
            $('#buildingDesignerForm').on('submit', (e) => this.handleSubmit(e));
            
            // Option selection with image change
            $('.bd-option').on('click', function() {
                const $option = $(this);
                const $input = $option.find('input[type="radio"]');
                const imageName = $option.data('image');
                
                // Select the radio button
                $input.prop('checked', true);
                
                // Update image
                if (imageName) {
                    const imageUrl = buildingDesigner.pluginUrl + 'assets/images/' + imageName;
                    $('#bdPreviewImage').fadeOut(200, function() {
                        $(this).attr('src', imageUrl).fadeIn(200);
                    });
                    
                    // Update caption
                    const label = $option.find('.bd-option-label').text();
                    const description = $option.find('.bd-option-description').text();
                    $('#bdImageTitle').text(label);
                    $('#bdImageDescription').text(description);
                }
                
                // Highlight selected option
                $option.closest('.bd-options-container').find('.bd-option').removeClass('active');
                $option.addClass('active');
            });

            // Dimension inputs
            $('input[type="number"]').on('input', function() {
                const width = $('#building_width').val();
                const height = $('#building_height').val();
                const length = $('#building_length').val();
                
                if (width && height && length) {
                    $('#bdImageDescription').text(
                        `${width}' W × ${length}' L × ${height}' H`
                    );
                }
            });
        }

        nextStep() {
            // Validate current step
            if (!this.validateStep()) {
                alert('Please select an option before continuing.');
                return;
            }

            // Save current step data
            this.saveStepData();

            // Move to next step
            if (this.currentStep < this.totalSteps) {
                this.currentStep++;
                this.showStep();
                this.updateProgress();
            }
        }

        prevStep() {
            if (this.currentStep > 1) {
                this.currentStep--;
                this.showStep();
                this.updateProgress();
            }
        }

        showStep() {
            $('.bd-step').hide();
            $(`.bd-step[data-step="${this.currentStep}"]`).fadeIn(300);

            // Update navigation buttons
            $('#bdPrevBtn').toggle(this.currentStep > 1);
            $('#bdNextBtn').toggle(this.currentStep < this.totalSteps);
            $('#bdSubmitBtn').toggle(this.currentStep === this.totalSteps);
        }

        validateStep() {
            const $currentStep = $(`.bd-step[data-step="${this.currentStep}"]`);
            const $inputs = $currentStep.find('input[type="radio"], input[type="number"]');
            
            if ($inputs.filter('[type="radio"]').length > 0) {
                return $inputs.filter(':checked').length > 0;
            }
            
            if ($inputs.filter('[type="number"]').length > 0) {
                let allFilled = true;
                $inputs.each(function() {
                    if (!$(this).val()) {
                        allFilled = false;
                    }
                });
                return allFilled;
            }
            
            return true;
        }

        saveStepData() {
            const $currentStep = $(`.bd-step[data-step="${this.currentStep}"]`);
            const stepId = $currentStep.find('input').first().attr('name');
            
            $currentStep.find('input:checked, input[type="number"]').each((i, el) => {
                const $el = $(el);
                if ($el.attr('type') === 'radio') {
                    this.formData[stepId] = $el.val();
                } else {
                    this.formData[$el.attr('name')] = $el.val();
                }
            });
        }

        updateProgress() {
            const progress = (this.currentStep / this.totalSteps) * 100;
            $('#bdProgressFill').css('width', progress + '%');
            $('#bdCurrentStep').text(this.currentStep);
        }

        handleSubmit(e) {
            e.preventDefault();
            
            if (!this.validateStep()) {
                alert('Please complete all fields.');
                return;
            }

            this.saveStepData();

            // Show loading state
            $('#bdSubmitBtn').prop('disabled', true).text('Processing...');

            // Submit via AJAX
            $.ajax({
                url: buildingDesigner.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'building_designer_submit',
                    nonce: buildingDesigner.nonce,
                    formData: this.formData
                },
                success: (response) => {
                    if (response.success) {
                        alert('Thank you! Your building design has been submitted. We will contact you soon.');
                        location.reload();
                    } else {
                        alert('Error: ' + response.data.message);
                        $('#bdSubmitBtn').prop('disabled', false).text('Get Quote');
                    }
                },
                error: () => {
                    alert('An error occurred. Please try again.');
                    $('#bdSubmitBtn').prop('disabled', false).text('Get Quote');
                }
            });
        }
    }

    // Initialize when document is ready
    $(document).ready(() => {
        new BuildingDesignerForm();
    });

})(jQuery);