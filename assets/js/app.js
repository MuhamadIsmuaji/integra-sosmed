// for check file    
function checkFile(oInput,event) {
    if(oInput.files[0].size > 50000000){ // 50 MB
        alert('Maaf, file terlalu besar!')
        oInput.value = "";
        return false;
    } else {
        var _validFileExtensions = [".docx", ".pdf", ".xlsx", ".pptx", ".jpg", ".jpeg" , ".png", ".mp4"];
        if (oInput.type == "file") {
            var sFileName = oInput.value;
            if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                        if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }                   
                if (!blnValid) {
                    alert("Maaf, hanya mendukung tipe: " + _validFileExtensions.join(", "));
                    oInput.value = "";
                    return false;
                } else {
                    $('#btnSubmitInputFile').focus();
                }
            }
        }

        return true;
    }
}