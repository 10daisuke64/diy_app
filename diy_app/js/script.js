/* ---------------------------
  responsive - small device
----------------------------- */
!(function () {
  const viewport = document.querySelector('meta[name="viewport"]');
  function switchViewport() {
    const value =
      window.outerWidth > 360
        ? 'width=device-width,initial-scale=1'
        : 'width=375';
    if (viewport.getAttribute('content') !== value) {
      viewport.setAttribute('content', value);
    }
  }
  addEventListener('resize', switchViewport, false);
  switchViewport();
})();

/* ---------------------------
  anchor - smooth scroll
----------------------------- */
$('a[href^="#"]').on("click", function () {
  var href = $(this).attr("href");
  var target = $(href == "#" || href == "" ? 'html' : href);
  var position = target.offset().top;
  var scrollPosition = position - 40;
  $('body,html').animate({ scrollTop: scrollPosition }, 500, 'swing');
  return false;
});
