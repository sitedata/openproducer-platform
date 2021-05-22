<?php

use ProfilePress\Core\Classes\FormRepository;

$form_id = absint($_GET['id']);

$title     = FormRepository::get_name($form_id, FormRepository::EDIT_PROFILE_TYPE);
$structure = FormRepository::get_form_meta($form_id, FormRepository::EDIT_PROFILE_TYPE, FormRepository::FORM_STRUCTURE);
$css       = FormRepository::get_form_meta($form_id, FormRepository::EDIT_PROFILE_TYPE, FormRepository::FORM_CSS);

$success_message = FormRepository::get_form_meta($form_id, FormRepository::EDIT_PROFILE_TYPE, FormRepository::SUCCESS_MESSAGE);

$title = isset($_POST['eup_title']) ? esc_attr($_POST['eup_title']) : $title;
$content = isset($_POST['eup_structure']) ? stripslashes($_POST['eup_structure']) : $structure;
?>

<form method="post">
    <div class="ppSCB-margin-r">
        <div class="ppSCB-tab-box">
            <div id="titlediv">
                <div id="titlewrap">
                    <label class="screen-reader-text" id="title-prompt-text" for="title"><?= esc_html__('Enter title here', 'wp-user-avatar') ?></label>
                    <input name="eup_title" type="text" value="<?= $title ?>" id="title">
                    <input class="ppSCB-save-btn button-primary" type="submit" name="edit_user_profile" value="<?= esc_html__('Save Changes', 'wp-user-avatar') ?>">
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
                    <textarea rows="30" name="eup_structure" id="pp_edit_profile_structure"><?php echo $content ?></textarea>
                    <div class="ppSCB-clear-both"></div>
                </div>
                <div id="ppCSS" class="ppSCB-tab-content">
                    <textarea rows="30" name="eup_css" id="pp_edit_profile_css"><?php echo isset($_POST['eup_css']) ? stripslashes($_POST['eup_css']) : $css; ?></textarea>
                    <div class="ppSCB-clear-both"></div>
                </div>
                <div id="ppSettings" class="ppSCB-tab-content">
                    <h4 class="ppSCB-tab-content-header"><?=esc_html__('General Settings', 'wp-user-avatar')?></h4>
                    <table class="form-table">
                        <?php do_action('ppress_shortcode_builder_edit_profile_screen_before', $form_id); ?>
                        <tr>
                            <th scope="row">
                                <label for="processing_label"><?php _e('Processing Label', 'wp-user-avatar'); ?></label>
                            </th>
                            <td>
                                <input type="text" name="processing_label" id="processing_label" value="<?= FormRepository::get_processing_label($form_id, FormRepository::EDIT_PROFILE_TYPE); ?>"/>
                                <p class="description"><?php _e('This is the text shown on the submit button when the form is submitted.', 'wp-user-avatar'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="message_success"><?=__('Success Message', 'wp-user-avatar')?></label>
                            </th>
                            <td>
                                <textarea name="eup_success_edit_profile" id="message_success"><?php echo isset($_POST['eup_success_edit_profile']) ? $_POST['eup_success_edit_profile'] : stripslashes(esc_textarea($success_message)); ?></textarea>
                                <p class="description"><?=__('Message to display when a user profile is edited.', 'wp-user-avatar')?></p>
                            </td>
                        </tr>
                        <?php do_action('ppress_shortcode_builder_edit_profile_screen_after', $form_id); ?>
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