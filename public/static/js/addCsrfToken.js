function addCsrfToken(form) {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    let csrfInput = document.createElement('input');
    csrfInput.type = 'hidden';
    csrfInput.name = 'csrfToken';
    csrfInput.value = token;
    form.appendChild(csrfInput);
    return true;
}