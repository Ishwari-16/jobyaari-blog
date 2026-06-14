import './bootstrap';
import '../css/app.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';

import Alpine from 'alpinejs';
import $ from 'jquery';
import 'bootstrap';

window.Alpine = Alpine;
window.$ = window.jQuery = $;

Alpine.start();