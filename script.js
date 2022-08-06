$(document).ready(async function(){

     const ip = await getIp();
     const elemetClone = $("#notice_loading > div:first").clone();

     console.log(ip);

     getNotices();

    $("#save_notice").click(function(){
        $("#form_notice").submit();
    })


    $("#form_notice").submit(function(e){
        e.preventDefault();
        addNotice(this);
    })


    $("#cancel_notice").click(function(){
        $("#form_notice")[0].reset();
    })


    $(document).on("click" ,".card svg" ,  function(){
        $("#confirmDeleteModal").data("id" , $(this).parent().data("id"));
    })


    $("#confirmDelete").click(deleteNotice)




    function getNotices(){


        fetch(`notices.php?action=get&ip=${ip}`).then(res=>{


            if(res.status==200){
                return res.json();
            }else{
                showToast("danger" , "התרחשה שגיאה בעת קבלת המודעות מהשרת");
            }

        }).then(response=>{

            
           
           
    
    
            elemetClone.find(".placeholder-glow").removeClass("placeholder-glow");
            elemetClone.find(".placeholder").remove("");
    
        
            $("#notice_loading > .col-xs-12 ").remove()
        
    
          
        if(response.result.length){
            response.result.map((notice)=>{
          
                elemetClone.find(".card").attr("data-id" , notice.id);
    
                elemetClone.find(".card-title:nth(0)").html(notice.name);
                elemetClone.find(".card-title:nth(1)").html(notice.email);
                elemetClone.find(".card-title:nth(2)").html(notice.date);
                elemetClone.find(".card-text").html(notice.content);
                
    
                if(notice.canRemove){
                    elemetClone.find(".card").append(`<svg xmlns="http://www.w3.org/2000/svg" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" title='מחיקה' width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                  </svg>`)
                }else{
                    elemetClone.find(".card svg").remove();
                }

                $("#notice_loading").append(elemetClone[0].outerHTML);
            })
        }else{
            $("#notice_loading").append("<h3 class='col-md-12 text-center mt-3'>לוח המודעות ריק</h3>")
        }
    
    




        })




    }



    function addNotice(formElement){

        $(formElement).addClass("was-validated");

        if(formElement.checkValidity()){

            $("#save_notice").attr("disabled" , "");
            $("#save_notice").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <span class="sr-only">אנא המתן...</span>')   
   




               const data = $(formElement).serializeArray();
               const formData  = new FormData();


                data.forEach(element => {
                        formData.append(element.name , element.value)
                });


                formData.append("ip" , ip)

    
            fetch("notices.php?action=add" , {
                method:"POST",
                body:formData
            }).then(res=>{

                if(res.status==200){
                    return res.json();
                }else{
                    showToast("danger" , "התרחשה שגיאה בעת הוספת המודעה");
                }


            }).then(response=>{

                if(response.result.insertId){

                    $("#notice_loading > h3").remove();
                    
                    const date = new Date();

                    const stringDate = `${(date.getDay() < 10) ? `0${date.getDay()}` : date.getDay()}-${((date.getMonth()+1) < 10 ) ? `0${date.getMonth()+1}`:date.getMonth()+1 }-${date.getUTCFullYear()}`


                    elemetClone.find(".card-title:nth(0)").html(formData.get("name"))
                    elemetClone.find(".card-title:nth(1)").html(formData.get("email"))
                    elemetClone.find(".card-title:nth(2)").html(stringDate)
                    elemetClone.find(".card-text").html(formData.get("content"))

                    elemetClone.find(".card").attr("data-id" , response.result.insertId)

                    if(!elemetClone.find(".card svg").length){
                        elemetClone.find(".card").append(`<svg xmlns="http://www.w3.org/2000/svg" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" title='מחיקה' width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                      </svg>`)
                    }
               


                    $("#notice_loading").prepend(elemetClone[0].outerHTML);


                    showToast("success" , "המודעה נוספה בהצלחה");

                    $("#save_notice").removeAttr("disabled");
                    $("#save_notice").html("הוספת מודעה")
        
                    $('#addModal').modal('hide');
        
        
                    $("#form_notice")[0].reset();
                    $(formElement).removeClass("was-validated");
        

                }else{
                    showToast("danger" , "התרחשה שגיאה בעת הוספת המודעה");
                }


            })  


        }

        

    }
    

    function deleteNotice(){

        const id = $("#confirmDeleteModal").data("id");


        fetch(`notices.php?action=delete&id=${id}`).then(res=>{
        
            if(res.status==200){
                return res.json();
            }else{
                showToast("danger" , "התרחחשה שגיאה בעת מחיקת המודעה");
            }

        }).then((response)=>{

           if(response.result){
                showToast("success" , "המודעה נמחקה בהצלחה");
                $(`.card[data-id=${id}]`).parent().remove();
           }else{
                showToast("danger" , "התרחחשה שגיאה בעת מחיקת המודעה");
           }



           if(!$("#notice_loading > div").length){
            $("#notice_loading").append("<h3 class='col-md-12 text-center mt-3'>לוח המודעות ריק</h3>")
           }
         
        })



    }


    function showToast(type , msg){


        $(".toast .toast-header").attr('class', 'toast-header');

        $(".toast .toast-header").addClass("bg-"+type);
        $(".toast .toast-body").html(msg);
        $(".toast").show();

        setTimeout(() => {
            $(".toast").hide();
        }, 2000);

    }


    async function  getIp(){
      
        const ip = await fetch("https://www.cloudflare.com/cdn-cgi/trace").then(res=>res.text()).then((response)=>{
        
            response = response.trim().split('\n').reduce(function(obj, pair) {
                pair = pair.split('=');
                return obj[pair[0]] = pair[1], obj;
              }, {});

            return response.ip;
       })

 

      return ip;

    }


    

})