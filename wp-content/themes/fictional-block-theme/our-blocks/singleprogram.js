wp.blocks.registerBlockType("ourblocktheme/singleprogram", {
  title: "Theme Single Program",
  edit: function() {
    return wp.element.createElement("div", {className: "our-placeholder-block"}, "Single Program placeholder")
  },
  save: function() {
    return null
  }
})