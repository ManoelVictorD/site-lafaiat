document.addEventListener('DOMContentLoaded', function() {
  const navLinks = document.querySelectorAll('header a');

  navLinks.forEach(link => {
      link.addEventListener('click', function(event) {
          event.preventDefault(); // Impede o comportamento padrão de rolar para a seção

          const targetId = this.getAttribute('href');
          const targetSection = document.querySelector(targetId);

          window.scrollTo({
              top: targetSection.offsetTop,
              behavior: 'smooth'
          });
      });
  });
});




