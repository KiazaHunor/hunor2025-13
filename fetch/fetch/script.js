

function Fetch()
{
    const pokemonName = document.getElementById("PokemonName").value.toLowerCase();
fetch(`https://pokeapi.co/api/v2/pokemon/${pokemonName}`)
    .then(x => x.json())
    .then(data => {
     console.log(data.weight);
    

    const PokemonCucc =data.sprites.front_default;
    const imgElement =document.getElementById("PokemonSprite");

    imgElement.src = PokemonCucc;
    imgElement.style.display = "block";
    });
}