var lobilist = null;

$(document).ready(function(){
    // Lobipanel
    initLobiPanel('.panel');

    // Add
    $('#add-content').click(function(){
        prototype = $('.prototype').clone();
        prototype.removeClass('prototype');
        prototype.addClass('new');

        $('#first-block').prepend(prototype);

        $('#first-block .new').show();

        $('#first-block .new').lobiPanel({
            sortable: true,
            reload: false
        });

        // Save content
        $('#first-block .new').on('onSaveTitle.lobiPanel', function(ev, lobiPanel){
            //find title
            var title = $(lobiPanel.$el[0]).find('.panel-title').text();

            $.ajax({
                url: Routing.generate('content_new', {'title': title}),
            }).done(function($id) {
                $(lobiPanel.$el[0]).removeClass('new');
                $(lobiPanel.$el[0]).attr('id', $id);
                $(lobiPanel.$el[0]).find('.edit-content').show();
                initLobiPanel('.panel#'+$id);
                console.log($id);
            });
        });

        $('#first-block .new').lobiPanel('startTitleEditing');
    });

    // Edit content
    $('body').on('click', '.edit-content', function(){
        console.log('Edit content');

        var id = $(this).parent().parent().parent().attr('id');
        var editButton = $(this).parent();
        var panelBody = $(this).parent().parent();

        $.ajax({
            url: Routing.generate('content_edit', {'id': id}),
        }).done(function(data) {
            editButton.hide();
            panelBody.prepend(data);

            //console.log(data);
        });
    });

    $('body').on('click', '.cancel-edit-content', function(){
        $(this).parent().parent().parent().find('.content-value').show();
        $(this).parent().parent().remove();

        return false;
    });

    $('body').on('click', '.save-content', function(ev){
        ev.preventDefault();
        ev.stopPropagation();

        var form = $(this).parent().parent();
        var id = form.parent().parent().attr('id');
        $.ajax({
            url: Routing.generate('content_edit', {'id': id}),
            method: "POST",
            data: form.serialize(),
        }).done(function(data) {
            form.parent().parent().removeClass('panel-default panel-primary panel-warning panel-danger panel-success panel-info')
            form.parent().parent().addClass(form.find('#content_contentClass').val());
            form.parent().html(data);

            //console.log(data);
        });

        return false;
    })

    // Lobilist
    $('#todo-lists').lobiList({
        onSingleLine: false,
        controls: ['edit','remove'],
        lists: taskLists,
        titleChange: function($list) {
            $title = $list.$title.html();
            if($list.$options.id == 'new') {
                $.ajax({
                    url: Routing.generate('tasklist_new', {'title': $title}),
                }).done(function($id) {
                    $list.$options.id = $id;
                    $list.$el.attr('id', $id);
                    reorderTodoList();
                });
            } else {
                $.ajax({
                    url: Routing.generate('tasklist_edit', {'id': $list.$options.id, 'title': $title}),
                }).done(function($id) {
                    console.log('ok');
                });
            }

        },
        afterItemAdd: function ($list, $object) {
            $.ajax({
                url: Routing.generate('task_new', {'task[title]': $object.title, 'task[taskList]': $list.$options.id, 'task[dueDate]': $object.dueDate, 'task[description]': $object.description}),
            }).done(function($id) {
                $list.$body.find('li[data-id="'+$object.id+'"]').attr('data-id', $id);
                console.log('new task');
            });
        },
        afterItemUpdate: function ($list, $object) {
            $.ajax({
                url: Routing.generate('task_edit', {'id': $object.id, 'task[title]': $object.title, 'task[taskList]': $list.$options.id, 'task[dueDate]': $object.dueDate, 'task[description]': $object.description}),
            }).done(function($id) {
                console.log($id);
            });
        },
        afterItemDelete: function ($list, $object) {
            $.ajax({
                url: Routing.generate('task_delete', {'id': $object.id}),
            }).done(function($id) {
                console.log($id);
            });
        },
        afterMarkAsDone: function ($list, $object) {
            $id = $object.parent().parent().attr('data-id');

            $.ajax({
                url: Routing.generate('task_do', {'id': $id}),
            }).done(function($status) {
                console.log($status);
            });
        },
        afterMarkAsUndone: function ($list, $object) {
            $id = $object.parent().parent().attr('data-id');

            $.ajax({
                url: Routing.generate('task_undo', {'id': $id}),
            }).done(function($status) {
                console.log($status);
            });
        },
        afterItemReorder: function (list, object) {
            var order = new Array();
            var listContainer = list.$body.parent();
            var id = listContainer.attr('id');

            listContainer.find('li').each(function() {
                order.push($(this).attr('data-id'));
            });

            $.ajax({
                url: Routing.generate('task_move', {'id': list.$options.id, 'order': order}),
            }).done(function($status) {
                console.log($status);
            });
        },
        afterListReorder: function(lobilist, list) {
            reorderTodoList();
        }
    });

    lobilist = $('#todo-lists').data('lobiList');

    $('#add-tasklist').click(function(){
        lobilist.addList({
            title: '...',
            defaultStyle: 'lobilist-default',
            useCheckboxes: false,
            item: [],
            id: 'new'
        });
    });

    var glyph_opts = {
        map: {
            doc: "glyphicon glyphicon-folder-close",
            docOpen: "glyphicon glyphicon-folder-open",
            checkbox: "glyphicon glyphicon-unchecked",
            checkboxSelected: "glyphicon glyphicon-check",
            checkboxUnknown: "glyphicon glyphicon-share",
            dragHelper: "glyphicon glyphicon-play",
            dropMarker: "glyphicon glyphicon-arrow-right",
            error: "glyphicon glyphicon-warning-sign",
            expanderClosed: "glyphicon glyphicon-menu-right",
            expanderLazy: "glyphicon glyphicon-menu-right",  // glyphicon-plus-sign
            expanderOpen: "glyphicon glyphicon-menu-down",  // glyphicon-collapse-down
            folder: "glyphicon glyphicon-folder-close",
            folderOpen: "glyphicon glyphicon-folder-open",
            loading: "glyphicon glyphicon-refresh glyphicon-spin"
        }
    };

    // Fancytree
    $("#tree").fancytree({
        extensions: ["dnd", "glyph", "edit"],
        dnd: {
            autoExpandMS: 400,
            focusOnClick: true,
            preventVoidMoves: true, // Prevent dropping nodes 'before self', etc.
            preventRecursiveMoves: true, // Prevent dropping nodes on own descendants
            dragStart: function(node, data) {
                /** This function MUST be defined to enable dragging for the tree.
                 *  Return false to cancel dragging of node.
                 */
                return true;
            },
            dragEnter: function(node, data) {
                /** data.otherNode may be null for non-fancytree droppables.
                 *  Return false to disallow dropping on node. In this case
                 *  dragOver and dragLeave are not called.
                 *  Return 'over', 'before, or 'after' to force a hitMode.
                 *  Return ['before', 'after'] to restrict available hitModes.
                 *  Any other return value will calc the hitMode from the cursor position.
                 */
                // Prevent dropping a parent below another parent (only sort
                // nodes under the same parent)
                /*           if(node.parent !== data.otherNode.parent){
                 return false;
                 }
                 // Don't allow dropping *over* a node (would create a child)
                 return ["before", "after"];
                 */
                return true;
            },
            dragDrop: function(node, data) {
                /** This function MUST be defined to enable dropping of items on
                 *  the tree.
                 */
                data.otherNode.moveTo(node, data.hitMode);

                console.log(data.hitMode);

                $.ajax({
                    url: Routing.generate('subject_move', {'id': data.otherNode.key, 'toId': node.key, 'mode': data.hitMode}),
                }).done(function(status) {
                    console.log('moved');
                });
            }
        },
        glyph: glyph_opts,
        edit: {
            triggerStart: ["f2", "shift+click", "mac+enter"],
            beforeEdit: function (event, data) {
                // Return false to prevent edit mode
            },
            edit: function (event, data) {
                data.input.select();
                console.log(data.input.val());
                // Editor was opened (available as data.input)
            },
            beforeClose: function (event, data) {
                // Return false to prevent cancel/save (data.input is available)
            },
            save: function (event, data) {
                if (data.node.key == 'new') {
                    $.ajax({
                        url: Routing.generate('subject_new', {'label': data.input.val()}),
                    }).done(function(id) {
                        window.open(Routing.generate('subject_show', {'id': id}), '_self');
                    });
                } else {
                    $.ajax({
                        url: Routing.generate('subject_edit', {'id': data.node.key, 'label': data.input.val()}),
                    }).done(function(id) {
                        console.log('edited');
                    });
                }

                return true;
            },
            close: function (event, data) {
                // Editor was removed
                if (data.save) {
                    // Since we started an async request, mark the node as preliminary
                    $(data.node.span).addClass("pending");
                }
            }
        },
        activate: function(event, data) {
            var node = data.node;
            window.open(node.data.href, '_self');
        }
    });

    $('#add-subject').click(function () {
        var activeNode = $("#tree").fancytree("getRootNode");

        node = activeNode.addChildren({
            title: '...',
            key: 'new'
        });

        node.editStart();
    });

    // Delete subject
    $('#confirmDelete').on('show.bs.modal', function (e) {
        $('#confirm-delete').off().on('click', function(){
            window.open($(e.relatedTarget).attr('data-href'), '_self');
        });
    })
});

