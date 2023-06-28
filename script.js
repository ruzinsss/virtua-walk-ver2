function getSelectedPhoto() {
    var select = document.getElementById("photoSelector");
    var selectedPhotoPath = select.options[select.selectedIndex].value;
    console.log(selectedPhotoPath);
    return selectedPhotoPath;
}

function showPanorama() {
    pannellum.viewer('panorama', {
        "type": "equirectangular",
        "panorama": `${selectedPhotoPath}`,
    })
}


