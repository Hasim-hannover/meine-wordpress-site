cat > blocksy-child/assets/js/faq.js <<'JS'
document.addEventListener('DOMContentLoaded', () => {
  const items = document.querySelectorAll('.faq-item-block');
  items.forEach(item => {
    item.addEventListener('toggle', () => {
      if (item.open) {
        items.forEach(other => {
          if (other !== item) other.open = false;
        });
      }
    });
  });
});
JS
