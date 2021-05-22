<?php

use ProfilePress\Core\Classes\FormRepository;

$form_id = absint($_GET['id']);

$title     = FormRepository::get_name($form_id, FormRepository::USER_PROFILE_TYPE);
$structure = FormRepository::get_form_meta($form_id, FormRepository::USER_PROFILE_TYPE, FormRepository::FORM_STRUCTURE);
$css       = FormRepository::get_form_meta($form_id, FormRepository::USER_PROFILE_TYPE, FormRepository::FORM_CSS);

$content = isset($_POST['fep_structure']) ? stripslashes($_POST['fep_structure']) : $structure;

?>

<form method="post">
    <div class="ppSCB-margin-r">
        <div class="ppSCB-tab-box">
            <div id="titlediv">
                <div id="titlewrap">
                    <label class="screen-reader-text" id="title-prompt-text" for="title"><?= esc_html__('Enter title here', 'wp-user-avatar') ?></label>
                    <input name="fep_title" type="text" value="<?= $title ?>" id="title">
                    <input class="ppSCB-save-btn button-primary" type="submit" name="edit_user_profile_page" value="<?= esc_html__('Save Changes', 'wp-user-avatar') ?>">
                </div>
            </div>
            <h2 class="nav-tab-wrapper">
                <a class="nav-tab" href="#ppStructure"><?= esc_html__('Structure', 'wp-user-avatar') ?></a>
                <a class="nav-tab" href="#ppCSS"><?= esc_html__('CSS', 'wp-user-avatar') ?></a>

                <span class="pp-form-builder-shortcodes-btn">
                    <a href="#" id="ppress-available-shortcodes-btn" class="button button-secondary"><?= esc_html__('Available Shortcodes', 'wp-user-avatar') ?></a>
                </span>
            </h2>
            <div class="ppSCB-tab-box-div">
                <div id="ppStructure" class="ppSCB-tab-content">
                    <textarea rows="30" name="fep_structure" id="pp_fe_profile_structure"><?php echo $content ?></textarea>
                    <div class="ppSCB-clear-both"></div>
                </div>
                <div id="ppCSS" class="ppSCB-tab-content">
                    <textarea rows="30" name="fep_css" id="pp_fe_profile_css"><?php echo isset($_POST['fep_css']) ? stripslashes($_POST['fep_css']) : $css; ?></textarea>
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