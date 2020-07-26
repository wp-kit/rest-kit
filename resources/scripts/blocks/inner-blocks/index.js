import editWithInnerBlocks from './editWithInnerBlocks'
import saveWithInnerBlocks from './saveWithInnerBlocks'
import moveInnerBlocks from './moveInnerBlocks';
import contenteditable from './contenteditable'

if(window.acf) {
	
	const { addFilter } = wp.hooks

	acf.data.blockTypes.filter(block => block.has_inner_blocks).forEach(block => {
		addFilter("editor.BlockEdit", `with-inner-blocks/${block.name}`, editWithInnerBlocks(block.name, block.inner_block_params))
		addFilter("blocks.getSaveElement",  `with-inner-blocks/${block.name}`, saveWithInnerBlocks(block.name))
		acf.addAction( `render_block_preview/type=${block.name.replace('acf/', '')}`, (preview, attributes) => moveInnerBlocks(preview, attributes, block) )
	})
	
	acf.data.blockTypes.forEach(block => {
		acf.addAction( `render_block_preview/type=${block.name.replace('acf/', '')}`, (preview, attributes) => contenteditable(preview, attributes, block) )
	})

}
