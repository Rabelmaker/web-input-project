$(function(){localStorage.getItem("spruhartl")=="true"?$("#navComplex").lightSlider({autoWidth:!0,pager:!1,slideMargin:3,rtl:!0}):$("#navComplex").lightSlider({autoWidth:!0,pager:!1,slideMargin:3,rtl:!1}),$(".main-nav-tabs .tab-link").on("click",function(a){a.preventDefault(),$(this).addClass("active"),$(this).parent().siblings().find(".tab-link").removeClass("active");var t=$(this).attr("href");$(t).addClass("active"),$(t).siblings().removeClass("active")})});