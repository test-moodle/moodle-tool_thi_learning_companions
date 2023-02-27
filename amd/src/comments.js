define([
    'jquery',
    'core/config',
    'core/str',
    'core/modal_factory',
    'core/modal_events',
    'local_learningcompanions/datatables',
    'local_learningcompanions/select2'
], function($, c, str, ModalFactory, ModalEvents) {
    return {

        select2: function() {
            $('.select2').select2();
        },

        init: function() {

            var translationURL = str.get_string('datatables_url', 'tool_learningcompanions');
            translationURL.then(function(url) {
                $('#flaggedcommentstable').DataTable({
                    language: {
                        url: url
                    }
                });
            });

            $('.flaggedcomments-deletecomment').click(function(e) {
                e.preventDefault();

                const commentid = $(this).data('cid');
                const comment = $(this).data('comment');

                var strings = [
                    {key: 'modal-deletecomment-title', component: 'tool_learningcompanions'},
                    {key: 'modal-deletecomment-text', component: 'tool_learningcompanions', param: comment},
                    {key: 'modal-deletecomment-okaybutton', component: 'tool_learningcompanions'},
                    {key: 'modal-deletecomment-cancelbutton', component: 'tool_learningcompanions'},
                ];

                str.get_strings(strings).then(function(strings) {
                    return ModalFactory.create({
                        title: strings[0],
                        body: '' +
                            '<div id="flaggedcomments-deletecomment-modal">' +
                            '<div id="flaggedcomments-deletecomment-modal-text">' + strings[1] + '</div>' +
                            '</div>',
                        footer: '' +
                            '<div id="flaggedcomments-deletecomment-modal-buttons">' +
                            '<button class="btn btn-primary" aria-hidden="true" id="flaggedcomments-deletecomment-modal-delete" data-cid="' + commentid + '">' + strings[2] + '</button>' +
                            '<button class="btn btn-secondary" aria-hidden="true" id="flaggedcomments-deletecomment-modal-close" data-action="hide">' + strings[3] + '</button>' +
                            '</div>'
                    });
                }).then(function(modal) {
                    modal.getRoot().on(ModalEvents.hidden, function() {
                        modal.destroy();
                    });
                    modal.show();
                });
            });

            $('.flaggedcomments-untagcomment').click(function(e) {
                e.preventDefault();

                const commentid = $(this).data('cid');
                const comment = $(this).data('comment');

                var strings = [
                    {key: 'modal-untagcomment-title', component: 'tool_learningcompanions'},
                    {key: 'modal-untagcomment-text', component: 'tool_learningcompanions', param: comment},
                    {key: 'modal-untagcomment-okaybutton', component: 'tool_learningcompanions'},
                    {key: 'modal-untagcomment-cancelbutton', component: 'tool_learningcompanions'},
                ];

                str.get_strings(strings).then(function(strings) {
                    return ModalFactory.create({
                        title: strings[0],
                        body: '' +
                            '<div id="flaggedcomments-untagcomment-modal">' +
                            '<div id="flaggedcomments-untagcomment-modal-text">' + strings[1] + '</div>' +
                            '</div>',
                        footer: '' +
                            '<div id="flaggedcomments-untagcomment-modal-buttons">' +
                            '<button class="btn btn-primary" aria-hidden="true" id="flaggedcomments-untagcomment-modal-untag" data-cid="' + commentid + '">' + strings[2] + '</button>' +
                            '<button class="btn btn-secondary" aria-hidden="true" id="flaggedcomments-untagcomment-modal-close" data-action="hide">' + strings[3] + '</button>' +
                            '</div>'
                    });
                }).then(function(modal) {
                    modal.getRoot().on(ModalEvents.hidden, function() {
                        modal.destroy();
                    });
                    modal.show();
                });
            });

            $('body').on('click', '#flaggedcomments-deletecomment-modal-close', function() {
                $('.modal').remove();
            });

            $('body').on('click', '#flaggedcomments-untagcomment-modal-close', function() {
                $('.modal').remove();
            });

            $('body').on('click', '#flaggedcomments-deletecomment-modal-delete', function() {

                const commentid = $(this).data('cid');

                $.ajax({
                    url: M.cfg.wwwroot + '/admin/tool/learningcompanions/ajax.php',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        action: 'deletecomment',
                        commentid: commentid
                    },
                    success: function (data) {
                        if (data === 'fail') {
                            window.location.href = (M.cfg.wwwroot + '/admin/tool/learningcompanions/comments/index.php?n=n_d');
                        } else {
                            window.location.href = (M.cfg.wwwroot + '/admin/tool/learningcompanions/comments/index.php?n=d');
                        }
                    }
                });
            });

            $('body').on('click', '#flaggedcomments-untagcomment-modal-untag', function() {

                const commentid = $(this).data('cid');

                $.ajax({
                    url: M.cfg.wwwroot + '/admin/tool/learningcompanions/ajax.php',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        action: 'untagcomment',
                        commentid: commentid
                    },
                    success: function (data) {
                        if (data === 'fail') {
                            window.location.href = (M.cfg.wwwroot + '/admin/tool/learningcompanions/comments/index.php?n=n_uf');
                        } else {
                            window.location.href = (M.cfg.wwwroot + '/admin/tool/learningcompanions/comments/index.php?n=uf');
                        }
                    }
                });
            });
        }

    };
});
