function getSelectedPhoto() {
    var select = document.getElementById("photoSelector");
    var selectedPhotoPath = select.options[select.selectedIndex].value;
    return selectedPhotoPath;
}

function showPanorama(selectedPhotoPath) {
    console.log(selectedPhotoPath);

    var panorama = pannellum.viewer('panorama', {
        "type": "equirectangular",
        "panorama": `${selectedPhotoPath}`,
        "autoLoad": true,
    });
}

function deletePanorama() {
    panorama.removeScene();
}

