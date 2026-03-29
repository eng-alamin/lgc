const numbers=[
[1,1,1,1,1,1,0,0,0,1,1,1,1,1,1],
[1,0,0,0,1,1,1,1,1,1,0,0,0,0,1],
[1,0,1,1,1,1,0,1,0,1,1,1,1,0,1],
[1,0,1,0,1,1,0,1,0,1,1,1,1,1,1],
[1,1,1,0,0,0,0,1,0,0,1,1,1,1,1],
[1,1,1,0,1,1,0,1,0,1,1,0,1,1,1],
[1,1,1,1,1,1,0,1,0,1,1,0,1,1,1],
[1,0,0,0,0,1,0,1,1,1,1,1,0,0,0],
[1,1,1,1,1,1,0,1,0,1,1,1,1,1,1],
[1,1,1,0,1,1,0,1,0,1,1,1,1,1,1]
];

const digits=[...document.querySelectorAll(".block")];
const blocks=[];

for(let i=0;i<4;i++){
blocks.push(digits.slice(i*15,i*15+15));
}

function setNum(block,num){
let n=numbers[num];
for(let i=0;i<block.length;i++){
block[i].classList[n[i]===1?"add":"remove"]("active");
}
}

const time={s:"",m:"",h:"",p:null};

function animator(){
let d=new Date();
let h=d.getHours().toString().padStart(2,"0");
let m=d.getMinutes().toString().padStart(2,"0");
let s=d.getSeconds().toString().padStart(2,"0");

if(s!==time.s){
for(let i=0;i<digits.length;i++){
if(i===+s){
digits[i].classList.add("second");
if(time.p!==null)digits[time.p].classList.remove("second");
time.p=i;
time.s=s;
}
}
}

if(m!==time.m){
setNum(blocks[2],m[0]);
setNum(blocks[3],m[1]);
time.m=m;
}

if(h!==time.h){
setNum(blocks[0],h[0]);
setNum(blocks[1],h[1]);
time.h=h;
}

requestAnimationFrame(animator);
}

requestAnimationFrame(animator);

const body=document.querySelector("body");
function changeTheme(){
body.classList.toggle("light-theme");
}