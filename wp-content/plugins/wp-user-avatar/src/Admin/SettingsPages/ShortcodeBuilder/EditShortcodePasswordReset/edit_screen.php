<?php

use ProfilePress\Core\Classes\FormRepository;

$form_id = absint($_GET['id']);

$title                  = FormRepository::get_name($form_id, FormRepository::PASSWORD_RESET_TYPE);
$structure              = FormRepository::get_form_meta($form_id, FormRepository::PASSWORD_RESET_TYPE, FormRepository::FORM_STRUCTURE);
$password_reset_handler = FormRepository::get_form_meta($form_id, FormRepository::PASSWORD_RESET_TYPE, FormRepository::PASSWORD_RESET_HANDLER);
$css                    = FormRepository::get_form_meta($form_id, FormRepository::PASSWORD_RESET_TYPE, FormRepository::FORM_CSS);

$success_message = FormRepository::get_form_meta($form_id, FormRepository::PASSWORD_RESET_TYPE, FormRepository::SUCCESS_MESSAGE);

$content = isset($_POST['prb_structure']) ? stripslashes($_POST['prb_structure']) : $structure;
?>

<form method="post">
    <div class="ppSCB-margin-r passwordReset">
        <div class="ppSCB-tab-box">
            <div id="titlediv">
                <div id="titlewrap">
                    <label class="screen-reader-text" id="title-prompt-text" for="title"><?= esc_html__('Enter title here', 'wp-user-avatar') ?></label>
                    <input name="prb_title" type="text" value="<?= $title ?>" id="title">
                    <input class="ppSCB-save-btn button-primary" type="submit" name="edit_password_reset" value="<?= esc_html__('Save Changes', 'wp-user-avatar') ?>">
                </div>
            </div>
            <h2 class="nav-tab-wrapper">
                <a class="nav-tab" href="#ppStructure"><?= esc_html__('Structure', 'wp-user-avatar') ?></a>
                <a class="nav-tab" href="#ppHandlerStructure"><?= esc_html__('Password Reset Handler Form', 'wp-user-avatar') ?></a>
                <a class="nav-tab" href="#ppCSS"><?= esc_html__('CSS', 'wp-user-avatar') ?></a>
                <a class="nav-tab" href="#ppSettings"><?= esc_html__('Settings', 'wp-user-avatar') ?></a>


                <span class="pp-form-builder-shortcodes-btn">
                    <a href="#" id="ppress-available-shortcodes-btn" class="button button-secondary"><?= esc_html__('Available Shortcodes', 'wp-user-avatar') ?></a>
                </span>
            </h2>
            <div class="ppSCB-tab-box-div">
                <div id="ppStructure" class="ppSCB-tab-content">
                    <textarea rows="30" name="prb_structure" id="pp_password_structure"><?php echo $content ?></textarea>
                    <div class="ppSCB-clear-both"></div>
                </div>
                <div id="ppHandlerStructure" class="ppSCB-tab-content">
                    <?php $content2 = isset($_POST['prb_handler_structure']) ? stripslashes($_POST['prb_handler_structure']) : $password_reset_handler; ?>
                    <textarea rows="30" name="prb_handler_structure" id="pp_password_handler_structure"><?php echo $content2 ?></textarea>
                    <div class="ppSCB-clear-both"></div>
                </div>
                <div id="ppCSS" class="ppSCB-tab-content">
                    <textarea rows="30" name="prb_css" id="pp_password_css"><?php echo isset($_POST['prb_css']) ? stripslashes($_POST['prb_css']) : $css; ?></textarea>
                    <div class="ppSCB-clear-both"></div>
                </div>
                <div id="ppSettings" class="ppSCB-tab-content">
                    <h4 class="ppSCB-tab-content-header"><?=esc_html__('General Settings', 'wp-user-avatar')?></h4>
                    <table class="form-table">
                        <?php do_action('ppress_shortcode_builder_password_reset_screen_before', $form_id); ?>
                        <tr>
                            <th scope="row">
                                <label for="processing_label"><?php _e('Processing Label', 'wp-user-avatar'); ?></label>
                            </th>
                            <td>
                                <input type="text" name="processing_label" id="processing_label" value="<?= FormRepository::get_processing_label($form_id, FormRepository::PASSWORD_RESET_TYPE); ?>"/>
                                <p class="description"><?php _e('This is the text shown on the submit button when the form is submitted.', 'wp-user-avatar'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="message_success"><?= esc_html__('Success Message', 'wp-user-avatar') ?></label>
                            </th>
                            <td>
                                <textarea name="prb_success_password_reset" id="message_success"><?php echo isset($_POST['prb_success_password_reset']) ? stripslashes(esc_textarea($_POST['prb_success_password_reset'])) : $success_message; ?></textarea>
                                <p class="description"><?= esc_html__('Message to display on successful user password reset.', 'wp-user-avatar') ?></p>
                            </td>
                        </tr>
                        <?php do_action('ppress_shortcode_builder_password_reset_screen_after', $form_id); ?>
                    </table>
                    <div class="ppSCB-clear-both"></div>
                </div>
            </div>
        </div>
        <div class="ppSCB-sidebar password-reset">
            <div class="ppSCB-preview-header">
                <div class="ppSCB-preview-h-left">
                    <h3><?= esc_html__('Reset Form Preview', 'wp-user-avatar') ?></h3></div>
                <div class="ppSCB-preview-h-right"><h3><?= esc_html__('Handler Form Preview', 'wp-user-avatar') ?></h3>
                </div>
            </div>
            <iframe id="indexIframe"></iframe>
            <iframe id="handlerIframe"></iframe>
        </div>
    </div>
</form>