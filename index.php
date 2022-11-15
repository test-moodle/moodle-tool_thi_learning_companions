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
 * @package     tool_learningcompanions
 * @category    admin
 * @copyright   2022 ICON Vernetzte Kommunikation GmbH <info@iconnewmedia.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once '../../../config.php';
require_once __DIR__.'/locallib.php';

$context = context_system::instance();
require_capability( 'tool/learningcompanions:manage', $context);

$PAGE->set_context($context);
$PAGE->set_url($CFG->wwwroot.'/admin/tool/learningcompanions/index.php');
$PAGE->set_pagelayout('standard');

echo $OUTPUT->header();

$modules = array('comments', 'groups');
$dashboardRows = array();
$counter = 0;
$row = 0;
$dashboardRows[0] = array('items' => array());

foreach($modules as $module) {
    $headlineFunction = '\tool_learningcompanions\getDashboardHeadline_'.ucfirst($module);

    if (function_exists($headlineFunction)) {
        $headline = $headlineFunction();
    } else {
        $headline = get_string('dashboard_'.$module, 'tool_learningcompanions');
    }

    $dashboardItem = array(
        'name'  => $module,
        'title' => $headline,
        'icon'  => get_string('icon_' . $module, 'tool_learningcompanions'),
        'link'  => $CFG->wwwroot . '/admin/tool/learningcompanions/'.$module.'/index.php',
        'linktitle' => get_string('manage_' . $module, 'tool_learningcompanions')
    );

    $dashboardRows[$row]['items'][] = $dashboardItem;
    $counter++;

    if ($counter === 2) {
        $row++;
        $counter = 0;
        $dashboardRows[$row] = array('items' => array());
    }
}

echo $OUTPUT->render_from_template('tool_learningcompanions/index', array(
    'rows' => $dashboardRows,
    'cfg' => $CFG
));

echo $OUTPUT->footer();
