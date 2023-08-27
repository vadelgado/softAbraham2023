
function RegistrarUsuario(){
    var documento = document.getElementById('documento').value;
    var nombre = document.getElementById('nombre').value;
    var correo = document.getElementById('correo').value;
    var password = document.getElementById('password').value;
    var password_confirm = document.getElementById('password_confirm').value;
    var rol = document.getElementById('rol');
    var selectedIndex = rol.selectedIndex;

    //validar correo
    var correoValido = /\S+@\S+\.\S+/.test(correo);
      // Comparar contraseñas
    var contraseniasCoinciden = password === password_confirm;

    if (documento == "" || nombre=="" || correo == "" || password =="" 
    || password_confirm=="" || selectedIndex==0) {
        Swal.fire(
            'Alerta',
            'Por favor, llene todos los campos',
            'warning'
          )
    } else {
      if (!correoValido) {
        correoError.innerHTML = 'Correo electrónico inválido';
      } 
      else if (!contraseniasCoinciden) {
        correoError.innerHTML = '';
        contraseniaError.innerHTML = 'Las contraseñas no coinciden';
        confirmarContraseniaError.innerHTML = 'Las contraseñas no coinciden';
      } else {
        contraseniaError.innerHTML = '';
        confirmarContraseniaError.innerHTML = '';
        $("#formRegistrar").submit(); // Enviar el formulario

      }
    }

}

