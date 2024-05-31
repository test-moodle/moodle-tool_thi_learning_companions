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
require_once(__DIR__ . '/../../../../config.php');
require_once($CFG->dirroot . '/local/thi_learning_companions/lib.php');
require_login();
$context = context_system::instance();
require_capability( 'tool/thi_learning_companions:group_manage', $context);

$PAGE->set_context($context);
$PAGE->set_url($CFG->wwwroot.'/admin/tool/thi_learning_companions/groups/index.php');
$PAGE->set_pagelayout('admin');
$PAGE->set_title(get_string('groupoverview', 'tool_thi_learning_companions'));
$PAGE->requires->js_call_amd('tool_thi_learning_companions/groups', 'init');
$PAGE->requires->css('/local/thi_learning_companions/js_lib/DataTables/datatables.min.css');
$PAGE->requires->css('/local/thi_learning_companions/js_lib/balloon.css');
$PAGE->navbar->add(get_string('navbar_thi_learning_companions', 'tool_thi_learning_companions'));
$PAGE->navbar->add(get_string('navbar_groups', 'tool_thi_learning_companions'),
    new moodle_url('/admin/tool/thi_learning_companions/groups/index.php')
);

$groups = \local_thi_learning_companions\groups::get_all_groups(true, true);

echo $OUTPUT->header();
$hasgroups = count($groups) > 0;
echo $OUTPUT->render_from_template('tool_thi_learning_companions/groups', [
    'hasgroups' => $hasgroups,
    'groups' => array_values($groups),
    'cfg' => $CFG,
]);
echo $OUTPUT->footer();
