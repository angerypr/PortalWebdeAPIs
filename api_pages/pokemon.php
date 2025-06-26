<?php
include('../plantilla.php');
Plantilla::aplicar();
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
<style>
    body {
        background: linear-gradient(to bottom, #fceabb, #f8b500);
        font-family: 'Press Start 2P', cursive;
    }

    h2 {
        color: #D32F2F;
        text-shadow: 2px 2px 0 #fff;
    }

    .pokemon-card {
        background-color: #ffffffcc;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        text-align: center;
    }

    .pokemon-img {
        width: 150px;
    }

    .btn-primary {
        background-color: #ffcb05;
        border: none;
        color: #3b4cca;
        font-weight: bold;
    }

    .btn-primary:hover {
        background-color: #f5b700;
    }

    .pokemon-audio {
        margin-top: 15px;
    }
</style>

<div class="container mt-4 mb-5">
    <h2 class="text-center mb-4">Información de un Pokémon ⚡</h2>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form id="formPokemon" class="card p-4 rounded-4 pokemon-card" onsubmit="return false;">
                <div class="mb-3">
                    <label for="nombrePokemon" class="form-label">Nombre del Pokémon:</label>
                    <input type="text" class="form-control text-center" id="nombrePokemon" placeholder="Ej. pikachu" required>
                </div>
                <button class="btn btn-primary w-100">Buscar</button>
            </form>

            <div id="resultadoPokemon" class="mt-4"></div>
        </div>
    </div>
</div>

<script>
document.getElementById('formPokemon').addEventListener('submit', () => {
    const nombre = document.getElementById('nombrePokemon').value.trim().toLowerCase();
    const resultado = document.getElementById('resultadoPokemon');
    resultado.innerHTML = "";

    if (!nombre) {
        resultado.innerHTML = `<div class="alert alert-warning">Por favor, ingresa el nombre de un Pokémon.</div>`;
        return;
    }

    fetch(`https://pokeapi.co/api/v2/pokemon/${encodeURIComponent(nombre)}`)
        .then(res => {
            if (!res.ok) throw new Error("Pokémon no encontrado");
            return res.json();
        })
        .then(data => {
            const nombreMostrar = data.name.charAt(0).toUpperCase() + data.name.slice(1);
            const img = data.sprites.front_default;
            const experiencia = data.base_experience;
            const habilidades = data.abilities.map(hab => hab.ability.name).join(', ');
            
            const sonido = `https://play.pokemonshowdown.com/audio/cries/${data.name}.mp3`;

            resultado.innerHTML = `
                <div class="pokemon-card">
                    <h4>${nombreMostrar}</h4>
                    <img src="${img}" alt="${nombreMostrar}" class="pokemon-img">
                    <p>⚔️ Experiencia Base: <strong>${experiencia}</strong></p>
                    <p>🧠 Habilidades: <strong>${habilidades}</strong></p>
                    <audio controls class="pokemon-audio">
                        <source src="${sonido}" type="audio/mpeg">
                        Tu navegador no soporta el audio.
                    </audio>
                </div>`;
        })
        .catch(error => {
            resultado.innerHTML = `<div class="alert alert-danger">No se pudo encontrar ese Pokémon.</div>`;
            console.error(error);
        });
});
</script>
