define(
[
'Mwolf_Donation/js/view/checkout/summary/fee'
],
	function (Component) {
		'use strict';
		return Component.extend({
		/**
		* @override
		*/
			isDisplayed: function () {
				return true;
			}
		});
	}
);