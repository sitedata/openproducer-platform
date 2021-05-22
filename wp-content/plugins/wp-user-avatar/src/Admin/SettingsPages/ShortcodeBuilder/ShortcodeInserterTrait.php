<?php

namespace ProfilePress\Core\Admin\SettingsPages\ShortcodeBuilder;

use ProfilePress\Core\Classes\ExtensionManager as EM;
use ProfilePress\Core\Classes\PROFILEPRESS_sql;

trait ShortcodeInserterTrait
{
    public $form_shortcodes;

    public function traitInit($form_shortcodes)
    {
        $this->form_shortcodes = $form_shortcodes;

        add_action('admin_footer', [$this, 'shortcode_inserter_modal']);
        add_action('admin_footer', [$this, 'shortcode_inserter_script']);
    }

    public static function global_shortcodes()
    {
        return apply_filters('ppress_global_available_shortcodes', [
            'pp-user-avatar'      => [
                'description' => esc_html__("Displays user's avatar", 'wp-user-avatar'),
                'shortcode'   => 'pp-user-avatar',
                'attributes'  => [
                    'size'  => [
                        'label' => esc_html__('Size of avatar', 'wp-user-avatar'),
                        'field' => 'number'
                    ],
                    'class' => [
                        'label' => esc_html__('CSS class', 'wp-user-avatar'),
                        'field' => 'text'
                    ],
                ]
            ],
            'pp-user-cover-image' => [
                'description' => esc_html__("Displays user's cover image", 'wp-user-avatar'),
                'shortcode'   => 'pp-user-cover-image',
                'attributes'  => [
                    'id'    => [
                        'label' => esc_html__('ID', 'wp-user-avatar'),
                        'field' => 'text'
                    ],
                    'class' => [
                        'label' => esc_html__('CSS class', 'wp-user-avatar'),
                        'field' => 'text'
                    ],
                    'alt'   => [
                        'label' => esc_html__('Alternate text', 'wp-user-avatar'),
                        'field' => 'text'
                    ],
                ]
            ],
            'pp-password-hint'    => [
                'description' => esc_html__('Displays password hint', 'wp-user-avatar'),
                'shortcode'   => 'pp-password-hint'
            ],
            'pp-social-login'     => [
                'description' => esc_html__('Social login button', 'wp-user-avatar'),
                'shortcode'   => 'pp-social-login',
                'attributes'  => [
                    'type' => [
                        'label'   => esc_html__('Social network', 'wp-user-avatar'),
                        'field'   => 'select',
                        'options' => [
                            'facebook' => esc_html__('Facebook', 'wp-user-avatar'),
                            'twitter'  => esc_html__('Twitter', 'wp-user-avatar'),
                            'google'   => esc_html__('Google', 'wp-user-avatar'),
                            'linkedin' => esc_html__('LinkedIn', 'wp-user-avatar'),
                            'vk'       => esc_html__('VK', 'wp-user-avatar'),
                            'github'   => esc_html__('GitHub', 'wp-user-avatar'),
                        ]
                    ]
                ]
            ],
            'link-registration'   => [
                'description' => esc_html__('Link to registration page', 'wp-user-avatar'),
                'shortcode'   => 'link-registration',
                'attributes'  => [
                    'label' => [
                        'label' => esc_html__('Link label', 'wp-user-avatar'),
                        'field' => 'text',
                    ],
                    'id'    => [
                        'label' => esc_html__('ID', 'wp-user-avatar'),
                        'field' => 'text'
                    ],
                    'class' => [
                        'label' => esc_html__('CSS class', 'wp-user-avatar'),
                        'field' => 'text'
                    ],
                    'raw'   => [
                        'label' => esc_html__('Check to return URL', 'wp-user-avatar'),
                        'field' => 'checkbox'
                    ],
                ]
            ],
            'link-login'          => [
                'description' => esc_html__('Link to login page', 'wp-user-avatar'),
                'shortcode'   => 'link-login',
                'attributes'  => [
                    'label' => [
                        'label' => esc_html__('Link label', 'wp-user-avatar'),
                        'field' => 'text',
                    ],
                    'id'    => [
                        'label' => esc_html__('ID', 'wp-user-avatar'),
                        'field' => 'text'
                    ],
                    'class' => [
                        'label' => esc_html__('CSS class', 'wp-user-avatar'),
                        'field' => 'text'
                    ],
                    'raw'   => [
                        'label' => esc_html__('Check to return URL', 'wp-user-avatar'),
                        'field' => 'checkbox'
                    ],
                ]
            ],
            'link-lost-password'  => [
                'description' => esc_html__('Link to password reset page', 'wp-user-avatar'),
                'shortcode'   => 'link-lost-password',
                'attributes'  => [
                    'label' => [
                        'label' => esc_html__('Link label', 'wp-user-avatar'),
                        'field' => 'text',
                    ],
                    'id'    => [
                        'label' => esc_html__('ID', 'wp-user-avatar'),
                        'field' => 'text'
                    ],
                    'class' => [
                        'label' => esc_html__('CSS class', 'wp-user-avatar'),
                        'field' => 'text'
                    ],
                    'raw'   => [
                        'label' => esc_html__('Check to return URL', 'wp-user-avatar'),
                        'field' => 'checkbox'
                    ],
                ]
            ],
            'link-my-account'     => [
                'description' => esc_html__('Link to My Account page', 'wp-user-avatar'),
                'shortcode'   => 'link-my-account',
                'attributes'  => [
                    'label' => [
                        'label' => esc_html__('Link label', 'wp-user-avatar'),
                        'field' => 'text',
                    ],
                    'id'    => [
                        'label' => esc_html__('ID', 'wp-user-avatar'),
                        'field' => 'text'
                    ],
                    'class' => [
                        'label' => esc_html__('CSS class', 'wp-user-avatar'),
                        'field' => 'text'
                    ],
                    'raw'   => [
                        'label' => esc_html__('Check to return URL', 'wp-user-avatar'),
                        'field' => 'checkbox'
                    ],
                ]
            ],
            'link-logout'         => [
                'description' => esc_html__('Link to log out', 'wp-user-avatar'),
                'shortcode'   => 'link-logout',
                'attributes'  => [
                    'label' => [
                        'label' => esc_html__('Link label', 'wp-user-avatar'),
                        'field' => 'text',
                    ],
                    'id'    => [
                        'label' => esc_html__('ID', 'wp-user-avatar'),
                        'field' => 'text'
                    ],
                    'class' => [
                        'label' => esc_html__('CSS class', 'wp-user-avatar'),
                        'field' => 'text'
                    ],
                    'raw'   => [
                        'label' => esc_html__('Check to return URL', 'wp-user-avatar'),
                        'field' => 'checkbox'
                    ],
                ]
            ],
            'facebook-login-url'  => [
                'description' => esc_html__('Link to login with Facebook', 'wp-user-avatar'),
                'shortcode'   => 'facebook-login-url'
            ],
            'twitter-login-url'   => [
                'description' => esc_html__('Link to login with Twitter', 'wp-user-avatar'),
                'shortcode'   => 'twitter-login-url'
            ],
            'linkedin-login-url'  => [
                'description' => esc_html__('Link to login with LinkedIn', 'wp-user-avatar'),
                'shortcode'   => 'linkedin-login-url'
            ],
            'google-login-url'    => [
                'description' => esc_html__('Link to login with Google', 'wp-user-avatar'),
                'shortcode'   => 'google-login-url'
            ],
            'github-login-url'    => [
                'description' => esc_html__('Link to login with GitHub', 'wp-user-avatar'),
                'shortcode'   => 'github-login-url'
            ],
            'vk-login-url'        => [
                'description' => esc_html__('Link to login with VK', 'wp-user-avatar'),
                'shortcode'   => 'vk-login-url'
            ],
        ]);
    }

