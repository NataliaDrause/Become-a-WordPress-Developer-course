wp.blocks.registerBlockType("ourblocktheme/search", {
  title: "Theme Search",
  edit: function() {
    return wp.element.createElement("div", {className: "our-placeholder-block"}, "Search placeholder")
  },
  save: function() {
    return null
  }
})