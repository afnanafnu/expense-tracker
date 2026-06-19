import './bootstrap';

import $ from 'jquery';
import 'jquery-validation';

window.$ = $;
window.jQuery = $;

// Select2
import select2 from 'select2';
import 'select2/dist/css/select2.min.css';
select2($);

// SweetAlert2
import Swal from 'sweetalert2';
window.Swal = Swal;

/**
 * ALWAYS FORCE GLOBAL FUNCTION
 */
window.showToast = (icon, message) => {
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon,
        title: message,
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        customClass: {
            popup: 'swal-toast'
        },
        backdrop: false   // ⭐ IMPORTANT FIX
    });
};