<section class="bg-white col-12">
        <form action="/controller/autentificacion.php" method="POST">
            <div class="h5 text-center"> <?php echo $mensaje_error; ?></div>
            <div>
                <label for="usuario" class="form-label">Nombre de usuario</label>
                <input type="text" name="usuario" class="form-control rounded-0" id="usuario" aria-describedby="userHelp">
            </div>
            <div class="mb-3">
                <label for="clave" class="form-label">Contraseña</label>
                <input type="password" name="clave" class="form-control rounded-0" id="clave">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input rounded-0" id="recordar">
                <label class="form-check-label" for="recordar">Recordar</label>
            </div>
            <div class="d-flex justify-content-center">
                <input type="submit" value="Iniciar sesión" class="col-12 col-md-8 btn btn-color-primary mb-2 rounded-0">
            </div>
        </form>
        <div class="d-flex justify-content-center">
            <a href="/view/form_registro_usuario.php" type="button" class="col-12 col-md-8 btn btn-color-primary mt-2 rounded-0">Crear Usuario</a>
        </div>
        <!-- Acceso con Google -->
        <hr>
        <div class="d-flex justify-content-center pb-3"> <a class="col-12 col-md-10 btn btn-primary rounded-0" href="/controller/google-oauth.php" role="button"><img src="/public/img/google.svg" width="20px" height="20px">Acceder con Google</a>
        </div>
    </section>