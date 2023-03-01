wp.blocks.registerBlockType("ourblocktheme/archive", {
  title: "Theme Archive",
  edit: function() {
    return wp.element.createElement("div", {className: "our-placeholder-block"}, "Archive placeholder")
  },
  save: function() {
    return null
  }
})