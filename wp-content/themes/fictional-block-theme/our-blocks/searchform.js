wp.blocks.registerBlockType("ourblocktheme/searchform", {
  title: "Theme Search Form",
  edit: function() {
    return wp.element.createElement("div", {className: "our-placeholder-block"}, "Search Form placeholder")
  },
  save: function() {
    return null
  }
})