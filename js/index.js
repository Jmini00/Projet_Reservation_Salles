/**
 * Récupère et affiche toutes les salles
 */
fetch('api/all_rooms.php')
    .then(response => response.json())
    .then(rooms => {
        rooms.forEach(room => {
            const card = createRoomCard(room, true)
            document.querySelector('#rooms').appendChild(card)
        })
    })
    .catch(error => console.error(error))

/**
 * Récupère et affiche toutes les salles sélectionnées
 */
fetch('api/reserved_rooms.php')
    .then(response => response.json())
    .then(rooms => {
        rooms.forEach(room => {
            const card = createRoomCard(room, false)
            document.querySelector('#rooms-reserved').appendChild(card)
        })
    })
    .catch(error => console.error(error))

/**
 * Créer une carte pour une salle
 */
function createRoomCard(room, leftColumn)
{
    // Si la salle va dans la colonne de gauche, je récupère l'ID du template qu'il me faut
    const idTemplate = leftColumn ? '#room-template' : '#room-reserved-template'
    const template = document.querySelector(idTemplate).content.cloneNode(true)

    const card = template.querySelector('.card')

    // Ajoute les valeurs à l'image de la carte
    card.querySelector('.card-img-top').src = room.picture
    card.querySelector('.card-img-top').alt = room.name

    card.querySelector('.card-title').textContent = room.name
    card.querySelector('.card-text').textContent = `Capacité : ${room.capacity}`

    // Bouton réservation
    const reservedButton = card.querySelector('.btn-success')
    if (room.isReserved && reservedButton) {
        reservedButton.id = `room-id-${room.id}`
        reservedButton.disabled = true // Désactive le clic du bouton
        reservedButton.textContent = 'Déjà réservé' // Change le texte du bouton
        reservedButton.classList.replace('btn-success', 'btn-light') // Remplace une classe CSS par une autre
    } else if (!room.isReserved && reservedButton) {
        reservedButton.id = `room-id-${room.id}`
        reservedButton.addEventListener('click', function() {
            reservedRoom(room)
        })
    }

    // Bouton de suppression d'une réservation
    const deletedButton = card.querySelector('.btn-danger')
    if (deletedButton) {
        deletedButton.addEventListener('click', function() {
            deletedReservation(room, card)
        })
    }

    return card
}

/**
 * Permet de supprimer une réservation
 */
function deletedReservation(room, card)
{
    fetch('api/cancel_reservation.php', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            'roomId': room.id
        })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Modifie le bouton pour le remettre à son état initial
                const button = document.querySelector(`#room-id-${room.id}`)
                button.disabled = false
                button.textContent = '+'
                button.classList.replace('btn-light', 'btn-success')

                if (button.getAttribute('listener') && button.getAttribute('listener') !== true) {
                    button.addEventListener('click', function() {
                        reservedRoom(room)
                    })

                    button.setAttribute('listener', 'true')
                }

                // Retire la carte de la colonne de droite en la supprimant du DOM
                card.remove()
            }
        })
        .catch(error => console.error(error))
}


/**
 * Permet de réserver une salle
 */
function reservedRoom(room)
{
    fetch('api/reserve_room.php', {
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            'roomId': room.id
        })
    })
        .then(response => response.json())
        .then(data => {
            // En cas de succès...
            if (data.success) {
                // ...on modifie le bouton pour ne plus à avoir à réserver la salle
                const button = document.querySelector(`#room-id-${room.id}`)
                button.disabled = true
                button.textContent = 'Déjà réservé'
                button.classList.replace('btn-success', 'btn-light')

                // Ajoute une nouvelle carte dans la colonne de droite
                const card = createRoomCard(room, false)
                document.querySelector('#rooms-reserved').appendChild(card)
            }
        })
        .catch(error => console.error(error))
}
