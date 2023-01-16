wp.blocks.registerBlockType("ourplugin/multiple-choice-block", {
  title: "Multiple Choice Block",
  icon: "smiley",
  category: "common",
  edit: function () {
    return (
      <div>
        <p>Hello, this is a paragraph.</p>
        <h4>Hi there.</h4>
      </div>
    )
  },
  save: function () {
    return (
      <>
        <h3>My title</h3>
        <p>my paragraph</p>
      </>
    )
  }
});