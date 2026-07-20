async function replaceWithFetch(button, targetElement) {
    const url = button.dataset.url;
    const target = targetElement || button;
    const token = getCsrfToken();

    const dataStr = button.dataset.data;
    const dataObj = dataStr ? JSON.parse(dataStr) : {};
    const formData = new FormData();
    for (const key in dataObj) {
        formData.append(key, dataObj[key]);
    }
    formData.append("csrfToken", token);

    try {
        const response = await fetch(url, {
            method: "POST",
            body: formData,
        });

        const data = await response.json();

        const temp = document.createElement("div");
        temp.innerHTML = data.html;

        target.replaceWith(temp.firstElementChild);
        setCsrfToken(data.csrfToken);
    } catch (err) { }
}