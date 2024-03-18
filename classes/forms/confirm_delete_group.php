<?php

namespace tool_thi_learning_companions\forms;
global $CFG;

use context;
use core_form\dynamic_form;
use local_thi_learning_companions\groups;
use moodle_url;

require_once $CFG->libdir . "/formslib.php";

class confirm_delete_group extends dynamic_form {
    /**
     * @inheritDoc
     */
    protected function definition() {
        $mform = $this->_form;

        $mform->addElement('html', get_string('confirm_delete_group', 'tool_thi_learning_companions'));
        $mform->addElement('hidden', 'groupId', $this->_ajaxformdata['groupId']);
        $this->add_action_buttons(true, get_string('delete_group', 'tool_thi_learning_companions'));
    }

    protected function get_context_for_dynamic_submission(): context {
        return \context_system::instance();
    }

    protected function check_access_for_dynamic_submission(): void {
        require_capability('tool/thi_learning_companions:group_manage', $this->get_context_for_dynamic_submission());
    }

    public function process_dynamic_submission() {
        $groupId = $this->_ajaxformdata['groupId'];

        groups::delete_group($groupId);
    }

    public function set_data_for_dynamic_submission(): void {}

    protected function get_page_url_for_dynamic_submission(): moodle_url {
        return new moodle_url('/admin/tool/thi_learning_companions/groups/index.php');
    }

    public function validation($data, $files) {
        return parent::validation($data, $files);
    }
}
