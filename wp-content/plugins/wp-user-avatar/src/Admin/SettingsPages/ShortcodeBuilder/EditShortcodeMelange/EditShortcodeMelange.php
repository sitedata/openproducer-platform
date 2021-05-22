<?php

namespace ProfilePress\Core\Admin\SettingsPages\ShortcodeBuilder\EditShortcodeMelange;

use ProfilePress\Core\Admin\SettingsPages\ShortcodeBuilder\ShortcodeInserterTrait;
use ProfilePress\Core\Classes\FormRepository;

class EditShortcodeMelange
{
    use ShortcodeInserterTrait;

    private $melange_errors;

    public function __construct()
    {
        add_action('admin_init', [$this, 'save_edit']);
        add_action('ppress_admin_notices', [$this, 'admin_notices']);
    }

    public function available_shortcodes()
    {
        return apply_filters('ppress_melange_available_shortcodes', [
                'pp-login-form'          => [
                    'description' => esc_html__('All login form shortcodes, HTML and CSS codes should be inside of this shortcode. That is [pp-login-form]...[/pp-login-form]', 'wp-user-avatar'),
                    'shortcode'   => 'pp-login-form',
                ],
                'pp-registration-form'   => [
                    'description' => esc_html__('All registration form shortcodes, HTML and CSS codes should be inside of this shortcode. That is [pp-registration-form]...[/pp-registration-form]', 'wp-user-avatar'),
                    'shortcode'   => 'pp-registration-form',
                ],
                'pp-password-reset-form' => [
                    'description' => esc_html__('All password reset form shortcodes, HTML and CSS codes should be inside of this shortcode. That is [pp-password-reset-form]...[/pp-password-reset-form]', 'wp-user-avatar'),
                    'shortcode'   => 'pp-password-reset-form',
                ],
                'pp-edit-profile-form'   => [
                    'description' => esc_html__('All edit profile form shortcodes, HTML and CSS codes should be inside of this shortcode. That is [pp-password-reset-form]...[/pp-password-reset-form]', 'wp-user-avatar'),
                    'shortcode'   => 'pp-edit-profile-form',
                ],
            ]) + self::global_shortcodes();
    }

    public function admin_notices()
    {
        if (isset($this->melange_errors)) {
            echo '<div id="message" class="error notice is-dismissible"><p><strong>' . $this->melange_errors . '</strong></p></div>';

            return;
        }

        if (@$_GET['view'] == 'edit-shortcode-melange' && @$_GET['form-edited']) {
            echo '<div id="message" class="updated notice is-dismissible"><p><strong>' . esc_html__('Form updated', 'wp-user-avatar') . '</strong></p></div>';
        }
    }

    public function edit_screen()
    {
        $this->traitInit($this->available_shortcodes());
        require PPRESS_ADMIN_SETTINGS_PAGE_FOLDER . 'ShortcodeBuilder/EditShortcodeMelange/edit_screen.php';
    }

    public function save_edit()
    {
        if ( ! current_user_can('manage_options') || ! isset($_POST['edit_melange']) || ! ppress_verify_nonce()) return;

        $id                           = absint($_GET['id']);
        $title                        = @sanitize_text_field($_POST['mfb_title']);
        $structure                    = @stripslashes($_POST['mfb_structure']);
        $css                          = @stripslashes($_POST['mfb_css']);
        $registration_msg             = @stripslashes($_POST['mfb_success_registration']);
        $password_reset_msg           = @stripslashes($_POST['mfb_success_password_reset']);
        $edit_profile_msg             = @stripslashes($_POST['mfb_success_edit_profile']);
        $disable_username_requirement = esc_attr(@$_POST['mfb_disable_username_requirement']);

        // catch and save form generated errors in property @melange_errors
        if (empty($title)) {
            $this->melange_errors = esc_html__('Title is empty', 'wp-user-avatar');
        } elseif (empty($structure)) {
            $this->melange_errors = esc_html__('Melange Design is missing', 'wp-user-avatar');
        }

        if (isset($this->melange_errors)) return;

        FormRepository::update_form(
            $id,
            FormRepository::MELANGE_TYPE,
            $title,
            apply_filters('ppress_shortcode_builder_registration_meta', [
                FormRepository::FORM_STRUCTURE                         => $structure,
                FormRepository::FORM_CSS                               => $css,
                FormRepository::PROCESSING_LABEL                       => sanitize_text_field($_POST['processing_label']),
                FormRepository::MELANGE_EDIT_PROFILE_SUCCESS_MESSAGE   => $edit_profile_msg,
                FormRepository::MELANGE_PASSWORD_RESET_SUCCESS_MESSAGE => $password_reset_msg,
                FormRepository::MELANGE_REGISTRATION_SUCCESS_MESSAGE   => $registration_msg,
                FormRepository::DISABLE_USERNAME_REQUIREMENT           => $disable_username_requirement == 'yes'
            ])
        );

        wp_safe_redirect(esc_url_raw(add_query_arg('form-edited', 'true')));
        exit;
    }

    /**
     * @return EditShortcodeMelange
     */
    public static function get_instance()
    {
        static $instance = null;

        if (is_null($instance)) {
            $instance = new self();
        }

        return $instance;
    }
}