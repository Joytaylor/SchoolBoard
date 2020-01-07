// Compiled using marko@4.18.29 - DO NOT EDIT
"use strict";

var marko_template = module.exports = require("marko/src/html").t(__filename),
    marko_componentType = "/schoolboard$1.0.0/question.marko",
    marko_renderer = require("marko/src/runtime/components/renderer"),
    marko_forOf = require("marko/src/runtime/helpers/for-of"),
    helpers_escape_xml = require("marko/src/runtime/html/helpers/escape-xml"),
    marko_escapeXml = helpers_escape_xml.x,
    marko_attr = require("marko/src/runtime/html/helpers/attr"),
    marko_escapeScript = require("marko/src/runtime/html/helpers/escape-script-placeholder");

function render(input, out, __component, component, state) {
  var data = input;

  var $for$0 = 0;

  marko_forOf(input.question_info, function(question, index) {
    var $keyScope$0 = "[" + (($for$0++) + "]");

    out.w("<div class=\"question card-primary col-md-12\"><div class=\"header card-header row\"><div class=\"hashtags col-10 d-flex\"><h3 class=\"align-self-center\">");

    marko_forOf(question.hashtags, function(topic, index) {
      out.w("#" +
        marko_escapeXml(topic));
    });

    out.w("</h3></div><div class=\"vote col-2\">");

    if (question.voter_ids.includes(input.user_data.id)) {
      out.w("<div" +
        marko_attr("id", "" + question.id) +
        " class=\"voteButton btn disabled\"" +
        marko_attr("onclick", ("disableAndAnimate('" + question.id) + "')") +
        "><span class=\"font-weight-bold\">" +
        marko_escapeXml(question.votes) +
        "</span> Votes</div>");
    } else {
      out.w("<div" +
        marko_attr("id", "" + question.id) +
        " class=\"voteButton btn\"" +
        marko_attr("onclick", ("disableAndAnimate('" + question.id) + "')") +
        "><span class=\"font-weight-bold\">" +
        marko_escapeXml(question.votes) +
        "</span> Votes</div>");
    }

    out.w("<script>" +
      marko_escapeScript(("\r\n                var id = '" + question.id) + "'\r\n                $(id).click(function() {\r\n                    $.ajax({\r\n                        url: \"/vote\",\r\n                        type: \"POST\", \r\n                        data: {\r\n                            question_id: id\r\n                        }\r\n                    })\r\n                })\r\n            ") +
      "</script></div></div><div class=\"questionText card-body row\"><div class=\"col-12 questionBody\"><div class=\"row\"><div class=\"col-12\"><p>" +
      marko_escapeXml(question.question_text) +
      "</p></div></div><div class=\"row\"><div id=\"timeContainer\" class=\"col-12 text-center\"><p class=\"timestamp\">" +
      marko_escapeXml(question.date_of_ask) +
      "</p></div></div>");

    if (input.user_data.status == "teacher") {
      out.w("<div class=\"btn card-btn\">Answer</div>");
    }

    out.w("</div></div><div class=\"questionResponse row\">");

    var $for$1 = 0;

    marko_forOf(question.response, function(response, index) {
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

marko_template.meta = {
    id: "/schoolboard$1.0.0/question.marko"
  };
