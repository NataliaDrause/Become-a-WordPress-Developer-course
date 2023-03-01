wp.blocks.registerBlockType("ourblocktheme/campusarchive", {
  title: "Theme Campus Archive",
  edit: function() {
    return wp.element.createElement("div", {className: "our-placeholder-block"}, "Campus Archive placeholder")
  },
  save: function() {
    return null
  }
})