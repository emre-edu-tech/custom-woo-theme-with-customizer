(function ($) {
    // this below code checks that all settings and controls are loaded
    wp.customize.bind('ready', function() {

        // We get the setting that we created at the backend and bind a function to this setting
        // In this function we set other settings dependent on original setting - in this case 
        // it is set_number_of_slides and
        // manipulate the controls and dependent on those settings.
        wp.customize('set_number_of_slides', function(setting) {
            // runs for ONCE at the begininng and hides all the slide activate controls
            if(setting.get() == 0) {
                for (let index = 1; index < 21; index++) {
                    // deactivate all the slide activation controls if its setting value is 0
                    wp.customize('set_slide_'+index+'_activate', function(setting) {
                        setting.set(0)
                    });
                    wp.customize.control('set_slide_'+index+'_activate').container.hide();
                }
            } else {
                for (let index = setting.get() + 1; index < 21; index++) {
                    // deactivate all the slide activation controls if its setting value is 0
                    wp.customize.control('set_slide_'+index+'_activate').container.hide();
                }
            }
            // Then when the new value is chosen from number_of_slides dropdown then the corresponding
            // slide activation controls is shown
            setting.bind(function(newVal) {
                
                if(newVal > 0) {
                    // first hide all controls - not a good way - but can not find how to check the
                    // last value
                    for (let index = 1; index < 21; index++) {
                        // deactivate all the slide activation controls
                        wp.customize.control('set_slide_'+index+'_activate').container.hide();
                        wp.customize.control('set_slide_'+index+'_bg_image').container.hide();
                        wp.customize.control('set_slide_'+index+'_title').container.hide();
                        wp.customize.control('set_slide_'+index+'_btn_text').container.hide();
                        wp.customize.control('set_slide_'+index+'_btn_url').container.hide();
                    }
                    // then show again to the desired number again but check for the checked
                    // values of slide activation controls to show the sub controls
                    for (let index = 1; index <= newVal; index++) {
                        wp.customize.control('set_slide_'+index+'_activate').container.show();
                        wp.customize('set_slide_'+index+'_activate', function(setting) {
                            if(setting.get() == 1) {
                                wp.customize.control('set_slide_'+index+'_bg_image').container.show();
                                wp.customize.control('set_slide_'+index+'_title').container.show();
                                wp.customize.control('set_slide_'+index+'_btn_text').container.show();
                                wp.customize.control('set_slide_'+index+'_btn_url').container.show();
                            }
                        });
                    }
                } else {
                    // hide/deactivate ALL the slide controls if the newVal is 0
                    for (let index = 1; index < 21; index++) {
                        wp.customize.control('set_slide_'+index+'_activate').container.hide();
                        wp.customize.control('set_slide_'+index+'_bg_image').container.hide();
                        wp.customize.control('set_slide_'+index+'_title').container.hide();
                        wp.customize.control('set_slide_'+index+'_btn_text').container.hide();
                        wp.customize.control('set_slide_'+index+'_btn_url').container.hide();
                    }
                }
            });
        });
    });
})(jQuery);