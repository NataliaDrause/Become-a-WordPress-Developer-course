wp.blocks.registerBlockType("ourblocktheme/singlecampus", {
  title: "Theme Single Campus",
  edit: function() {
    return wp.element.createElement("div", {className: "our-placeholder-block"}, "Single Campus placeholder")
  },
  save: function() {
    return null
  }
})