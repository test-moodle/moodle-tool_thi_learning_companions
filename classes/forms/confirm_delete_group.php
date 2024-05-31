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
namespace tool_thi_learning_companions\forms;
defined('MOODLE_INTERNAL') || die();
global $CFG;

use context;
use core_form\dynamic_form;
use local_thi_learning_companions\groups;
use moodle_url;

require_once($CFG->libdir . "/formslib.php");

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
        $groupid = $this->_ajaxformdata['groupId'];

        groups::delete_group($groupid);
    }

    protected function get_page_url_for_dynamic_submission(): moodle_url {
        return new moodle_url('/admin/tool/thi_learning_companions/groups/index.php');
    }
}
