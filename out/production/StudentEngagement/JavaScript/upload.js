const actualBtn = document.getElementById('actual-btn');

const fileChosen = document.getElementById('fileToUpload');

actualBtn.addEventListener('change', function(){
    fileChosen.textContent = this.files[0].name
})