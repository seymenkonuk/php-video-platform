function sanitizeForm(form) {
    for (let element of form.elements) {
        // Form Elementi Boşsa
        const isEmpty = (element.type === "file") ?
            element.files.length === 0 :
            !element.value.trim();

        // Zorunlu Değil ve Boşsa Onu Backende Hiç Gönderme
        if (!element.required && isEmpty) {
            element.removeAttribute("name");
        }
    }
    return true;
}