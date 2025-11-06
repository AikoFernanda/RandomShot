import './bootstrap'; // sama sekali tidak akan bertabrakan (konflik) dengan Alpine.js. Menyiapkan alat backend Laravel, seperti Axios
import Alpine from 'alpinejs' // Menyiapkan alat frontend Alpine
 
window.Alpine = Alpine
 
Alpine.start() // Menyalakan Alpine