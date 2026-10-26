import './bootstrap';

import Alpine from 'alpinejs';
import iconPicker from './icon-picker';

window.Alpine = Alpine;
Alpine.data('iconPicker', iconPicker);

Alpine.start();
