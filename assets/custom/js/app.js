// Put your JS here, and make sure it's built with assets.ini to have an effect
// Example for initializing Foundation is below

if ($('.dzcard').length) {
    var previewTemplate = $('.dzcard')[0].innerHTML;
    $('.dzcard').remove();
    Dropzone.options.zone = {
        paramName: "file", // The name that will be used to transfer the file
        url: '/post/imageprocess',
        thumbnailWidth: 300,
        thumbnailHeight: null,
        uploadMultiple: true,
        method: "post",
        previewsContainer: '#imagePreview',
        previewTemplate: previewTemplate,
        clickable: true,
        acceptedFiles: 'image/*',
        autoProcessQueue: true,
        accept: function(file, done) {
            if (file.name == "justinbieber.jpg") {
                done("Naha, you don't.");
            }
            else { done(); }
        },
        success: function(file, response) {
            console.log(response);
            $(file.previewElement).find('.diffbot-info').text("Whatever!");
        },
        removedfile: function(file) {
            console.log("Removing");
            console.log(file);
            // TODO: add removing of file
            // add adding to server when uploaded
            // add unique form identifier for ad for every upload
            // add progress indicator for both upload and diffbot processing
            // add deletion from server based on unique ID in the preview elements?
        }
    };
}


$(document)
    .ready(function() {

        // fix menu when passed
        $('.masthead')
            .visibility({
                once: false,
                onBottomPassed: function() {
                    $('.fixed.menu').transition('fade in');
                },
                onBottomPassedReverse: function() {
                    $('.fixed.menu').transition('fade out');
                }
            })
        ;

        // create sidebar and attach to menu open
        $('.ui.sidebar')
            .sidebar('attach events', '.toc.item')
        ;

        // Activate tabs
        $('.tabular .item').tab();

        $('.accordion').accordion();

        $('.wiznext').on('click', function(e){
            var parent = $(e.currentTarget).closest('.segment');
            var nextStep = parent.next();
            wizardOpen(nextStep.attr('id'));
            return false;
        });

        $('.nav-tabs a[data-toggle="tab"]').on('click', function(e) {
            wizardOpen($(e.currentTarget).attr('aria-controls'));
        });

    });

function wizardOpen(id) {
    $('.nav-tabs li').removeClass('active');
    var nextLink = $('.nav-tabs a[data-toggle="tab"][aria-controls="'+id+'"]');
    nextLink.parent('li').addClass('active');
    nextLink.removeClass('disabled');
    $('.wizard .row form>.segment').hide();
    $('.wizard .row form>.segment#'+id).show();
}
