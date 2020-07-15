import $ from 'jquery'

export default ($preview, attributes, block) => {
	
	const preview = $preview[0]	
	const target = preview.querySelector('.js-inner-blocks')
	
	if( target ) {
		
		block.innerBlocks = block.innerBlocks || {}
		
		const innerBlocks = block.innerBlocks[attributes.id] || preview.closest('.wp-block').querySelector('.editor-inner-blocks')
		
		block.innerBlocks[attributes.id] = innerBlocks
		
		innerBlocks && target.appendChild(innerBlocks)
		
	}
	
}