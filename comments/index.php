<?php
require_once '../../../../config.php';
require_once '../../../../local/learningcompanions/lib.php';

$context = context_system::instance();
require_capability( 'tool/learningcompanions:comments_manage', $context);

$PAGE->set_context($context);
$PAGE->set_url($CFG->wwwroot.'/admin/tool/learningcompanions/comments/index.php');
$PAGE->set_pagelayout('standard');
$PAGE->requires->js_call_amd('tool_learningcompanions/comments', 'init');
$PAGE->requires->css('/local/learningcompanions/vendor/DataTables/datatables.min.css');
$PAGE->requires->css('/local/learningcompanions/vendor/balloon.css');

$comments = \local_learningcompanions\chats::get_all_flagged_comments(true, true);

echo $OUTPUT->header();
$hascomments = count($comments) > 0;
echo $OUTPUT->render_from_template('tool_learningcompanions/comments', array(
    'hascomments' => $hascomments,
    'comments' => array_values($comments),
    'cfg' => $CFG
));
echo $OUTPUT->footer();
