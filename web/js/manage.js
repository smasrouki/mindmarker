$(document).ready(function(){
    var sent = false;

    $('#subjects').lobiList({
        lists: subjects,
        onSingleLine: false,
        controls: [],
        useCheckboxes: false,
        afterItemReorder: function (list, object) {
            if(sent == false) {
                var id = object.attr('data-id');
                var subjectId = object.parent().parent().parent().attr('id');

                if(object.find('.lobilist-item-description').html() == 'C') {
                    // Content move
                    $.ajax({
                        url: Routing.generate('content_change_subject', {'id': id, 'subjectId': subjectId}),
                    }).done(function($status) {
                        sent = false;
                        console.log('Moved');
                    });
                } else {
                    // Tasklist move
                    $.ajax({
                        url: Routing.generate('tasklist_change_subject', {'id': id, 'subjectId': subjectId}),
                    }).done(function($status) {
                        sent = false;
                        console.log('Moved');
                    });
                }

                sent = true;
            }

        }
    });
});