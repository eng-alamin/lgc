<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? config('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset(config('setting.favicon'))}}" />
    @stack('styles')
    @livewireStyles
</head>
<body>

    {{ $slot }}

        <script>
            document.addEventListener('livewire:init', () => {
                // success toast
                Livewire.on('success', (event) => {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: event.message,
                        showConfirmButton: false,
                        timer: 3000
                    });
                });
                // error toast
                Livewire.on('error', (event) => {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: event.message,
                        showConfirmButton: false,
                        timer: 3000
                    });
                });
                // modal close
                Livewire.on('closeModal', () => {
                    document.querySelectorAll('.modal.show').forEach((modal) => {
                        bootstrap.Modal.getInstance(modal).hide();
                    });
                });
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')
    @livewireScripts
</body>
</html>