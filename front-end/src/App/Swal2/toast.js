import Swal from 'sweetalert2';

function Toast([position, background]) {
  return Swal.mixin({
    toast: true,
    position,
    showConfirmButton: false,
    background,
    timer: 1500,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer);
      toast.addEventListener('mouseleave', Swal.resumeTimer);
    },
  });
}

export default Toast;
