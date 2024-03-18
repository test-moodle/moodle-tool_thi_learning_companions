<?php
require_once '../../../../config.php';
require_once '../../../../local/thi_learning_companions/lib.php';

global $OUTPUT, $PAGE, $CFG;

$context = context_system::instance();
require_capability( 'tool/thi_learning_companions:comments_manage', $context);

$PAGE->set_context($context);
$PAGE->set_url($CFG->wwwroot.'/admin/tool/thi_learning_companions/comments/index.php');
$PAGE->set_pagelayout('admin');
$PAGE->set_title(get_string('commentsoverview', 'tool_thi_learning_companions'));
$PAGE->requires->js_call_amd('tool_thi_learning_companions/comments', 'init');
$PAGE->requires->css('/local/thi_learning_companions/js_lib/DataTables/datatables.min.css');
$PAGE->requires->css('/local/thi_learning_companions/js_lib/balloon.css');
$PAGE->navbar->add(get_string('navbar_thi_learning_companions', 'tool_thi_learning_companions'));
$PAGE->navbar->add(get_string('navbar_comments', 'tool_thi_learning_companions'), new moodle_url('/admin/tool/thi_learning_companions/comments/index.php'));

$comments = \local_thi_learning_companions\chats::get_all_flagged_comments(true, true);

echo $OUTPUT->header();

$notification = optional_param('n', null, PARAM_TEXT);
if (!is_null($notification)) {
    $notificationtype = substr($notification, 0, 2) == 'n_' ? 'error' : 'success';
    echo $OUTPUT->notification(get_string('notification_'.$notification, 'local_thi_learning_companions'), $notificationtype);
}

$hascomments = count($comments) > 0;
echo $OUTPUT->render_from_template('tool_thi_learning_companions/comments', array(
    'hascomments' => $hascomments,
    'comments' => array_values($comments),
    'cfg' => $CFG
));
echo $OUTPUT->footer();
