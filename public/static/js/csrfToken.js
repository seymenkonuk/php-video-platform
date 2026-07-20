function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
}

function setCsrfToken(token) {
    document.querySelector('meta[name="csrf-token"]').setAttribute('content', token);
}
