 jQuery(function($) {
  
    $(document).ready(function() {
        var scroll;

        $(".banner").css({"height": $(window).height() + "px"});

        $(window).scroll(function() {
            scroll = $(window).scrollTop();

            if (scroll > 200) {
                $("header").css({"background-color": "#3c3c3c"});
                $("header .logo").css({"margin-top": "5px"});
                $("header .logo img").css({"width": "65%"});
            } else {
                $("header").css({"background-color": "rgba(0,0,0,0.3)"});
                $("header .logo").css({"margin-top": "150px"});
                $("header .logo img").css({"width": "100%"});
            }

            if (scroll > 400) {
                $("header .headline").fadeOut("fast");
            } else {
                $("header .headline").fadeIn("slow");
            }

        });
    });

    $(function(){
        if (navigator.userAgent.match(/(iPod|iPhone|iPad|Android)/)) {
            $('#ios-notice').removeClass('hidden');
            $('.parallax-container').height( $(window).height() * 0.5 | 0 );
        } else {
            $(window).resize(function(){
                var parallaxHeight = Math.max($(window).height() * 0.7, 200) | 0;
                $('.parallax-container').height(parallaxHeight);
            }).trigger('resize');
        }
    });

});
