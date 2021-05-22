<?php

namespace ProfilePress\Core\Admin\SettingsPages\ShortcodeBuilder\EditShortcodePasswordReset;


use ProfilePress\Core\Admin\SettingsPages\ShortcodeBuilder\ShortcodeInserterTrait;
use ProfilePress\Core\Classes\FormRepository;

class EditShortcodePasswordReset
{
    use ShortcodeInserterTrait;

    private $password_reset_builder_errors;

    public function __construct()
    {
        add_action('admin_init', [$this, 'save_edit']);
        add_action('ppress_admin_notices', [$this, 'admin_notices']);
    }

    public function available_shortcodes()
    {
        return apply_filters('ppress_password_reset_available_shortcodes', [
                   'user-login'            => [
                       'description' => esc_html__('Username / Email field - Password reset form', 'wp-user-avatar'),
                       'shortcode'   => 'user-login',
                       'attributes'  => [
                           'placeholder' => [
                               'label' => esc_html__('Placeholder', 'wp-user-avatar'),
                               'field' => 'text'
                           ],
                           'id'          => [
                               'label' => esc_html__('ID', 'wp-user-avatar'),
                               'field' => 'text'
                           ],
                           'class'       => [
                               'label' => esc_html__('CSS class', 'wp-user-avatar'),
                               'field' => 'text'
                           ]
                       ]
                   ],
                   'reset-submit'          => [
                       'description' => esc_html__('Submit button - Password reset form', 'wp-user-avatar'),
                       'shortcode'   => 'reset-submit',
                       'attributes'  => [
                           'value' => [
                               'label' => esc_html__('Button label', 'wp-user-avatar'),
                               'field' => 'text'
                           ],
                           'id'    => [
                               'label' => esc_html__('ID', 'wp-user-avatar'),
                               'field' => 'text'
                           ],
                           'class' => [
                               'label' => esc_html__('CSS class', 'wp-user-avatar'),
                               'field' => 'text'
                           ],
                       ]
                   ],
                   'enter-password'        => [
                       'description' => esc_html__('Password field  - Password reset handler form', 'wp-user-avatar'),
                       'shortcode'   => 'enter-password',
                       'attributes'  => [
                           'placeholder' => [
                               'label' => esc_html__('Placeholder', 'wp-user-avatar'),
                               'field' => 'text'
                           ],
                           'id'          => [
                               'label' => esc_html__('ID', 'wp-user-avatar'),
                               'field' => 'text'
                           ],
                           'class'       => [
                               'label' => esc_html__('CSS class', 'wp-user-avatar'),
                               'field' => 'text'
                           ]
                       ]
                   ],
                   're-enter-password'     => [
                       'description' => esc_html__('Confirm password field  - Password reset handler form', 'wp-user-avatar'),
                       'shortcode'   => 're-enter-password',
                       'attributes'  => [
                           'placeholder' => [
                               'label' => esc_html__('Placeholder', 'wp-user-avatar'),
                               'field' => 'text'
                           ],
                           'id'          => [
                               'label' => esc_html__('ID', 'wp-user-avatar'),
                               'field' => 'text'
                           ],
                           'class'       => [
                               'label' => esc_html__('CSS class', 'wp-user-avatar'),
                               'field' => 'text'
                           ]
                       ]
                   ],
                   'reset-password-meter'  => [
                       'description' => esc_html__('Password strength meter  - Password reset handler form', 'wp-user-avatar'),
                       'shortcode'   => 'reset-password-meter',
                       'attributes'  => [
                           'enforce' => [
                               'label'   => esc_html__('Enforce strong password', 'wp-user-avatar'),
                               'field'   => 'select',
                               'options' => ['true' => esc_html__('Yes', 'wp-user-avatar'), 'false' => esc_html__('No', 'wp-user-avatar')]
                           ],
                           'class'   => [
                               'label' => esc_html__('CSS class', 'wp-user-avatar'),
                               'field' => 'text'
                           ]
                       ]
                   ],
                   'password-reset-submit' => [
                       'description' => esc_html__('Submit button - Password reset handler form', 'wp-user-avatar'),
                       'shortcode'   => 'password-reset-submit',
                       'attributes'  => [
                           'value' => [
                               'label' => esc_html__('Button label', 'wp-user-avatar'),
                               'field' => 'text'
                           ],
                           'id'    => [
                               'label' => esc_html__('ID', 'wp-user-avatar'),
                               'field' => 'text'
                           ],
                           'class' => [
                               'label' => esc_html__('CSS class', 'wp-user-avatar'),
                               'field' => 'text'
                           ],
                       ]
                   ],
               ]) + self::global_shortcodes();
    }

    public function admin_notices()
    {
        if (isset($this->password_reset_builder_errors)) {
            echo '<div id="message" class="error notice is-dismissible"><p><strong>' . $this->password_reset_builder_errors . '</strong></p></div>';

            return;
        }

        if (@$_GET['view'] == 'edit-shortcode-password-reset' && @$_GET['form-edited']) {
            echo '<div id="message" class="updated notice is-dismissible"><p><strong>' . esc_html__('Form updated', 'wp-user-avatar') . '</strong></p></div>';
        }
    }

    public function edit_screen()
    {
        $this->traitInit($this->available_shortcodes());

        require PPRESS_ADMIN_SETTINGS_PAGE_FOLDER . 'ShortcodeBuilder/EditShortcodePasswordReset/edit_screen.php';
    }

    public function save_edit()
    {
        if ( ! current_user_can('manage_options') || ! isset($_POST['edit_password_reset']) || ! ppress_verify_nonce()) return;

        $id = absint($_GET['id']);

        $title                  = @sanitize_text_field($_POST['prb_title']);
        $structure              = @stripslashes($_POST['prb_structure']);
        $handler_structure      = @stripslashes($_POST['prb_handler_structure']);
        $css                    = @stripslashes($_POST['prb_css']);
        $success_password_reset = @stripslashes($_POST['prb_success_password_reset']);

        // catch and save form generated errors in property @password_reset_builder_errors
        if (empty($title)) {
            $this->password_reset_builder_errors = esc_html__('Title is empty', 'wp-user-avatar');
        } elseif (empty($structure)) {
            $this->password_reset_builder_errors = esc_html__('Structure is missing', 'wp-user-avatar');
        } elseif (empty($handler_structure)) {
            $this->password_reset_builder_errors = esc_html__('Password Reset Handler Form Structure is missing', 'wp-user-avatar');
        }

        if (isset($this->password_reset_builder_errors)) return;

        FormRepository::update_form(
            $id,
            FormRepository::PASSWORD_RESET_TYPE,
            $title,
            apply_filters('ppress_shortcode_builder_registration_meta', [
                FormRepository::FORM_STRUCTURE         => $structure,
                FormRepository::FORM_CSS               => $css,
                FormRepository::PROCESSING_LABEL       => sanitize_text_field($_POST['processing_label']),
                FormRepository::SUCCESS_MESSAGE        => $success_password_reset,
                FormRepository::PASSWORD_RESET_HANDLER => $handler_structure
            ])
        );

        wp_safe_redirect(esc_url_raw(add_query_arg('form-edited', 'true')));
        exit;
    }

    /**
     * @return EditShortcodePasswordReset
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