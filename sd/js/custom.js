$(document).ready(function() {


    var userFeed = new Instafeed({
        get: 'user',
        userId: '7033844108',
        limit: 12,
        resolution: 'standard_resolution',
        accessToken: '7033844108.1677ed0.aa0f7bb30da542c7b9c71db1f020f261',
        sortBy: 'most-recent',
        template: '<div class="col-lg-3 instaimg"><a href="{{image}}" title="{{caption}}" target="_blank"><img src="{{image}}" alt="{{caption}}" class="img-fluid"/></a></div>',
    });


    userFeed.run();

    
    // This will create a single gallery from all elements that have class "gallery-item"
    $('.gallery').magnificPopup({
        type: 'image',
        delegate: 'a',
        gallery: {
            enabled: true
        }
    });


});