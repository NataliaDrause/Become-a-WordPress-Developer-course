wp.blocks.registerBlockType("ourblocktheme/page", {
  title: "Theme Page",
  edit: function() {
    return wp.element.createElement("div", {className: "our-placeholder-block"}, "Page placeholder")
  },
  save: function() {
    return null
  }
})