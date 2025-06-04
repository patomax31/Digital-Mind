document.getElementById("toggle-translate").addEventListener("click", function () {
    let boton = document.getElementById("toggle-translate");
    let isTranslating = boton.classList.contains("active");

    // Select all elements that contain text to be translated
    // Add or remove selectors based on what you want to translate
    // Excluded the logo link (header .logo a) from translation
    const elementsToTranslate = document.querySelectorAll(
        'header a:not(.logo a), #toggle-translate span, .search-input, .most-recent, .content-item .title, .content-item p:not(.published), .content-item p.published, .content-item .see-more, footer p, .post-header h1, .post-header-text p, .comments-section h2, .comments-list .comment-item .comment-body, .references-container h2, .references-content p, .rating-section h3, .star-rating label, .rating-submit-btn, .comments-section .login-prompt p, .comments-section .login-prompt a, .post-content p, .post-content h2, .post-content h3, .post-content h4, .post-content h5, .post-content h6, .post-content li, .hero h1, .hero p, .inspiration-quote, .section-header h2, .section-header p, .team-card h3, .team-info p, .value-card h3, .value-card p, .footer-logo, .categoria-card h3, .categoria-card p, .cta-contacto h2, .cta-contacto a, h1, h2, h3, h4, h5, h6, p, li, a, button, label, span, th, td, ' +
        '.hero h1, .hero p, .inspiration-quote, .section-header h2, .section-header p, ' +
        '.section-content p, .team-card h3, .team-info p, .value-card h3, .value-card p, ' +
        '.footer-logo, footer p, footer a, value-card fade-in' + '.hero-title, .contact-title, .glass-form h2, .faq-section h2, .faq-question, .faq-answer, .info-box, .submit-button, .glass-form input[placeholder], .glass-form textarea[placeholder], .cta-contacto h2, .cta-contacto a, h1, h2, h3, h4, h5, h6, p, li, a, button, label, span, th, td' + '.nav-bar-button, .nav-button-container button, ' +
        // Títulos y subtítulos
        'h1, h2, h3, h4, h5, h6, ' +
        // Botones de acción
        '.crear-publicacion, .bulk-actions button, .view-button, .edit-button, .delete-button, .archive-button, .unarchive-button, .action-buttons a, ' +
        // Formularios de categoría
        '.form-categoria input[placeholder], .form-categoria button[type="submit"], .form-categoria .file-label, ' +
        // Tablas y encabezados
        'table th, table td, .table th, .table td, ' +
        // Mensajes y modales
        '#modal-archivado, .no-results-message p, .no-results-message span, ' +
        // Tarjetas de categoría
        '.categoria-card h2, .categoria-card p, ' +
        // Otros elementos generales
        'label, span, a, button'
    );

    // Use a Map to store original texts associated with elements
    // This map will persist between clicks to restore original text
    // Use a Map to store original texts associated with elements
    if (!window.originalTexts) {
        window.originalTexts = new Map();
    }

    if (isTranslating) {
        // Restore original text
        window.originalTexts.forEach((originalText, element) => {
            if (element.tagName === 'INPUT' && element.type === 'text') {
                element.placeholder = originalText;
            } else {
                element.textContent = originalText;
            }
        });
        boton.querySelector('span').innerText = "Traducir";
        boton.classList.remove("active");
    } else {
        // Store original texts only if not stored yet
        if (window.originalTexts.size === 0) {
            elementsToTranslate.forEach(element => {
                if (element.tagName === 'INPUT' && element.type === 'text') {
                    window.originalTexts.set(element, element.placeholder);
                } else {
                    window.originalTexts.set(element, element.textContent);
                }
            });
        }

        // Collect all original texts to send to the server
        const textsToTranslate = Array.from(window.originalTexts.values());

        // Call AJAX to `translate.php`
        fetch("translate.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: new URLSearchParams({
                "texts": JSON.stringify(textsToTranslate),
                "target_lang": "EN"
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data && data.translatedTexts && Array.isArray(data.translatedTexts)) {
                const translatedTexts = data.translatedTexts;
                let i = 0;
                window.originalTexts.forEach((originalText, element) => {
                    if (i < translatedTexts.length) {
                        if (element.tagName === 'INPUT' && element.type === 'text') {
                            element.placeholder = translatedTexts[i];
                        } else {
                            element.textContent = translatedTexts[i];
                        }
                        i++;
                    }
                });
            }
        })
        .catch(error => console.error("Error en la traducción:", error));

        boton.querySelector('span').innerText = "Mostrar en Español";
        boton.classList.add("active");
    }
});
