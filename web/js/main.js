var lobilist = null;

$(document).ready(function(){
    $('.panel').lobiPanel({
        sortable: true
    });

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
                console.log($id);
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
            }
        },
        glyph: glyph_opts,
        edit: {
            triggerStart: ["f2", "dblclick", "shift+click", "mac+enter"],
            beforeEdit: function (event, data) {
                // Return false to prevent edit mode
            },
            edit: function (event, data) {
                // Editor was opened (available as data.input)
            },
            beforeClose: function (event, data) {
                // Return false to prevent cancel/save (data.input is available)
            },
            save: function (event, data) {
                // Save data.input.val() or return false to keep editor open
                console.log("save...", this, data);
                // Simulate to start a slow ajax request...
                setTimeout(function () {
                    $(data.node.span).removeClass("pending");
                    // Let's pretend the server returned a slightly modified
                    // title:
                    data.node.setTitle(data.node.title + "*");
                }, 2000);
                // We return true, so ext-edit will set the current user input
                // as title
                return true;
            },
            close: function (event, data) {
                // Editor was removed
                if (data.save) {
                    // Since we started an async request, mark the node as preliminary
                    $(data.node.span).addClass("pending");
                }
            }
        }
    });
});