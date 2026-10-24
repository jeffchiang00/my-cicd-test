window.onorientationchange = OnChange;

function OnChange() {
	//TweenLite.to($(".MobMask"), 0, {css:{display:"none"}});
	switch (window.orientation) {
		case -90:

			TweenLite.to($(".MobMask"), 0, {css:{display:"block"}});
			break;
		case 90:
			TweenLite.to($(".MobMask"), 0, {css:{display:"block"}});
			break;
		default:
			TweenLite.to($(".MobMask"), 0, {css:{display:"none"}});
			break;
	}	

}

OnChange();