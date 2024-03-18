<?php
require_once '../../../../config.php';
require_once '../../../../local/thi_learning_companions/lib.php';

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
$PAGE->navbar->add(get_string('navbar_groups', 'tool_thi_learning_companions'), new moodle_url('/admin/tool/thi_learning_companions/groups/index.php'));

$groups = \local_thi_learning_companions\groups::get_all_groups(true, true);

echo $OUTPUT->header();
$hasgroups = count($groups) > 0;
echo $OUTPUT->render_from_template('tool_thi_learning_companions/groups', array(
    'hasgroups' => $hasgroups,
    'groups' => array_values($groups),
    'cfg' => $CFG
));
echo $OUTPUT->footer();