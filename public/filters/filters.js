 document.addEventListener('DOMContentLoaded', function() {
        const filterCards = document.querySelectorAll('.filter-card.collapsible');

        // Función para manejar el colapso/expansión
        filterCards.forEach(card => {
            const title = card.querySelector('.filter-title');
            title.addEventListener('click', () => {
                card.classList.toggle('collapsed');
            });
        });

        // Lógica para Rango de Precios (Simulación)
        const minPriceInput = document.getElementById('minPrice');
        const maxPriceInput = document.getElementById('maxPrice');
        const priceRangeDisplay = document.getElementById('priceRangeDisplay');

        function updatePriceDisplay() {
            const min = minPriceInput.value ? parseInt(minPriceInput.value).toLocaleString('es-AR') : '0';
            const max = maxPriceInput.value ? parseInt(maxPriceInput.value).toLocaleString('es-AR') : 'Máximo';
            priceRangeDisplay.textContent = `Rango Actual: $${min} - $${max}`;
        }

        minPriceInput.addEventListener('input', updatePriceDisplay);
        maxPriceInput.addEventListener('input', updatePriceDisplay);

        // Inicializar el display
        updatePriceDisplay();

        // Lógica de Botones (Simulación)
        const applyBtn = document.getElementById('applyFilters');
        const clearBtn = document.getElementById('clearFilters');

        applyBtn.addEventListener('click', () => {
            alert('Filtros Aplicados (Lógica de Livewire/Fetch iría aquí)');
            // Aquí deberías emitir un evento de Livewire o hacer una llamada AJAX
            // Ejemplo: Livewire.dispatch('apply-filters', { data: getSelectedFilters() });
        });

        clearBtn.addEventListener('click', () => {
            // Limpiar todos los checkboxes/radio
            document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => checkbox.checked = false);
            document.querySelectorAll('input[type="radio"]').forEach(radio => radio.checked = false);

            // Restablecer radios de habitaciones y baños
            document.querySelector('input[name="minRooms"][value="1"]').checked = true;
            document.querySelector('input[name="minBathrooms"][value="1"]').checked = true;

            // Limpiar inputs de precio
            minPriceInput.value = '';
            maxPriceInput.value = '';
            updatePriceDisplay();
            
            alert('Filtros Limpiados');
        });
    });