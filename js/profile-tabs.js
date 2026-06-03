document.addEventListener("DOMContentLoaded", function () {
  const tabs = document.querySelectorAll(".profile-tab");
  const panels = document.querySelectorAll(".tab-panel");

  if (tabs.length === 0 || panels.length === 0) {
    return;
  }

  tabs.forEach(function (tab) {
    tab.addEventListener("click", function () {
      const target = tab.dataset.tab;
      const targetPanel = document.getElementById(target);

      if (!targetPanel) {
        return;
      }

      tabs.forEach(function (item) {
        item.classList.remove("active");
      });

      panels.forEach(function (panel) {
        panel.classList.remove("active");
      });

      tab.classList.add("active");
      targetPanel.classList.add("active");
    });
  });
});