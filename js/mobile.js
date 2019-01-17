//
//  https://davidwalsh.name/device-state-detection-css-media-queries-javascript
//
//



// Create the state-indicator element
var indicator = document.createElement('div');
indicator.className = 'state-indicator';
document.body.appendChild(indicator);




// Create a method which returns device state
function getDeviceState() {
    return window.getComputedStyle(
				   document.querySelector('.state-indicator'), ':before'
				   ).getPropertyValue('content')
	}


var lastDeviceState = getDeviceState();
window.addEventListener('resize', debounce(function() {
	    var state = getDeviceState();
	    if(state != lastDeviceState) {
		// Save the new state as current
		lastDeviceState = state;
		
		// Announce the state change, either by a custom DOM event or via JS pub/sub
		// Since I'm in love with pub/sub, I'll assume we have a pub/sub lib available
		publish('/device-state/change', [state]);
	    }
	}, 20));

// Usage
subscribe('/device-state/change', function(state) {
	if(state == "tablet") { 
	});
