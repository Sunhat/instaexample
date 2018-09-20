import $ from 'jquery'
import Flash from './Flash'

export default function($form) {
	return $.post($form.attr('action'), $form.serialize()).then((response) => {
		Flash.success(response.success)
		$form.reset()
	}).catch((err) => {
		let alertRes = ''
		err.responseJSON.errors.forEach(element => {
			alertRes += element + '\n'
		});
		Flash.error(alertRes)
	});
}