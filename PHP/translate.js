
document.getElementById("toggle-translate").addEventListener("click", function () {
    let boton = document.getElementById("toggle-translate");
    let isTranslating = boton.classList.contains("active");

    // Select all elements that contain text to be translated
    // Add or remove selectors based on what you want to translate
    // Excluded the logo link (header .logo a) from translation
    const elementsToTranslate = document.querySelectorAll(
        'header a:not(.logo a), #toggle-translate span, .search-input, .most-recent, .content-item .title, .content-item p:not(.published), .content-item p.published, .content-item .see-more, footer p, .post-header h1, .post-header-text p, .comments-section h2, .comments-list .comment-item .comment-body, .references-container h2, .references-content p, .rating-section h3, .star-rating label, .rating-submit-btn, .comments-section .login-prompt p, .comments-section .login-prompt a, .post-content p, .post-content h2, .post-content h3, .post-content h4, .post-content h5, .post-content h6, .post-content li' // Added selector for paragraphs within post-header-text
    );

    // Use a Map to store original texts associated with elements
    // This map will persist between clicks to restore original text
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

        boton.querySelector('span').innerText = "Traducir"; // Restore button text
        boton.classList.remove("active");

    } else {
        // Translate to English

        // If original texts are not stored yet, store them
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

        // *** AÑADIR ESTA LÍNEA PARA DEPURACIÓN ***
        console.log("Textos a traducir:", textsToTranslate);

        // Call AJAX to `translate.php`
        fetch("translate.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: new URLSearchParams({
                "texts": JSON.stringify(textsToTranslate), // Send an array of texts
                "target_lang": "EN"
            })
        })
        .then(response => {
            if (!response.ok) {
                // *** MODIFICAR ESTA LÍNEA PARA INCLUIR EL CÓDIGO DE ESTADO ***
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log("Respuesta de la API:", data); // Log the response

            if (data && data.translatedTexts && Array.isArray(data.translatedTexts)) {
                // Update elements with translated text
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
            } else {
                 console.error("Invalid response format from translate.php:", data);
            }
        })
        .catch(error => console.error("Error en la traducción:", error));

        boton.querySelector('span').innerText = "Mostrar en Español"; // Change button text
        boton.classList.add("active");
    }
});
