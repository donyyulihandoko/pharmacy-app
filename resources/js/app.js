import './bootstrap';
import 'flowbite';
import { initFlowbite } from 'flowbite';
// import Alpine from 'alpinejs';

// window.Alpine = Alpine;
document.addEventListener('livewire:navigated', () => { 
    initFlowbite();
});
// Alpine.start();
