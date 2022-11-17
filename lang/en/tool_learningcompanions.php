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
 * Plugin strings are defined here.
 *
 * @package     tool_learningcompanions
 * @category    string
 * @copyright   2022 ICON Vernetzte Kommunikation GmbH <info@iconnewmedia.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'Learning Companions - Admin Dashboard';
$string['learningcompanions_settings'] = 'Admin tool learningcompanions';
$string['navbar_learningcompanions'] = 'Learning companions';
$string['administration_head'] = 'Learning companions administration';
$string['datatables_url'] = $CFG->wwwroot . '/admin/tool/learningcompanions/lang/en/datatables.json';

// Group overview
$string['groupoverview'] = 'Group overview';
$string['groupname'] = 'Group name';
$string['groupdescription'] = 'Group description';
$string['membercount'] = 'Member count';
$string['groupcreatedby'] = 'Created by';
$string['groupadmins'] = 'Admins';
$string['grouptimecreated'] = 'Created on';
$string['closedgroup'] = 'Is closed group';
$string['nogroups'] = 'There are no groups.';
$string['navbar_groups'] = 'Group overview';

// Comments overview
$string['commentsoverview'] = 'Flagged comments overview';
$string['comment'] = 'Comment';
$string['commentedby'] = 'Commented by';
$string['flaggedby'] = 'Flagged by';
$string['commentdate'] = 'Commented on';
$string['relatedchat'] = 'Related chat';
$string['actions'] = 'Actions';
$string['noflaggedcomments'] = 'There are no flagged comments.';
$string['navbar_comments'] = 'Flagged comments';
$string['delete_comment'] = 'Delete comment';
$string['untag_comment'] = 'Untag comment';
$string['modal-deletecomment-title'] = 'Delete this comment?';
$string['modal-deletecomment-text'] = '{$a}';
$string['modal-deletecomment-okaybutton'] = 'Delete comment';
$string['modal-deletecomment-cancelbutton'] = 'Cancel';
$string['modal-untagcomment-title'] = 'Untag this comment?';
$string['modal-untagcomment-text'] = '{$a}';
$string['modal-untagcomment-okaybutton'] = 'Untag comment';
$string['modal-untagcomment-cancelbutton'] = 'Cancel';

// Dashboard
$string['dashboard_comments'] = '{$a} Tagged comments';
$string['dashboard_groups'] = '{$a} Groups';
$string['dashboard_comments_single'] = '1 tagged comment';
$string['dashboard_groups_single'] = '1 group';
$string['icon_comments'] = 'fa fa-graduation-cap';
$string['icon_groups'] = 'fa fa-users';
$string['manage_comments'] = 'Manage comments';
$string['manage_groups'] = 'Manage groups';
