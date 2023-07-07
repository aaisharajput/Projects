let item =document.getElementById("item");
let amount =document.getElementById("amount");
let rzp=document.getElementById("rzp-button1");
let count_item=0,sum=0,off=0;
let p;
cart_item((data)=>{

   let addProducts=document.getElementById("addProducts");
   if(data.err==""){
      
      addProducts.innerHTML+=`<div class="col-12 col-md-12 d-flex justify-content-center p-5 mt-5">
               <h4 class="p-5 mt-5 mb-5">Empty Cart!!</h4>      
            </div>`;
            rzp.disabled=true;
   }else if(data.err){
      
      addProducts.innerHTML+=`<div class="col-12 col-md-12 d-flex justify-content-center p-5 mt-5">
               <h4 class="p-5 mt-5 mb-5">${data.err}</h4>      
            </div>`;
      rzp.disabled=true;
   }else{
      p=data;
   
      for(let i=0;i<data.length;i++){
      if(data[i].id==null){
         addProducts.innerHTML+=`<div class="col-12 col-md-3 pt-5">
         <div class="card">
            <div class="img">
               <img src="no-products.jpg" alt="no-products.jpg">
               <div class="card-text pl-2 pt-4">
                  <h5>Product Deleted!!</h5>
                  <p>Product is not Available</p>
                  <p>Or deleted from database</p>
                  <p>You may delete this product.</p>
               </div>
               <div class="btnn d-flex justify-content-around">
                  <button type="submit" class="btn btn-danger" onclick="delete_item(${data[i].prev_id})">Delete</button>
               </div>
               
            </div>
         </div>
      </div>`;
      }else{
         count_item++;
         sum+=data[i].price*data[i].quantity;
         if(data[i].stock < data[i].quantity) off+= data[i].quantity-data[i].stock;
         addProducts.innerHTML+=`<div class="col-12 col-md-3 pt-5" id="col${data[i].id}">
         <div class="card">
            <div class="img">
               <img src="/${data[i].img}" alt="${data[i].img}">
               <div class="card-text pl-2 pt-3">
                  <h5>${data[i].p_name}</h5>
                  <p>Price: ₹${data[i].price}</p>
                  <p>Available: ${data[i].stock}</p>
                  <p>Quantity: <span id="quan${i}">${(data[i].stock < data[i].quantity)?"<strike>"+data[i].quantity+"</strike>":data[i].quantity} </span><button onclick="minus(${i},${data[i].id})" class="btn btn-primary ml-5">-</button><button onclick="plus(${i},${data[i].id})" class="btn btn-primary ml-5">+</button></p>
                  <span style='color:red' id='sp${i}'>${(data[i].stock < data[i].quantity)?"Out of stock":""}</span>
                  </div>
               <div class="btnn d-flex justify-content-around">
                  <button type="submit" class="btn btn-danger" onclick="delete_item(${data[i].id},${data[i].price*data[i].quantity})">Delete</button>
                  <button class="btn btn-success" onclick="show_itm(${i})">View</button>
               </div>
            </div>
         </div>
      </div>`;
      }
      
   }
   }
   
   item.innerText=count_item;
   if(off>=1){
      amount.innerHTML=`<strike>${sum}</strike>`;
      rzp.disabled=true;
   }
   else{
      amount.innerText=sum;
      rzp.disabled=false;
   } 
   
});

   function minus(i,id){
      let quan=document.getElementById("quan"+i);
      let sp=document.getElementById("sp"+i);
      let val=parseInt(quan.innerText);
         if(val<=1){
            if(val>p[i].stock){
               quan.innerHTML=0;
               add_del_product(id,0);
            }
            else if(val==0)
               quan.innerHTML=0;
            else{
               quan.innerText=1;
            }
         }
         else{
            if(val-1>p[i].stock){
               quan.innerHTML=`<strike>${val-1}</strike>`;
               rzp.disabled=true;
               sum-=p[i].price;
               --off;
               amount.innerHTML=`<strike>${sum}</strike>${off}`;
               if(val-2==p[i].stock)
                  off--;
            }
            else{
               quan.innerText=val-1;
               sp.innerText='';
               sum-=p[i].price;
               // --off;
               if(off>=1){
                  amount.innerHTML=`<strike>${sum}</strike>`;
                  rzp.disabled=true;
               }               
               else{
                  amount.innerText=sum;
                  rzp.disabled=false;
               }
               
            }
            add_del_product(id,0);
         }
   }

   function plus(i,id){
      let quan=document.getElementById("quan"+i);
      let val=parseInt(quan.innerText);
         if(quan.innerText==p[i].stock){
            quan.innerText=p[i].stock;
            if(p[i].stock!=0)
            Swal.fire({
            title: 'Reached Limit',
            text: "Stock limit is reached!!",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
         })
         }
         else{
            if(val>p[i].stock){
               amount.innerHTML=`<strike>${sum}</strike>`;
               quan.innerHTML=`<strike>${val}</strike>`;
               rzp.disabled=true;
            }
            else{
               quan.innerText=val+1;
               sum+=p[i].price;
               amount.innerText=sum;
               rzp.disabled=false;
               add_del_product(id,1);
            }
               
         }
            
   }
    
    function add_del_product(i,operation){
            let request = new XMLHttpRequest();
                request.open("POST","/user/plus_minus_product");
                request.setRequestHeader("Content-Type","application/json");
                request.send(JSON.stringify({id:i,op:operation}));
    
                request.addEventListener("load", function(){
                  let result=JSON.parse(request.responseText);
                  if(result.redirect){
                    window.location.href=result.redirect;
                  }else{
                     console.log(result);
                  }
                });
    }
   function show_itm(id){
      let span=`<div class="row">
      <div class="col-12 col-md-4">
          <img id="p_img" src="/${p[id].img}" style="height: 90%;width: 115%;">
      </div>
      <div class="col-12 col-md-8">
        <div class="row">
          <div class="col-4 col-md-4 d-flex justify-content-end"><p>saller_name :</p></div> <div class="col-8 col-md-8 d-flex justify-content-start"><p>${p[id].saller_name}</p></div>
          <div class="col-4 col-md-4 d-flex justify-content-end"><p>shipping_charges :</p></div> <div class="col-8 col-md-8 d-flex justify-content-start"><p>Rs. ${p[id].shipping_charges}</p></div>
          <div class="col-4 col-md-4 d-flex justify-content-end"><p>Product Details :</p></div> <div class="col-8 col-md-8 d-flex justify-content-start"><textarea rows="10" class="form-control" style="background:#fff;border:none" disabled>${p[id].p_details}</textarea></div>
          
        </div>
      </div>
      
    </div> `;
  
  Swal.fire({
      title:p[id].p_name+" "+ p[id].color+" Rs."+ p[id].price,
      width:1000,
      html:span,
      confirmButtonText: 'Cancel'
  })

   }

   function cart_item(callback){
      let request = new XMLHttpRequest();
          request.open("POST","/user/cart");
          request.send();

          request.addEventListener("load", function(){
            callback(JSON.parse(request.responseText))
          });
   }

   function delete_item(id,remove_amount){
         Swal.fire({
            title: 'Are you sure?',
            text: "You want to delete it!!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
         }).then((result) => {
            if (result.isConfirmed) {
               dlt(id,()=>{
                  let col_id=document.getElementById('col'+id);
                      col_id.remove();
                      count_item--;
                      item.innerText=count_item;
                      sum-=remove_amount;
                      amount.innerHTML=sum;

                      if(count_item==0){
                        addProducts.innerHTML+=`<div class="col-12 col-md-12 d-flex justify-content-center p-5 mt-5">
                        <h4 class="p-5 mt-5 mb-5">Empty Cart!!</h4>      
                        </div>`;
                        rzp.disabled=true;
                        sum=0;
                        amount.innerHTML=0;
                      }
               });
            }
            })
   }

   function dlt(id,callback){
      let request = new XMLHttpRequest();
          request.open("POST","/user/delete");
          request.setRequestHeader("Content-Type","application/json");
          request.send(JSON.stringify({id:id}));

          request.addEventListener("load", function(){
            let result=JSON.parse(request.responseText);
                  if(result.dmsg){
                     Swal.fire(
                        'Deleted!',
                        'Item has been deleted successfully.',
                        'success',
                     )
                     callback();
                     // setTimeout(()=>{
                     //    window.location.href=result.redirect;
                     // },2000);
                     
                  }else{
                     Swal.fire({
                        title: 'Error',
                        text: "Error Occured!!",
                        icon: 'warning',
                     })
                  }
          });
   }