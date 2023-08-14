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

/**
 * Add imprint to footer
 */
function local_imprint_before_footer() {

    global $PAGE;

    $excludepages = Array('admin', 'embedded', 'frametop', 'maintenance', 'popup',
                          'print', 'redirect', 'report');

    if (!in_array($PAGE->pagelayout, $excludepages)) { // Do not show on pages that may use $OUTPUT.

        $settings = Array('link1', 'link2', 'publisher', 'vidsp', 'dsb');

        $show = false;

        foreach ($settings as $setting) {
            if (trim(get_config('local_imprint', $setting)) != '') {
                $show = true;
                break;
            }
        }

        if (get_config('local_imprint', 'enabled') == 'yes' && $show) {

            echo '<div class="local_imprint" style="';
            echo str_replace('"', '\"', get_config('local_imprint', 'css')) . '">';
            echo '<div class="links"><a href="' . get_config('local_imprint', 'link1');
            echo '" target="_blank">' . get_string('link1_text', 'local_imprint') . '</a>&nbsp;|&nbsp;';
            echo '<a href="' . get_config('local_imprint', 'link2');
            echo '" target="_blank">' . get_string('link2_text', 'local_imprint') . '</a></div>';
            echo '<div class="publisher">' . get_string('publisher_text', 'local_imprint');
            echo ': ' . get_config('local_imprint', 'publisher') . '</div>';
            echo '<div class="vidsp">' . get_string('vidsp_text', 'local_imprint');
            echo ': ' . get_config('local_imprint', 'vidsp') . '</div>';
            echo '<div class="dsb">' . get_string('dpo_text', 'local_imprint');
            echo ': ' . get_config('local_imprint', 'dpo') . '</div>';
            echo '</div>';

            echo '<style>@media only screen and (max-device-width: 1000px) { .local_imprint { ';
            echo str_replace('"', '\"', get_config('local_imprint', 'css_mobile'));
            echo '} } } </style>';
        }

    }
}
