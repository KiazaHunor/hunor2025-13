document.body.onload=init();

function init()
{
    console.log("ad");
    document.getElementById("todoList").innerHTML +=todoSor();
    document.getElementById("todoList").innerHTML +=todoSor();
    todoBetolt();
}

function todoBetolt()
{
    fetch("todo")
    .then(x => x.json())
    .then(y => 
        {
            if(document.getElementById("mindentTorloGomb"))
            {
                document.getElementById("mindentTorloGomb").remove();   
            }
        
        console.log(y);
        document.getElementById("todoList").innerHTML="";
        y.forEach(todo => 
        {
            //console.log(todo)
            document.getElementById("todoList").innerHTML += todoSor(todo.szoveg,todo.id,todo.vege!=="0000-00-00 00:00:00");
        });
    });

    if(y.every(adat => adat.vege!=="0000-00-00 00:00:00"))
    {
    
        let mindentTorloGomb=document.createElement("button");
        mindentTorloGomb.innerText="Mindent töröl";
        mindentTorloGomb.class="btn btn-danger";
        mindentTorloGomb.onclick="mindenTorloGomb()";
        mindentTorloGomb.id="mindentTorloGomb"
        document.querySelector(".btn btn-secondary").after(mindentTorloGomb)
    }
    else
    {
                 
    }
}

function todoSor(szoveg,id,vegeVan)
{
    //console.log(szoveg)
   return `<li class="list-group-item ${vegeVan?"disabled":""}" data-id=""">${szoveg}awd <button type="button" class="btn data-id=torles(${id}) btn-secondary">Törlés</button> <button type="button" onclick=pipa(${id}) class="btn btn-secondary">Pipa</button></li>`;
}

/* gombra click
szöveg megszerzése
apinak elküldése post json formában
api feldolgozza (php)
adatbazisba ment
sikerességet visszakuldi
forntend megkapja
*/


function hozzaAd(id=-1)
{
    if(id=-1)
        {
//-1: új
    //másik id: módosít
    //console.log("hozzaad");

    console.log("-----");
    let szoveg=document.getElementById("inputPassword").value;
    //console.log(szoveg);

    let json=
    {
        memberId: "adawdaw",
        feladat:szoveg
    };


    //TODO ha van id, akkor PUT, különben POST
    fetch("todo/",
        {
            method: "POST",
            body : JSON.stringify(json)
        })
    .then(x => x.json())
    .then(y => 
        {
            if(y.status=="success")
                {
                    document.getElementById("inputPassword").value="";
                    todoBetolt();
                }
                else
                {
                    console.log(y);
                    document.getElementById("errorMessage").innerHTML=y.errorMessage;
                    document.getElementById("errorMessage").parentElement.classList.remove("d-none");
                    setTimeout(() => 
                    {
                        document.getElementById("errorMessage").innerHTML="";
                        document.getElementById("errorMessage").parentElement.classList.add("d-none");
                    }, 3000);
                }
        })
        .catch(err =>
            {
                console.error("Fetch hiba",err)
            });
        }
    else
        {
            //módosítás
            fetch("todo/"+id+"/edit ",
            {
            method: "POST",
            body : JSON.stringify(json)
            })
            .then(x => x.json())
            .then(y => 
            {
                if(y.status=="success")
                    {
                        document.getElementById("inputPassword").value="";
                        todoBetolt();
                    }
                    else
                    {
                        console.log(y);
                        document.getElementById("errorMessage").innerHTML=y.errorMessage;
                        document.getElementById("errorMessage").parentElement.classList.remove("d-none");
                        setTimeout(() => 
                        {
                            document.getElementById("errorMessage").innerHTML="";
                            document.getElementById("errorMessage").parentElement.classList.add("d-none");
                        }, 3000);
                    }
            })
            .catch(err =>
                {
                    console.error("Fetch hiba",err)
                });

        }
    
}

function torol(elem)
{
    console.log("törlés",elem,elem.dataset.id);
}

function pipa(id)
{
    //console.log("hozzaad");
    //let szoveg=document.getElementById("inputPassword").value;
    //console.log(szoveg);

    let json=
    {
        memberId: "adawdaw",
        //feladat:szoveg
    };

    fetch("todo/"+id+"/pipa",
        {
            method: "PUT",
            body : JSON.stringify(json)
        })
    .then(x => x.json())
    .then(y => 
        {
            if(y.status=="success")
                {
                    //document.getElementById("inputPassword").value="";
                    todoBetolt();
                }
                else
                {
                    console.log(y);
                    document.getElementById("errorMessage").innerHTML=y.errorMessage;
                    document.getElementById("errorMessage").parentElement.classList.remove("d-none");
                    setTimeout(() => 
                    {
                        document.getElementById("errorMessage").innerHTML="";
                        document.getElementById("errorMessage").parentElement.classList.add("d-none");
                    }, 3000);
                }
        })
        .catch(err =>
            {
                console.error("Fetch hiba",err)
            }); 
}

function szerkesztes(id)
{
    console.log("szerkesztés",id);

    let json=
    {
        memberId:"adawdaw",
    };

    fetch("todo/"+id+"?memberId="+json.memberId,
    {
        method: "GET",
    })
    .then(x => x.json())
    .then(y => 
        {
            if(y.status=="success")
                {
                    //document.getElementById("inputPassword").value="";
                    console.log(y);
                    document.querySelector("#szoveg").value=y.data[0].szoveg;
                    //document.querySelector(".bi-plus-circle").onclick="hozzaAd("+y.data[0].id+")";
                    //document.querySelector(".bi-plus-circle").addEventListener("click",hozzaAd,y.data[0].id)
                    document.querySelector(".bi-plus-circle").setAttribute("onclick","hozzaAd("+y.data[0].id+")");

                }
                else
                {
                    console.log(y);
                    document.getElementById("errorMessage").innerHTML=y.errorMessage;
                    document.getElementById("errorMessage").parentElement.classList.remove("d-none");
                    setTimeout(() => 
                    {
                        document.getElementById("errorMessage").innerHTML="";
                        document.getElementById("errorMessage").parentElement.classList.add("d-none");
                    }, 3000);
                }
        })
    
}

function mindenTorol()
{
    let json=
    {
        memberId:"adawdaw",
    };

    fetch("todo/all",
    {
        method: "DELET",
        body: JSON.stringify(json)
    })
    .then(x => x.json())
    .then(y => 
        {
            if(y.status=="success")
               {
                
               }
        })
}