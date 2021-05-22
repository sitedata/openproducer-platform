<?php

namespace ProfilePress\Core\Admin\SettingsPages\ShortcodeBuilder\EditShortcodeLogin;


use ProfilePress\Core\Admin\SettingsPages\ShortcodeBuilder\ShortcodeInserterTrait;
use ProfilePress\Core\Classes\FormRepository;

class EditShortcodeLogin
{
    use ShortcodeInserterTrait;

    private $login_builder_errors;

    public function __construct()
    {
        add_action('admin_init', [$this, 'save_edit']);
        add_action('ppress_admin_notices', [$this, 'admin_notices']);
    }

    public function available_shortcodes()
    {
        return apply_filters('ppress_login_available_shortcodes', [
                'login-username' => [
                    'description' => esc_html__('Username / Email address field', 'wp-user-avatar'),
                    'shortcode'   => 'login-username',
                    'attributes'  => self::popular_attributes()
                ],
                'login-password' => [
                    'description' => esc_html__('Password field', 'wp-user-avatar'),
                    'shortcode'   => 'login-password',
                    'attributes'  => self::popular_attributes()
                ],
                'login-remember' => [
                    'description' => esc_html__('Remeber Me checkbox', 'wp-user-avatar'),
                    'shortcode'   => 'login-remember',
                    'attributes'  => [
                        'id'    => [
                            'label' => esc_html__('ID', 'wp-user-avatar'),
                            'field' => 'text'
                        ],
                        'class' => [
                            'label' => esc_html__('CSS class', 'wp-user-avatar'),
                            'field' => 'text'
                        ]
                    ]
                ],
                'login-submit'   => [
                    'description' => esc_html__('Form submit button', 'wp-user-avatar'),
                    'shortcode'   => 'login-submit',
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
        if (isset($this->login_builder_errors)) {
            echo '<div id="message" class="error notice is-dismissible"><p><strong>' . $this->login_builder_errors . '</strong></p></div>';

            return;
        }

        if (@$_GET['view'] == 'edit-shortcode-login' && @$_GET['form-edited']) {
            echo '<div id="message" class="updated notice is-dismissible"><p><strong>' . esc_html__('Form updated', 'wp-user-avatar') . '</strong></p></div>';
        }
    }

    public function edit_screen()
    {
        $this->traitInit($this->available_shortcodes());
        require PPRESS_ADMIN_SETTINGS_PAGE_FOLDER . 'ShortcodeBuilder/EditShortcodeLogin/edit_screen.php';
    }

    public function save_edit()
    {
        if ( ! current_user_can('manage_options') || ! isset($_POST['edit_login']) || ! ppress_verify_nonce()) return;

        $id                = absint($_GET['id']);
        $title             = @sanitize_text_field($_POST['lfb_title']);
        $structure         = @stripslashes($_POST['lfb_structure']);
        $css               = @stripslashes($_POST['lfb_css']);
        $make_passwordless = @sanitize_text_field($_POST['lfb_make_passwordless']);

        if (empty($title)) {
            $this->login_builder_errors = esc_html__('Title is empty', 'wp-user-avatar');
        } elseif (empty($structure)) {
            $this->login_builder_errors = esc_html__('Structure is missing', 'wp-user-avatar');
        }

        if (isset($this->login_builder_errors)) return;

        FormRepository::update_form(
            $id,
            FormRepository::LOGIN_TYPE,
            $title,
            apply_filters('ppress_shortcode_builder_registration_meta', [
                FormRepository::FORM_STRUCTURE     => $structure,
                FormRepository::FORM_CSS           => $css,
                FormRepository::PROCESSING_LABEL   => sanitize_text_field($_POST['processing_label']),
                FormRepository::PASSWORDLESS_LOGIN => ! empty($make_passwordless)
            ])
        );

        wp_safe_redirect(esc_url_raw(add_query_arg('form-edited', 'true')));
        exit;
    }

    /**
     * @return EditShortcodeLogin
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