function togglePasswordVisibility() {
    var pass = document.querySelector('#password');
    if (pass.type === "password") {
        pass.type = "text";
    } else {
        pass.type = "password";
    }
}
// Show the image input 
var loadFile = function (event) {
    var image = document.querySelector('#img-output');
    image.src = URL.createObjectURL(event.target.files[0]);
    image.onload = function () {
        URL.revokeObjectURL(output.src)
    }
};
// Validate user input at the client side
(() => {
    'use strict'
    const forms = document.querySelectorAll('.needs-validation')

    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)

    })
})()