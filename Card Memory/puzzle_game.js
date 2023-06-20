let r1=document.getElementById("r1");
let r2=document.getElementById("r2");
let tb4=document.getElementById("tb4");
let tb6=document.getElementById("tb6");
let timer=document.getElementById("timer");
let start=document.getElementById("start");
let time_out=document.getElementById("time_out");
let normal=document.getElementById("normal");
let hard=document.getElementById("hard");
let res=document.getElementById("res");
let show=document.getElementById("show");
let output=document.getElementById("output");
let td=document.querySelectorAll("td");
let id,count=0,value1,value2,btn_id2;
let ss,mm,matched=0,win=0,loss=0,level,chk_loss=true,win_time;
let obj=[];
const nums = new Set();
const nums1 = new Set();

start.disabled=true;

function generate_nos(n,srt,end,x){
    nums.clear();
    nums1.clear();
    while (nums.size != n) {
        nums.add(Math.floor(Math.random() * n) + 1);
      }
      while (nums1.size !== n) {
        nums1.add(Math.floor(Math.random() * n) + 1);
      }
      
      const rendom_nos=[...nums,...nums1];
      console.log(rendom_nos);
      
      for(let i=0;i<end;i++){
          td[(i+srt)].innerHTML=`<input type="button" class="btn flip" onclick="chk_match(${x}${i})" id="${x}${i}" style="background-color: gray;
          color:gray;" value="${rendom_nos[i]}"></input>`;
      }
}

function chk_match(btn_id){
    let b1=document.getElementById(btn_id);
        b1.style.color="#fff";
        if(count==0){
            value1=b1;
        }
        else
            value2=b1;
            
        count++;

        
    if(count==2){
     if(value1!=value2){
        if(value1.value==value2.value){
            value1.style.color="#fff";
            value1.disabled=true;
            value2.style.color="#fff";
            value2.disabled=true;
            
            matched++;

            if(matched==level){
                win++;
                chk_loss=false;
                clearInterval(id);
                    ++ss;
                if(mm<10)mm='0'+mm;
                if(ss<10)ss='0'+ss;
                win_time=mm+":"+(ss);
                obj.push({win:win,loss:loss,time:win_time});
                show.classList.remove("d-none");
                res.classList.remove("d-none");
                matched=0;
                alert("Congratulations. You complete the game before: "+win_time);
            }

        }else{
            setTimeout(function(){
                value1.style.color="gray";
                value2.style.color="gray";
                value1.disabled=false;
                value2.disabled=false;
              },300)
            
        }
        count=0;

    }else{
        value1.style.color="gray";
        value1.disabled=false;
        count=0;
}
}

}


normal.addEventListener("click",function(){

    mm=1,ss=0;
    level=8;
    timer.innerText="01:00";
    r2.style.visibility="collapse";
    r1.style.visibility="visible";
    start.disabled=false;

    generate_nos(8,0,16,"4");

    let btn=document.querySelectorAll(".flip");

    btn.forEach(function(f) {
    f.disabled=true;
});
    
});

hard.addEventListener("click",function(){
    mm=5,ss=0;
    level=18;
    timer.innerText="05:00";
    r1.style.visibility="collapse";
    r2.style.visibility="visible";
    start.disabled=false;
    generate_nos(18,16,36,"6");

    let btn=document.querySelectorAll(".flip");

    btn.forEach(function(f) {
        f.disabled=true;
    });
    
});

start.addEventListener("click",function(){
    
        start.value="Play";
        start.disabled=true;
        normal.disabled=true;
        hard.disabled=true;

        let btn=document.querySelectorAll(".flip");

        btn.forEach(function(f) {
            f.disabled=false;
         });
        
         id=setInterval(function(){
            
            if(ss<0){--mm,ss=59;}
            if(mm==0&&ss==0){
                time_out.style.color="red";
                time_out.innerText="Time Out!!";
                if(chk_loss)
                    loss++;
                    obj.push({win:win,loss:loss,time:"00:00"});

                show.classList.remove("d-none");
                res.classList.remove("d-none");

                let btn=document.querySelectorAll(".flip");

                    btn.forEach(function(f) {
                        f.disabled=true;
                    });

                
                clearInterval(id);
            }
            ss=parseInt(ss);
            mm=parseInt(mm);

            if(mm<10)mm='0'+mm;
            if(ss<10)ss='0'+ss;
            timer.innerText=mm+":"+ss;
            ss--;
        },1000);


});


res.addEventListener("click",function(){
    show.classList.add("d-none");
    res.classList.add("d-none");

    r2.style.visibility="hidden";
    r1.style.visibility="hidden";
    normal.disabled=false;
    hard.disabled=false;
    time_out.innerText="Timer:";
    time_out.style.color="black";
    output.innerText="";
    matched=0;
})

show.addEventListener("click",function(){
    let btn=document.querySelectorAll(".flip");

        btn.forEach(function(f) {
            f.style.color="#fff";
        });

        
        for(let i=0;i<obj.length;i++){
            output.innerHTML+=`<li>Wins: ${obj[i].win} ->Loss: ${obj[i].loss}  ->Time: ${obj[i].time}</li>`;
        }

    
})