<footer class="text-center mt-5 py-3" style="background-color:#1a1a1a; color:#bbb;">
  <small>© 2025 SnakeAdopt | Platform Adopsi Ular</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
//Fade-in 
document.body.style.opacity = 0;
document.addEventListener('DOMContentLoaded', () => {
  document.body.style.transition = 'opacity 0.6s ease';
  document.body.style.opacity = 1;
});

//pas klik
document.addEventListener('DOMContentLoaded', function() {
  const links = document.querySelectorAll('a.btn-success, a.btn-danger');
  links.forEach(link => {
    link.addEventListener('click', e => {
      const isApprove = link.classList.contains('btn-success');
      const actionText = isApprove ? 'menyetujui' : 'menolak';
      if (!confirm(`Apakah kamu yakin ingin ${actionText} pengajuan ini?`)) {
        e.preventDefault();
      }
    });
  });
});

//hover
document.addEventListener('DOMContentLoaded', () => {
  const cards = document.querySelectorAll('.card');
  cards.forEach(card => {
    card.style.transition = 'transform 0.3s ease, box-shadow 0.3s ease';
    card.addEventListener('mouseenter', () => {
      card.style.transform = 'translateY(-5px)';
      card.style.boxShadow = '0 8px 20px rgba(255,255,255,0.1)';
    });
    card.addEventListener('mouseleave', () => {
      card.style.transform = 'translateY(0)';
      card.style.boxShadow = 'none';
    });
  });
});
</script>

</body>
</html>
