jQuery(document).ready(function($){

	console.log('Start Interpolate JS');

	var Inter = Inter || {};

	var $navbar 			= $('.navbar-nav'),
		$parentNavItem 		= $('.menu-item-has-children', $navbar),
		$parentNavItemLink 	= $('a', $parentNavItem);

	Inter.interAddArrow = function() {

		$('<div class="arrow"></div>').insertAfter($parentNavItemLink);

		console.log($parentNavItemLink);
	}

	Inter.toggleSubMenu = function () {

		$('.menu-item-has-children .arrow', '#topNavBar').on('click', function () {

			var $this = $(this);

			$this.parent('li.menu-item-has-children').toggleClass('is--active');
		});
	}

	Inter.init = function() {

		var self = this;

		self.interAddArrow();
		self.toggleSubMenu();
	}

	Inter.init();

});