import './bootstrap';
import '../css/app.css';

import Alpine from 'alpinejs';
import $ from 'jquery';
import 'bootstrap';

window.Alpine = Alpine;
window.$ = window.jQuery = $;

Alpine.start();
