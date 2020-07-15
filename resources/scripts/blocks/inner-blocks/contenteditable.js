export default ($preview, attributes, block) => {
	
	const preview = $preview[0]	
	
	const getInput = (el) => {
		
		let attribute = el.getAttribute('data-attribute')
			
		let field = document.querySelector(`.acf-block-fields .acf-field[data-name="${attribute}"]`)
		
		if( field ) {
		
			let key = field.getAttribute('data-key')
			
			return field.querySelector(`[name="acf-${attributes.id}[${key}]"]`)
			
		}
		
		return null	
		
	}
	
	Array.from(preview.querySelectorAll('[contenteditable][data-attribute]')).forEach(el => {
		
		el.addEventListener('input', () => {
			
			let input = getInput(el)
		
			if( input ) {
				
				$(input).val(el.innerHTML)
				
			}
			
		})
		
		el.addEventListener('blur', () => {
			
			let input = getInput(el)
		
			if( input ) {
				
				$(input).trigger('change')
				
			}
			
		})
		
	})
	
}