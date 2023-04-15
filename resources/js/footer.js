const $footer = document.getElementById('footer');
const $screenHeight = document.documentElement.clientHeight;
const $bodyHeight = document.body.scrollHeight;
if ($bodyHeight < $screenHeight) {
    $footer.classList.toggle('fixed-bottom')
}
