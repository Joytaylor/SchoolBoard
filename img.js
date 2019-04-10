function createDiv(id, tags, question, cardType) {
	var div =
	"<div id = 'card" + id + "' class = 'card " + cardType + "'>" +
		"<div class = 'card-header'>" +
			tags +
		"</div>" +
		"<div class = 'card-body justify-content-center'>" +
			"<h5 class = 'card-title'>" +
				question +
			"</h5>" +
			"<a href = '#' class = 'btn card-btn'>Answer</a>" +
		"</div>" +
	"</div>";
	return div;
}
$(function() {
	$.getJSON("qExamples.json", function(data) {
		var ObjTops = [];
		var ObjLefts = [];
		for(var i = 0; i < data.length; i++) {
			//creating the div in the dom here
			var question = data[i].question;
			var tags = data[i].tags;
			var cardType = data[i].cardType;
			var div = createDiv(i, tags, question, cardType);
			$("#cardBackground").append(div);

			//setting the actual positioning variables here
			var holeHeight = $("#headerItem").height;
			var holeWidth = $("#headerItem").width;
			var divWidth = $("#card" + i).width();
			var divHeight = $("#card" + i).height();
			var scale = Math.random();
			//saving the positioning variables in an object here
			ObjLefts.push(useLeft);
			ObjTops.push(useTop);

			//Preventing divs from overlapping in width
			for(var j = 0; j < ObjLefts.length; j++) {
				var spaceCheck = Math.abs(ObjLefts[j] - useLeft);
				if(spaceCheck < widthPercentage) {
					var offset = useLeft + widthPercentage - ObjLefts[j];
					useLeft = useLeft - offset;
					ObjLefts[j] = useLeft;
				}
			}
			console.log(ObjLefts);
			$("#card" + i).css("transform", "translate(" + useLeft + "vw, " + useTop + "vh) scale(" + scale + ")");
			$("#card" + i).delay(120*(i+1)).fadeTo("slow", 0.1);
		}
	});
});
