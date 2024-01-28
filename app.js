'use strict'

const container = document.querySelector('.container');

fetch('http://localhost/projet_get/getData.php')
  .then(response => response.json())
  .then(data => {
    const pokemons = data.slice();

    pokemons.map(pokemon => {
      console.log(pokemon)
      container.insertAdjacentHTML('beforeend', `
    <div class="pokemon-card ${pokemon.typ_libelle}">
      <div class="pokemon-name">
      <h2>${pokemon.pok_nom}</h2>
      <span id="PV">${pokemon.stat_libelle}${pokemon.pokstat_value}</span>
      </div>
      <div class="pokemon-image">
          <img src=${pokemon.pok_image_online}>
      </div>
      <div class="pokemon-char">
        <span>Poids: ${pokemon.pok_poids} kg | Taille: ${pokemon.pok_taille} <br> Type: ${pokemon.typ_libelle} | N°: ${pokemon.pok_id}  </span>
      </div>
    </div>
    `)
    })
  })
  .catch(error => {
    console.error('Oupsi y à une erreur:', error);
  });
