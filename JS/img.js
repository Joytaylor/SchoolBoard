//Question data
var questionData = [
     {
          "tags": "#中文",
          "question": "如果你可以度我些什么，你怎么知道中文?",
          "cardType": "card-tertiary"
     },
     {
          "tags": "#InternationalRelations",
          "question": "What marked the end of the US's unilateral policy?",
          "cardType": "card-primary"
     },
     {
          "tags": "#Externalities",
          "question": "Is there no way to account for externalities within a supply-demand model?",
          "cardType": "card-quinary"
     }
]
function createDiv(v, counter) {
       $(".card-header").eq(counter).text(questionData[v].tags);
       $(".card-title").eq(counter).text(questionData[v].question);
       $(".card").eq(counter).addClass(questionData[v].cardType);
}
function animateDivs() {
	anime({
		targets: '.card',
		opacity: [0,1],
		duration: 500,
		delay: anime.stagger(500, {start: 300}),
		easing: 'easeInOutQuad',
	});
	anime({
		targets: '.card:nth-of-type(1)',
		translateY: [50,60],
		easing: 'easeInOutQuad',
		delay: 50,
		loop: true,
		direction: 'alternate',
	});
	anime({
		targets: '.card:nth-of-type(2)',
		translateY: [0,15],
		easing: 'easeInOutQuad',
		loop: true,
		direction: 'alternate',
	});
	anime({
		targets: '.card:nth-of-type(3)',
		translateY: [60,65],
		easing: 'easeInOutQuad',
		delay: 25,
		loop: true,
		direction: 'alternate',
	});
}
$(function() {
	//making card pasting loop
	var counter = 0;
	for (var v = 0; v < 3; v++) {
		createDiv(v, counter);
		counter++;
		if (counter == 2) {
			animateDivs();
		}
	}
});
