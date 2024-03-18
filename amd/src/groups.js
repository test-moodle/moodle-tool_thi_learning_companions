/* eslint-disable jsdoc/require-jsdoc, no-console */
import $ from 'jquery';
import * as str from 'core/str';
import * as ModalFactory from 'core/modal_factory';
import DynamicForm from 'core_form/dynamicform';
import 'local_thi_learning_companions/jquery.dataTables';

export async function init() {
    setUpDataTable();
    $('body').on('click', '.js-delete-group', handleGroupDelete);
}

async function setUpDataTable() {
    const translationURL = await str.get_string('datatables_url', 'tool_thi_learning_companions');

    $('#allgroupstable').DataTable({
        language: {
            url: translationURL
        }
    });
}

async function handleGroupDelete() {
    const confirmTitle = await str.get_string('deletegroupconfirmtitle', 'tool_thi_learning_companions');
    const groupId = $(this).data('groupid');

    const modal = await ModalFactory.create({
        title: confirmTitle,
        body: '<div class="js-form-wrapper"></div>',
        large: false
    });
    modal.show();

    const formContainer = document.querySelector('.js-form-wrapper');
    const form = new DynamicForm(formContainer, '\\tool_thi_learning_companions\\forms\\confirm_delete_group');
    await form.load({groupId});

    form.addEventListener(form.events.FORM_SUBMITTED, () => {
        window.location.reload();
    });
    form.addEventListener(form.events.FORM_CANCELLED, () => {
        modal.destroy();
    });
}
