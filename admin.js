jQuery(document).ready(function($){
    var frame;
    $('#haitruong_gallery_button').on('click', function(e) {
        e.preventDefault();
        
        if (frame) {
            frame.open();
            return;
        }
        
        frame = wp.media({
            title: 'Select Gallery Images',
            button: {
                text: 'Use these images'
            },
            multiple: true
        });
        
        frame.on('select', function() {
            var selection = frame.state().get('selection');
            var ids = [];
            selection.map(function(attachment) {
                attachment = attachment.toJSON();
                ids.push(attachment.id);
            });
            $('#project_gallery').val(ids.join(','));
            $('#haitruong_gallery_count strong').text(ids.length);
        });
        
        frame.open();
        
        // Pre-select current images
        var current_ids = $('#project_gallery').val();
        if (current_ids) {
            var selection = frame.state().get('selection');
            current_ids.split(',').forEach(function(id) {
                if (id) {
                    var attachment = wp.media.attachment(id);
                    attachment.fetch();
                    selection.add(attachment ? [attachment] : []);
                }
            });
        }
    });
});
