function success_transaction(e){
    function func(response) {
        let json_request = JSON.parse(response);
        ansver_top(json_request);
    }
    ajax_post(e, "elem", func)
}
function closed_transaction(e){
    function func(response) {
        let json_request = JSON.parse(response);
        ansver_top(json_request);
    }
    ajax_post(e, "elem", func)
}
function ansver_top(data_result){
    console.log(data_result)
    const answer_message_html = document.querySelector('.answer_message_right')
    switch (data_result['code']) {
        case 0:
        case "0":
            answer_message_html.classList.remove('error')
            answer_message_html.classList.add('success')
            break;
        case 1:
        case "1":
            answer_message_html.classList.remove('success')
            answer_message_html.classList.add('error')
            break;
    }
    answer_message_html.classList.add('active');
    setTimeout(()=>{
        answer_message_html.classList.remove('active');
    },3000)
}