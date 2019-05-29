function showClass(n) {
    var i;
    var classT = document.getElementsByClassName("content");
    var men = document.getElementsByClassName("classA");
    if (n > classT.length)
    {
        classIndex = 1;
    }
    if (n < 1)
    {
        classIndex = classT.length;
    }
    for (i = 0; i < men.length; i++)
    {
      men[i].className = men[i].className.replace("active","");

    }
    for(i = 0; i < classT.length; i++)
    {
        classT[i].style.display = "none";
    }
    classT[classIndex-1].style.display = "block";
    men[classIndex-1].className += " active";
  }
  function currentClass(n)
  {
    showClass(classIndex=n);
  }
