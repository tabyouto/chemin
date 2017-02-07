/**
 * Created by hjoker on 2017/2/2.
 */
'use strict';

(function() {
	function completed() {
		document.removeEventListener( "DOMContentLoaded", completed );
		window.removeEventListener( "load", completed );
		Cready();
	}
	if ( document.readyState === "complete" ||
		( document.readyState !== "loading" && !document.documentElement.doScroll ) ) {
		// Handle it asynchronously to allow scripts the opportunity to delay ready
		window.setTimeout( window.Cready() );

	} else {

		// Use the handy event callback
		document.addEventListener( "DOMContentLoaded", completed );

		// A fallback to window.onload, that will always work
		window.addEventListener( "load", completed );
	}


	var srcArr = [],index = 0;

	function Cready() {
		var $$imgArr = document.querySelectorAll('.entry-content p img');
		console.log(document.querySelectorAll('.entry-content p img'));
		$$imgArr.forEach(function(item) {
			item.style.setProperty('cursor','pointer');
			item.addEventListener('click',function() {
				showBox(this);
			});
			srcArr.push({
				src: item.currentSrc,
				naturalHeight: item.naturalHeight,
				naturalWidth: item.naturalWidth
			});
		})
	}

	var getSingle = function(fn) {
		var result;
		return function() {
			return result || (result = fn.apply(this,arguments));
		}
	};
	var render = getSingle(buildDiv);

	function showBox(item) {
		var tmpLen = srcArr.length;
		for(var i = 0;i<tmpLen;i++) {
			if( item.currentSrc == srcArr[i]['src'] ) {
				index = i+1;
				console.log(i,index);
				break;
			}
		}
		var a = render();
		console.log(a);
	}

	function buildDiv() {
		var createNode = document.createElement("div");
		createNode.setAttribute('id','mask');
		createNode.style.cssText = 'position:fixed;top:0;left:0;width:100%;height:100%;background-color:rgba(0,0,0,.6)';
		document.body.appendChild(createNode);
		bindUI();
		return createNode;
	}


	var bindUI = function() {
		console.log(1);
		var $$mask = document.getElementById('mask');
		$$mask.addEventListener('click',function(e) {
			$$mask.style.setProperty('display','none');
		});
	}

})();