function initLobiPanel(selector)
{
    $(selector+':not(.prototype)').lobiPanel({
        sortable: true,
        reload: false
    });

    // Edit title
    $(selector).off('onSaveTitle.lobiPanel');
    $(selector).on('onSaveTitle.lobiPanel', function(ev, lobiPanel){
        var id =$(lobiPanel.$el[0]).attr('id');
        var title = $(lobiPanel.$el[0]).find('.panel-title').text();

        $.ajax({
            url: Routing.generate('content_edit', {'id': id, 'title': title}),
        }).done(function($id) {
            console.log('edited');
        });
    });

    // Close - SOFT DELETE
    $(selector).on('beforeClose.lobiPanel', function(ev, lobiPanel){
        var id =$(lobiPanel.$el[0]).attr('id');

        $.ajax({
            url: Routing.generate('content_delete', {'id': id}),
        }).done(function($status) {
            console.log($status);
        });
    });

    // Collapse
    $(selector).on('beforeMinimize.lobiPanel', function(ev, lobiPanel){
        var id =$(lobiPanel.$el[0]).attr('id');

        $.ajax({
            url: Routing.generate('content_collapse', {'id': id}),
        }).done(function($status) {
            console.log($status);
        });
    });

    // Open
    $(selector).on('beforeMaximize.lobiPanel', function(ev, lobiPanel){
        var id =$(lobiPanel.$el[0]).attr('id');

        $.ajax({
            url: Routing.generate('content_open', {'id': id}),
        }).done(function($status) {
            console.log($status);
        });
    });

    // Unpin
    $(selector).on('onUnpin.lobiPanel', function(ev, lobiPanel){
        lobiPanel.setSize(360, 500)
            .setPosition(15, 255);
    });

    // Reorder
    $(selector).on('dragged.lobiPanel', function(ev, lobiPanel){
        var firstBlock = new Array();

        $('#first-block .panel:not(.prototype)').each(function(){
            firstBlock.push($(this).attr('id'));
        });

        var leftBlock = new Array();

        $('#left-block .panel:not(.prototype)').each(function(){
            leftBlock.push($(this).attr('id'));
        });

        var rightBlock = new Array();

        $('#right-block .panel:not(.prototype)').each(function(){
            rightBlock.push($(this).attr('id'));
        });

        $.ajax({
            url: Routing.generate('content_reorder', {'firstBlock': firstBlock, 'leftBlock': leftBlock, 'rightBlock': rightBlock}),
        }).done(function($status) {
            console.log($status);
        });
    });

}

function reorderTodoList()
{
    var order = new Array();

    $('#todo-lists .lobilist').each(function(){
        order.push($(this).attr('id'));
    });

    $.ajax({
        url: Routing.generate('tasklist_reorder', {'order': order}),
    }).done(function($status) {
        console.log($status);
    });
}