    public static function popular_attributes($show_required = false, $remove_value = false, $show_cpf_fields = false)
    {
        $args = [];

        if ($show_cpf_fields) {

            $custom_fields = PROFILEPRESS_sql::get_profile_custom_fields();

            $contact_infos = PROFILEPRESS_sql::get_contact_info_fields();

            $options = ['' => esc_html__('Select...', 'wp-user-avatar')];

            foreach ($contact_infos as $field_key => $label) {
                $options[$field_key] = $label;
            }

            foreach ($custom_fields as $custom_field) {
                $options[$custom_field['field_key']] = $custom_field['label_name'];
            }

            $args['key'] = [
                'label'   => esc_html__('Field key', 'wp-user-avatar'),
                'field'   => 'select',
                'options' => $options
            ];
        }

        $args = $args + [
                'id'          => [
                    'label' => esc_html__('ID', 'wp-user-avatar'),
                    'field' => 'text'
                ],
                'placeholder' => [
                    'label' => esc_html__('Placeholder', 'wp-user-avatar'),
                    'field' => 'text'
                ],
                'class'       => [
                    'label' => esc_html__('CSS class', 'wp-user-avatar'),
                    'field' => 'text'
                ],
                'value'       => [
                    'label' => esc_html__('Default field value', 'wp-user-avatar'),
                    'field' => 'text'
                ],
            ];

        if ($remove_value) {
            unset($args['value']);
        }

        if ($show_required) {
            $args['required'] = [
                'label' => esc_html__('Mark as required', 'wp-user-avatar'),
                'field' => 'checkbox'
            ];
        }

        return $args;
    }

