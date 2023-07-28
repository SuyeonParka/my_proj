
function chkDuplicationId() {
    const id = document.getElementById('id');

    const url = "/api/user?id=" + id.value;
    let apiData = null;
    // API 연결
    // fetch(url) //fetch로 url주고
    // .then(data => {return data.json();}) //성공하면 다음 단계 진행 
    // .then(apiData => {
    //     const idspan = document.getElementById('errMsgId');
    //     if(apiData["flg"] === "1") {
    //         idspan.innerHTML = apiData["msg"];
    //     }
    //     else {
    //         idspan.innerHTML = "";
    //     }
    // });


    fetch(url) //fetch로 url주고
    .then(data => {
        if(data.status !== 200) {
            throw new Error(data.status + ' : API Response Error');
        }
            return data.json();
        }) 
    .then(apiData => {
        const idspan = document.getElementById('errMsgId');
        if(apiData["flg"] === "1") {
            idspan.innerHTML = apiData["msg"];
        } else {
            idspan.innerHTML = "";
        }
    })

    .catch(error => alert(error.message));
}