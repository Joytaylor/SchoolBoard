//Vote confirmation animation
function disableAndAnimate(questionID) {
    $(`#${questionID}`).css({
            background: "none",
            border: "1px solid white"
        }, 500, "ease-in-out")
        .text("Voted!").css({
            color: "white"
        }).addClass("disabled")
}

//Toggling display of question/answer containers
function toggleDisplays(toggleType, question, info) {
    switch (toggleType) {
        case "question":
            $("#invisibleQuestionContainer").removeClass("inactive").addClass("active")
            $("#black").removeClass("inactive").addClass("active")
            $("#blur").css({
                filter: "blur(10px)"
            })
            break;
        case "answer":
            $("#invisibleAnswerContainer").removeClass("inactive").addClass("active")
            $("#black").removeClass("inactive").addClass("active")
            $("#blur").css({
                filter: "blur(10px)"
            })
            $("#questionPreview").text(question)
            $("#answerResponseID").val(info)
            break;
        case "outfocus":
            if ($("#black").hasClass("active")) {
                $(".invisibleSpace").removeClass("active").addClass("inactive")
                $("#black").removeClass("active").addClass("inactive")
            }
            $("#blur").css({
                filter: "blur(0px)"
            })
    }
}

//Adding hashtag input on "Add #" click
function addHashtag() {
    var component = `
    <div class = 'row hashtagElement'>
        <div class='input-group'>
            <div class='input-group-prepend'>
                <span class='input-group-text' id='basic-addon1'>#</span>
            </div>
            <input type='text' class='form-control' placeholder='Hashtag' aria-label='Username' aria-describedby='basic-addon1' name = "hashtag">
        </div>
    </div>`
    $("#hashtagPaste").append(component)
}

//Functions manipulating scroll speed
$.fn.scrollSpeed = function() {
    var $window = $("#app");
    var instances = [];

    $(this).each(function() {
        instances.push(new moveItItem($(this)));
    });

    window.addEventListener('scroll', function() {
        var scrollTop = $window.scrollTop();
        instances.forEach(function(inst) {
            inst.update(scrollTop);
        });
    }, { passive: true });
}
var moveItItem = function(el) {
    this.el = $(el);
    this.speed = parseFloat(this.el.attr('data-scroll-speed'));
};
moveItItem.prototype.update = function(scrollTop) {
    this.el.css('transform', 'translateY(' + -(scrollTop / this.speed) + 'px)');
};

$(function() {
    $("#app").on("scroll", function() {
        var scrollTop = $("#app").scrollTop();
        if (scrollTop > 2) {
            $("#classCode").css("font-size", "0");
            $("#classCode").css("opacity", "0");
            $("header").css("height", "10vh");
            $("#app").css("height", "90vh");
        } else {
            $("#classCode").css("font-size", "calc(0.6rem + 0.6vw)");
            $("#classCode").css("opacity", "1");
            $("header").css("height", "20vh");
            $("#app").css("height", "80vh");
        }
    })
});