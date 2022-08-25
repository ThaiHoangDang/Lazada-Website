var loadFile = function (event) {
    var image = document.getElementById("profile-img");
    image.src = URL.createObjectURL(event.target.files[0]);
    image.onload = function () {
        URL.revokeObjectURL(output.src)
    }
};