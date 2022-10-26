<?php
require_once '../../../../config.php';
require_once '../../../../local/learningcompanions/lib.php';

$context = context_system::instance();
require_capability( 'tool/learningcompanions:group_manage', $context);

$PAGE->set_context($context);
$PAGE->set_url($CFG->wwwroot.'/admin/tool/learningcompanions/groups/index.php');
$PAGE->set_pagelayout('standard');
$PAGE->requires->js_call_amd('tool_learningcompanions/groups', 'init');
$PAGE->requires->css('/local/learningcompanions/vendor/DataTables/datatables.min.css');
$PAGE->requires->css('/local/learningcompanions/vendor/balloon.css');

$groups = \local_learningcompanions\groups::get_all_groups(true, true);

echo $OUTPUT->header();
$hasgroups = count($groups) > 0;
echo $OUTPUT->render_from_template('tool_learningcompanions/groups', array(
    'hasgroups' => $hasgroups,
    'groups' => array_values($groups),
    'cfg' => $CFG
));
echo $OUTPUT->footer();
