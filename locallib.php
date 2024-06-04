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
 * Local library file.
 *
 * @package     tool_thi_learning_companions
 * @category    admin
 * @copyright   2022 ICON Vernetzte Kommunikation GmbH <info@iconnewmedia.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_thi_learning_companions;

/**
 * Note to developers: Don't let your IDE fool you. The function is being used.
 * The function name gets created dynamically in index.php inside the foreach loop.
 * @return \lang_string|string
 * @throws \coding_exception
 */
function get_dashboard_headline_comments() {
    $comments = \local_thi_learning_companions\chats::get_all_flagged_comments();
    $commentcount = count($comments);
    $suffix = '';
    if ($commentcount === 1) {
        $suffix = '_single';
    }
    $headline = get_string('dashboard_comments'.$suffix, 'tool_thi_learning_companions', $commentcount);
    return $headline;
}

/**
 * Note to developers: Don't let your IDE fool you. The function is being used.
 * The function name gets created dynamically in index.php inside the foreach loop.
 * @return \lang_string|string
 * @throws \coding_exception
 * @throws \dml_exception
 */
function get_dashboard_headline_groups() {
    $groups = \local_thi_learning_companions\groups::get_all_groups();
    $groupcount = count($groups);
    $suffix = '';
    if ($groupcount === 1) {
        $suffix = '_single';
    }
    $headline = get_string('dashboard_groups'.$suffix, 'tool_thi_learning_companions', $groupcount);
    return $headline;
}
