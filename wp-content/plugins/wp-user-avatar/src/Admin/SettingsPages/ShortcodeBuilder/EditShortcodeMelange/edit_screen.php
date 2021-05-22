<?php

use ProfilePress\Core\Classes\FormRepository;

$form_id = absint($_GET['id']);

$title     = FormRepository::get_name($form_id, FormRepository::MELANGE_TYPE);
$structure = FormRepository::get_form_meta($form_id, FormRepository::MELANGE_TYPE, FormRepository::FORM_STRUCTURE);
$css       = FormRepository::get_form_meta($form_id, FormRepository::MELANGE_TYPE, FormRepository::FORM_CSS);

$registration_success_message   = FormRepository::get_form_meta($form_id, FormRepository::MELANGE_TYPE, FormRepository::MELANGE_REGISTRATION_SUCCESS_MESSAGE);
$edit_profile_success_message   = FormRepository::get_form_meta($form_id, FormRepository::MELANGE_TYPE, FormRepository::MELANGE_EDIT_PROFILE_SUCCESS_MESSAGE);
$password_reset_success_message = FormRepository::get_form_meta($form_id, FormRepository::MELANGE_TYPE, FormRepository::MELANGE_PASSWORD_RESET_SUCCESS_MESSAGE);
$disable_username_requirement   = FormRepository::get_form_meta($form_id, FormRepository::MELANGE_TYPE, FormRepository::DISABLE_USERNAME_REQUIREMENT) ? 'yes' : 'no';

$title   = isset($_POST['mfb_title']) ? esc_attr($_POST['mfb_title']) : $title;
$content = isset($_POST['mfb_structure']) ? stripslashes($_POST['mfb_structure']) : $structure;
?>

<form method="post">
    <div class="ppSCB-margin-r">
        <div class="ppSCB-tab-box">
            <div id="titlediv">
                <div id="titlewrap">
                    <label class="screen-reader-text" id="title-prompt-text" for="title"><?= esc_html__('Enter title here', 'wp-user-avatar') ?></label>
                    <input name="mfb_title" type="text" value="<?= $title ?>" id="title">
                    <input class="ppSCB-save-btn button-primary" type="submit" name="edit_melange" value="<?= esc_html__('Save Changes', 'wp-user-avatar') ?>">
                </div>
            </div>
            <h2 class="nav-tab-wrapper">
                <a class="nav-tab" href="#ppStructure"><?= esc_html__('Structure', 'wp-user-avatar') ?></a>
                <a class="nav-tab" href="#ppCSS"><?= esc_html__('CSS', 'wp-user-avatar') ?></a>
                <a class="nav-tab" href="#ppSettings"><?= esc_html__('Settings', 'wp-user-avatar') ?></a>

                <span class="pp-form-builder-shortcodes-btn">
                    <a href="#" id="ppress-available-shortcodes-btn" class="button button-secondary"><?= esc_html__('Available Shortcodes', 'wp-user-avatar') ?></a>
                </span>
            </h2>
            <div class="ppSCB-tab-box-div">
                <div id="ppStructure" class="ppSCB-tab-content">
                    <textarea rows="30" name="mfb_structure" id="pp_melange_structure"><?php echo $content ?></textarea>
                    <div class="ppSCB-clear-both"></div>
                </div>
                <div id="ppCSS" class="ppSCB-tab-content">
                    <textarea rows="30" name="mfb_css" id="pp_melange_css"><?php echo isset($_POST['mfb_css']) ? stripslashes($_POST['mfb_css']) : $css; ?></textarea>
                    <div class="ppSCB-clear-both"></div>
                </div>
                <div id="ppSettings" class="ppSCB-tab-content">
                    <h4 class="ppSCB-tab-content-header"><?=esc_html__('General Settings', 'wp-user-avatar')?></h4>
                    <table class="form-table">
                        <?php do_action('ppress_shortcode_builder_melange_screen_before', $form_id); ?>
                        <tr>
                            <th scope="row">
                                <label for="processing_label"><?php _e('Processing Label', 'wp-user-avatar'); ?></label>
                            </th>
                            <td>
                                <input type="text" name="processing_label" id="processing_label" value="<?= FormRepository::get_processing_label($form_id, FormRepository::MELANGE_TYPE); ?>"/>
                                <p class="description"><?php _e('This is the text shown on the submit button when the form is submitted.', 'wp-user-avatar'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="reg_message_success"><?php _e('Registration Success Message', 'wp-user-avatar'); ?></label>
                            </th>
                            <td>
                                <textarea name="mfb_success_registration" id="reg_message_success"><?php echo isset($_POST['mfb_success_registration']) ? $_POST['mfb_success_registration'] : $registration_success_message; ?></textarea>

                                <p class="description"><?php _e('Message displayed on successful user registration.', 'wp-user-avatar'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="mfb_success_password_reset"><?php _e('Password-reset Success Message', 'wp-user-avatar'); ?></label>
                            </th>
                            <td>
                                <textarea name="mfb_success_password_reset" id="mfb_success_password_reset"><?php echo isset($_POST['mfb_success_password_reset']) ? $_POST['mfb_success_password_reset'] : $password_reset_success_message; ?></textarea>

                                <p class="description"><?php _e('Message displayed on successful user password reset.', 'wp-user-avatar'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="mfb_success_edit_profile"><?php _e('Edit-profile Success Message', 'wp-user-avatar'); ?></label>
                            </th>
                            <td>
                                <textarea name="mfb_success_edit_profile" id="mfb_success_edit_profile"><?php echo isset($_POST['mfb_success_edit_profile']) ? $_POST['mfb_success_edit_profile'] : $edit_profile_success_message; ?></textarea>

                                <p class="description"><?php _e('Message displayed on users successfully editing their profile', 'wp-user-avatar'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="disable_username_requirement_melange"><?php _e('Disable Username Requirement', 'wp-user-avatar'); ?></label>
                            </th>
                            <td>
                                <input type="checkbox" name="mfb_disable_username_requirement" id="disable_username_requirement_melange" value="yes" <?php checked('yes', $disable_username_requirement); ?> />
                                <label for="disable_username_requirement_melange"><strong><?php _e('Check to Disable', 'wp-user-avatar'); ?></strong></label>

                                <p class="description"><?php _e('Disable requirement for users to enter a username during registration. Usernames will automatically be generated from their email addresses.', 'wp-user-avatar'); ?></p>
                            </td>
                        </tr>
                        <?php do_action('ppress_shortcode_builder_melange_screen_after', $form_id); ?>
                    </table>
                    <div class="ppSCB-clear-both"></div>
                </div>
            </div>
        </div>
        <div class="ppSCB-sidebar">
            <h3><?= esc_html__('Preview', 'wp-user-avatar') ?></h3>
            <iframe id="indexIframe"></iframe>
        </div>
    </div>
</form>