<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulador GanaMes</title>
</head>
<body>
    <div class="container centrado-vertical d-flex justify-content-center align-items-center">
        <div class="simulator p-4 shadow-lg">
            <h2 class="mb-4 text-center">¡Simula tu GanaMes!</h2>
            <p style="text-align: center">¡Descubre tus ganancias con nuestro producto GanaMes! ¡Aprovecha al máximo tus ahorros!</p>
            <form id="ganaMesForm">
                <div class="mb-3">
                    <label for="saldoCuenta" class="form-label">Saldo en tu cuenta (sin comas ni puntos):</label>
                    <input type="number" id="saldoCuenta" class="form-control" placeholder="Ingresa el saldo en tu cuenta" min="0" required><br>
                    <p style="text-align: left"><b>¡Recuerda!</b> Tu saldo en cuenta determinará la tasa de interés que recibirás.</p>
                </div>
                <div class="mb-3">
                    <label for="plazoDias" class="form-label">Plazo en días:</label>
                    <input type="number" id="plazoDias" class="form-control" value="30" disabled>
                    <p style="text-align: left"><b>¡Recuerda!</b> Esta simulación se realiza en base a 30 días.</p>
                </div><br>
                <div class="g-recaptcha" data-sitekey="TU_CLAVE_SECRETA"></div><br>
                <div style="text-align: center">
                    <button style="font-size:18px" type="submit" class="btn btn-primary">¡Simular!</button>
                </div>
            </form>
            <div id="popupResultado" class="popup" style="display:none;">
                <div class="popup-inner">
                    <!-- Aquí se mostrará el resultado de la simulación -->
                    <div id="resultado"></div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.getElementById("ganaMesForm").addEventListener("submit", function(event) {
            event.preventDefault();
            document.getElementById("fondoGris").style.display = "block";
            var response = grecaptcha.getResponse();
            if (response.length == 0) {
                alert("Por favor, completa el CAPTCHA para continuar.");
                return;
            }
            var saldoCuenta = parseFloat(document.getElementById("saldoCuenta").value);
            var tasaInteres = calcularTasaInteres(saldoCuenta);
    
            // Calculamos la ganancia total en 30 días
            var gananciaTotal = saldoCuenta * tasaInteres;
    
            // Formatear los resultados
            var formattedSaldoCuenta = saldoCuenta.toLocaleString('es-ES', { style: 'currency', currency: 'COP', maximumFractionDigits: 0 });
            var formattedTasaInteres = (tasaInteres * 100).toLocaleString('es-ES', { style: 'decimal', maximumFractionDigits: 2 }) + "%";
            var formattedGananciaTotal = gananciaTotal.toLocaleString('es-ES', { style: 'currency', currency: 'COP', maximumFractionDigits: 0 });
            var formattedGananciaOtrasEntidades = (gananciaTotal * 0.5).toLocaleString('es-ES', { style: 'currency', currency: 'COP', maximumFractionDigits: 0 });
    
            // Construir el HTML con los resultados
            var html = `
                <a class="circular-image navbar-brand d-flex justify-content-between align-items-center" href="#">
                    <img style="width:200px" src="{{ asset('images/logo.png') }}" alt="Logo">
                    <button type="button" class="btn-close m-3" aria-label="Close" onclick="cerrarPopup()"></button>
                </a><br><br>
                <div style=" margin-top:-30px;text-align: center;">
                <h2 style="font-size:28px">Resultados de tu simulación</h2><hr>
                <h3 style="font-size:18px;font-weight: 300;">Saldo en tu cuenta:<b style="font-weight:700"> $${formattedSaldoCuenta}</b></h3>
                <p style="margin-top:5px;font-size:15px;text-align:center"><b>¡¡RECUERDA!!</b> Tu saldo en cuenta determina la tasa de interés que recibirás.</p>
                <h3 style="font-size:18px;font-weight: 300;">Tasa de interés aplicada: <b style="font-weight:700">${formattedTasaInteres}</b> </h3><br>
                <p style="text-decoration-line: line-through;font-size:18px;font-weight: 300;"><b>Ganancia estimada con otras entidades: </b> $${formattedGananciaOtrasEntidades}</p>   
                <h3 style="font-size:18px;font-weight: 300;">Ganancia total estimada en 30 días: <b style="font-weight:700">$${formattedGananciaTotal}</b></h3>
                <p style="font-size:15px;text-align:center" ><b>¡Comparado con otras entidades financieras!</b> Nuestra tasa de interés es mucho más alta.</p>
                <p style="font-size:15px;text-align:center" ><b>¡¡RECUERDA!!</b> Esta es solo una <b>simulación</b>, y la tasa de interés puede variar según las condiciones actuales.</p>
                <a style="font-size:18px" href="/form" class="btn btn-primary" wire:navigate>¡Lo quiero!</a>
                </div>
            `;
    
            // Mostrar el resultado en un popup
            var popupResultado = document.getElementById("popupResultado");
            popupResultado.style.display = "flex"; // Mostrar el popup
            document.getElementById("resultado").innerHTML = html;
        });
    
        function cerrarPopup() {
            document.getElementById("popupResultado").style.display = "none"; // Ocultar el popup
            // Ocultar el fondo gris
            document.getElementById("fondoGris").style.display = "none";
        }
    
        function calcularTasaInteres(saldo) {
            if (saldo >= 1000001) {
                return 0.1175; 
            } else if (saldo >= 100001 && saldo <= 999999) {
                return 0.026; 
            } else if (saldo >= 50001 && saldo <= 100000) {
                return 0.023; 
            } else if (saldo >= 20001 && saldo <= 50000) {
                return 0.019; 
            } else if (saldo >= 10001 && saldo <= 20000) {
                return 0.016; 
            } else if (saldo >= 5001 && saldo <= 10000) {
                return 0.01; 
            } else if (saldo >= 501 && saldo <= 5000) {
                return 0.007; 
            } else {
                return 0.003; 
            }
        }
    </script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</body>
</html>
