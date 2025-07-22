let btnSubmit = document.getElementById('btn-submit');
let formComment = document.getElementById('formComment')
// btnSubmit.disabled = true
let errorMessage = document.getElementById('errorMessage');

let mField = document.getElementById('message');
mField.addEventListener('input', (e)=>{
    let m = e.target.value;
    // btnSubmit.disabled = m.length <= 3;
})

// отправка формы комментария
formComment.addEventListener('submit', (e)=>{
    e.preventDefault();
    btnSubmit.textContent = "Sending..."
    btnSubmit.disabled = false;

    fetch('/actions.php', {
        method: 'post',
        body: new FormData(formComment)
    })
        .then((resp) => resp.json())
        .then((data)=> {
            if (data.status === 'success'){
                formComment.reset()
                location.reload()
            } else {
                errorMessage.insertAdjacentHTML('afterBegin', data.msg)
                errorMessage.removeAttribute('hidden')
                btnSubmit.textContent = "Send message"
                setTimeout(()=>{
                errorMessage.setAttribute('hidden', true);
                errorMessage.innerHTML = '';
                }, 2000)
            }
        })
})


// ajax проверка кода капчи
const inputCode = document.getElementById('inputCode');
const check_captcha = document.getElementById('check_captcha');

inputCode.addEventListener('input', (e)=>{
    let value = e.target.value.trim()
    let postParams = JSON.stringify({
        input: value,
        action: 'inputCode'
    })
    //     console.log('hah')
    fetch('/actions.php',{
        method:'post',
        body:postParams,
    })
        .then((response)=>response.json())
        .then((data)=>{
            if (data.status === 'success'){
                check_captcha.innerHTML = data.message
            } else {
                check_captcha.innerHTML='';
            }
        })
})

// перезагрузка кода каптчи
const reloadCaptcha = document.getElementById('btn-reload-captcha');
reloadCaptcha.addEventListener('click',e=>{
    e.preventDefault();
    let postParams = JSON.stringify({
        action: 'reloadCaptcha'
    });
    fetch('/actions.php', {
        method: 'post',
        body: postParams
    })
        .then((response)=>response.json())
        .then( (data) =>{
            check_captcha.innerHTML='';
            document.getElementById('captcha_image').innerHTML = '<img src="' + data.inlineCpt + '"  width="132" alt="captcha" >';
        })
})