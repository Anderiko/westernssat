"use strict"

const baseMap = L.map('basemap').setView([48.7322183, -3.4587994], 16);
let userMarker;

let geopoints = [];

fetch('/geocache/map/geopoints').then(response => {

    response.json().then(data => {
        geopoints = data.geopoints;

        Object.freeze(geopoints);

        for (let gp of geopoints) setGeopoint(baseMap, gp);

        window.dispatchEvent(new Event('geopoints_loaded'))
    })

});


const icons = {
    "fragment": "/images/geocache/position-fragment.png",
    "geocache": "/images/geocache/position-cache.png",
    "found": "/images/geocache/position-cache-validee.png",
    "final": "/images/geocache/position-final.png",
};

function setGeopoint(map, geopointData) {

    let icnImg = icons[geopointData.found ? "found" : geopointData.type];
    let icon = L.icon({
        iconUrl: icnImg,
        shadowUrl: '/images/geocache/position-shadow.png',
        iconSize: [24.7, 40],
        iconAnchor: [12.3, 40],
        shadowSize: [87, 39],
        shadowAnchor: [34, 23],
        popupAnchor: [0, -45]
    });

    let marker = L.marker(geopointData.coord, {icon: icon}).addTo(map);
    if (geopointData.type == "final") marker.bindPopup(geopointData.desc);
    else marker.bindPopup(`<h4>Fragment ${geopointData.id}</h4><p>${geopointData.desc}</p><a href="/geocache/caches/${geopointData.id}">Plus d'infos</a>${geopointData.found ? "<br/><p style=\"color:#4DAB33\">Vous avez déjà trouvé ce fragment !</p>" : ""}`);
}


L.tileLayer("https://tile.thunderforest.com/atlas/{z}/{x}/{y}.png?apikey=7c352c8ff1244dd8b732e349e0b0fe8d", {
    minZoom: 12,
    maxZoom: 22,
    attribution: "Données cartographiques © <a href=\"https://www.openstreetmap.org/copyright\">OpenStreetMap</a>"
}).addTo(baseMap);


window.addEventListener('geopoints_loaded', event => {

    navigator.geolocation.getCurrentPosition(function (location) {

            /*let minDistance = 1000;

            for (let gp of geopoints) {
                let latDist = (location.coords.latitude - gp.coord[0]) * 1.1119 / 1e-5;
                let lngDist = (location.coords.longitude - gp.coord[1]) * 0.7339 / 1e-5;
                let gpDistance = Math.sqrt(Math.pow(latDist, 2) + Math.pow(lngDist, 2))
                minDistance = Math.min(minDistance, gpDistance);
            }

            document.getElementById("proximityLabel").innerText = `Proximité : ${minDistance.toFixed(1)}m`;*/
            // document.getElementById("proximityLabel").innerText = `Proximité: ${minDistance.toFixed(1)}m`;

            let icon = L.icon({
                iconUrl: '/images/geocache/position-joueur.png',
                shadowUrl: '/images/geocache/position-shadow.png',
                iconSize: [24.7, 40],
                iconAnchor: [12.3, 40],
                shadowSize: [87, 39],
                shadowAnchor: [34, 23],
                popupAnchor: [0, -45]
            });

            let userCoord = L.latLng(location.coords.latitude, location.coords.longitude);
            userMarker = L.marker(userCoord, {icon: icon}).addTo(baseMap);
            userMarker.bindPopup(`<b>Vous êtes ici</b>`);
        }, function () {
            alert("Impossible d'accéder à votre position GPS :/\n\nLa fonctionnalité de mesure de proximité n'est pas disponible et a été désactivée.\n\nVérifiez les autorisations de votre navigateur web et de cette page pour l'activer.")
        },
        {enableHighAccuracy: true, maximumAge: 1000}
    );


    navigator.geolocation.watchPosition(function (location) {
        let minDistance = 1000;

        for (let gp of geopoints) {
            let latDist = (location.coords.latitude - gp.coord[0]) * 1.1119 / 1e-5;
            let lngDist = (location.coords.longitude - gp.coord[1]) * 0.7339 / 1e-5;
            let gpDistance = Math.sqrt(Math.pow(latDist, 2) + Math.pow(lngDist, 2))
            minDistance = Math.min(minDistance, gpDistance)
        }

        let userCoord = L.latLng(location.coords.latitude, location.coords.longitude);
        if (userMarker) {
            userMarker.setLatLng(userCoord);
            document.getElementById("proximityLabel").innerText = `Proximité: ${minDistance.toFixed(1)}m`;
        }
    });

})
