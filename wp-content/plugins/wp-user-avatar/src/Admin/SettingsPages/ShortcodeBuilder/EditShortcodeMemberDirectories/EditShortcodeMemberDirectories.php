<?php

namespace ProfilePress\Core\Admin\SettingsPages\ShortcodeBuilder\EditShortcodeMemberDirectories;

use ProfilePress\Core\Admin\SettingsPages\ShortcodeBuilder\EditShortcodeUserProfile\EditShortcodeUserProfile;
use ProfilePress\Core\Admin\SettingsPages\ShortcodeBuilder\ShortcodeInserterTrait;
use ProfilePress\Core\Classes\FormRepository;

class EditShortcodeMemberDirectories extends EditShortcodeUserProfile
{
    use ShortcodeInserterTrait;

    private $builder_errors;

    public function admin_notices()
    {
        if (isset($this->builder_errors)) {
            echo '<div id="message" class="error notice is-dismissible"><p><strong>' . $this->builder_errors . '</strong></p></div>';

            return;
        }

        if (@$_GET['view'] == 'edit-shortcode-member-directory' && @$_GET['form-edited']) {
            echo '<div id="message" class="updated notice is-dismissible"><p><strong>' . esc_html__('Changes saved.', 'wp-user-avatar') . '</strong></p></div>';
        }
    }

    public function edit_screen()
    {
        $this->traitInit($this->available_shortcodes());
        require dirname(__FILE__) . '/edit_screen.php';
    }

    public function save_edit()
    {
        if ( ! current_user_can('manage_options') || ! isset($_POST['edit_member_directory']) || ! ppress_verify_nonce()) return;

        $id        = absint($_GET['id']);
        $title     = @sanitize_text_field($_POST['md_title']);
        $structure = @stripslashes($_POST['md_structure']);
        $css       = @stripslashes($_POST['md_css']);

        if (empty($title)) {
            $this->builder_errors = esc_html__('Title is empty', 'wp-user-avatar');
        } elseif (empty($structure)) {
            $this->builder_errors = esc_html__('Structure is missing', 'wp-user-avatar');
        }

        if (isset($this->builder_errors)) return;

        FormRepository::update_form(
            $id,
            FormRepository::MEMBERS_DIRECTORY_TYPE,
            $title,
            apply_filters('ppress_shortcode_builder_registration_meta', [
                FormRepository::FORM_STRUCTURE => $structure,
                FormRepository::FORM_CSS       => $css,
            ])
        );

        wp_safe_redirect(esc_url_raw(add_query_arg('form-edited', 'true')));
        exit;
    }

    /**
     * @return self
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