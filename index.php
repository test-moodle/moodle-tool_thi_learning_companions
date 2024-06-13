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
 * The initial page for this tool
 * @package     tool_thi_learning_companions
 * @category    admin
 * @copyright   2022 ICON Vernetzte Kommunikation GmbH <info@iconnewmedia.de>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(dirname(__DIR__, 3).'/config.php');
require_once(__DIR__.'/locallib.php');
require_login();
$context = context_system::instance();
require_capability( 'tool/thi_learning_companions:manage', $context);

$PAGE->set_context($context);
$PAGE->set_url($CFG->wwwroot.'/admin/tool/thi_learning_companions/index.php');
$PAGE->set_pagelayout('admin');
$PAGE->set_title(get_string('pluginname', 'tool_thi_learning_companions'));

echo $OUTPUT->header();

$modules = ['comments', 'groups'];
$dashboardrows = [];
$counter = 0;
$row = 0;
$dashboardrows[0] = ['items' => []];

foreach ($modules as $module) {
    $headlinefunction = '\tool_thi_learning_companions\get_dashboard_headline_'.ucfirst($module);

    if (function_exists($headlinefunction)) {
        $headline = $headlinefunction();
    } else {
        $headline = get_string('dashboard_'.$module, 'tool_thi_learning_companions');
    }

    $dashboarditem = [
        'name'  => $module,
        'title' => $headline,
        'icon'  => get_string('icon_' . $module, 'tool_thi_learning_companions'),
        'link'  => $CFG->wwwroot . '/admin/tool/thi_learning_companions/'.$module.'/index.php',
        'linktitle' => get_string('manage_' . $module, 'tool_thi_learning_companions'),
    ];

    $dashboardrows[$row]['items'][] = $dashboarditem;
    $counter++;

    if ($counter === 2) {
        $row++;
        $counter = 0;
        $dashboardrows[$row] = ['items' => []];
    }
}

echo $OUTPUT->render_from_template('tool_thi_learning_companions/index', [
    'rows' => $dashboardrows,
    'cfg' => $CFG,
]);

echo $OUTPUT->footer();
