document.addEventListener('DOMContentLoaded', () => {
  const formFilm = document.querySelector('form');
  if (!formFilm) return;

  formFilm.addEventListener('submit', (e) => {
    const titre = formFilm.querySelector('#titre').value.trim();
    if (titre.length < 2) {
      alert('Le titre doit contenir au moins 2 caractères.');
      e.preventDefault();
      return false;
    }

    const duree = formFilm.querySelector('#duree').value;
    if (duree && (isNaN(duree) || duree <= 0)) {
      alert('La durée doit être un nombre positif.');
      e.preventDefault();
      return false;
    }
  });
});