    public static function reg_edit_profile_available_shortcodes($type = 'reg')
    {
        $shortcodes = apply_filters('ppress_reg_edit_profile_available_shortcodes', [
                $type . '-username'         => [
                    'description' => esc_html__('Username field', 'wp-user-avatar'),
                    'shortcode'   => $type . '-username',
                    'attributes'  => self::popular_attributes()
                ],
                $type . '-password'         => [
                    'description' => esc_html__('Password field', 'wp-user-avatar'),
                    'shortcode'   => $type . '-password',
                    'attributes'  => self::popular_attributes()
                ],
                $type . '-confirm-password' => [
                    'description' => esc_html__('Confirm password field', 'wp-user-avatar'),
                    'shortcode'   => $type . '-confirm-password',
                    'attributes'  => self::popular_attributes()
                ],
                $type . '-password-meter'   => [
                    'description' => esc_html__('Password strength meter', 'wp-user-avatar'),
                    'shortcode'   => $type . '-password-meter',
                    'attributes'  => [
                        'enforce' => [
                            'label'   => esc_html__('Enforce strong password', 'wp-user-avatar'),
                            'field'   => 'select',
                            'options' => ['true' => esc_html__('Yes', 'wp-user-avatar'), 'false' => esc_html__('No', 'wp-user-avatar')]
                        ],
                        'id'      => [
                            'label' => esc_html__('ID', 'wp-user-avatar'),
                            'field' => 'text'
                        ],
                        'class'   => [
                            'label' => esc_html__('CSS class', 'wp-user-avatar'),
                            'field' => 'text'
                        ],
                    ]
                ],
                $type . '-email'            => [
                    'description' => esc_html__('Email address field', 'wp-user-avatar'),
                    'shortcode'   => $type . '-email',
                    'attributes'  => self::popular_attributes()
                ],
                $type . '-confirm-email'    => [
                    'description' => esc_html__('Confirm email address field', 'wp-user-avatar'),
                    'shortcode'   => $type . '-confirm-email',
                    'attributes'  => self::popular_attributes()
                ],
                $type . '-website'          => [
                    'description' => esc_html__('Website field', 'wp-user-avatar'),
                    'shortcode'   => $type . '-website',
                    'attributes'  => self::popular_attributes(true)
                ],
                $type . '-nickname'         => [
                    'description' => esc_html__('Nickname field', 'wp-user-avatar'),
                    'shortcode'   => $type . '-nickname',
                    'attributes'  => self::popular_attributes(true)
                ],
                $type . '-display-name'     => [
                    'description' => esc_html__('Display name field', 'wp-user-avatar'),
                    'shortcode'   => $type . '-display-name',
                    'attributes'  => self::popular_attributes(true)
                ],
                $type . '-first-name'       => [
                    'description' => esc_html__('First name field', 'wp-user-avatar'),
                    'shortcode'   => $type . '-first-name',
                    'attributes'  => self::popular_attributes(true)
                ],
                $type . '-last-name'        => [
                    'description' => esc_html__('Last name field', 'wp-user-avatar'),
                    'shortcode'   => $type . '-last-name',
                    'attributes'  => self::popular_attributes(true)
                ],
                $type . '-bio'              => [
                    'description' => esc_html__('Biographical info field', 'wp-user-avatar'),
                    'shortcode'   => $type . '-bio',
                    'attributes'  => self::popular_attributes(true)
                ],
                $type . '-avatar'           => [
                    'description' => esc_html__('Profile picture upload field', 'wp-user-avatar'),
                    'shortcode'   => $type . '-avatar',
                    'attributes'  => self::popular_attributes(true, true)
                ],
                $type . '-cover-image'      => [
                    'description' => esc_html__('Profile cover image upload field', 'wp-user-avatar'),
                    'shortcode'   => $type . '-cover-image',
                    'attributes'  => self::popular_attributes(true, true)
                ],
                $type . '-cpf'              => [
                    'description' => esc_html__('Custom field', 'wp-user-avatar'),
                    'shortcode'   => $type . '-cpf',
                    'attributes'  => self::popular_attributes(true, true, true)
                ],
                $type . '-submit'           => [
                    'description' => esc_html__('Form submit button', 'wp-user-avatar'),
                    'shortcode'   => $type . '-submit',
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
                ]
            ], $type) + self::global_shortcodes();

        if ( ! EM::is_enabled(EM::CUSTOM_FIELDS)) {
            unset($shortcodes[$type . '-cpf']);
        }

        return $shortcodes;
    }

