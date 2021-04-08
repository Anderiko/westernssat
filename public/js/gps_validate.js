"use strict"

const form = document.getElementById('codePromptForm')

form.addEventListener('submit', e => {

    e.preventDefault();

    let btn = document.getElementById('codePromptSubmitBtn');
    btn.disabled = true;
    btn.querySelector('#validateLoader').style.display = 'inline-block';

    navigator.geolocation.getCurrentPosition(
        function (location) {
            let text = document.getElementById('codePromptTextbox')

            let latElement = document.createElement("input");
            latElement.type = "hidden";
            latElement.name = "coordLat";
            latElement.value = String(location.coords.latitude);
            text.after(latElement);

            let lonElement = document.createElement("input");
            lonElement.type = "hidden";
            lonElement.name = "coordLon";
            lonElement.value = String(location.coords.longitude);
            text.after(lonElement);

            form.submit();
        },
        function () {
        },
        {enableHighAccuracy: true}
    );

});

let errorGeo = navigator.geolocation.watchPosition(
    function () {
        document.getElementById('errorNoGPSbox').remove();

        let text = document.getElementById('codePromptTextbox')
        text.disabled = false;
        text.placeholder = "Entrez le code à valider"
        text.name = "code";
        text.focus();

        let btn = document.getElementById('codePromptSubmitBtn');
        btn.disabled = false;
        btn.querySelector('#validateLoader').style.display = 'none';

        navigator.geolocation.clearWatch(errorGeo)
    },
    function () {
    },
    {enableHighAccuracy: true}
);

