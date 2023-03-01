wp.blocks.registerBlockType("ourblocktheme/footer", {
  title: "Theme Footer",
  edit: function() {
    return wp.element.createElement("div", {className: "our-placeholder-block"}, "Theme Footer placeholder")
  },
  save: function() {
    return null
  }
})