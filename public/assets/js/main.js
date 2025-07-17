let btnSubmit = document.getElementById('btn-submit');
let formComment = document.getElementById('formComment')
// btnSubmit.disabled = true
let errorMessage = document.getElementById('errorMessage');

let mField = document.getElementById('message');
mField.addEventListener('input', (e)=>{
    let m = e.target.value;
    // btnSubmit.disabled = m.length <= 3;
})

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