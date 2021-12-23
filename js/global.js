const ajax_post = (modal_forms, type_status, func = () => {
}) => {
    localStorage.removeItem(type_status)
    const ajaxSend = async (formData) => {
        const fetchResp = await fetch(modal_forms.action, {
            method: 'POST',
            body: formData
        });
        if (!fetchResp.ok) {
            throw new Error(`Ошибка по адресу ${modal_forms.action}, статус ошибки ${fetchResp.status}`);
        }
        return await fetchResp.text();
    };
    const formData = new FormData(modal_forms);

    ajaxSend(formData)
        .then((response) => {
            func(response);
        })
        .catch((err) => console.error(err));
}