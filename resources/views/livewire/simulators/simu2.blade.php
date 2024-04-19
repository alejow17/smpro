<body>
    <div class="container centrado-vertical d-flex justify-content-center align-items-center">
        <div class="simulator p-4 shadow-lg">
            <h2 class="mb-4 text-center">¡Simula tu CDAT!</h2>
            <p style="text-align: center">¡Descubre tus ganancias con nuestro CDAT! ¡Asegura tu futuro financiero ahora!</p>
            <form id="cdatForm">
                <div class="mb-3">
                    <label for="valorInversion" class="form-label">Valor de la inversión (sin comas ni puntos):</label>
                    <input type="number" id="valorInversion" class="form-control" placeholder="Ingresa el valor de la inversión" min="50000" required><br>
                    <p style="text-align: left"><b>¡Recuerda!</b> Cada peso que inviertas te acerca más a tus sueños financieros.</p>
                </div><br>
                <div class="mb-3">
                    <label for="plazoDias" class="form-label">Plazo en días:</label>
                    <select id="plazoDias" class="form-select" required>
                        <option value="90">90 días</option>
                        <option value="180">180 días</option>
                        <option value="270">270 días</option>
                        <option value="365">365 días</option>
                    </select><br>
                    <p style="text-align: left"><b>¡Recuerda!</b> Cada día es una oportunidad para hacer crecer tu inversión.</p>
                </div><br>
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
        document.getElementById("cdatForm").addEventListener("submit", function(event) {
            event.preventDefault();
            document.getElementById("fondoGris").style.display = "block";
            var valorInversion = parseFloat(document.getElementById("valorInversion").value);
            var plazoDias = parseInt(document.getElementById("plazoDias").value);
            
            // Realizamos el cálculo de intereses y otros detalles del CDAT
            var tasaAnual = 9 / 100;
            var tasaPeriodo = tasaAnual / 365;
            var totalIntereses = 0;

            for (var i = 0; i < plazoDias; i++) {
                var interesPeriodo = valorInversion * tasaPeriodo;
                totalIntereses += interesPeriodo;
            }

            // Calculamos el total de ahorro
            var totalAhorro = valorInversion + totalIntereses;

            var OtrasEntidades = totalAhorro - (totalAhorro * 0.2);

            // Formatear los resultados
            var formattedTotalIntereses = totalIntereses.toLocaleString('es-ES', { style: 'currency', currency: 'COP',  maximumFractionDigits: 0 });
            var formattedValorInversion = valorInversion.toLocaleString('es-ES', { style: 'currency', currency: 'COP',  maximumFractionDigits: 0 });
            var formattedTotalAhorro = totalAhorro.toLocaleString('es-ES', { style: 'currency', currency: 'COP',  maximumFractionDigits: 0 });
            var formattedOtrasEntidades = OtrasEntidades.toLocaleString('es-ES', { style: 'currency', currency: 'COP',  maximumFractionDigits: 0 });


            // Construir el HTML con los resultados
            var html = `
                <a class="circular-image navbar-brand d-flex justify-content-between align-items-center" href="#">
                    <img style="width:200px" src="{{ asset('images/logo.png') }}" alt="Logo">
                    <button type="button" class="btn-close m-3" aria-label="Close" onclick="cerrarPopup()"></button>
                </a><br><br>
                <div style=" margin-top:-30px;text-align: center;">
                <h2 style="font-size:28px">Resultados de tu simulación</h2><hr>
                <h3 style="font-size:18px;font-weight: 300;">Valor de la inversión:<b style="font-weight:700"> $${formattedValorInversion}</b></h3>
                <p style="margin-top:5px;font-size:15px;text-align:center"><b>¡¡RECUERDA!!</b> Cada peso que inviertas te acerca más a tus sueños financieros.</p>
                <h3 style="font-size:18px;font-weight: 300;">Ganancia total en ${plazoDias} días: <b style="font-weight:700">$${formattedTotalIntereses}</b> </h3>
                <p style="font-size:15px;text-align:center" ><b>¡¡RECUERDA!!</b> Cada día es una oportunidad para hacer crecer tu inversión.</p>
                <p style="font-size:15px;font-weight: 300;color:red"><b>Ganancia estimada con otras entidades: $${formattedOtrasEntidades} </b></p>
                <h3 style="font-size:18px;font-weight: 300;">Total ahorro: <b style="font-weight:700">$${formattedTotalAhorro}</b></h3><br>
                <p style="font-size:15px;text-align:center"><b>¡¡RECUERDA!!</b> Esta es solo una <b>simulación</b>, y la tasa de interés puede variar dependiendo de tus necesidades con nosotros.</p>
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
    </script>
</body>
</html>
