// Compiled using marko@4.18.24 - DO NOT EDIT
"use strict";

var marko_template = module.exports = require("marko/src/html").t(__filename),
    marko_componentType = "/schoolboard$1.0.0/question.marko",
    components_helpers = require("marko/src/runtime/components/helpers"),
    marko_renderer = components_helpers.r,
    marko_defineComponent = components_helpers.c,
    button_template = require("./components/button.marko"),
    marko_helpers = require("marko/src/runtime/html/helpers"),
    marko_loadTag = marko_helpers.t,
    button_tag = marko_loadTag(button_template),
    marko_forEach = marko_helpers.f,
    marko_escapeXml = marko_helpers.x;

function render(input, out, __component, component, state) {
  var data = input;

  button_tag({}, out, __component, "0");

  var $for$0 = 0;

  marko_forEach(input.question_info, function(question, index) {
    var $keyScope$0 = "[" + (($for$0++) + "]");

    out.w("<div class=\"question card-primary col-md-12\"><div class=\"header card-header row\"><div class=\"hashtags col-10 d-flex\"><h3 class=\"align-self-center\">");

    marko_forEach(question.hashtags, function(topic, index) {
      out.w("#" +
        marko_escapeXml(topic));
    });

    out.w("</h3></div><div class=\"vote col-2\"></div></div><div class=\"questionText card-body row\"><div class=\"col-12 questionBody\"><div class=\"row\"><div class=\"col-12\"><p>" +
      marko_escapeXml(question.question_text) +
      "</p></div></div><div class=\"row\"><div id=\"timeContainer\" class=\"col-12 text-center\"><p class=\"timestamp\">" +
      marko_escapeXml(question.date_of_ask) +
      "</p></div></div>");

    if (input.user_data.status == "teacher") {
      button_tag({
          class: "btn card-btn",
          renderBody: function(out) {
            out.w("Answer");
          }
        }, out, __component, "14" + $keyScope$0);
    }

    out.w("</div></div><div class=\"questionResponse row\">");

    var $for$1 = 0;

    marko_forEach(question.response, function(response, index) {
      var $keyScope$1 = "[" + ((($for$1++) + $keyScope$0) + "]");

      out.w("<div id=\"responseContainer\" class=\"col-12\"><p>" +
        marko_escapeXml(response.teacher_response) +
        "</p></div>");
    });

    out.w("</div></div>");
  });
}

marko_template._ = marko_renderer(render, {
    ___implicit: true,
    ___type: marko_componentType
  });

marko_template.Component = marko_defineComponent({}, marko_template._);

marko_template.meta = {
    id: "/schoolboard$1.0.0/question.marko",
    tags: [
      "./components/button.marko"
    ]
  };
