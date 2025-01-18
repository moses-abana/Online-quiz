setup_exam();
let max_number;
function setup_exam(){
   let request = new XMLHttpRequest();
    request.open("GET","exam_setup.php", true);
    request.onload = ()=>{
	const res = JSON.parse(request.responseText);
	max_number = res.max_no;
    };

    request.send();
}

