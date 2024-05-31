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
 * @package     tool_thi_learning_companions
 * @category    admin
 * @copyright   2022 ICON Vernetzte Kommunikation GmbH <info@iconnewmedia.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once((dirname(__DIR__, 3)).'/config.php');
require_login();
global $DB;

$action = required_param('action', PARAM_TEXT);

if ($action == 'deletecomment') {
    $commentid = required_param('commentid', PARAM_INT);

    if (\local_thi_learning_companions\chats::delete_comment($commentid)) {
        echo '1';
    } else {
        echo 'fail';
    }
}

if ($action == 'untagcomment') {
    $commentid = required_param('commentid', PARAM_INT);

    if (\local_thi_learning_companions\chats::unflag_comment($commentid)) {
        echo '1';
    } else {
        echo 'fail';
    }
}
