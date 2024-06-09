// Récupération des éléments HTML
const fromStationElement = document.getElementById('from_station');
const toStationElement = document.getElementById('to_station');
const trainListElement = document.getElementById('train-list');

// Fonction pour afficher les trajets disponibles
function displayTrains(trainData) {
  trainListElement.innerHTML = '';
  trainData.forEach((train) => {
    const trainElement = document.createElement('li');
    trainElement.innerHTML = `
      <span class="train-name">${train.name}</span>
      <span class="train-duration">${train.duration}</span>
      <span class="train-price">${train.price}</span>
      <button class="Prix">Réserver</button>
    `;
    trainListElement.appendChild(trainElement);
  });
}

// Événement pour sélectionner les villes
document.addEventListener('DOMContentLoaded', () => {
  // Appel à une API ou à un serveur web pour récupérer les données de trajet
  fetch('/api/trains')
    .then(response => response.json())
    .then(trainData => displayTrains(trainData))
    .catch(error => console.error('Erreur lors de la récupération des données:', error));
});