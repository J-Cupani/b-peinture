const addScrollspy = (
  defaultClass = "nav-link",
  linksContainer = ".scrollspyLinks",
  activeClass = "current"
) => {
  var section = document.querySelectorAll(".scrollSpysection");

  var sections = {};
  var i = 0;

  Array.prototype.forEach.call(section, function (e) {
    sections[e.id] = e.offsetTop;
  });
  var scrollPosition =
    document.documentElement.scrollTop || document.body.scrollTop;

  for (i in sections) {
    if (sections[i] <= scrollPosition) {
      document
        .querySelector(linksContainer + ` .${activeClass}`)
        ?.setAttribute("class", defaultClass);
      const navLink = document.querySelector(
        linksContainer + " a[href*=" + i + "]"
      );

      navLink?.setAttribute("class", `${defaultClass} ${activeClass}`);
    }
  }
};
export default addScrollspy;
