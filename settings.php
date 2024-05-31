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
 * @package     tool_thi_learning_companions
 * @category    admin
 * @copyright   2022 ICON Vernetzte Kommunikation GmbH <info@iconnewmedia.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    // phpcs:ignore Generic.CodeAnalysis.EmptyStatement.DetectedIf

    $settings = new admin_settingpage( 'tool_thi_learning_companions',
        get_string('thi_learning_companions_settings', 'tool_thi_learning_companions')
    );
    $category = new admin_category('lcconfig',
        get_string('adminareaname', 'local_thi_learning_companions')
    );
    if (!$ADMIN->locate('lcconfig')) { // Avoids "duplicate admin page name" warnings.
        $ADMIN->add('root', $category);
    }
    $ADMIN->add('lcconfig', $settings);
}
