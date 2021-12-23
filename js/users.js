function register(e){
    function func(response) {
        const message = document.querySelector(".message");
        let json_request = JSON.parse(response);
        if (json_request['code'] === 0){
            message.classList.add('success');
            message.classList.remove('error');
        }else {
            message.classList.add('error');
            message.classList.remove('success');
        }
        message.innerHTML = json_request['text'];
        // for (let key in json_request['error_message']) {
        //     json_request['error_message'][key].forEach((item)=>{
        //         console.log(item)
        //     });
        // }

    }
    ajax_post(e, "elem", func)
}