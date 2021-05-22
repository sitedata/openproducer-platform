<?php

use ProfilePress\Core\Classes\FormRepository;

$form_id = absint($_GET['id']);

$title     = FormRepository::get_name($form_id, FormRepository::LOGIN_TYPE);
$structure = FormRepository::get_form_meta($form_id, FormRepository::LOGIN_TYPE, FormRepository::FORM_STRUCTURE, true);
$css       = FormRepository::get_form_meta($form_id, FormRepository::LOGIN_TYPE, FormRepository::FORM_CSS, true);

$make_passwordless = FormRepository::is_login_passwordless($form_id) ? 'yes' : 'no';
$content           = isset($_POST['lfb_structure']) ? stripslashes($_POST['lfb_structure']) : $structure;

?>

<form method="post">
    <div class="ppSCB-margin-r">
        <div class="ppSCB-tab-box">
            <div id="titlediv">
                <div id="titlewrap">
                    <label class="screen-reader-text" id="title-prompt-text" for="title"><?= esc_html__('Enter title here', 'wp-user-avatar') ?></label>
                    <input name="lfb_title" type="text" value="<?= $title ?>" id="title">
                    <input class="ppSCB-save-btn button-primary" type="submit" name="edit_login" value="<?= esc_html__('Save Changes', 'wp-user-avatar') ?>">
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
                    <textarea rows="30" name="lfb_structure" id="pp_login_structure"><?php echo $content ?></textarea>
                    <div class="ppSCB-clear-both"></div>
                </div>
                <div id="ppCSS" class="ppSCB-tab-content">
                    <textarea rows="30" name="lfb_css" id="pp_login_css"><?php echo isset($_POST['lfb_css']) ? stripslashes($_POST['lfb_css']) : $css; ?></textarea>
                    <div class="ppSCB-clear-both"></div>
                </div>
                <div id="ppSettings" class="ppSCB-tab-content">
                    <h4 class="ppSCB-tab-content-header"><?=esc_html__('General Settings', 'wp-user-avatar')?></h4>
                    <table class="form-table">
                        <?php do_action('ppress_shortcode_builder_login_screen_before', $form_id); ?>
                        <tr>
                            <th scope="row">
                                <label for="processing_label"><?php _e('Processing Label', 'wp-user-avatar'); ?></label>
                            </th>
                            <td>
                                <input type="text" name="processing_label" id="processing_label" value="<?= FormRepository::get_processing_label($form_id, FormRepository::LOGIN_TYPE); ?>"/>
                                <p class="description"><?php _e('This is the text shown on the submit button when the form is submitted.', 'wp-user-avatar'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="description"><?php _e('Passwordless Login', 'wp-user-avatar'); ?></label>
                            </th>
                            <td>
                                <input type="checkbox" name="lfb_make_passwordless" id="make-login-passwordless" value="yes" <?php checked('yes', $make_passwordless); ?> />
                                <label for="make-login-passwordless"><strong><?php _e('Make this a passwordless login', 'wp-user-avatar'); ?></strong></label>
                                <p class="description"><?php _e('Passwordless login allows users to sign in to your WordPress site via a one-time URL sent to their email address.', 'wp-user-avatar'); ?></p>
                            </td>
                        </tr>
                        <?php do_action('ppress_shortcode_builder_login_screen_after', $form_id); ?>
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