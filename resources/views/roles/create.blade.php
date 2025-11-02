<!doctype html>
<html lang="es" class="h-full">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crear Tipo de Usuario</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="/_sdk/data_sdk.js"></script>
  <script src="/_sdk/element_sdk.js"></script>
  <style>
        body {
            box-sizing: border-box;
        }
        
        .loading-spinner {
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        .success-banner {
            animation: slideDown 0.3s ease-out;
        }
        
        @keyframes slideDown {
            from { transform: translateY(-100%); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        
        .fade-out {
            animation: fadeOut 0.3s ease-out forwards;
        }
        
        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; }
        }
    </style>
  <style>@view-transition { navigation: auto; }</style>
 </head>
 <body class="h-full bg-gray-50 dark:bg-gray-900 font-sans">
  <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
   <div class="max-w-xl w-full space-y-8"><!-- Mensaje de Éxito -->
    <div id="successBanner" class="hidden success-banner bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
     <div class="flex items-center">
      <svg class="w-5 h-5 text-green-600 mr-3" fill="currentColor" viewbox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
      </svg>
      <p class="text-green-800 font-medium">Rol creado exitosamente</p>
     </div>
    </div><!-- Contenedor Principal -->
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-8 border border-gray-200 dark:border-gray-700"><!-- Encabezado -->
     <div class="text-center mb-8">
      <h1 id="formTitle" class="text-2xl font-semibold text-gray-900 dark:text-white">Crear Nuevo Tipo de Usuario</h1>
     </div><!-- Formulario -->
     <form id="roleForm" class="space-y-6"><!-- Campo de Entrada -->
      <div><label id="fieldLabel" for="roleName" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"> Nombre del Rol </label> <input type="text" id="roleName" name="roleName" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white transition-colors duration-200" placeholder="Ej: Administrador, Operador, Cliente" required>
       <p id="errorMessage" class="hidden mt-2 text-sm text-red-600">Este campo es obligatorio</p>
      </div><!-- Botones de Acción -->
      <div class="space-y-4"><!-- Botón Principal (Guardar) --> <button type="submit" id="saveButton" class="w-full h-12 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200 flex items-center justify-center space-x-2 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
        <svg id="saveIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3-3m0 0l-3 3m3-3v12"></path>
        </svg><span id="saveButtonText">Guardar Rol</span> </button> <!-- Botón Secundario (Cancelar) --> <button type="button" id="cancelButton" class="w-full h-12 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"> <span id="cancelButtonText">Cancelar</span> </button>
      </div>
     </form>
    </div>
   </div>
  </div>
  <script>
        // Configuración por defecto
        const defaultConfig = {
            form_title: "Crear Nuevo Tipo de Usuario",
            field_label: "Nombre del Rol",
            placeholder_text: "Ej: Administrador, Operador, Cliente",
            save_button_text: "Guardar Rol",
            cancel_button_text: "Cancelar",
            primary_color: "#2563eb",
            surface_color: "#ffffff",
            text_color: "#111827",
            success_color: "#059669",
            border_color: "#d1d5db"
        };

        let currentRoles = [];
        let isLoading = false;

        // Configuración del Data SDK
        const dataHandler = {
            onDataChanged(data) {
                currentRoles = data;
            }
        };

        // Función para mostrar estado de carga
        function showLoading() {
            if (isLoading) return;
            isLoading = true;
            
            const saveButton = document.getElementById('saveButton');
            const saveIcon = document.getElementById('saveIcon');
            const saveButtonText = document.getElementById('saveButtonText');
            
            saveButton.disabled = true;
            saveButton.classList.add('opacity-75', 'cursor-not-allowed');
            
            saveIcon.innerHTML = `
                <div class="loading-spinner w-5 h-5 border-2 border-white border-t-transparent rounded-full"></div>
            `;
            saveButtonText.textContent = 'Guardando...';
        }

        // Función para ocultar estado de carga
        function hideLoading() {
            if (!isLoading) return;
            isLoading = false;
            
            const saveButton = document.getElementById('saveButton');
            const saveIcon = document.getElementById('saveIcon');
            const saveButtonText = document.getElementById('saveButtonText');
            const config = window.elementSdk?.config || defaultConfig;
            
            saveButton.disabled = false;
            saveButton.classList.remove('opacity-75', 'cursor-not-allowed');
            
            saveIcon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3-3m0 0l-3 3m3-3v12"></path>
            `;
            saveButtonText.textContent = config.save_button_text || defaultConfig.save_button_text;
        }

        // Función para mostrar mensaje de éxito
        function showSuccess() {
            const successBanner = document.getElementById('successBanner');
            successBanner.classList.remove('hidden');
            
            setTimeout(() => {
                successBanner.classList.add('fade-out');
                setTimeout(() => {
                    successBanner.classList.add('hidden');
                    successBanner.classList.remove('fade-out');
                }, 300);
            }, 3000);
        }

        // Función para mostrar error
        function showError(message) {
            const errorMessage = document.getElementById('errorMessage');
            errorMessage.textContent = message;
            errorMessage.classList.remove('hidden');
        }

        // Función para ocultar error
        function hideError() {
            const errorMessage = document.getElementById('errorMessage');
            errorMessage.classList.add('hidden');
        }

        // Función para limpiar formulario
        function clearForm() {
            document.getElementById('roleName').value = '';
            hideError();
        }

        // Manejador del formulario
        document.getElementById('roleForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            if (isLoading) return;
            
            const roleName = document.getElementById('roleName').value.trim();
            
            if (!roleName) {
                showError('Este campo es obligatorio');
                return;
            }
            
            hideError();
            
            // Verificar límite de registros
            if (currentRoles.length >= 999) {
                showError('Se ha alcanzado el límite máximo de 999 roles. Por favor, elimine algunos roles primero.');
                return;
            }
            
            showLoading();
            
            try {
                const newRole = {
                    id: Date.now().toString(),
                    nombre: roleName,
                    fechaCreacion: new Date().toISOString()
                };
                
                const result = await window.dataSdk.create(newRole);
                
                if (result.isOk) {
                    showSuccess();
                    clearForm();
                } else {
                    showError('Error al guardar el rol. Por favor, inténtelo de nuevo.');
                }
            } catch (error) {
                showError('Error inesperado. Por favor, inténtelo de nuevo.');
            } finally {
                hideLoading();
            }
        });

        // Manejador del botón cancelar
        document.getElementById('cancelButton').addEventListener('click', function() {
            clearForm();
        });

        // Configuración del Element SDK
        async function onConfigChange(config) {
            const formTitle = document.getElementById('formTitle');
            const fieldLabel = document.getElementById('fieldLabel');
            const roleNameInput = document.getElementById('roleName');
            const saveButtonText = document.getElementById('saveButtonText');
            const cancelButtonText = document.getElementById('cancelButtonText');
            const saveButton = document.getElementById('saveButton');
            
            // Actualizar textos
            formTitle.textContent = config.form_title || defaultConfig.form_title;
            fieldLabel.textContent = config.field_label || defaultConfig.field_label;
            roleNameInput.placeholder = config.placeholder_text || defaultConfig.placeholder_text;
            
            if (!isLoading) {
                saveButtonText.textContent = config.save_button_text || defaultConfig.save_button_text;
            }
            cancelButtonText.textContent = config.cancel_button_text || defaultConfig.cancel_button_text;
            
            // Actualizar colores
            const primaryColor = config.primary_color || defaultConfig.primary_color;
            const surfaceColor = config.surface_color || defaultConfig.surface_color;
            const textColor = config.text_color || defaultConfig.text_color;
            
            saveButton.style.backgroundColor = primaryColor;
            document.querySelector('.bg-white.dark\\:bg-gray-800').style.backgroundColor = surfaceColor;
            formTitle.style.color = textColor;
        }

        function mapToCapabilities(config) {
            return {
                recolorables: [
                    {
                        get: () => config.primary_color || defaultConfig.primary_color,
                        set: (value) => {
                            if (window.elementSdk) {
                                window.elementSdk.setConfig({ primary_color: value });
                            }
                        }
                    },
                    {
                        get: () => config.surface_color || defaultConfig.surface_color,
                        set: (value) => {
                            if (window.elementSdk) {
                                window.elementSdk.setConfig({ surface_color: value });
                            }
                        }
                    },
                    {
                        get: () => config.text_color || defaultConfig.text_color,
                        set: (value) => {
                            if (window.elementSdk) {
                                window.elementSdk.setConfig({ text_color: value });
                            }
                        }
                    }
                ],
                borderables: [],
                fontEditable: undefined,
                fontSizeable: undefined
            };
        }

        function mapToEditPanelValues(config) {
            return new Map([
                ["form_title", config.form_title || defaultConfig.form_title],
                ["field_label", config.field_label || defaultConfig.field_label],
                ["placeholder_text", config.placeholder_text || defaultConfig.placeholder_text],
                ["save_button_text", config.save_button_text || defaultConfig.save_button_text],
                ["cancel_button_text", config.cancel_button_text || defaultConfig.cancel_button_text]
            ]);
        }

        // Inicialización
        async function init() {
            try {
                // Inicializar Data SDK
                const dataResult = await window.dataSdk.init(dataHandler);
                if (!dataResult.isOk) {
                    console.error('Error al inicializar Data SDK');
                }

                // Inicializar Element SDK
                if (window.elementSdk) {
                    window.elementSdk.init({
                        defaultConfig,
                        onConfigChange,
                        mapToCapabilities,
                        mapToEditPanelValues
                    });
                }
            } catch (error) {
                console.error('Error durante la inicialización:', error);
            }
        }

        // Inicializar cuando la página esté lista
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', init);
        } else {
            init();
        }
    </script>
 <script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9986fc0c7742dea5',t:'MTc2MjEyMTY2My4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>