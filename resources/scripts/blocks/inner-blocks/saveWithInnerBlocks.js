export default blockName => (BlockSave, block) => {
  if (typeof block === "undefined") {
    return BlockSave;
  }

  if (block.name !== blockName) {
    return BlockSave || block.save;
  }
  
  const { InnerBlocks } = wp.editor

  return (
    <div>
      <InnerBlocks.Content />
    </div>
  );
}