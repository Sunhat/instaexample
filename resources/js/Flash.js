export default (function () {
	const flashContainer = document.getElementById('flash-container')

	const injectAlert = (type, message) => {
		let newAlert = document.createElement('div')
		newAlert.classList.add('alert')
		newAlert.classList.add(type)
		newAlert.innerHTML = message
		flashContainer.appendChild(newAlert)
	}
	
	const add = async (type, message) => {
		await clear()
		if (typeof message === "string") {
			injectAlert(type, message)
		} else if (message instanceof Array) {
			message.forEach(injectAlert.bind(null, type))
		} else {
			throw "Only a String or Array can be provided to flashMessage"
		}
	}
	
	const clear = () => {
		flashContainer.innerHTML = ''
		return new Promise(resolve => setTimeout(resolve, 350))
	}

	return { 
		success: (message) => { add('alert-success', message) },
		error: (message) => { add('alert-danger', message) }
	}
})()