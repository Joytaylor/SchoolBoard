function createDiv(v, counter) {
	$.getJSON("qExamples.json", function(data) {
		$(".card-header").eq(counter).text(data[v].tags);
		$(".card-title").eq(counter).text(data[v].question);
		$(".card").eq(counter).addClass(data[v].cardType);
	}
			 );
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
