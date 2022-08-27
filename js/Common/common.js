// Show the image input 
var loadFile = function (event) {
    var image = document.querySelector('#img-output');
    image.src = URL.createObjectURL(event.target.files[0]);
    image.onload = function () {
        URL.revokeObjectURL(output.src)
    }
};
function checkErrorMessage() {
    let pass = document.querySelector('#password').value;
    let feedback = document.querySelector('#password-feedback');
    if (!/^[A-Za-z\d!@#$%^&*]{8,20}$/.test(pass)) {
        feedback.innerHTML = "Password must be from 8 to 20 characters with appropriate characters"
    } else if (!/(?=.*[a-z])/.test(pass)) {
        feedback.innerHTML = "Password must contain at least 1 lowercase character"
    } else if (!/(?=.*[A-Z])/.test(pass)) {
        feedback.innerHTML = "Password must contain at least 1 uppercase character"
    } else if (!/(?=.*\d)/.test(pass)) {
        feedback.innerHTML = "Password must contain at least 1 digit"
    } else if (!/(?=.*[!@#$%^&*])/.test(pass)) {
        feedback.innerHTML = "Password must contain at least 1 special character: !@#$%^&*"
    }
}
// Validate Bootstrap form
(() => {
    'use strict'
    const forms = document.querySelectorAll('.needs-validation')

    Array.from(forms).forEach(form => {
        form.addEventListener('submit', checkErrorMessage);
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)

    })
})()