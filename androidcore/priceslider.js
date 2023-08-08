/*check_disable (currentPos, currentPostwo, minCount, maxCount);*/

function price_slider(currentPos, minCount, currentPostwo, maxCount, Count) {
	if (currentPos >= 0 && currentPostwo) {
		if (minCount >= 0 && maxCount) {
			if (currentPos < minCount) {
				currentPos = minCount;
			}
			if (currentPostwo > maxCount) {
				currentPostwo = maxCount;
			}
			if (currentPos > maxCount) {
				currentPos = maxCount;
			}
			if (currentPostwo < minCount) {
				currentPostwo = minCount;
			}
			let rele = document.getElementById('rele');
			let reletwo = document.getElementById('reletwo');
			let range = document.getElementById('range');
			let offsetRele = rele.offsetWidth / 2;
			let offsetReletwo = reletwo.offsetWidth / 2;
			let line = document.getElementById('line');
			let inpmin = document.getElementById('minCurr');
			let inpmax = document.getElementById('maxCurr');
			let rightEdge = line.offsetWidth - rele.offsetWidth * 2;
			rele.style.left = ((currentPos - minCount) * rightEdge) / Count + "px";
			reletwo.style.left = ((currentPostwo - minCount) * rightEdge) / Count + "px";
			range.style.marginLeft = parseInt(rele.style.left) + offsetRele + 'px';
			range.style.marginRight = line.offsetWidth - parseInt(reletwo.style.left) - reletwo.offsetWidth - offsetReletwo + 'px';

			//rele.ontouchstart = function(f) {
			rele.addEventListener('touchstart', function (e) {
				if (e.cancelable) e.preventDefault();
				let shiftX = e.targetTouches[0].pageX - rele.offsetLeft;
				let maxavail = reletwo.offsetLeft - line.offsetLeft - reletwo.offsetWidth;
				//document.ontouchmove = function(f) {
				rele.addEventListener('touchmove', function (e) {
					let newLeft = e.targetTouches[0].pageX - shiftX - line.offsetLeft;
					if (newLeft < 0) {
						newLeft = 0;
					}
					if (newLeft > maxavail) {
						newLeft = maxavail;
					}
					if (newLeft > rightEdge) {
						newLeft = rightEdge;
					}
					rele.style.left = newLeft + 'px';
					inpmin.value = Math.round((newLeft / rightEdge) * Count) + minCount;
					range.style.marginLeft = newLeft + offsetRele + 'px';
				});
				document.ontouchend = function () {
					document.ontouchmove = document.ontouchend = null;/*check_disable (inpmin.value, inpmax.value);*/
				};
				return false;
			});

			//reletwo.ontouchstart = function(e) {
			reletwo.addEventListener('touchstart', function (e) {
				if (e.cancelable) e.preventDefault();
				let shiftXtwo = e.targetTouches[0].pageX - reletwo.offsetLeft;
				let minavail = rele.offsetLeft - line.offsetLeft;
				//document.ontouchmove = function(e) {
				reletwo.addEventListener('touchmove', function (e) {
					let newLefttwo = e.targetTouches[0].pageX - shiftXtwo - line.offsetLeft;
					if (newLefttwo < 0) {
						newLefttwo = 0;
					}
					if (newLefttwo < minavail) {
						newLefttwo = minavail;
					}
					if (newLefttwo > rightEdge) {
						newLefttwo = rightEdge;
					}
					reletwo.style.left = newLefttwo + 'px';
					inpmax.value = Math.round((newLefttwo / rightEdge) * Count) + minCount;
					range.style.marginRight = line.offsetWidth - newLefttwo - reletwo.offsetWidth - offsetReletwo + 'px';
				});
				document.ontouchend = function () {
					document.ontouchmove = document.ontouchend = null;/*check_disable (inpmin.value, inpmax.value);*/
				};
				return false;
			});

		}

	}
}

function check_disable(mncurr, mxcurr, minCount, maxCount) {
	const inputMinCurr = $("input#minCurr"),
		inputMaxCurr = $("input#maxCurr");
	(mncurr === minCount) ? inputMinCurr.prop('disabled', true) : inputMinCurr.prop('disabled', false);
	(mxcurr === maxCount) ? inputMaxCurr.prop('disabled', true) : inputMaxCurr.prop('disabled', false);
}
