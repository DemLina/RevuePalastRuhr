export function initMenu() {
  const $header = document.querySelector(".header");
  initHeader();
  initMenuToggle();

  function initHeader() {
    if (window.scrollY > 20) {
      $header.classList.add("header--min");
    } else {
      $header.classList.remove("header--min");
    }

    window.addEventListener("scroll", function () {
      if (window.scrollY > 20) {
        $header.classList.add("header--min");
      } else {
        $header.classList.remove("header--min");
      }
    });
  }
  const currentPath = window.location.pathname;

  document.querySelectorAll(".header__menu a").forEach((link) => {
    if (currentPath.startsWith(link.pathname) && link.pathname !== "/") {
      link.parentElement.classList.add("active");
    }
  });

  function initMenuToggle() {
    const headerMenuActiveClassName = "menu--opened";

    document.querySelectorAll(".js-menu-toggle").forEach((btn) => {
      btn.addEventListener("click", function () {
        $header.classList.toggle(headerMenuActiveClassName);
        if ($header.classList.contains("menu--opened")) {
          document.querySelector("html").style.overflowY = "hidden";
        } else {
          document.querySelector("html").style.overflowY = "unset";
        }
      });
    });
  }
}
