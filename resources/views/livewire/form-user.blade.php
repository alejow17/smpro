<div class="contenedor1 centrado-form">
    <div class="col-md-4" class="row justify-content-center">
        <div>
            <div>
                <div>
                    <form wire:submit="save" class="form">
                        <h1 style="font-size:24px" class="text-center">¡Únete a nosotros hoy mismo!</h1>
                        <p style="font-size:14px" class="text-center">Ingresa tus datos y déjanos ser parte de tu historia
                            de éxito.</p>
                        <div class="form-group">
                            <label style="margin-bottom:8px;font-weight: 400" for="nombre">Nombre completo</label>
                            <input wire:model="nombre" type="text" id="nombre" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label style="font-weight: 400" for="email">Correo Electrónico</label>
                            <input wire:model="email" type="email" id="email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label style="margin-bottom:8px;font-weight: 400" for="telefono">Teléfono</label>
                            <input wire:model="telefono" type="tel" id="telefono" class="form-control"
                                maxlength="10" required>
                        </div>
                        <div class="form-group">
                            <label style="margin-bottom:8px;font-weight: 400" for="categoria">Categoría</label>
                            <select wire:model="categoria" id="categoria" class="form-control" required>
                                <option value="">Seleccione una opción</option>
                                <option value="asociado">Asociado</option>
                                <option value="nuevo usuario">Nuevo Usuario</option>
                            </select>
                        </div><br>
                        <label style="font-weight:400;font-size:14px" class="text-center" for="terminos">
                            <input type="checkbox" id="terminos" required>
                            Acepto términos y condiciones sobre el <a style="color:black;text-decoration: underline"
                                href="https://www.prosperando.co/seguridad-datos-personales/">tratamiento y protección
                                de datos
                                personales</a>.
                        </label><br><br>
                        <div style="text-align: center">
                            <button type="submit" class="btn btn-primary btn-block">Registrar</button>
                        </div>  
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
