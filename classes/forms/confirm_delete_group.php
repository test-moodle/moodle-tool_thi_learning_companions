<?php

namespace tool_learningcompanions\forms;
global $CFG;

use context;
use core_form\dynamic_form;
use local_learningcompanions\groups;
use moodle_url;

require_once $CFG->libdir . "/formslib.php";

class confirm_delete_group extends dynamic_form {
    /**
     * @inheritDoc
     */
    protected function definition() {
        $mform = $this->_form;

        $mform->addElement('html', get_string('confirm_delete_group', 'tool_learningcompanions'));
        $mform->addElement('hidden', 'groupId', $this->_ajaxformdata['groupId']);
        $this->add_action_buttons(true, get_string('delete_group', 'tool_learningcompanions'));
    }

    protected function get_context_for_dynamic_submission(): context {
        return \context_system::instance();
    }

    protected function check_access_for_dynamic_submission(): void {
        require_capability('tool/learningcompanions:group_manage', $this->get_context_for_dynamic_submission());
    }

    public function process_dynamic_submission() {
        $groupId = $this->_ajaxformdata['groupId'];

        groups::delete_group($groupId);
    }

    public function set_data_for_dynamic_submission(): void {}

    protected function get_page_url_for_dynamic_submission(): moodle_url {
        return new moodle_url('/admin/tool/learningcompanions/groups/index.php');
    }

    public function validation($data, $files) {
        return parent::validation($data, $files);
    }
}
