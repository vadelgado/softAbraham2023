// Función autoejecutable
(function() {
  "use strict";

  // Función de utilidad para seleccionar elementos del DOM
  const select = (el, all = false) => {
    el = el.trim();

    if (all) {
      return [...document.querySelectorAll(el)]; // Retorna una matriz de elementos
    } else {
      return document.querySelector(el); // Retorna un solo elemento
    }
  };

  // Función de utilidad para agregar eventos a los elementos del DOM
  const on = (type, el, listener, all = false) => {
    if (all) {
      select(el, all).forEach(e => e.addEventListener(type, listener)); // Agrega el evento a cada elemento seleccionado
    } else {
      select(el, all).addEventListener(type, listener); // Agrega el evento al elemento seleccionado
    }
  };

  // Función de utilidad para escuchar eventos de desplazamiento en un elemento
  const onscroll = (el, listener) => {
    el.addEventListener('scroll', listener);
  };

  // Verificar si el elemento '.toggle-sidebar-btn' existe en el DOM
  if (select('.toggle-sidebar-btn')) {
    // Agregar evento de clic al elemento '.toggle-sidebar-btn'
    on('click', '.toggle-sidebar-btn', function(e) {
      select('body').classList.toggle('toggle-sidebar'); // Alternar la clase 'toggle-sidebar' en el elemento 'body'
    });
  }

})();

function agregarTitulo() {
  var tituloDiv = document.createElement("div");
  tituloDiv.className = "titulo";

  var html = `
  <div class="row">
  <div class="col-md-6 mb-3">
    <label for="titulo_academico" class="form-label">Título Académico:</label>
    <input type="text" class="form-control" name="titulo_academico[]" required>
  </div>
  <div class="col-md-6 mb-3">
    <label for="especializacion" class="form-label">Especialización:</label>
    <input type="text" class="form-control" name="especializacion[]" required>
  </div>
</div>
  `;

  tituloDiv.innerHTML = html;
  document.getElementById("titulos").appendChild(tituloDiv);
}

  // Función para agregar experiencia docente
  function agregarExperienciaDocente() {
    var experienciaDocenteDiv = document.createElement("div");
    experienciaDocenteDiv.className = "experiencia-docente";

    var html = `
    <div class="row">
    <div class="col-md-6 mb-3">
      <label for="experiencia_docente" class="form-label">Experiencia Docente (años):</label>
      <input type="number" class="form-control" name="experiencia_docente[]" required>
    </div>
    <div class="col-md-6 mb-3">
      <label for="materias" class="form-label">Materias:</label>
      <input type="text" class="form-control" name="materias[]" required>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 mb-3">
      <label for="nivel_educativo" class="form-label">Nivel Educativo:</label>
      <input type="text" class="form-control" name="nivel_educativo[]" required>
    </div>
  </div>
    `;

    experienciaDocenteDiv.innerHTML = html;
    document.getElementById("experiencias_docentes").appendChild(experienciaDocenteDiv);
  }

