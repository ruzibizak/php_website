function toggleContent() {
    var contentDiv = document.getElementById('toggleDiv');
    if (contentDiv.classList.contains('hidden')) {
        contentDiv.classList.remove('hidden');
    } else {
        contentDiv.classList.add('hidden');
    }
}
