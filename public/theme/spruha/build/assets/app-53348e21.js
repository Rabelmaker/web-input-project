$(function(){window.addEventListener("load",()=>{document.getElementById("global-loader").style.display="none"}),$("#global-loader").fadeOut("slow");const n="div.card";$(document).on("click",'[data-bs-toggle="card-remove"]',function(e){return $(this).closest(n).remove(),e.preventDefault(),!1}),$(document).on("click",'[data-bs-toggle="card-collapse"]',function(e){return $(this).closest(n).toggleClass("card-collapsed"),e.preventDefault(),!1}),$(document).on("click",'[data-bs-toggle="card-fullscreen"]',function(e){return $(this).closest(n).toggleClass("card-fullscreen").removeClass("card-collapsed"),e.preventDefault(),!1}),$(".layout-setting").on("click",function(e){document.querySelector("body").classList.contains("dark-theme")?($("body").removeClass("dark-theme"),$("body").addClass("light-theme"),$("#myonoffswitch3").prop("checked",!0),$("#myonoffswitch6").prop("checked",!0),localStorage.setItem("spruhalightMode",!0),localStorage.removeItem("spruhadarkMode"),$("#myonoffswitch1").prop("checked",!0)):($("body").addClass("dark-theme"),$("body").removeClass("light-theme"),$("#myonoffswitch5").prop("checked",!0),$("#myonoffswitch8").prop("checked",!0),localStorage.setItem("spruhadarkMode",!0),localStorage.removeItem("spruhalightMode"),$("#myonoffswitch2").prop("checked",!0))}),window.matchMedia("(min-width: 992px)").matches&&$(".main-header-menu .active").removeClass("show"),$(".main-header .dropdown > a").on("click",function(e){e.preventDefault(),$(this).parent().toggleClass("show"),$(this).parent().siblings().removeClass("show")}),$(".main-navbar .with-sub").on("click",function(e){e.preventDefault(),$(this).parent().toggleClass("show"),$(this).parent().siblings().removeClass("show")}),$(".dropdown-menu .main-header-arrow").on("click",function(e){e.preventDefault(),$(this).closest(".dropdown").removeClass("show")}),$("#mainSidebarToggle").on("click",function(e){e.preventDefault(),$("body.horizontalmenu").toggleClass("main-navbar-show")}),$("#mainContentLeftShow").on("click touch",function(e){e.preventDefault(),$("body").addClass("main-content-left-show")}),$("#mainContentLeftHide").on("click touch",function(e){e.preventDefault(),$("body").removeClass("main-content-left-show")}),$("#mainContentBodyHide").on("click touch",function(e){e.preventDefault(),$("body").removeClass("main-content-body-show")}),$("body").append('<div class="main-navbar-backdrop"></div>'),$(".main-navbar-backdrop").on("click touchstart",function(){$("body").removeClass("main-navbar-show")}),$(document).on("click touchstart",function(e){e.stopPropagation();var t=$(e.target).closest(".main-header .dropdown").length;if(t||$(".main-header .dropdown").removeClass("show"),window.matchMedia("(min-width: 992px)").matches){var c=$(e.target).closest(".main-navbar .nav-item").length;c||$(".main-navbar .show").removeClass("show");var r=$(e.target).closest(".main-header-menu .nav-item").length;r||$(".main-header-menu .show").removeClass("show"),$(e.target).hasClass("main-menu-sub-mega")&&$(".main-header-menu .show").removeClass("show")}else if(!$(e.target).closest("#mainMenuShow").length){var i=$(e.target).closest(".main-header-menu").length;i||$("body").removeClass("main-header-menu-show")}}),$("#mainMenuShow").on("click",function(e){e.preventDefault(),$("body").toggleClass("main-header-menu-show")}),$(".main-header-menu .with-sub").on("click",function(e){e.preventDefault(),$(this).parent().toggleClass("show"),$(this).parent().siblings().removeClass("show")}),$(".main-header-menu-header .close").on("click",function(e){e.preventDefault(),$("body").removeClass("main-header-menu-show")});var o=[].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));o.map(function(e){return new bootstrap.Popover(e)});var l=[].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));l.map(function(e){return new bootstrap.Tooltip(e)}),$(".toast").toast(),$(window).on("scroll",function(e){$(this).scrollTop()>0?$("#back-to-top").fadeIn("slow"):$("#back-to-top").fadeOut("slow")}),$(document).on("click","#back-to-top",function(e){return $("html, body").animate({scrollTop:0},0),!1}),$(document).on("click",".fullscreen-button",function(){$("html").addClass("fullscreen"),document.fullScreenElement!==void 0&&document.fullScreenElement===null||document.msFullscreenElement!==void 0&&document.msFullscreenElement===null||document.mozFullScreen!==void 0&&!document.mozFullScreen||document.webkitIsFullScreen!==void 0&&!document.webkitIsFullScreen?document.documentElement.requestFullScreen?document.documentElement.requestFullScreen():document.documentElement.mozRequestFullScreen?document.documentElement.mozRequestFullScreen():document.documentElement.webkitRequestFullScreen?document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT):document.documentElement.msRequestFullscreen&&document.documentElement.msRequestFullscreen():($("html").removeClass("fullscreen"),document.cancelFullScreen?document.cancelFullScreen():document.mozCancelFullScreen?document.mozCancelFullScreen():document.webkitCancelFullScreen?document.webkitCancelFullScreen():document.msExitFullscreen&&document.msExitFullscreen())}),$(".cover-image").each(function(){var e=$(this).attr("data-image-src");typeof e<"u"&&e!==!1&&$(this).css("background","url("+e+") center center")});function s(e){a===""?e.attr("href").indexOf("#")!==-1&&(e.parents(".main-navbar .nav-item").last().removeClass("active"),e.parents(".main-navbar .nav-sub").length&&e.parents(".main-navbar .nav-sub-item").last().removeClass("active")):e.attr("href").indexOf(a)!==-1&&(e.parents(".main-navbar .nav-item").last().addClass("active"),e.parents(".main-navbar .nav-sub").length&&(e.parents(".main-navbar .nav-sub-item").last().addClass("active"),e.parent().addClass("active"),e.parent().siblings().removeClass("active")))}var a=location.pathname.split("/").slice(-1)[0].replace(/^\/|\/$/g,"");$(".main-navbar .nav li a").each(function(){var e=$(this);s(e)}),$(window).on("scroll",function(e){$(window).scrollTop()>=66?$(".main-header").addClass("fixed-header"):$(".main-header").removeClass("fixed-header")})});
