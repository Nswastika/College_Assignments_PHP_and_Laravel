let mic = document.getElementById("mic");
let chatareamain = document.querySelector('.chatarea-main');
let chatareaouter = document.querySelector('.chatarea-outer');

let intro = ["I am a student-friendly chatbot. My name is Smart Bot"];
let help = ["How can i assist you?"];
let greetings = ["I am really good. How are you?"];
let fine = ["Nice to hear that"];
let hobbies = ["i love to talk with humans", "i like to make friends like you", "i like cooking"];
let pizzas = ["You can find part-time jobs and internships in thsi website."];
let apply = ["Select job as per your need and click 'Apply Now' button"];
let query = ["You can select a job and click 'Message' button to directly query about the job with employer"];
let time = ["Your resume will be evaluated and reply will be sent to you after some days via Gmail"]
let thank = ["Most welcome","Not an issue","Its my pleasure","Mention not"];
let activated = ["If you are a student you can click on the link sent to Gmail to activate. If you are employer you shold wait until you are activated by the Admin."];
let closing = ['Ok bye-bye','As you wish, bye take-care','Bye-bye, see you soon..']

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
    speech.text = "This is test message";
    if(message.includes('you' || 'who')){
        let finalresult = intro[Math.floor(Math.random() * intro.length)];
        speech.text = finalresult;
    }
    if(message.includes('help')){
        let finalresult = help[Math.floor(Math.random() * help.length)];
        speech.text = finalresult;
    }
    if(message.includes('apply for')){
        let finalresult = reply[Math.floor(Math.random() * reply.length)];
        speech.text = finalresult;
    }
    if(message.includes('how are you' || 'how are you doing today')){
        let finalresult = greetings[Math.floor(Math.random() * greetings.length)];
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
    if(message.includes('when will job be approved' || 'how to know job is approved or not' || 'approved')){
        let finalresult = time[Math.floor(Math.random() * time.length)];
        speech.text = finalresult;
    }
    if(message.includes('how to activate my account' || 'activated')){
        let finalresult = activated[Math.floor(Math.random() * activated.length)];
        speech.text = finalresult;
    }
    if(message.includes('tell me something about you' || 'tell me something about your hobbies')){
        let finalresult = hobbies[Math.floor(Math.random() * hobbies.length)];
        speech.text = finalresult;
    }
    if(message.includes('type of job' || 'kinds of job' || 'offer')){
        let finalresult = pizzas[Math.floor(Math.random() * pizzas.length)];
        speech.text = finalresult;
    }
    if(message.includes('thank you' || 'thank you so much')){
        let finalresult = thank[Math.floor(Math.random() * thank.length)];
        speech.text = finalresult;
    }
    if(message.includes('talk to you' || 'talk')){
        let finalresult = closing[Math.floor(Math.random() * closing.length)];
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
