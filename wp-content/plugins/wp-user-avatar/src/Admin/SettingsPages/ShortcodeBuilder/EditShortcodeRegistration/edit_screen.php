<?php

use ProfilePress\Core\Classes\FormRepository;

$form_id = absint($_GET['id']);

$title     = FormRepository::get_name($form_id, FormRepository::REGISTRATION_TYPE);
$structure = FormRepository::get_form_meta($form_id, FormRepository::REGISTRATION_TYPE, FormRepository::FORM_STRUCTURE);
$css       = FormRepository::get_form_meta($form_id, FormRepository::REGISTRATION_TYPE, FormRepository::FORM_CSS);

$new_user_role                = FormRepository::get_form_meta($form_id, FormRepository::REGISTRATION_TYPE, FormRepository::REGISTRATION_USER_ROLE);
$success_message              = FormRepository::get_form_meta($form_id, FormRepository::REGISTRATION_TYPE, FormRepository::SUCCESS_MESSAGE);
$disable_username_requirement = FormRepository::get_form_meta($form_id, FormRepository::REGISTRATION_TYPE, FormRepository::DISABLE_USERNAME_REQUIREMENT) ? 'yes' : 'no';

$selected = get_option('default_role');
if ( ! empty($new_user_role)) $selected = $new_user_role;

if (isset($_POST['rfb_new_user_role'])) $selected = sanitize_text_field($_POST['rfb_new_user_role']);

$title = isset($_POST['rfb_title']) ? sanitize_title($_POST['rfb_title']) : $title;

$content = isset($_POST['rfb_structure']) ? stripslashes($_POST['rfb_structure']) : $structure;
?>

<form method="post">
    <div class="ppSCB-margin-r">
        <div class="ppSCB-tab-box">
            <div id="titlediv">
                <div id="titlewrap">
                    <label class="screen-reader-text" id="title-prompt-text" for="title"><?= esc_html__('Enter title here', 'wp-user-avatar') ?></label>
                    <input name="rfb_title" type="text" value="<?= $title ?>" id="title">
                    <input class="ppSCB-save-btn button-primary" type="submit" name="edit_registration" value="<?= esc_html__('Save Changes', 'wp-user-avatar') ?>">
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
                    <textarea rows="30" name="rfb_structure" id="pp_registration_structure"><?php echo $content ?></textarea>
                    <div class="ppSCB-clear-both"></div>
                </div>
                <div id="ppCSS" class="ppSCB-tab-content">
                    <textarea rows="30" name="rfb_css" id="pp_registration_css"><?php echo isset($_POST['rfb_css']) ? stripslashes($_POST['rfb_css']) : $css; ?></textarea>
                    <div class="ppSCB-clear-both"></div>
                </div>
                <div id="ppSettings" class="ppSCB-tab-content">
                    <h4 class="ppSCB-tab-content-header"><?=esc_html__('General Settings', 'wp-user-avatar')?></h4>
                    <table class="form-table">
                        <?php do_action('ppress_shortcode_builder_registration_screen_before', $form_id); ?>
                        <tr>
                            <th scope="row">
                                <label for="processing_label"><?php _e('Processing Label', 'wp-user-avatar'); ?></label>
                            </th>
                            <td>
                                <input type="text" name="processing_label" id="processing_label" value="<?= FormRepository::get_processing_label($form_id, FormRepository::REGISTRATION_TYPE); ?>"/>
                                <p class="description"><?php _e('This is the text shown on the submit button when the form is submitted.', 'wp-user-avatar'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="message_success"><?php esc_attr_e('Success message', 'wp-user-avatar'); ?></label>
                            </th>
                            <td>
                                <textarea name="rfb_success_registration" id="message_success"><?= $success_message ?></textarea>
                                <p class="description"><?php esc_attr_e('Message to display on successful user registration.', 'wp-user-avatar'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="new_user_role"><?php esc_attr_e('New User Role', 'wp-user-avatar'); ?></label>
                            </th>
                            <td>
                                <select name="rfb_new_user_role" id="new_user_role"><?php wp_dropdown_roles($selected); ?></select>
                                <p class="description"><?php esc_attr_e('Role of users registered through this form.', 'wp-user-avatar'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="disable_username_requirement"><?php esc_attr_e('Disable Username Requirement', 'wp-user-avatar'); ?></label>
                            </th>
                            <td>
                                <input type="checkbox" name="rfb_disable_username_requirement" id="disable_username_requirement" value="yes" <?php checked('yes', $disable_username_requirement); ?> />
                                <label for="disable_username_requirement"><strong><?php _e('Check to Disable', 'wp-user-avatar'); ?></strong></label>

                                <p class="description">
                                    <?php _e('Disable requirement for users to enter a username during registration. Usernames will automatically be generated from their email addresses.', 'wp-user-avatar'); ?>
                                </p>
                            </td>
                        </tr>
                        <?php do_action('ppress_shortcode_builder_registration_screen_after', $form_id); ?>
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