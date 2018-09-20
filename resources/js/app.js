import $ from 'jquery'
import Api from './Api'
/**
 * using jQuery to quickly set up event listeners and make API requests.
 * would prefer not to use this if I had a little more time
*/
/**
 * if I had more time, I would've created a better UX for displaying errors.
 * It was within the last couple of hours that 
 * I realised you wanted the password list compared at this point in the
 * user journey.
 */
// Run after initial HTML/DOM Render

$(function() {
	$('[data-submit]').on('submit', function(event) {
		event.preventDefault()
		Api($(this))
	});
});
