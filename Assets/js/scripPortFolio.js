// Espera a que el DOM esté completamente cargado antes de ejecutar el código
document.addEventListener('DOMContentLoaded', function() {
    
    // =============================================
    // Configuración del tema oscuro/claro
    // =============================================
    
    // Obtener el botón de alternar tema
    const themeToggle = document.querySelector('.theme-toggle');
    // Obtener el tema guardado en localStorage o usar 'light' como predeterminado
    const currentTheme = localStorage.getItem('theme') || 'light';
    
    // Aplicar el tema guardado al cargar la página
    document.documentElement.setAttribute('data-theme', currentTheme);
    // Actualizar el ícono del botón según el tema actual
    updateToggleIcon(currentTheme);
    
    // Evento para cambiar el tema al hacer clic en el botón
    themeToggle.addEventListener('click', () => {
        // Determinar el nuevo tema (alternar entre dark y light)
        const newTheme = document.documentElement.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
        // Aplicar el nuevo tema al documento
        document.documentElement.setAttribute('data-theme', newTheme);
        // Guardar la preferencia del tema en localStorage
        localStorage.setItem('theme', newTheme);
        // Actualizar el ícono del botón
        updateToggleIcon(newTheme);
    });
    
    // Función para actualizar el ícono del botón de tema
    function updateToggleIcon(theme) {
        // Determinar qué ícono mostrar (sol para dark, luna para light)
        const icon = theme === 'dark' ? 'fa-sun' : 'fa-moon';
        // Actualizar el HTML del botón con el ícono correspondiente
        themeToggle.innerHTML = `<i class="fas ${icon}"></i>`;
    }
    
    // =============================================
    // Manejo del formulario de contacto
    // =============================================
    
    // Evento para el envío del formulario
    document.getElementById('contactForm').addEventListener('submit', function(e) {
        // Prevenir el envío tradicional del formulario
        e.preventDefault();
        // Mostrar un mensaje de confirmación
        alert('Gracias por tu mensaje. Me pondré en contacto contigo pronto.');
        // Resetear el formulario después del envío
        this.reset();
    });
    
    // =============================================
    // Actualización del año en el footer
    // =============================================
    
    // Obtener el año actual y mostrarlo en el elemento con ID 'current-year'
    document.getElementById('current-year').textContent = new Date().getFullYear();
  
    // =============================================
    // Sección de habilidades (tecnologías y herramientas)
    // =============================================
    
    // Lista de tecnologías
    const technologies = ['HTML5', 'CSS3', 'JavaScript', 'Python', 'C#'];
    // Lista de herramientas
    const tools = ['Git', 'VS Code', 'Figma', 'Jira','FileZilla'];
    // Contenedor donde se mostrarán las habilidades
    const skillsDisplay = document.getElementById('skillsDisplay');
    // Botón para alternar entre tecnologías y herramientas
    const toggleBtn = document.getElementById('toggleSkills');
    // Variable para rastrear qué se está mostrando actualmente
    let showTechnologies = true;
  
    // Función para alternar entre la visualización de tecnologías y herramientas
    function toggleSkillsView() {
        // Invertir el estado actual
        showTechnologies = !showTechnologies;
        
        // Limpiar el contenedor de habilidades
        skillsDisplay.innerHTML = '';
        // Determinar qué lista mostrar
        const itemsToShow = showTechnologies ? technologies : tools;
        
        // Crear y agregar elementos para cada habilidad
        itemsToShow.forEach(item => {
            const skillTag = document.createElement('span');
            skillTag.className = 'skill-tag';  // Clase CSS para estilizar
            skillTag.textContent = item;      // Texto de la habilidad
            skillsDisplay.appendChild(skillTag); // Agregar al contenedor
        });
        
        // Actualizar el texto del botón según lo que se mostrará al siguiente clic
        toggleBtn.textContent = showTechnologies ? 'Mostrar Herramientas' : 'Mostrar Tecnologías';
    }
  
    // Inicializar mostrando tecnologías al cargar la página
    toggleSkillsView();
    
    // Evento para el botón de alternar habilidades
    toggleBtn.addEventListener('click', toggleSkillsView);
  });
  
  // codigo para cargar proyectos desde un archivo JSON
  
fetch("api.php")
  .then(response => response.json())
  .then(data => {
    const contenedor = document.getElementById("contenedor-proyectos");
    
    // Mapeo personalizado para asignar imágenes específicas
    const proyectosConImagenes = data.map((proyecto, index) => ({
      ...proyecto,
      imagen: `img/proyecto${index + 1}.png` // proyecto1.png, proyecto2.png, etc.
    }));

    proyectosConImagenes.forEach(proyecto => {
      const card = document.createElement("div");
      card.className = "project-card";
      card.innerHTML = `
        <div class="project-image">
          <img src="${proyecto.imagen}" alt="${proyecto.titulo}" 
               onerror="this.src='Assets/img/default-project.png'">
        </div>
        <div class="project-content">
          <h3>${proyecto.titulo}</h3>
          <p>${proyecto.descripcion}</p>
          <a href="${proyecto.url_github}" class="project-link" target="_blank">
            <i class="fab fa-github"></i> Código
          </a>
        </div>
      `;
      contenedor.appendChild(card);
    });
  })
  .catch(error => {
    console.error("Error:", error);
    document.getElementById("contenedor-proyectos").innerHTML = `
      <p class="error-message">Error al cargar proyectos. Recarga la página.</p>
    `;
  });