wp.blocks.registerBlockType("ourblocktheme/pastevents", {
  title: "Theme Past Events",
  edit: function() {
    return wp.element.createElement("div", {className: "our-placeholder-block"}, "Past Events placeholder")
  },
  save: function() {
    return null
  }
})