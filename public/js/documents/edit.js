const deleteImageBtn = document.querySelectorAll(".delete-image-btn");
const deleteFilesList = document.querySelector("#delete-files-list");

//list of files ids to be deleted from the backend
let deleteFiles = [];

deleteImageBtn.forEach((element) => {
    element.addEventListener("click", ()=> deleteImage(element))  });


function deleteImage(element) { 
        element.parentElement.remove();
        deleteFiles.push ( element.parentElement.querySelector("input[type='hidden']").value ) ; 

        deleteFilesList.value = JSON.stringify(deleteFiles); 
        console.log(deleteFilesList.value);
}
