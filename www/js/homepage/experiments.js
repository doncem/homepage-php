/**
 * How much to leave from top
 */
const TOP_GAP_SCROLL = 20;

/**
 * If 'e' has class 'active' - scroll to it, it's active already<br />
 * Else if link is with hash - activate it<br />
 * Else go to that link
 * @param {jQuery} e Experiment to activate
 */
function activateExperiment(e) {
    if (e.hasClass("active")) {
        scrllToTop(e, TOP_GAP_SCROLL);
    } else {
        var href = e.children(".link-container").children("a");

        if (href.attr("href").substr(0, 1) == "#") {
            e.addClass("active");
            //href.parent().fadeOut("slow");
            scrollToTop(e, TOP_GAP_SCROLL);
            window[getFunction(href.attr("href").substr(1))]();
        } else {
            window.location = $(this).attr("href");
        }
    }
}
/**
 * Converts element id into camel case function name
 * @param {String} id
 * @return {String} Function name
 */
function getFunction(id) {
    arr = id.split("-");
    s = arr[0];
    
    for (i = 1; i < arr.length; i++) {
        s += arr[i].substr(0, 1).toUpperCase() + arr[i].substr(1);
    }
    
    return s;
}
/**
 * Add activation links to each non-active experiment.<br />
 * Attach a click to it as well
 */
$.fn.attachExperiment = function() {
    var link = $(this).attr("id");
    
    if (!$("#" + link).hasClass("active")) {
        if (link.substr(0, 6) == "jquery") {
            $("#" + link).append("<p class=\"link-container\"><a href=\"#" + link + "\">Launch it</a></p>");
        } else {
            $("#" + link).append("<p class=\"link-container\"><a href=\"/" + link + "/\">Go there</a></p>");
        }
    }
    
    $("#" + link + " a").live("click", function(e) {
        e.preventDefault();
        activateExperiment($("#" + link));
    });
}

$(function() {
    $(".experiment").each(function(i, e) {
        $(e).attachExperiment();
    });
    
    if ((window.location.pathname == $("#menu a.active").attr("href")) && ($(window.location.hash).length > 0)) {
        activateExperiment($(window.location.hash));
    } else if ($(".experiment.active").length > 0) {
        activateExperiment($(".experiment.active").first());
    }
    
    $(window).bind("hashchange", function() {
        if ($(window.location.hash).length > 0) {
            activateExperiment($(window.location.hash));
        }
    });
});

var jqueryWindowGrid = function() {
    var c = $("#jquery-window-grid-container");
    var element = "<div class=\"grid-element\"></div>";
    var gap = 4;
    var activeColour = "#012345";
    var colour = "#543210";
    
    var calculateSize = function(wSize, k) {
        return Math.floor((wSize - gap) / k - gap - 2);
    }
    
    var calculateMax = function(wSize) {
        return Math.floor((wSize - gap) / (3 + gap));
    }
    
    var close = function() {
        c.children("div").each(function(i, e) {
            setTimeout(function(e) { $(e).hide("fast"); }, 400);
        }).parent().hide("slow");
    }
    
    var moveLeft = function() {
        //
    }
    
    var moveUp = function() {
        //
    }
    
    var moveRight = function() {
        //
    }
    
    var moveDown = function() {
        //
    }
    
    if (c.children("div").length > 1) {
        c.show("slow").children("div").each(function(i, e) {
            setTimeout(function(e) { $(e).fadeIn("fast"); }, 400);
        });
    } else {
        var x = 1;
        var y = 1;
        var xCurrent = 1;
        var yCurrent = 1;
        var xMax = calculateMax($(window).width());
        var yMax = calculateMax($(window).height());
        c.css({
            paddingLeft: gap,
            paddingTop: gap,
            width: $(window).width(),
            height: $(window).height()
        }).show("slow").children("div").css({
            marginRight: gap,
            marginBottom: gap,
            width: $(window).width() - 2 * (gap + 1),
            height: $(window).height() - 2 * (gap + 1),
            color: activeColour
        }).fadeIn("fast");
    }
    
    $(window).keyup(function(e) {
        e.preventDefault();
        
        switch(e.which) {
            case 27:
                close();
                break;
            case 37:
                moveLeft();
                break;
            case 38:
                moveUp();
                break;
            case 39:
                moveRight();
                break;
            case 40:
                moveDown();
                break;
        }
    });
}