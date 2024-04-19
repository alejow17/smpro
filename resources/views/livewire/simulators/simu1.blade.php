<div>
    <div class="container centrado-vertical d-flex justify-content-center align-items-center">
        <div class="simulator p-4 shadow-lg">
            <h2 class="mb-4 text-center">¡Simula tu ahorro programado!</h2>
            <p style="text-align: center">¡Planifica tus sueños! Simula tu ahorro con precisión y facilidad.</p>
            <!-- Monto Mensual -->
            <div class="mb-3">
                <label for="monto" class="form-label">Monto Mensual (Sin puntos ni comas):</label>
                <input type="number" id="monto" class="form-control" min="50000" required><br>
                <p style="text-align: left"><b>¡Recuerda!</b> ¡Cada céntimo cuenta para alcanzar tus metas financieras!</p>
            </div><br>
            <!-- Duración -->
            <div class="mb-3">
                <label for="duracion" class="form-label">Duración (en días):</label>
                <select id="duracion" class="form-select">
                    <option value="90">90</option>
                    <option value="180">180</option>
                    <option value="270">270</option>
                    <option value="365">365</option>
                </select><br>
                <p style="text-align: left"><b>¡Recuerda!</b> Cada día es una nueva oportunidad para acercarte a tus sueños.</p>
            </div><br>
            <div class="g-recaptcha" data-sitekey="TU_CLAVE_SECRETA"></div><br>
            <div class="text-center">
                <button style="font-size:18px" onclick="calcularAhorro()" class="btn btn-primary">¡Simular!</button>
            </div>
        </div>
    </div>

    <!-- Popup oculto por defecto -->
    <div class="position-relative" style="display: none;">
        <div id="popupResultado" class="popup"></div>
    </div>

    <script>
         function calcularAhorro() {
            var response = grecaptcha.getResponse();
            if (response.length == 0) {
                alert("Por favor, completa el CAPTCHA para continuar.");
                return;
            }
            var montoMensual = parseFloat(document.getElementById("monto").value);
            if (isNaN(montoMensual) || montoMensual < 50000) {
                alert("El monto mensual debe ser mínimo de 50000");
                return;
            }

            document.getElementById("fondoGris").style.display = "block";
            var duracion = parseInt(document.getElementById("duracion").value);
            var tasaAnual;

            switch (duracion) {
                case 90:
                    tasaAnual = 1.85;
                    break;
                case 180:
                    tasaAnual = 2.15;
                    break;
                case 270:
                    tasaAnual = 2.45;
                    break;
                case 365:
                    tasaAnual = 2.85;
                    break;
                default:
                    tasaAnual = 0;
                    break;
            }

            // Calcular los rendimientos mensuales
            var tasaMensual = tasaAnual / 12 / 100;
            var totalRendimientos = 0;

            // Calcular el número de meses para el período de duración seleccionado
            var numMeses = duracion / 30;

            // Calcular los rendimientos de manera adecuada para períodos anuales
            if (duracion === 365) {
                totalRendimientos = montoMensual * (1 + tasaAnual / 100) - montoMensual;
            } else {
                // Calcular los rendimientos mensuales para otros períodos
                for (var i = 0; i < numMeses; i++) {
                    // Calcular el rendimiento mensual y sumarlo al total
                    totalRendimientos += montoMensual * tasaMensual;
                }
            }

            // Calcular el saldo del ahorro
            var saldoAhorro = montoMensual * numMeses + totalRendimientos;

            // Formatear los resultados sin centavos
            var formattedSaldoAhorro = new Intl.NumberFormat('es-ES', { style: 'currency', currency: 'COP', maximumFractionDigits: 0 }).format(saldoAhorro);
            var formattedTotalRendimientos = new Intl.NumberFormat('es-ES', { style: 'currency', currency: 'COP', maximumFractionDigits: 0 }).format(totalRendimientos);

            // Construir el HTML con los resultados
            var html = `
                <a class="circular-image navbar-brand d-flex justify-content-between align-items-center" href="#">
                    <img style="width:200px" src="{{ asset('images/logo.png') }}" alt="Logo">
                    <button type="button" class="btn-close m-3" aria-label="Close" onclick="cerrarPopup()"></button>
                </a><br><br>
                <div style=" margin-top:-30px;text-align: center;">
                    <h2 style="font-size:28px">Resultados de tu simulación</h2><hr>
                    <h3 style="text-decoration-line: line-through;font-size:18px;font-weight: 300;">Con otras entidades: 1,25%</h3>
                    <h3 style="font-size:18px;font-weight: 300;"><b style="font-weight:700;">¡¡Con nosotros!!</b> (Tasa efectiva anual): <b style="font-weight:700">${tasaAnual}%</b> </h3><br>
                    <h3 style="font-size:18px;font-weight: 300;">Saldo del ahorro: <b style="font-weight:700"> $${formattedSaldoAhorro} </b></h3><br>
                    ${duracion !== 365 ? `<h3 style="font-size:18px;font-weight: 300;">Valor de los rendimientos: <b style="font-weight:700"> $${formattedTotalRendimientos} </b></h3><br>` : ''}
                    <h3 style="font-size:18px;font-weight: 300;">GMF: <b style="font-weight:700"> $0.00 </b></h3>
                    <h3 style="font-size:18px;font-weight: 300;">Retención en la fuente: <b style="font-weight:700"> $0.00 </b></h3>
                    <h3 style="text-decoration-line: line-through;font-size:18px;font-weight: 300;">Con otras entidades: $ 16.000</h3><b style="font-size:18px">¡¡Nosotros lo asumimos!!</b></p><br>
                    <h3 style="font-size:18px;font-weight: 300;">:¡Tu ahorro total! <b style="font-weight:700"> $${formattedSaldoAhorro} </b></h3><br>
                    <p style="font-size:15px;text-align:center" ><b>¡¡RECUERDA!!</b> Esta es solo una <b>simulación</b>, y la tasa de interés puede adaptarse a tus necesidades con la entidad financiera.</p>
                    <a style="font-size:18px" href="/form" class="btn btn-primary" wire:navigate>¡Lo quiero!</a>
                </div>
            `;

            // Mostrar el resultado en un popup
            var popupResultado = document.getElementById("popupResultado");
            popupResultado.innerHTML = html;
            popupResultado.parentNode.style.display = "block"; // Mostrar el popup cambiando su estilo
        }

        function cerrarPopup() {
            document.querySelector(".position-relative").style.display = "none";
            
            document.getElementById("fondoGris").style.display = "none";
        }

        // Función para obtener la fecha actual y establecerla en el campo de fecha de inicio
        document.getElementById('fechaInicio').value = new Date().toISOString().slice(0, 10);
    </script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</div>
