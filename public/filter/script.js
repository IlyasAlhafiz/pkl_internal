document.addEventListener("DOMContentLoaded", function () {
  const kategoriLinks = document.querySelectorAll('#kategori-tab .nav-link');
  const productContainer = document.getElementById('product-container');

  kategoriLinks.forEach(link => {
    link.addEventListener('click', function (e) {
      e.preventDefault();
      const kategoriId = this.dataset.id;

      kategoriLinks.forEach(l => l.classList.remove('active'));
      this.classList.add('active');

      productContainer.classList.add('animate-exit');

      setTimeout(() => {
        fetch("{{ route('produk.filter') }}", {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({ kategori_id: kategoriId })
        })
        .then(res => res.text())
        .then(html => {
          productContainer.innerHTML = html;

          productContainer.classList.remove('animate-exit');
          productContainer.classList.add('animate-enter');

          setTimeout(() => {
            productContainer.classList.remove('animate-enter');
          }, 500);
        });
      }, 300);
    });
  });
});