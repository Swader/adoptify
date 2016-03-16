// Put your JS here, and make sure it's built with assets.ini to have an effect
// Example for initializing Foundation is below

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