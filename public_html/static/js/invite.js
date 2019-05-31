function toJson(response) {
  return response
    .json()
    .then(function (response) {
      if (response.error) {
        throw response.error
      } else {
        return response
      }
    })
}

function handleError(error) {
  alert('Error getting link.')
}

function shareClass(id) {
  fetch('/api/invite.php?id=' + id, {
    method: 'POST',
    credentials: 'same-origin'
  })
    .then(toJson)
    .then(function (response) {
      var inviteLink = document.getElementById('inviteLink');
      inviteLink.value = response.link;
    })
    .catch(function (error) {
      handleError(error)
    })
}
