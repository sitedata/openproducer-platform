<?php

namespace ProfilePress\Core\Admin\SettingsPages\ShortcodeBuilder\EditShortcodeEditProfile;

use ProfilePress\Core\Admin\SettingsPages\ShortcodeBuilder\ShortcodeInserterTrait;
use ProfilePress\Core\Classes\FormRepository;

class EditShortcodeEditProfile
{
    use ShortcodeInserterTrait;

    private $edit_profile_builder_errors;

    public function __construct()
    {
        add_action('admin_init', [$this, 'save_edit']);
        add_action('ppress_admin_notices', [$this, 'admin_notices']);
    }

    public function available_shortcodes()
    {
        $shortcodes = self::reg_edit_profile_available_shortcodes('edit-profile');

        $shortcodes['pp-remove-avatar-button'] = [
            'description' => esc_html__('Button to delete profile picture', 'wp-user-avatar'),
            'shortcode'   => 'pp-remove-avatar-button',
            'attributes'  => [
                'label' => [
                    'label'       => esc_html__('Button label', 'wp-user-avatar'),
                    'field'       => 'text',
                    'placeholder' => esc_html__('Delete Avatar', 'wp-user-avatar')
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
        ];

        $shortcodes['pp-remove-cover-image-button'] = [
            'description' => esc_html__('Button to delete profile cover image', 'wp-user-avatar'),
            'shortcode'   => 'pp-remove-cover-image-button',
            'attributes'  => [
                'label' => [
                    'label'       => esc_html__('Button label', 'wp-user-avatar'),
                    'field'       => 'text',
                    'placeholder' => esc_html__('Delete Cover Image', 'wp-user-avatar')
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
        ];

        return $shortcodes;
    }

    public function admin_notices()
    {
        if (isset($this->edit_profile_builder_errors)) {
            echo '<div id="message" class="error notice is-dismissible"><p><strong>' . $this->edit_profile_builder_errors . '</strong></p></div>';

            return;
        }

        if (@$_GET['view'] == 'edit-shortcode-edit-profile' && @$_GET['form-edited']) {
            echo '<div id="message" class="updated notice is-dismissible"><p><strong>' . esc_html__('Form updated', 'wp-user-avatar') . '</strong></p></div>';
        }
    }

    public function edit_screen()
    {
        // we're using here because this method is only called when the view is called for the form type.
        $this->traitInit($this->available_shortcodes());

        require PPRESS_ADMIN_SETTINGS_PAGE_FOLDER . 'ShortcodeBuilder/EditShortcodeEditProfile/edit_screen.php';
    }

    public function save_edit()
    {
        if ( ! current_user_can('manage_options') || ! isset($_POST['edit_user_profile']) || ! ppress_verify_nonce()) return;

        $id                   = absint($_GET['id']);
        $title                = @sanitize_text_field($_POST['eup_title']);
        $structure            = @stripslashes($_POST['eup_structure']);
        $css                  = @stripslashes($_POST['eup_css']);
        $success_edit_profile = @stripslashes($_POST['eup_success_edit_profile']);

        if (empty($title)) {
            $this->edit_profile_builder_errors = esc_html__('Title is empty', 'wp-user-avatar');
        } elseif (empty($structure)) {
            $this->edit_profile_builder_errors = esc_html__('Form Structure is missing', 'wp-user-avatar');
        }

        if (isset($this->edit_profile_builder_errors)) return;

        FormRepository::update_form(
            $id,
            FormRepository::EDIT_PROFILE_TYPE,
            $title,
            apply_filters('ppress_shortcode_builder_registration_meta', [
                FormRepository::FORM_STRUCTURE   => $structure,
                FormRepository::FORM_CSS         => $css,
                FormRepository::PROCESSING_LABEL => sanitize_text_field($_POST['processing_label']),
                FormRepository::SUCCESS_MESSAGE  => $success_edit_profile,
            ])
        );

        wp_safe_redirect(esc_url_raw(add_query_arg('form-edited', 'true')));
        exit;
    }

    /**
     * @return EditShortcodeEditProfile
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