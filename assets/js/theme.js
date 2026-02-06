document.addEventListener("DOMContentLoaded", () => {
  const html = document.documentElement;
  const toggle = document.getElementById("themeToggle");

  if (!toggle) return;

  const icon = toggle.querySelector("i");

  // Cargar tema guardado
  const theme = localStorage.getItem("theme") || "dark";

  if (theme === "light") {
    html.classList.remove("dark");
    icon.setAttribute("data-lucide", "sun");
  } else {
    html.classList.add("dark");
    icon.setAttribute("data-lucide", "moon");
  }

  lucide.createIcons();

  toggle.addEventListener("click", () => {
    html.classList.toggle("dark");

    const isDark = html.classList.contains("dark");
    localStorage.setItem("theme", isDark ? "dark" : "light");

    icon.setAttribute("data-lucide", isDark ? "moon" : "sun");
    lucide.createIcons();
  });
});
