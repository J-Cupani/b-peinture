export function menuOpen(e) {
  e.preventDefault();
  document.querySelector(".popup-mobile-menu")?.classList.add("menu-open");
  document.documentElement.style.overflow = "hidden";
}

export function closeMobileMenu(e) {
  e.preventDefault();
  document.querySelector(".popup-mobile-menu")?.classList.remove("menu-open");

  document.documentElement.style.overflow = "";
}
export function mobileMenuOpen(e) {
  if (e.target === this) {
    document.querySelector(".popup-mobile-menu")?.classList.remove("menu-open");
    document.documentElement.style.overflow = "";
  }
}
