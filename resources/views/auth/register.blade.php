@extends('adminlte/layout')

@section('links')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" />
@endsection

@section('app')
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <img src="../../dist/img/logo2.png" alt="Clínica Conquistadores" class="brand-image elevation-5" style="opacity: .8" width="220" height="220">
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <x-label for="name" :value="__('Nombres')" />
                <x-input id="name" class="appearance-none border rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Document -->
            <div class="mb-4">
                <x-label for="document" :value="__('Documento')" />
                <x-input id="document" class="appearance-none border rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline" type="text" name="document" :value="old('document')" required autofocus />
            </div>

            <!-- Rol -->
            <div class="mb-4">
                <x-label for="tipo" :value="__('Rol')" />
                <select id="tipo" class="appearance-none border rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline" name="tipo" :value="old('tipo')" required autofocus onchange="toggleSelect(this)">
                    <option value="">Seleccione...</option>
                    <option value="Administrador">Administrador</option>
                    <option value="Funcionario">Funcionario</option>
                </select>
            </div>

            <div id="otroSelect" style="display: none;" class="mb-4">
                <x-label for="otro" :value="__('Seleccione una opción')" />
                <select id="otro" class="appearance-none border rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline" name="otro" onchange="toggleSelect2(this)">
                    <option value="">Seleccione...</option>
                    <option value="depe">Dependencias</option>
                    <option value="subdepe">Subdependencias</option>
                </select>
            </div>

            <div id="otroSelect2" style="display: none;" class="mb-4">
                <x-label for="id_dependencia" :value="__('Seleccionar Dependencia')" />
                <select id="id_dependencia" class="appearance-none border rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline" name="id_dependencia">
                    <option value="">Seleccione...</option>
                    <script>
                        var options = [
                            "Oficina Asesora Jurídica",
                            "Control Interno de Gestión",
                            "Control Interno Disciplinario",
                            "Secretaría Privada",
                            "Secretaría General",
                            "Secretaría de Prensa y Comunicaciones",
                            "Departamento Administrativo de Planeación",
                            "Secretaría Gestión del Riesgo de Desastres",
                            "Secretaría de Hacienda",
                            "Secretaría del Tesoro",
                            "Secretaría de Valorización y Plusvalía",
                            "Departamento Administrativo Bienestar Social",
                            "Secretaría de Educación",
                            "Secretaría Postconflicto y Cultura de Paz",
                            "Secretaría de Vivienda",
                            "Secretaría Equidad de Género",
                            "Secretaría de Salud",
                            "Secretaría Banco de Progreso",
                            "Secretaría de Gobierno",
                            "Secretaría de Cultura y Turismo",
                            "Secretaría Desarrollo Social",
                            "Secretaría de Infraestructura",
                            "Secretaría de Seguridad Ciudadana",
                            "Secretaría de Tránsito y Transporte",
                            "Oficina Caracterización Socioeconómica",
                            "Oficina Tecnologías de la Información y Comunicaciones",
                            "Subsecretaría Contaduria Municipal",
                            "Coordinación Casa de Justicia"
                        ];

                        for (var i = 0; i < options.length; i++) {
                            document.write('<option value="' + (i + 1) + '">' + options[i] + '</option>');
                        }
                    </script>
                </select>
            </div> 
            
            <div id="otroSelect3" style="display: none;" class="mb-4">
                <x-label for="id_subdependencia" :value="__('Seleccionar Subdependencia')" />
                <select id="id_subdependencia" class="appearance-none border rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline" name="id_subdependencia">
                    <option value="">Seleccione...</option>
                    <script>
                        var options = [
                            "Subsecretaría Administración del Talento Humano",
                            "Oficina de Pensiones",
                            "Subdirección Control Físico y Ambiental",
                            "Subdirección Desarrollo Físico y Ambiental",
                            "Subdirección Desarrollo Socioeconómico",
                            "Subdirección Gestión y Supervisión de Servicios Domiciliarios",
                            "Subsecretaría Recuperación de cartera",
                            "Subsecretaría Rentas e impuestos",
                            "Subsecretaría Financiera",
                            "Subsecretaría de Gestión Catastral Multipropósito",
                            "Subsecretaría Desarrollo de la Juventud",
                            "Subsecretaría Investigación y Desarrollo Pedagógico",
                            "Subsecretaría Administración Recursos Financieros",
                            "Subsecretaría Desarrollo del Talento Humano Educativo",
                            "Subsecretaría Administración del Tesoro Educativo",
                            "Subsecretaría de Planeación y Desarrollo Educativo",
                            "Subsecretaría Planeación en Salud",
                            "Subsecretaría de Salud Pública",
                            "Subsecretaría Aseguramiento y Control de Atención",
                            "Subsecretaría de Concertación Ciudadana",
                            "Subsecretaría Cultura y Turismo",
                            "Subsecretaría Productividad y Competitividad",
                            "Subsecretaría Participación Comunitaria",
                            "Subsecretaría de Infraestructura",
                            "Subsecretaría de Medio Ambiente",
                            "Subsecretaría de Seguridad Ciudadana",
                            "Subsecretaría Regulación de Tránsito y Transporte"
                        ];

                        for (var i = 0; i < options.length; i++) {
                            document.write('<option value="' + (i + 1) + '">' + options[i] + '</option>');
                        }
                    </script>
                </select>
            </div>

            <!-- Email Address -->
            <div class="mb-4">
                <x-label for="email" :value="__('Correo')" />
                <x-input id="email" class="appearance-none border rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-label for="password" :value="__('Contraseña')" />
                <x-input id="password" class="appearance-none border rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline" type="password" name="password" required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <x-label for="password_confirmation" :value="__('Confirmar Contraseña')" />
                <x-input id="password_confirmation" class="appearance-none border rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline" type="password" name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="bg-black hover:bg-gray-900 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    {{ __('Registrar') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

<script>
    function toggleSelect(selectElement) {
        var otroSelectDiv = document.getElementById('otroSelect');
        var otroSelect2Div = document.getElementById('otroSelect2');
        otroSelectDiv.style.display = (selectElement.value === 'Funcionario') ? 'block' : 'none';
        otroSelect2Div.style.display = 'none';
    }

    function toggleSelect2(selectElement) {
        var otroSelect2Div = document.getElementById('otroSelect2');
        var otroSelect3Div = document.getElementById('otroSelect3');

        otroSelect2Div.style.display = (selectElement.value === 'depe') ? 'block' : 'none';
        otroSelect3Div.style.display = (selectElement.value === 'subdepe') ? 'block' : 'none';

    }
</script>

@endsection