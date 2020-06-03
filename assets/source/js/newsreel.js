export default () => {
    
    const postTypeName = 'newsheadline'; 
    const url = '/wp-json/wp/v2/' + postTypeName; 
    const optionsUrl = '/wp-json/wp/v2/newsOptions'; 

    let amount = 0;
    let newsHeadlineElements = []; 
    let currentNews = 0; 
    let newsReelEnabled = true; 

    let navbarEl = document.querySelector(".navbar"); 

    //Animation settings
    let transitionTime=5000 ; //fade in and out time in ms. 
    let pauseTime = 800; //pause time in ms.
    let animationCounter = 0;
    const animationStep = 1000/30; //in ms

    let paused = false; 
    let headlineContainer = false,
        newsreelContainer = false; 
    const headerEl = document.querySelector("#site-header"); 

    fetch(optionsUrl)
        .then(response => response.json() )
        .then(data => {
            transitionTime = parseInt(data.animation_transition_time);
            pauseTime = parseInt(data.animation_pause_time);
            newsReelEnabled = data.enabled; 

            if(newsReelEnabled) {
                navbarEl.classList.add("news-top-margin");
                //Get the data from the wp-json api and generate the list of news headlines
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        newsHeadlineElements = generateNewsList(data); 
                        //if there are any headlines to display, then generate the html elements
                        if(newsHeadlineElements.length > 0) { 
                            createNewsReelElements();
                            setCurrentNewsItem(currentNews); 
                            startAnimation(); 
                        }
                    }); 
            } else {
                navbarEl.classList.remove("news-top-margin");
            }

        }); 


    function startAnimation(){
        setInterval( () => {
            if(!paused){
                animationCounter += animationStep;
            }
            if(animationCounter > pauseTime+transitionTime*2) {
                next(); 
            }
        }, animationStep); 
    }

    function pause(){
        paused = true; 
    }
    function restart(){
        paused = false; 
    }

    function next(){
        animationCounter = 0; 
        let currentNewsHeadline = document.querySelector("#newsHeadline");
        currentNewsHeadline.classList.remove("activeNewsLink");
        currentNewsHeadline.classList.add("disabledNewsLink"); 
        setTimeout(()=>{
            currentNews = (currentNews+1)%amount; 
            setCurrentNewsItem(currentNews);
        }, transitionTime);
    }
    function previous(){
        animationCounter = 0; 
        let currentNewsHeadline = document.querySelector("#newsHeadline");
        currentNewsHeadline.classList.remove("activeNewsLink");
        currentNewsHeadline.classList.add("disabledNewsLink"); 
        setTimeout(()=>{
            if(currentNews===0){
                currentNews = amount -1; 
            } else { 
                currentNews = (currentNews-1)%amount; 
            }
            setCurrentNewsItem(currentNews);
        }, transitionTime);
    }


    function createNewsReelElements(){
        newsreelContainer = document.createElement("div"); 
        newsreelContainer.classList.add("newsreel-container","carousel");
        newsreelContainer.id = "newsreel-container"; 
        addControls(); 
    
        let content = document.createTextNode(""); 
        newsreelContainer.appendChild(content); 
        headerEl.appendChild(newsreelContainer);         
    }

    function addControls(){
        let backButton = document.createElement("button");
        backButton.classList.add("flickity-button","flickity-prev-next-button", "previous" );
        backButton.type="button"; 
        let backIcon = document.createElement('svg');
        backIcon.classList.add("flickity-button-icon");
        backIcon.setAttribute("viewBox", "0 0 100 100"); 
        let backIconPath = document.createElement("path");
        backIconPath.setAttribute("d", "M 10,50 L 60,100 L 70,90 L 30,50  L 70,10 L 60,0 Z"); 
        backIconPath.classList.add("arrow"); 
        backIcon.appendChild(backIconPath);
        backButton.appendChild(backIcon);     
        
        headlineContainer = document.createElement("div"); 
        headlineContainer.classList.add("headlineContainer");
        headlineContainer.id = "headline-container"; 
        headlineContainer.onmouseover = pause;
        headlineContainer.onmouseout = restart; 
        
        
        let forwardButton = document.createElement("button");
        forwardButton.classList.add("flickity-button","flickity-prev-next-button", "next" );
        forwardButton.type="button"; 
        let forwardIcon = document.createElement('svg');
        forwardIcon.classList.add("flickity-button-icon");
        forwardIcon.setAttribute("viewBox", "0 0 100 100"); 
        let forwardIconPath = document.createElement("path");
        forwardIconPath.setAttribute("d", "M 10,50 L 60,100 L 70,90 L 30,50  L 70,10 L 60,0 Z"); 
        forwardIconPath.classList.add("arrow"); 
        forwardIcon.appendChild(forwardIconPath);
        forwardButton.appendChild(forwardIcon);     

        backButton.onclick = (event) => {
            previous();
        }
        forwardButton.onclick = (event) => {
            next();
        }

        newsreelContainer.appendChild(backButton); 
        newsreelContainer.appendChild(headlineContainer); 
        newsreelContainer.appendChild(forwardButton); 

    }

    function generateNewsList(array) { 
        let elems = []; 
        array.forEach(element => {
            let newsLink = document.createElement("a"); 
            newsLink.classList.add("newsLink","animate");
            newsLink.id = 'newsHeadline'; 
            newsLink.href = element.url; 
            newsLink.style.transition = "opacity " + transitionTime + "ms ease-in"; 
            
            amount++; 
            let newsHeadline = document.createTextNode(element.title.rendered); 
            newsLink.appendChild(newsHeadline);
            elems.push(newsLink); 
        });
        
        return elems; 
    }

    //changes the visible news headline, with fading out and in. 
    //here the parameter i should be an integer in 0...(amount-1). 
    function setCurrentNewsItem(i) {
        let el = newsreelContainer.querySelector("#newsHeadline");
        if(el){ headlineContainer.removeChild(el); } 
        headlineContainer.appendChild(newsHeadlineElements[i]); 

        setTimeout(() => {
            newsHeadlineElements[i].classList.remove("disabledNewsLink"); 
            newsHeadlineElements[i].classList.add("activeNewsLink");
        }, 100)
    }



}



