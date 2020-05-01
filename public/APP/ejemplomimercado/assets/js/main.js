function showLoading(s){return s?s.LoadingOverlay("show",{image:"",custom:$('<div class="d-flex justify-content-center"><div class="loader-shopping-cart"></div></div>')}):null}function hideLoading(s){return s?s.LoadingOverlay("hide"):null}!function(s){"use strict";function e(){return d.fadeOut("fast")}function t(){return d.stop().slideUp(400)}function i(){return d.stop().slideDown(600)}function o(e){"success"===e.result?(s(".mailchimp-success").html(""+e.msg).fadeIn(900),s(".mailchimp-error").fadeOut(400)):"error"===e.result&&s(".mailchimp-error").html(""+e.msg).fadeIn(900)}function a(){l.width()<=991?h.slideUp():h.slideDown()}function n(){l.width()<=991?(s(".category-menu .menu-item-has-children > a").prepend('<i class="expand menu-expand"></i>'),s(".category-menu .menu-item-has-children ul").slideUp()):(s(".category-menu .menu-item-has-children > a i").remove(),s(".category-menu .menu-item-has-children ul").slideDown())}var l=s(window),r=(l.width(),s(".header-sticky")),c=s(".menubar-top");l.on("scroll",function(){var t=l.scrollTop(),i=s(".sticky-logo-scroll"),o=s(".stick-menu-scroll");t<300?(r.removeClass("is-sticky"),c.removeClass("d-none"),c.addClass("d-flex"),i.removeClass("col-md-2"),i.addClass("col-md-3"),o.removeClass("col-md-10"),o.addClass("col-md-9")):(r.addClass("is-sticky"),c.addClass("d-none"),c.removeClass("d-flex"),i.removeClass("col-md-3"),i.addClass("col-md-2"),o.removeClass("col-md-9"),o.addClass("col-md-10"),screen.width<767&&(r.addClass("is-sticky"),c.addClass("d-none"),c.removeClass("d-flex"))),t>=400?(s(".scroll-cart").fadeIn(),s(".scroll-top").fadeIn(),e()):(s(".scroll-cart").fadeOut(),s(".scroll-top").fadeOut(),s("#cart-floating-box-fixed").fadeOut())}),s("body").on("click","#open_cart_popup",function(e){s("#cart-floating-box-fixed").stop().slideDown(600)}),s("body").on("click",".close_cart_popup",function(e){s("#cart-floating-box-fixed").stop().slideUp(600)}),s(".scroll-top").on("click",function(){s("html,body").animate({scrollTop:0},2e3)});var d=s("#cart-floating-box");s(".open_shopping_cart").click(function(){i()}),s(document).click(function(e){s(e.target).closest(".shopping-cart").length||t()}),s(".hero-slider-one").slick({arrows:!0,autoplay:!0,autoplaySpeed:8e3,dots:!1,pauseOnFocus:!1,pauseOnHover:!1,fade:!0,infinite:!0,slidesToShow:1,prevArrow:'<button type="button" class="slick-prev"><i class="fa fa-chevron-left"></i></button>',nextArrow:'<button type="button" class="slick-next"><i class="fa fa-chevron-right"></i></button>'}),s(".hero-slider-two").slick({arrows:!0,autoplay:!0,autoplaySpeed:1e4,dots:!1,pauseOnFocus:!1,pauseOnHover:!1,fade:!0,infinite:!0,slidesToShow:1,adaptiveHeight:!0,prevArrow:'<button type="button" class="slick-prev"><i class="fa fa-chevron-left"></i></button>',nextArrow:'<button type="button" class="slick-next"><i class="fa fa-chevron-right"></i></button>'}),s(".hero-slider-three").slick({arrows:!1,autoplay:!0,autoplaySpeed:1e4,dots:!0,pauseOnFocus:!1,pauseOnHover:!1,fade:!0,infinite:!0,slidesToShow:1}),s(".blog-image-gallery").slick({prevArrow:'<button type="button" class="slick-prev"><i class="fa fa-chevron-left"></i></button>',nextArrow:'<button type="button" class="slick-next"><i class="fa fa-chevron-right"></i></button>',arrows:!0,autoplay:!1,autoplaySpeed:5e3,dots:!1,pauseOnFocus:!1,pauseOnHover:!1,infinite:!0,slidesToShow:1}),s(".store-images").slick({prevArrow:'<button type="button" class="slick-prev"><i class="fa fa-chevron-left"></i></button>',nextArrow:'<button type="button" class="slick-next"><i class="fa fa-chevron-right"></i></button>',arrows:!0,autoplay:!0,autoplaySpeed:5e3,dots:!1,pauseOnFocus:!1,pauseOnHover:!1,infinite:!0,slidesToShow:1,adaptiveHeight:!0}),s(".category-slider-container").slick({arrows:!0,autoplay:!1,draggable:!1,dots:!1,infinite:!0,slidesToShow:6,prevArrow:'<button type="button" class="slick-prev"><i class="fa fa-caret-left"></i></button>',nextArrow:'<button type="button" class="slick-next"><i class="fa fa-caret-right"></i></button>',responsive:[{breakpoint:1499,settings:{slidesToShow:6}},{breakpoint:1199,settings:{slidesToShow:5}},{breakpoint:991,settings:{slidesToShow:4}},{breakpoint:767,settings:{slidesToShow:3}},{breakpoint:575,settings:{slidesToShow:2}}]}),s(".blog-slider-container").slick({arrows:!0,autoplay:!1,dots:!1,infinite:!0,slidesToShow:3,prevArrow:'<button type="button" class="slick-prev"><i class="fa fa-caret-left"></i></button>',nextArrow:'<button type="button" class="slick-next"><i class="fa fa-caret-right"></i></button>',responsive:[{breakpoint:1499,settings:{slidesToShow:3}},{breakpoint:1199,settings:{slidesToShow:3}},{breakpoint:991,settings:{slidesToShow:2}},{breakpoint:767,settings:{slidesToShow:2}},{breakpoint:575,settings:{slidesToShow:1}}]}),s(".brand-logo-wrapper").slick({arrows:!0,autoplay:!0,dots:!1,infinite:!0,slidesToShow:5,prevArrow:'<button type="button" class="slick-prev"><i class="fa fa-caret-left"></i></button>',nextArrow:'<button type="button" class="slick-next"><i class="fa fa-caret-right"></i></button>',responsive:[{breakpoint:1499,settings:{slidesToShow:5}},{breakpoint:1199,settings:{slidesToShow:5}},{breakpoint:991,settings:{slidesToShow:4}},{breakpoint:767,settings:{slidesToShow:3}},{breakpoint:575,settings:{slidesToShow:2}}]}),s(".best-seller-slider-container").slick({arrows:!0,autoplay:!0,autoplaySpeed:3e3,dots:!1,infinite:!0,slidesToShow:3,prevArrow:'<button type="button" class="slick-prev"><i class="fa fa-caret-left"></i></button>',nextArrow:'<button type="button" class="slick-next"><i class="fa fa-caret-right"></i></button>',responsive:[{breakpoint:1499,settings:{slidesToShow:3}},{breakpoint:1199,settings:{slidesToShow:3}},{breakpoint:991,settings:{slidesToShow:3}},{breakpoint:767,settings:{slidesToShow:2}},{breakpoint:575,settings:{slidesToShow:2}},{breakpoint:479,settings:{slidesToShow:1}}]}),s(".tab-slider-container").slick({arrows:!0,autoplay:!1,dots:!1,infinite:!0,slidesToShow:4,prevArrow:'<button type="button" class="slick-prev"><i class="fa fa-caret-left"></i></button>',nextArrow:'<button type="button" class="slick-next"><i class="fa fa-caret-right"></i></button>',responsive:[{breakpoint:1499,settings:{slidesToShow:4}},{breakpoint:1199,settings:{slidesToShow:4}},{breakpoint:991,settings:{slidesToShow:3}},{breakpoint:767,settings:{slidesToShow:2}},{breakpoint:575,settings:{slidesToShow:2}},{breakpoint:479,settings:{slidesToShow:1}}]}),s(".banner-slider-container").slick({pauseOnFocus:1,pauseOnHover:!1,pauseOnDotsHover:!1,slidesToScroll:4,speed:8000,arrows:!0,autoplay:!0,dots:!1,infinite:!0,slidesToShow:4,lazyLoad:"progressive",prevArrow:'<button type="button" class="slick-prev"><i class="fa fa-caret-left"></i></button>',nextArrow:'<button type="button" class="slick-next"><i class="fa fa-caret-right"></i></button>',responsive:[{breakpoint:1499,settings:{slidesToShow:4}},{breakpoint:1199,settings:{slidesToShow:4}},{breakpoint:991,settings:{slidesToShow:2}},{breakpoint:767,settings:{slidesToShow:2,slidesToScroll:2}},{breakpoint:575,settings:{slidesToShow:2,slidesToScroll:2}},{breakpoint:479,settings:{slidesToShow:1,slidesToScroll:1}}]}),s(".multisale-slider-wrapper").slick({arrows:!0,autoplay:!1,dots:!1,infinite:!0,slidesToShow:4,prevArrow:'<button type="button" class="slick-prev"><i class="fa fa-caret-left"></i></button>',nextArrow:'<button type="button" class="slick-next"><i class="fa fa-caret-right"></i></button>',responsive:[{breakpoint:1499,settings:{slidesToShow:4}},{breakpoint:1199,settings:{slidesToShow:3}},{breakpoint:991,settings:{slidesToShow:2}},{breakpoint:767,settings:{slidesToShow:2}},{breakpoint:575,settings:{slidesToShow:2}},{breakpoint:479,settings:{slidesToShow:1}}]}),s(".related-product-slider-wrapper").slick({arrows:!0,autoplay:!1,dots:!1,infinite:!0,slidesToShow:4,prevArrow:'<button type="button" class="slick-prev"><i class="fa fa-caret-left"></i></button>',nextArrow:'<button type="button" class="slick-next"><i class="fa fa-caret-right"></i></button>',responsive:[{breakpoint:1499,settings:{slidesToShow:4}},{breakpoint:1199,settings:{slidesToShow:4}},{breakpoint:991,settings:{slidesToShow:3}},{breakpoint:767,settings:{slidesToShow:2}},{breakpoint:575,settings:{slidesToShow:1}}]}),s(".sale-single-product-container").slick({arrows:!0,autoplay:!1,dots:!1,infinite:!0,slidesToShow:1,prevArrow:'<button type="button" class="slick-prev"><span class="arrow_carrot-left"></span></button>',nextArrow:'<button type="button" class="slick-next"><span class="arrow_carrot-right"></span></button>',responsive:[{breakpoint:1200,settings:{slidesToShow:1}},{breakpoint:991,settings:{slidesToShow:1,arrows:!1}},{breakpoint:480,settings:{slidesToShow:1,arrows:!1}}]}),s(".small-image-slider-single-product").slick({prevArrow:'<i class="fa fa-angle-up"></i>',nextArrow:'<i class="fa fa-angle-down slick-next-btn"></i>',slidesToShow:3,vertical:!0,responsive:[{breakpoint:1200,settings:{slidesToShow:3,slidesToScroll:1}},{breakpoint:991,settings:{slidesToShow:3,slidesToScroll:1}},{breakpoint:767,settings:{slidesToShow:3,slidesToScroll:3}},{breakpoint:480,settings:{prevArrow:'<i class="fa fa-angle-left"></i>',nextArrow:'<i class="fa fa-angle-right slick-next-btn"></i>',vertical:!1,slidesToShow:2,slidesToScroll:1}}]}),s(".small-image-slider-single-product a").on("click",function(e){e.preventDefault();var t=s(this).closest(".product-image-slider"),i=s(this).attr("href");t.find(".small-image-slider-single-product a").removeClass("active"),s(this).addClass("active"),t.find(".product-large-image-list .tab-pane").removeClass("active show"),t.find(".product-large-image-list "+i).addClass("active show")}),s(".small-image-slider-single-product-tabstyle-3").slick({prevArrow:'<i class="fa fa-angle-left"></i>',nextArrow:'<i class="fa fa-angle-right slick-next-btn"></i>',slidesToShow:3,responsive:[{breakpoint:1200,settings:{slidesToShow:3,slidesToScroll:1}},{breakpoint:991,settings:{slidesToShow:3,slidesToScroll:1}},{breakpoint:767,settings:{slidesToShow:3,slidesToScroll:3}},{breakpoint:480,settings:{slidesToShow:2,slidesToScroll:2}}]}),s(".small-image-slider-single-product-tabstyle-3 a").on("click",function(e){e.preventDefault();var t=s(this).closest(".product-image-slider"),i=s(this).attr("href");t.find(".small-image-slider-single-product-tabstyle-3 a").removeClass("active"),s(this).addClass("active"),t.find(".product-large-image-list .tab-pane").removeClass("active show"),t.find(".product-large-image-list "+i).addClass("active show")}),s(".product-image-gallery-slider").slick({prevArrow:'<i class="fa fa-angle-left"></i>',nextArrow:'<i class="fa fa-angle-right slick-next-btn"></i>',slidesToShow:3,responsive:[{breakpoint:1200,settings:{slidesToShow:3,slidesToScroll:1}},{breakpoint:991,settings:{slidesToShow:2,slidesToScroll:1}},{breakpoint:767,settings:{slidesToShow:2,slidesToScroll:1}},{breakpoint:480,settings:{slidesToShow:1,slidesToScroll:1}}]}),s(".small-image-slider").slick({prevArrow:'<i class="fa fa-angle-left"></i>',nextArrow:'<i class="fa fa-angle-right slick-next-btn"></i>',slidesToShow:3,responsive:[{breakpoint:1200,settings:{slidesToShow:3,slidesToScroll:3}},{breakpoint:991,settings:{slidesToShow:2,slidesToScroll:2}},{breakpoint:767,settings:{slidesToShow:3,slidesToScroll:3}},{breakpoint:480,settings:{slidesToShow:3,slidesToScroll:3}}]}),s(".modal").on("shown.bs.modal",function(e){s(".small-image-slider").resize(),s(".small-image-slider").slick("setPosition")}),s(".small-image-slider a").on("click",function(e){e.preventDefault();var t=s(this).closest(".product-image-slider"),i=s(this).attr("href");t.find(".small-image-slider a").removeClass("active"),s(this).addClass("active"),t.find(".product-large-image-list .tab-pane").removeClass("active show"),t.find(".product-large-image-list "+i).addClass("active show")}),s("[data-countdown]").each(function(){var e=s(this),t=s(this).data("countdown");e.countdown(t,function(s){e.html(s.strftime('<div class="single-countdown"><span class="single-countdown-time">%D</span><span class="single-countdown-text">Days</span></div><div class="single-countdown"><span class="single-countdown-time">%H</span><span class="single-countdown-text">Hours</span></div><div class="single-countdown"><span class="single-countdown-time">%M</span><span class="single-countdown-text">Mins</span></div><div class="single-countdown"><span class="single-countdown-time">%S</span><span class="single-countdown-text">Secs</span></div>'))})});var p=(s(".main-menu nav"),s(".main-menu-mobile nav"));s(".main-menu-other-homepage-remove-mean-bar nav").meanmenu({meanScreenWidth:"991",meanMenuContainer:".display-none"}),p.meanmenu({meanScreenWidth:"991",meanMenuContainer:".mobile-menu",meanMenuClose:'<span class="menu-close"></span>',meanMenuOpen:'<span class="menu-bar"></span>',meanRevealPosition:"right",meanMenuCloseSize:"0"}),s("#mc-form").ajaxChimp({language:"en",callback:o,url:"http://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef"});var u=(s(".category-toggle-wrap"),s(".category-toggle")),h=s(".category-menu");a(),l.resize(a),n(),l.resize(n),u.on("click",function(){h.slideToggle()}),s(".category-menu").on("click","li a, li a .menu-expand",function(e){var t=s(this).hasClass("menu-expand")?s(this).parent():s(this);if(t.parent().hasClass("menu-item-has-children")&&("#"===t.attr("href")||s(this).hasClass("menu-expand"))&&(t.siblings("ul:visible").length>0?t.siblings("ul").slideUp():(s(this).parents("li").siblings("li").find("ul:visible").slideUp(),t.siblings("ul").slideDown())),s(this).hasClass("menu-expand")||"#"===t.attr("href"))return e.preventDefault(),!1});var g=s(".sidebar-category li .children");g.slideUp(),g.parents("li").addClass("has-children"),s(".sidebar-category").on("click","li.has-children > a",function(e){if(s(this).parent().hasClass("has-children")&&(s(this).siblings("ul:visible").length>0?s(this).siblings("ul").slideUp():(s(this).parents("li").siblings("li").find("ul:visible").slideUp(),s(this).siblings("ul").slideDown())),"#"===s(this).attr("href"))return e.preventDefault(),!1}),s(".category-menu li.hidden").hide(),s("#more-btn").on("click",function(e){e.preventDefault(),s(".category-menu li.hidden").toggle(500);var t='<span class="icon_plus_alt2"></span> Más Categorias';s(this).html()==t?s(this).html('<span class="icon_minus_alt2"></span> Menos Categorias'):s(this).html(t)}),s(".big-image-popup").magnificPopup({type:"image",gallery:{enabled:!0}}),s(".easyzoom").easyZoom(),s("#product-feature-details").stickySidebar({topSpacing:90,bottomSpacing:-90,minWidth:767}),s("#price-range").slider({range:!0,min:0,max:2e3,values:[25,970],slide:function(e,t){s("#price-amount").val("Price: $"+t.values[0]+" - $"+t.values[1])}}),s("#price-amount").val("Price: $"+s("#price-range").slider("values",0)+" - $"+s("#price-range").slider("values",1)),s(".view-mode-icons a").on("click",function(e){e.preventDefault();var t=s(".shop-product-wrap"),i=s(this).data("target");s(".view-mode-icons a").removeClass("active"),s(this).addClass("active"),t.removeClass("grid list").addClass(i)}),s(".nice-select").niceSelect(),s("[data-shipping]").on("click",function(){s("[data-shipping]:checked").length>0?s("#shipping-form").slideDown():s("#shipping-form").slideUp()}),s('[name="payment-method"]').on("click",function(){var e=s(this).attr("value");s(".single-method p").slideUp(),s('[data-method="'+e+'"]').slideDown()})}(jQuery);