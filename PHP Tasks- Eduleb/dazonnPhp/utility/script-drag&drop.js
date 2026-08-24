const inputLabel = document.getElementById("inputLabel");
const fileInput = document.getElementById("userImg");
const imgName = document.getElementById("imgName");

//manually select an image it name will show
fileInput.addEventListener("change", ()=>{
    if(fileInput.files.length){
        imgName.textContent = fileInput.files[0].name;
        console.log(imgName);
    }
});

// drag & drop 
inputLabel.addEventListener("dragover", (e) =>{
    e.preventDefault(); //preventDefault() stops the browser from opening the image.
});
inputLabel.addEventListener("drop",(e) =>{
    e.preventDefault();
    const files = e.dataTransfer.files;
    if(files.length){
        fileInput.files = files;   //assign value to input:files to store it on db
        imgName.textContent = files[0].name;
    }
});