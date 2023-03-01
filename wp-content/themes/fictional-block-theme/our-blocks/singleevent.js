wp.blocks.registerBlockType("ourblocktheme/singleevent", {
  title: "Theme Single Event",
  edit: function() {
    return wp.element.createElement("div", {className: "our-placeholder-block"}, "Single Event placeholder")
  },
  save: function() {
    return null
  }
})