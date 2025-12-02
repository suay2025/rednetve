document.addEventListener('DOMContentLoaded', function () {
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
    const sections = document.querySelectorAll('main section[id]');
    
    // Altura del header fijo (aproximadamente 90px, ajustada en CSS con scroll-padding-top)
    const navbarHeight = 90; 

    // Función para establecer el enlace activo, se utiliza tanto al hacer clic como al desplazarse
    function setActiveLink(targetLink) {
        if (!targetLink) return;

        // 1. Desactiva todos los enlaces
        navLinks.forEach(l => {
            l.classList.remove('active');
        });
        
        // 2. Activa el enlace objetivo
        targetLink.classList.add('active');
        
        // 3. Manejar la activación del padre Dropdown (Ej: Si activamos "Planes Residenciales", activamos "Servicios")
        const parentToggle = targetLink.closest('.dropdown')?.querySelector('.dropdown-toggle');
        if (parentToggle) {
            parentToggle.classList.add('active');
        }
    }

    // Lógica para manejar el Scroll Spy (Detección de sección activa por desplazamiento)
    function handleScrollSpy() {
        let currentSectionId = '';
        
        // Iterar sobre las secciones de atrás hacia adelante para priorizar la más alta
        for (let i = sections.length - 1; i >= 0; i--) {
            const section = sections[i];
            
            // Usamos offsetTop ajustado por la altura de la barra de navegación
            const sectionTop = section.offsetTop - navbarHeight;
            
            // Si el desplazamiento vertical es mayor o igual al inicio de la sección,
            // esa es nuestra sección actual.
            if (window.scrollY >= sectionTop) {
                currentSectionId = section.id;
                break; // Encontramos la sección activa, salimos del bucle
            }
        }

        if (currentSectionId) {
            // Mapeamos el ID de la sección al valor del atributo data-page en el menú de navegación.
            let pageName = '';
            // Usamos un switch (o if/else if) para mapear explícitamente los IDs a los data-page
            if (currentSectionId === 'inicio') pageName = 'inicio';
            else if (currentSectionId === 'quienes-somos') pageName = 'nosotros';
            else if (currentSectionId === 'cobertura') pageName = 'cobertura';
            else if (currentSectionId === 'nuestros-servicios') pageName = 'servicios'; // El caso de "Servicios"
            else if (currentSectionId === 'planes') pageName = 'planes';

            
            // Si encontramos un nombre de página válido (y no es una sección auxiliar como 'disfruta')
            if (pageName) {
                // Buscamos el enlace usando el atributo data-page, que es más robusto.
                const targetLink = document.querySelector(`.navbar-nav .nav-link[data-page="${pageName}"]`);
                
                if (targetLink && !targetLink.classList.contains('active')) {
                    setActiveLink(targetLink);
                }
            } 
            // Si la sección actual no tiene un enlace principal (como 'disfruta'),
            // el enlace activo se mantiene en la sección anterior, que es el comportamiento deseado.

        } else {
            // Si estamos en la parte superior de la página (antes de #inicio), activar 'Inicio'
            const inicioLink = document.querySelector('a[data-page="inicio"]');
            if (inicioLink && !inicioLink.classList.contains('active')) {
                setActiveLink(inicioLink);
            }
        }
    }

    // ----------------------------------------------------
    // Event Listeners
    // ----------------------------------------------------

    // 1. Listener para el clic en los enlaces (comportamiento instantáneo)
    navLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            const isInternalAnchor = this.getAttribute('href') && this.getAttribute('href').startsWith('#');
            
            // Si es un ancla interna o un elemento de un submenú, lo activamos
            if (isInternalAnchor || this.classList.contains('dropdown-item')) {
                setActiveLink(this);
            }
            
            // Si es un toggle, también lo activamos
            if (this.id && this.id.includes('Dropdown')) {
                setActiveLink(this);
            }
        });
    });
    
    // 2. Listener para el desplazamiento (comportamiento Scroll Spy)
    window.addEventListener('scroll', handleScrollSpy);

    // ----------------------------------------------------
    // Inicialización al cargar la página
    // ----------------------------------------------------
    
    // Llamar a Scroll Spy una vez al inicio para establecer la sección activa (por si se recarga en medio de la página)
    handleScrollSpy();
});