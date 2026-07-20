function addCsrfToken(form) {
    const token = getCsrfToken();
    let csrfInput = document.createElement('input');
    csrfInput.type = 'hidden';
    csrfInput.name = 'csrfToken';
    csrfInput.value = token;
    form.appendChild(csrfInput);
    return true;
}