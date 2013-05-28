var mp3Pl = {
    init : function() {
        jQuery('.form-submit').click(function(e) {
            e.preventDefault();

            jQuery('#footer-form input[type=text]').click(function(e) {
                var inputval = jQuery(this).val();
                if(inputval == 'Please enter a name' || inputval == 'Please enter an e-mail')
                    jQuery(this).val('');
            });

            jQuery('#footer-form input[type=email]').click(function(e) {
                var inputval = jQuery(this).val();
                if(inputval == 'Please enter an e-mail')
                    jQuery(this).val('');
            });

            jQuery('#footer-form textarea').click(function(e) {
                var inputval = jQuery(this).val();
                if(inputval == 'Please add a message')
                    jQuery(this).val('');
            });

            var name = jQuery("#mp3_name"),
                email = jQuery("#mp3_email"),
                message = jQuery("#mp3_message");
            if(name.val() == '')
                name.val('Please enter a name');
            if(email.val() == '')
                email.val('Please enter an e-mail');
            if(message.val() == '')
                message.val('Please add a message');
            if(name.val() != '' && name.val != 'Please enter a name'
                && email.val() != '' && email.val() != 'Please enter an e-mail' 
                && message.val() != '' && message.val() != 'Please add a message')
            {
                data_html = "name=" + name.val() + "&email="+ email.val() + "&message=" + message.val() + "&submit=1";
                jQuery.ajax({
                    type: 'POST',
                    url: 'process.php',
                    data: data_html,
                    success: function(msg){
                        
                        if (msg == 'sent'){
                            jQuery("#footer-form").fadeOut(400);
                            jQuery("span#success").html("Message sent!").fadeIn(400);
                        } else{
                            jQuery("span#success").html('Mail Error. Please Try Again!'); 
                            jQuery("span#success").fadeIn(400);
                        }
                    }
                });
            }

        });

        jQuery('input, textarea').placeholder();

        jQuery('.slider').flexslider({
            'controlNav': true,
            'directionNav' : false,
            "touch": true,
            "animation": "slide",
            "animationLoop": true,
            "slideshow" : false
        });

        new jPlayerPlaylist({
            jPlayer: "#jplayer_1",
            cssSelectorAncestor: "#jplayer_container"
        }, [
            {
                title:"J. Lang - In Peace, The Love & Happiness Mix",
                mp3:"mp3/djlang59_-_In_Peace_The_Love_Happiness_Mix.mp3"
            },
            {
                title:"George Ellinas - Hornet",
                mp3:"mp3/George_Ellinas_-_Hornet.mp3"
            },
            {
                title:"Pitx - Black Rainbow",
                mp3:"mp3/Pitx_-_Black_Rainbow.mp3"
            }
        ], {
            preload : "auto",
            swfPath: "mp3js",
            supplied: "mp3"
        });

        jQuery('#main .jp-jplayer').each(function(index) {
            var i = index+1;

            var element = jQuery(this);
            var song = "mp3/"+element.find('.path').text();
            element.jPlayer({
                ready: function () {
                    jQuery(this).jPlayer("setMedia", {
                        mp3: song
                    });
                },

                preload : "auto",

                pause : function() {
                    var index = jQuery(this).attr("id");
                    index = index.split("_");
                    index = index[index.length-1];
                    var el = jQuery("#jp_container_"+index);
                    el.find('.jp-progress,.jp-time-holder')
                        .slideToggle();
                },
                play: function() { // To avoid both jPlayers playing together.
                    jQuery(this).jPlayer("pauseOthers");
                    var index = jQuery(this).attr("id");
                    index = index.split("_");
                    index = index[index.length-1];
                    var el = jQuery("#jp_container_"+index);
                    el.find('.jp-progress,.jp-time-holder')
                        .slideToggle();
                },

                swfPath: "mp3js",
                supplied: "m4a, mp3",
                cssSelectorAncestor:"#jp_container_"+i
            });
        });


        jQuery('#daily-event').flexslider({
            'controlNav': false,
            'directionNav' : false,
            "touch": true,
            "animation": "slide",
            "animationLoop": true,
            "slideshow" : false
        });
        jQuery('.today-event-controls .next').click(function(){
            $('#daily-event').flexslider("next");
            return false;
        });
        jQuery('.today-event-controls .prev').click(function(){
            $('#daily-event').flexslider("prev");
            return false;
        });

        jQuery('.go-up').click(mp3Pl.scrollTop);

        jQuery("nav > ul").tinyNav({
            active: 'active',
            header: 'Navigation'
        });
        jQuery('.l_tinynav1').addClass('hidden-phone');
        jQuery('#tinynav1').addClass('visible-phone');
        jQuery('.options-line .btn-view').click(mp3Pl.changeView);

        if (jQuery(window).width() > 768) {
            jQuery('.today-event .right').height(jQuery('.today-event .left').height());
        }
    },

    changeView : function() {
        var element = jQuery(this);
        if(element.hasClass('list')) {
            if (jQuery('.new-albums').hasClass('list')) return false;
            jQuery('.new-albums').removeClass('grid').addClass('list');
            jQuery('.options-line .btn-view.grid').removeClass('active');
            element.addClass('active');
        }
        if(element.hasClass('grid')) {
            if (jQuery('.new-albums').hasClass('grid')) return false;
            jQuery('.new-albums').removeClass('list').addClass('grid');
            jQuery('.options-line .btn-view.list').removeClass('active');
            element.addClass('active');
        }
        return false;
    },

    scrollTop : function() {
        jQuery('body, html').animate({
                scrollTop:  "0px"
            }, 500);
            return false;
    }
};

