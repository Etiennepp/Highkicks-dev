$(document).ready(function() {


       var userFeed = new Instafeed({
        get: 'user',
        userId: '8488820033',
        limit: 12,
        resolution: 'standard_resolution',
        accessToken: '8488820033.1677ed0.e037b7630224494796f746b38e8c29ad',
        sortBy: 'most-recent',
        template: '<div class="col-lg-4 instaimg"><a href="{{image}}" title="{{caption}}" target="_blank"><img src="{{image}}" alt="{{caption}}" class="img-fluid"/></a></div>',
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