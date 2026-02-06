document.addEventListener("DOMContentLoaded", () => {
  // Sidebar contenedor
  gsap.from("aside", {
    x: -80,
    opacity: 0,
    duration: 1,
    ease: "power3.out",
  });

  // Links y botón del sidebar
  gsap.from(".sidebar-link", {
    x: -20,
    autoAlpha: 0,
    duration: 0.6,
    stagger: 0.12,
    delay: 0.4,
    ease: "power2.out",
    clearProps: "all",
  });

  // Cards
  gsap.fromTo(
    ".dashboard-card",
    { y: 40, autoAlpha: 0 },
    {
      y: 0,
      autoAlpha: 1,
      duration: 0.8,
      stagger: 0.2,
      delay: 0.6,
      ease: "power3.out",
      clearProps: "all",
    },
  );
});
