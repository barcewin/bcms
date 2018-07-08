/**
  * Modify as you like
  * Created by Mark Eriksson http://mark-eriksson.com
  */

(function($) {	
	$.habAlert = function(opts) {
		var options = $.extend({
			title: 'habAlert',
			image: '',
			leadTitle: '',
			body: '<p>No default body text has been set for this habAlert.</p>',
			bodyType: 'html',
			controls: {
				links: [],
				buttons: []
			}
		}, opts);
		
		var closehabAlert = function() {
			$('.habalert').fadeOut('medium', function() {
				$(this).remove();
			});
		}
		
		var wrapper = $('<div />').addClass('habalert');
		
		var header = $('<div />').addClass('habalert-header').append(($('<a />').attr({href:'#close', class:'habalert-close'}).on('click', function(e) {
			e.preventDefault();
			closehabAlert();
		})), ($('<span />').addClass('habalert-title').text(options.title)));
		
		var border = $('<div />').addClass('habalert-border');
		
		if (options.image && options.leadTitle) {
			var leadWrapper = $('<div />').addClass('habalert-lead habalert-cf').append(($('<img />').attr({src: options.image, alt: 'habAlert image'})), ($('<h3 />').text(options.leadTitle)));
		}
		
		var body = $('<div />').addClass('habalert-body');
		options.bodyType === 'html' ? body.html(options.body) : body.text(options.body);
		
		var controlsWrapper = $('<div />').addClass('habalert-controls-wrapper');
		var controls = $('<div />').addClass('habalert-controls');
		
		if (options.controls.links.length > 0) {
			for (i=0;i<=options.controls.links.length-1;i++) {
				var thisLink = options.controls.links[i];
				
				if (!thisLink.target) thisLink.target = '';
				
				controls.append(($('<a />').addClass('habalert-link').attr({href: thisLink.href, target: thisLink.target}).text(thisLink.text)));
			}
		}
		
		if (options.controls.buttons.length > 0) {
			for (s=0;s<=options.controls.buttons.length-1;s++) {
				var thisButton = options.controls.buttons[s];
				
				if (!thisButton.target) thisButton.target = '';
				
				controls.append(($('<a />').addClass('habalert-button').attr({href: thisButton.href, target: thisButton.target}).text(thisButton.text)));
			}
		}
		
		wrapper.append(header, border.append(body), (controlsWrapper.append(controls)));
		
		if (leadWrapper) border.prepend(leadWrapper);
		
		$('body').append(wrapper);
	}
})(jQuery);