let mic = document.getElementById("mic");
let chatareamain = document.querySelector('.chatarea-main');
let chatareaouter = document.querySelector('.chatarea-outer');

let intro = ["I am a student-friendly chatbot. My name is Smart Bot"];
let help = ["How can i assist you?"];
let greetings = ["I am really good. How are you?"];
let fine = ["Happy to hear that"];
let something = ["i love to talk with humans", "i like to make friends like you", "i like cooking"];
let jobs = ["You can find part-time jobs and internships in this website."];
let providejob = ["You can find part-time jobs and internships in this website."];
let kindsofjobs = ["You can find part-time jobs and internships in this website."];
let apply = ["Select job and click Apply Now button and upload your resume to apply for a job."];
let savejob = ["Select job and click on the Save button to save a job."];
let resume = ["Fill up all the details in the form and click download button to get your resume in pdf format."];
let query = ["You should login and select a job and click Message button to directly query about the job with employer"];
let jobapproval = ["Your resume will be evaluated and reply will be sent to you after some days via Gmail"];
let jobapproved = ["Your resume will be evaluated and reply will be sent to you after some days via Gmail"];
let jobapprovedd = ["Your resume will be evaluated and reply will be sent to you after some days via Gmail"];
let thanks = ["Most welcome","Not an issue","Its my pleasure","Mention not"];
let activated = ["If you are a student you can click on the link sent to Gmail to activate. If you are employer you should wait until you are activated by the Admin."];
let bye = ['Ok bye-bye','As you wish, bye take-care','Bye-bye, see you soon..'];
let facilities = ["Using this website user can view job, search job, save a job, create resume, download resume, add success story and apply for a job."];
let search = ["Enter a job name, location or parttime/internship and click 'Search' button to search a job according to your need."];
const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
const recognition = new SpeechRecognition();

function showusermsg(usermsg){
    let output = '';
    output += `<div class="chatarea-inner user">${usermsg}</div>`;
    chatareaouter.innerHTML += output;
    return chatareaouter;
}

function showchatbotmsg(chatbotmsg){
    let output = '';
    output += `<div class="chatarea-inner chatbot">${chatbotmsg}</div>`;
    chatareaouter.innerHTML += output;
    return chatareaouter;
}

function chatbotvoice(message){
    const speech = new SpeechSynthesisUtterance();
    speech.text = "Sorry! I couldn't understand you. Please repeat again.";
    if(message.includes('who')){
        let finalresult = intro[Math.floor(Math.random() * intro.length)];
        speech.text = finalresult;
    }
    if(message.includes('help')){
        let finalresult = help[Math.floor(Math.random() * help.length)];
        speech.text = finalresult;
    }
    if(message.includes('search')){
        let finalresult = search[Math.floor(Math.random() * search.length)];
        speech.text = finalresult;
    }
    if(message.includes('apply for')){
        let finalresult = apply[Math.floor(Math.random() * apply.length)];
        speech.text = finalresult;
    }
    if(message.includes('save a job')){
        let finalresult = savejob[Math.floor(Math.random() * savejob.length)];
        speech.text = finalresult;
    }
    if(message.includes('how are you' || 'how are you doing today')){
        let finalresult = greetings[Math.floor(Math.random() * greetings.length)];
        speech.text = finalresult;
    }
    if(message.includes('facilities')){
        let finalresult = facilities[Math.floor(Math.random() * facilities.length)];
        speech.text = finalresult;
    }
    if(message.includes('fine' || 'i am good')){
        let finalresult = fine[Math.floor(Math.random() * fine.length)];
        speech.text = finalresult;
    }
    if(message.includes('query' || 'query about job ')){
        let finalresult = query[Math.floor(Math.random() * query.length)];
        speech.text = finalresult;
    }
    if(message.includes('job is selected')){
        let finalresult = jobapproval[Math.floor(Math.random() * jobapproval.length)];
        speech.text = finalresult;
    }
    if(message.includes('job result')){
        let finalresult = jobapproved[Math.floor(Math.random() * jobapproved.length)];
        speech.text = finalresult;
    }
    if(message.includes('applied job is approved')){
        let finalresult = jobapprovedd[Math.floor(Math.random() * jobapprovedd.length)];
        speech.text = finalresult;
    }
    if(message.includes('activate account')){
        let finalresult = activated[Math.floor(Math.random() * activated.length)];
        speech.text = finalresult;
    }
    if(message.includes('hobbies' || 'something about you')){
        let finalresult = something[Math.floor(Math.random() * something.length)];
        speech.text = finalresult;
    }
    if(message.includes('types of job')){
        let finalresult = jobs[Math.floor(Math.random() * jobs.length)];
        speech.text = finalresult;
    }
    if(message.includes('create a resume')){
        let finalresult = resume[Math.floor(Math.random() * resume.length)];
        speech.text = finalresult;
    }
    if(message.includes('kinds of job')){
        let finalresult = kindsofjobs[Math.floor(Math.random() * kindsofjobs.length)];
        speech.text = finalresult;
    }
    if(message.includes('jobs you provide')){
        let finalresult = providejob[Math.floor(Math.random() * providejob.length)];
        speech.text = finalresult;
    }
    if(message.includes('thank you' || 'thank you so much' || 'thanks')){
        let finalresult = thanks[Math.floor(Math.random() * thanks.length)];
        speech.text = finalresult;
    }
    if(message.includes('talk to you' || 'talk')){
        let finalresult = bye[Math.floor(Math.random() * bye.length)];
        speech.text = finalresult;
    }
    if(message.includes('bye')){
        let finalresult = byebye[Math.floor(Math.random() * byebye.length)];
        speech.text = finalresult;
    }
    window.speechSynthesis.speak(speech);
    chatareamain.appendChild(showchatbotmsg(speech.text));
}

recognition.onresult=function(e){
    let resultIndex = e.resultIndex;
    let transcript = e.results[resultIndex][0].transcript;
    chatareamain.appendChild(showusermsg(transcript));
    chatbotvoice(transcript);
    console.log(transcript);
}
recognition.onend=function(){
    mic.style.background="#ff3b3b";
}
mic.addEventListener("click", function(){
    mic.style.background='#39c81f';
    recognition.start();
    console.log("Activated");
})