jQuery(document).ready(function(){
    mp3Pl.init();
    var fileW = jQuery('.content .file').width();
    jQuery('.content .file .name').width(fileW - 90);
    var jplayerW = jQuery('.content .jp-audio.custom').width();
    jQuery('.content .jp-audio.custom .name').width(jplayerW - 84);

    var evnts = function(){
        return {
            "event":
                [
                    {"date":"01/28/2013","title":"28", "link" : "/events-article.html"}
                    ,{"date":"01/07/2013","title":"2", "link" : "/events-article.html"}
                    ,{"date":"01/14/2013","title":"34", "link" : "/events-article.html"}
                    ,{"date":"01/12/2013","title":"11", "link" : "/events-article.html"}
                ]
        }
    };
    $('#calendar').Calendar({ 'events': evnts, 'weekStart': 1 })
            .on('changeDay', function(event){
//                alert(event.day.valueOf() +'-'+ event.month.valueOf() +'-'+ event.year.valueOf() );
            })
            .on('onEvent', function(event){
//                alert(event.day.valueOf() +'-'+ event.month.valueOf() +'-'+ event.year.valueOf() );
            })
            .on('onNext', function(event){
//                alert("Next");
            })
            .on('onPrev', function(event){
//                alert("Prev");
            })
            .on('onCurrent', function(event){
//                alert("Current");
            });

    var ts = new Date(2013, 2, 1);
    $('article.art1 .countdown').countdown({
        timestamp	: ts
    });
    ts = new Date(2013, 2, 2);
    $('article.art2 .countdown').countdown({
        timestamp	: ts
    });
    ts = new Date(2013, 2, 5);
    $('article.art3 .countdown').countdown({
        timestamp	: ts
    });
    ts = new Date(2013, 2, 10);
    $('article.art4 .countdown').countdown({
        timestamp	: ts
    });
    ts = new Date(2013, 3, 10);
    $('article.art5 .countdown').countdown({
        timestamp	: ts
    });
    ts = new Date(2013, 3, 10);
    $('article.art6 .countdown').countdown({
        timestamp	: ts
    });
    ts = new Date(2013, 3, 2);
    $('article.art7 .countdown').countdown({
        timestamp	: ts
    });
    ts = new Date(2013, 3, 3);
    $('article.art8 .countdown').countdown({
        timestamp	: ts
    });
    ts = new Date(2013, 2, 11);
    $('article.art9 .countdown').countdown({
        timestamp	: ts
    });
    ts = new Date(2013, 2, 11);
    $('.today01 .countdown').countdown({
        timestamp	: ts
    });
    ts = new Date(2013, 1, 11);
    $('.today02 .countdown').countdown({
        timestamp	: ts
    });
    ts = new Date(2013, 2, 11);
    $('.countdown-article .countdown').countdown({
        timestamp	: ts
    });

});
jQuery(window).resize(function(){
    var fileW = jQuery('.content .file').width();
    jQuery('.content .file .name').width(fileW - 90);

    var jplayerW = jQuery('.content .jp-audio.custom').width();
    jQuery('.content .jp-audio.custom .name').width(jplayerW - 84);

    if (jQuery(window).width() > 768) {
        jQuery('.today-event .right').height(jQuery('.today-event .left').height());
    }
});