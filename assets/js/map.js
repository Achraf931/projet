function initMap(lat, long, name, schedule, address) {
    let myLatlng = new google.maps.LatLng(lat, long)
    let mapOptions = {
        zoom: 16,
        center: myLatlng
    }
    let map = new google.maps.Map(document.getElementById("map"), mapOptions)

    let contentString = '<div id="content">'+
        '<div id="siteNotice">'+
        '</div>'+
        '<h3 id="firstHeading" class="firstHeading">' + name + '</h3>'+
        '<br>'+
        '<div id="bodyContent">'+
        '<p>' + schedule + '</p>'+
        '<br>'+
        '<p>' + address + '</p>'+
        '</div>'+
        '</div>'

    let infowindow = new google.maps.InfoWindow({
        content: contentString
    })

    let marker = new google.maps.Marker({
        position: myLatlng,
        map: map
    })

    marker.addListener('click', function() {
        infowindow.open(map, marker)
    })
}

window.onload = function () {
    initMap(48.8622484,2.4393288,"Mairie de Montreuil","Ouvert du lundi au samedi de 0h à 17h",'Place Jean Jaurès 93100 Montreuil')
}

let services = document.querySelectorAll('.event')
services.forEach(function (service) {
    service.addEventListener('click', function () {
        map.style.display = 'block'
        initMap(service.getAttribute('data-lat'), service.getAttribute('data-long'), service.getAttribute('data-name'), service.getAttribute('data-schedule'), service.getAttribute('data-address'))
    })
})