<?php
include('../plantilla.php');
Plantilla::aplicar();
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<style>
  body { background: rgb(231, 231, 192); font-family: 'Poppins', sans-serif; }
  .form-label { font-weight: 600; }
  .btn-primary { background-color: rgb(214, 173, 61); border: none; }
  .btn-primary:hover { background-color: rgb(160, 130, 46); }
  .clima-card { border-radius: 15px; padding: 25px; color: white; text-align: center; }
  .clima-sol { background: #f7b733; }
  .clima-lluvia { background: #4a90e2; }
  .clima-nublado { background: #95a5a6; }
  .icono-clima { font-size: 3rem; }
</style>

<div class="container mt-4 mb-5">
  <h2 class="text-center mb-4">Clima en República Dominicana 🌦️</h2>
  <div class="row justify-content-center">
    <div class="col-md-6">
      <form id="formClima" class="card p-4 rounded-4 shadow border-0" onsubmit="return false;">
        <div class="mb-3">
          <label for="ciudadClima" class="form-label">Ciudad:</label>
          <input type="text" class="form-control" id="ciudadClima" placeholder="Ej. Santo Domingo" required>
        </div>
        <button class="btn btn-primary w-100">Consultar clima</button>
      </form>
      <div id="resultadoClima" class="mt-4"></div>
    </div>
  </div>
  <div class="text-center mt-4">
    <a href="../index.php" class="btn btn-secondary">Volver al Inicio</a>
</div>
</div>

<script>
  const coords = {
    "santo domingo": [18.4861, -69.9312],
    "santiago": [19.45, -70.7],
    "puerto plata": [19.8, -70.7],
    "la vega": [19.2167, -70.5333],
    "higüey": [18.5833, -68.3833]
  };

  document.getElementById("formClima").addEventListener("submit", () => {
    const ciudad = document.getElementById("ciudadClima").value.trim().toLowerCase();
    const resultado = document.getElementById("resultadoClima");
    resultado.innerHTML = "";

    if (!coords[ciudad]) {
      resultado.innerHTML = `<div class="alert alert-warning">No tengo coordenadas para "<strong>${ciudad}</strong>". Usa una de: Santo Domingo, Santiago, La Vega, Puerto Plata, Higüey.</div>`;
      return;
    }
    const [lat, lon] = coords[ciudad];

    fetch(`https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&current_weather=true`)
      .then(r => r.json())
      .then(data => {
        const temp = data.current_weather.temperature.toFixed(1);
        const code = data.current_weather.weathercode;
        let clase = 'clima-sol', emoji = '☀️', texto = 'Despejado';

        if ([61,63,65,80,81].includes(code)) { clase = 'clima-lluvia'; emoji = '🌧️'; texto = 'Lluvia'; }
        else if ([2,3,45,48,71,75,77,85,86].includes(code)) { clase = 'clima-nublado'; emoji = '☁️'; texto = 'Nublado'; }

        resultado.innerHTML = `
          <div class="clima-card ${clase} shadow">
            <div class="icono-clima">${emoji}</div>
            <h4>${ciudad.replace(/\b\w/g, l => l.toUpperCase())}, República Dominicana</h4>
            <p class="mb-1">🌡️ <strong>${temp} °C</strong></p>
            <p>${texto}</p>
          </div>`;
      })
      .catch(err => {
        console.error(err);
        resultado.innerHTML = `<div class="alert alert-danger">Error al consultar clima.</div>`;
      });
  });
</script>
