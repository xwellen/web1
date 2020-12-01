function validate(){
    var changeX = document.getElementById("changex");
    var valX = changeX.value.replace(",",".");

    if (isNaN(valX) || valX < -3 || valX > 5 || !valX){
        changeX.style.boxShadow = "0 0 10px rgba(255, 0, 0, 0.8)"
        document.getElementById("invalidx").innerHTML = "Введите число -3..5";
        return false;
    }

    return true;
}