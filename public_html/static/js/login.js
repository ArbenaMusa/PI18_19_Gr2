const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

function clearErrors() {
  var nodes = document.querySelectorAll('div.error');
  var len = nodes.length;
  for (var i = 0; i < len; i++) {
    var node = nodes[i];
    while (node.firstChild) {
      node.removeChild(node.firstChild);
    }
  }
}

signUpButton.addEventListener('click', () => {
  clearErrors();
  container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
  clearErrors();
  container.classList.remove("right-panel-active");
});
