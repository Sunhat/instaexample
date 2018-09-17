const $ = require('jQuery');
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
$(document).ready(function() {
	$('[data-submit]').on('submit', function(event) {
		event.preventDefault()
		let $this = $(this)
		let method = $this.data('submit')
		let action = $this.attr('action')
		let data = $this.serialize()
		InstaAPI[method](action, data).then(() => {
			alert('thanks for registering!')
		}).catch((err) => {
			let alertRes = ''
			err.responseJSON.errors.forEach(element => {
				alertRes += element + '\n'
			});
			alert(alertRes)
		});
	});
});


window.InstaAPI = {
	registerUser(action, data) {
		return $.post(action, data).then((response) => {
			// ha ha ha
			console.log(response)
			return response;
		})
	}
};