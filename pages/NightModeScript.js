 function changeNightMode()
    {
        var myElement = document.getElementsByClassName("center");

        for (let i=0 ; i<myElement.length ; i++)
        {
        
            if (myElement[i].style.backgroundColor == "white") 
            {
                myElement[i].style.backgroundColor = "black";
                myElement[i].style.color = "white";
            } 
            else 
            {
                myElement[i].style.backgroundColor = "white";
                myElement[i].style.color = "black";
            }
        }
   
    }
