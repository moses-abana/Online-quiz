
let question_no = 1;
let question_id=1;
let timing;

const question = document.getElementById("question");
const opA = document.getElementById("opA");
const opB = document.getElementById("opB");
const opC = document.getElementById("opC");
const opD = document.getElementById("opD");
const timer = document.getElementById("timer");
let time_left =0;



document.getElementById("prev").classList.add("disabled");
get_question(question_no);


function get_question(question_no){
    let request = new XMLHttpRequest();
    request.open("GET","test2.php?q="+question_no, true);
    request.onload = ()=>{
        const exam = JSON.parse(request.responseText);
        if(exam){
            update_question(exam);
            
        }
    };

    request.send();
}


function count_down(){
    if(time_left >= 1){
        time_left -= 1;
        timer.innerHTML = time_left +"s";
    }else{
        let ans = document.querySelectorAll(".form-check-input");
        ans.forEach((btn)=>{
            btn.disabled = true;
        });
        clearInterval(timing)
        submit_answer();
    }
}



function update_question(exam){

    let ans = document.querySelectorAll(".form-check-input");
    ans.forEach((btn)=>{
        if(btn.checked){
            myans = btn.value;
        }
        btn.checked=false;
    });
    question_id = exam.id;
    question.innerHTML = question_no +". "+exam.question;
    opA.innerHTML = "A. " + exam.A;
    opB.innerHTML = "B. " + exam.B;
    opC.innerHTML = "C. " + exam.C;
    opD.innerHTML = "D. " + exam.D;
    timer.innerHTML = exam.sec + "s";
    time_left = exam.sec;
    document.querySelector(".progress").innerHTML = ""+question_no+"/"+max_number;
	
    if(question_no >= max_number){
        document.getElementById("next").classList.add("disabled");
    }

    if(time_left <= 0){
            ans.forEach((btn)=>{
                btn.disabled = true;
                if(btn.id == exam.ans){
                    btn.checked = true;
                }
            });
        return;
    }
    ans.forEach((btn)=>{
        btn.disabled = false;
        if(btn.id == exam.ans){
            btn.checked = true;
        }
    });

    
	
   timing = setInterval(count_down,1000);
}

function load_question(n){
    if((question_no +n) > max_number){
        document.getElementById("next").classList.add("disabled");
	return;
    }	

    question_no += n;
    if(question_no >= 2){
        document.getElementById("prev").classList.remove("disabled");
    }else{
        document.getElementById("prev").classList.add("disabled");
    }
	
    document.getElementById("next").classList.remove("disabled");
    submit_answer();
    get_question(question_no);
}




function submitOnClick(){
    let request = new XMLHttpRequest();
    let myans;
    let radio_btn = document.querySelectorAll(".form-check-input");
    radio_btn.forEach((btn)=>{
        if(btn.checked){
            myans = btn.value;
        }
       
    });
    request.open("POST","submit_answer.php",true);
    request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");


    if(myans == undefined){
        request.send("ans=Z"+"&time_left="+time_left+"&q_id="+question_id);
        return;
    }

    request.send("ans="+myans+"&time_left="+time_left+"&q_id="+question_id);
}

function submit_answer(){
    clearInterval(timing);
    submitOnClick()
}