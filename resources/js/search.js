const $searchBox = document.getElementById('search-box')
const $searchBtn = document.getElementById('search-btn')
    $searchBtn.onclick = function () {
    $searchBox.classList.toggle('header-bottom-closed')
}
