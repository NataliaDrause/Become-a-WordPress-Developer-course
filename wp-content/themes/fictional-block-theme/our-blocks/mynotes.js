wp.blocks.registerBlockType("ourblocktheme/mynotes", {
  title: "Theme My Notes",
  edit: function() {
    return wp.element.createElement("div", {className: "our-placeholder-block"}, "My Notes placeholder")
  },
  save: function() {
    return null
  }
})