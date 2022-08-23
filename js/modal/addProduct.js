function loadFile(event) {
    var output = document.getElementById('imgResult');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function () {
        URL.revokeObjectURL(output.src)
    }
};

var input = document.getElementById('product-image');
input.addEventListener('change', loadFile);