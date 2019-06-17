// window.addEventListener('scroll', function () {
//     let picker = document.querySelector('#cuppaDatePickerContainer')
//     let rect = picker.getBoundingClientRect()
//     let y = rect.top
//
//     if (y < 75) {
//         picker.style.visibility = 'hidden'
//     } else if(y > 75){
//         picker.style.visibility = 'visible'
//     }
// })
let sendDate = function (date, type) {
    let object = {
        date: date,
        type: type,
    }
    fetch('api/events-list.php', {
        method: 'POST',
        headers: new Headers(),
        body: JSON.stringify(object)
    })
        .then((res) => {
            return res.json()
        })
        .then((data) => {
            if (data.arrayDate !== '') {
                document.querySelector(".containEvents").innerHTML = ""

                if (data.msg){
                    document.querySelector('.containEvents').innerHTML = `<p>${data.msg}</p>`
                }

                for (let a = 0; a < data.arrayDate.length; a++){
                    let event = document.createElement('div')
                    event.classList.add('event')
                    event.innerHTML = `<a href="index.php?page=events&event_id=${data.arrayDate[a].id}" class="blue">
                                            <img class="img" src="assets/img/events/${data.arrayDate[a].image}" alt="">
                                            <div id='infoEvent'>
                                                <h3 class="blue">${data.arrayDate[a].title}</h3>
                                                <p>Lire l'événement</p>
                                            </div>
                                        </a>`
                    document.querySelector('.containEvents').appendChild(event)
                }
            }
        })
        .catch(() => {
            console.log("L'opération a échoué, veuillez réessayer ")
        })
}
sendDate('', 'allEvents')

let allEvents = document.querySelector('#allEvents')
allEvents.addEventListener('click', function () {
    sendDate('', 'allEvents')
})