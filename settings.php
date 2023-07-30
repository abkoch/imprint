<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Plugin administration pages are defined here.
 *
 * @package     local_imprint
 * @category    admin
 * @copyright   2023 Andreas Koch
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if (!class_exists('local_imprint_admin_setting_configtext')) {
    class local_imprint_admin_setting_configtext extends admin_setting_configtext {
        public function validate($data) {
            $return = parent::validate($data);
            if ($return === true) {
                return true;
            }
            return get_string('link_error', 'local_imprint');
        }
    }
}

if ($hassiteconfig) {
    $settings = new admin_settingpage('local_imprint_settings', new lang_string('pluginname', 'local_imprint'));
    $ADMIN->add('localplugins', $settings);

    if ($ADMIN->fulltree) {
        $setting = new admin_setting_configselect('local_imprint/enabled', get_string('enabled', 'local_imprint'), '', 'yes',
                    Array('yes' => get_string('yes', 'local_imprint'), 'no' => get_string('no', 'local_imprint')));
        $setting->set_updatedcallback('theme_reset_all_caches');
        $settings->add($setting);

        $setting = new local_imprint_admin_setting_configtext('local_imprint/link1', get_string('link1', 'local_imprint'),
                    get_string('link1_descr', 'local_imprint'), '', PARAM_URL);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $settings->add($setting);

        $setting = new local_imprint_admin_setting_configtext('local_imprint/link2', get_string('link2', 'local_imprint'),
                    get_string('link2_descr', 'local_imprint'), '', PARAM_URL);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $settings->add($setting);

        $setting = new admin_setting_configtextarea('local_imprint/publisher', get_string('publisher', 'local_imprint'), '', '',
                    PARAM_TEXT);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $settings->add($setting);

        $setting = new admin_setting_configtextarea('local_imprint/vidsp', get_string('vidsp', 'local_imprint'), '', '',
                    PARAM_TEXT);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $settings->add($setting);

        $setting = new admin_setting_configtextarea('local_imprint/dpo', get_string('dpo', 'local_imprint'), '', '',
                    PARAM_TEXT);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $settings->add($setting);

        $setting = new admin_setting_configtextarea('local_imprint/css', get_string('css', 'local_imprint'),
                                                    get_string('css_descr', 'local_imprint'),
                                                    "position: fixed;\n" .
                                                    "bottom: 0px;\n" .
                                                    "left: 0px;\n" .
                                                    "right: 0px;\n" .
                                                    "background-color: rgba(255, 255, 255, 0.5);\n" .
                                                    "text-align: center;\n" .
                                                    "padding: 10px;\n" .
                                                    "margin: 0px;\n" .
                                                    "font-size: 10px;\n" .
                                                    "margin-top: 50px;",
                                                     PARAM_RAW);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $settings->add($setting);
    }
}