    public function shortcode_inserter_script()
    {
        printf(
            '<script type="text/javascript">
                    var pp_shortcode_available_shortcodes = %s;
                    </script>',
            json_encode($this->form_shortcodes)
        );
    }

    public function shortcode_inserter_modal()
    {
        ?>
        <script type="text/html" id="tmpl-ppress-builder-shortcodes-inserter">
            <div id="ppress-builder-shortcodes-inserter">
                <div class="ppress-builder-shortcodes-inserter-search">
                    <input type="text" name="ppress_shortcode_inserter_search" id="ppress_shortcode_inserter_search" placeholder="<?= esc_html__('Search shortcodes', 'wp-user-avatar') ?>">
                </div>
                <div class="ppress-builder-shortcode-list-wrapper">
                    <?php foreach ($this->form_shortcodes as $key => $shortcode) : ?>
                        <div class="ppress-builder-shortcode-item-wrap ppclearfix">
                            <div class="ppress-builder-shortcode-item">
                                <div class="ppress-builder-shortcode-name"><?= $key ?></div>
                                <div class="ppress-builder-shortcode-desc"><?= $shortcode['description'] ?></div>
                            </div>
                            <div class="ppress-builder-shortcode-item-btn">
                                <a data-pp-form-shortcode="<?= $key ?>" href="#" class="button"><?= esc_html__('Select', 'wp-user-avatar') ?></a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </script>

        <script type="text/javascript">

            (function ($) {

                var tmpl = wp.template('ppress-builder-shortcodes-inserter'),

                    initModal = function () {
                        return new jBox('Modal', {
                            id: 'ppress-available-shortcodes-jbox',
                            closeButton: 'title',
                            maxHeight: 400,
                            repositionOnContent: true,
                            onOpen: onOpen
                        });
                    },

                    init_clipboard = function () {

                        var clipboardJS = new ClipboardJS('.ppress-builder-shortcode-btn', {
                            text: function () {
                                return $('#ppress-builder-shortcode-preview-field').text();
                            }
                        });

                        clipboardJS.on('success', function () {

                            alert('<?= esc_html__('Shortcode copied to clipboard.', 'wp-user-avatar') ?>');

                            setTimeout(function () {
                                window.ppressShortcodeBuilderMModal.close();
                            }, 200);
                        });
                    },

                    onOpen = function () {

                        var cache, tmpl = wp.template('ppress-shortcode-inserter-form');

                        $(document).on('click', '#ppress-builder-shortcodes-inserter .ppress-builder-shortcode-item-btn a', function (e) {
                            e.preventDefault();
                            cache = $('#ppress-builder-shortcodes-inserter'),
                                shortcode = $(this).data('pp-form-shortcode');

                            $('#ppress-shortcode-inserter-form').remove();

                            cache.hide();
                            cache.after(tmpl(pp_shortcode_available_shortcodes[shortcode]));

                            window.ppressShortcodeBuilderMModal
                                .setTitle('<span class="dashicons dashicons-arrow-left-alt ppress-shortcode-inserter-back" title="Back"></span>' + shortcode);

                            // trigger change to add defaults attribute and their values. looking at you select dropdown.
                            $('#ppress-available-shortcodes-jbox .ppress-shortcode-inserter-builder-field').change();

                            window.ppressShortcodeBuilderMModal.position(); // recalculate placement in DOM
                        });

                        $(document).on('click', '#ppress-available-shortcodes-jbox .ppress-shortcode-inserter-back', function (e) {
                            e.preventDefault();

                            $('#ppress-shortcode-inserter-form').remove();

                            $('#ppress-builder-shortcodes-inserter').show();

                            window.ppressShortcodeBuilderMModal
                                .setTitle('<?= esc_html__('Available Shortcodes', 'wp-user-avatar');?>');
                        });
                    };

                $(document).on('click', '#ppress-available-shortcodes-btn', function () {

                    if (typeof window.ppressShortcodeBuilderMModal != 'undefined') {
                        window.ppressShortcodeBuilderMModal.destroy();
                    }

                    window.ppressShortcodeBuilderMModal = initModal()
                        .setTitle('<?= esc_html__('Available Shortcodes', 'wp-user-avatar');?>')
                        .setContent(tmpl())
                        .open();
                });

                $(document).on('change', '.ppress-shortcode-inserter-builder-field', function () {
                    var field_value,
                        selected_shortcode = $('#ppress-shortcode-inserter-form').data('pp-selected-shortcode'),
                        constructed_shortcode = '[' + selected_shortcode;

                    $(this).parents('.ppress-builder-shortcode-attributes-wrap').find('.ppress-shortcode-inserter-builder-field').each(function () {

                        if ($(this).attr('type') === 'checkbox') {
                            if ($(this).prop('checked') === true) {
                                constructed_shortcode += ' ' + $(this).attr('name');
                            }
                        } else {

                            field_value = $(this).val();

                            if (typeof field_value !== "undefined" && field_value !== '' && field_value != '0') {
                                constructed_shortcode += ' ' + $(this).attr('name') + '="' + field_value + '"';
                            }
                        }
                    });

                    constructed_shortcode += ']';

                    $('#ppress-builder-shortcode-preview-field').text(constructed_shortcode);
                });

                $(document).on('keyup change', '#ppress_shortcode_inserter_search', function () {

                    var term = this.value,
                        cache = $('.ppress-builder-shortcode-item-wrap');

                    if (term === '') {
                        cache.show();
                    } else {
                        cache.hide().each(function () {
                            var content = $(this).text().replace(/\s/g, '');

                            if (new RegExp('(?=.*' + term + ').+', 'i').test(content) === true) {
                                $(this).show();
                            }
                        });
                    }
                });

                init_clipboard();

            })(jQuery);

        </script>

        <script type="text/html" id="tmpl-ppress-shortcode-inserter-form">
            <div id="ppress-shortcode-inserter-form" data-pp-selected-shortcode="{{data.shortcode}}">
                <div class="ppress-builder-shortcode-desc">
                    {{{data.description}}}
                </div>
                <# if(_.isEmpty(data.attributes) === false) { #>
                <div class="ppress-builder-shortcode-attributes-wrap">
                    <# _.each(data.attributes, function(value, key) { #>
                    <div class="ppress-builder-shortcode-attribute-row">
                        <div class="ppress-builder-shortcode-attribute-label">{{value.label}}</div>
                        <div class="ppress-builder-shortcode-attribute-field">
                            <# if(value.field == 'text') { placeholder = typeof value.placeholder !== 'undefined' ? value.placeholder : ''; #>
                            <input class="ppress-shortcode-inserter-builder-field" type="text" name="{{key}}" placeholder="{{placeholder}}">
                            <# } #>

                            <# if(value.field == 'number') { #>
                            <input class="ppress-shortcode-inserter-builder-field" type="number" name="{{key}}">
                            <# } #>

                            <# if(value.field == 'checkbox') { #>
                            <input class="ppress-shortcode-inserter-builder-field" type="checkbox" name="{{key}}" value="true">
                            <# } #>

                            <# if(value.field == 'select') { #>
                            <select class="ppress-shortcode-inserter-builder-field" name="{{key}}">

                                <# _.each(value.options, function(value2, key2) { #>
                                <option value="{{key2}}">{{value2}}</option>
                                <# }); #>
                            </select>
                            <# } #>
                        </div>
                    </div>
                    <# }); #>
                </div>
                <# } #>
                <div class="ppress-builder-shortcode-clipboard-form">
                    <div id="ppress-builder-shortcode-preview-field">[{{data.shortcode}}]</div>
                    <button class="ppress-builder-shortcode-btn button button-primary button-large"><?= esc_html__('Copy to clipboard', 'wp-user-avatar') ?></button>
                </div>
            </div>
        </script>
        <?php
    }
}