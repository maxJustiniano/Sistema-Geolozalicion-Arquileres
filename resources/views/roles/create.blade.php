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
   <div class="max-w-2xl w-full space-y-8"><!-- Mensaje de Éxito -->
    <div id="successBanner" class="hidden success-banner bg-green-100 border border-green-200 rounded-lg p-4 mb-6">
     <div class="flex items-center">
      <svg class="w-5 h-5 text-green-600 mr-3" fill="currentColor" viewbox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
      </svg>
      <p class="text-green-800 font-medium">Rol creado exitosamente</p>
     </div>
    </div><!-- Contenedor Principal (Tarjeta) -->
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-8 border border-gray-200 dark:border-gray-700"><!-- Encabezado -->
     <div class="text-center mb-8">
      <h1 id="formTitle" class="text-3xl font-semibold text-blue-600 dark:text-blue-400">Crear Nuevo Tipo de Usuario</h1>
     </div><!-- Formulario -->
     <form id="roleForm" class="space-y-6"><!-- Campo de Entrada -->
      <div><label id="fieldLabel" for="roleName" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2"> Nombre del Rol </label> <input type="text" id="roleName" name="roleName" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white transition-colors duration-200" placeholder="Ej: Administrador, Operador, Cliente" required>
       <p id="errorMessage" class="hidden mt-2 text-sm text-red-600">Este campo es obligatorio</p>
      </div><!-- Botones de Acción - Alineados en los extremos -->
      <div class="flex justify-between gap-4 pt-4"><!-- Botón Principal (Guardar) - IZQUIERDA --> <button type="submit" id="saveButton" class="h-12 px-6 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-lg transition-colors duration-200 flex items-center space-x-2 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
        <svg id="saveIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewbox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3-3m0 0l-3 3m3-3v12"></path>
        </svg><span id="saveButtonText">Guardar Rol</span> </button> <!-- Botón Secundario (Cancelar) - DERECHA --> <button type="button" id="cancelButton" class="h-12 px-6 bg-red-700 hover:bg-red-800 text-white font-medium rounded-lg transition-colors duration-200 focus:ring-2 focus:ring-red-500 focus:ring-offset-2"> <span id="cancelButtonText">Cancelar</span> </button>
      </div>
     </form>
    </div>
   </div>
  </div>
</html>