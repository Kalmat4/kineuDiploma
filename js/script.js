    let fieldArray = [
        'book__name',
        'author',
        'keyWords',
        'rubric',
        'faculty',
        'spec',
        'edition'
    ];
    let url = window.location.href;
    let coordinates = url.indexOf('reestr');
    if (coordinates > 1){
        for (let i=3;i<fieldArray.length;i++){
            let selectTag = document.querySelector('select[name=' + fieldArray[i] + ']');
            let dropdownSession = localStorage.getItem(fieldArray[i]);
            if(dropdownSession){
                selectTag.value = dropdownSession;
            }
        }
        function clearSession(){
            for (let i=3;i<fieldArray.length;i++){
                let selectTag = document.querySelector('select[name=' + fieldArray[i] + ']');
                let dropdownSession = localStorage.getItem(fieldArray[i]);
                if(dropdownSession){
                    selectTag.value = '0';
                    localStorage.removeItem(fieldArray[i]);
                }
                }
        }
    
        // select.value = "5";
        // select.options[select.selectedIndex].text;
        let firstSavedField = '';
        let secondSavedField = '';
        for (let i=0;i<fieldArray.length;i++){
            if (i >= 3){
                let select = document.querySelector('select[name=' + fieldArray[i] + ']');
                if (select.value.length >= 1){
                    if (firstSavedField.length >= 1){
                        secondSavedField = select.name;
                    }else{
                        firstSavedField = select.name;
                    }
                }
                
            }else{
                let input = document.querySelector('input[name=' + fieldArray[i] + ']');
                if (input.value.length >= 1){
                    if (firstSavedField.length >= 1){
                        secondSavedField = input.name;
                    }else{
                        firstSavedField = input.name;
                    }
                }
            }
        }
    
        let firstField;
        let secondField;
        if (firstSavedField.length >= 1 && secondSavedField.length >=1){
            disableFields(firstSavedField, secondSavedField);
        }
    }
    
    
    let tipStatus = 'closed';
    function showTip(){
        let tip = document.querySelector('.tip');
       
        if (tipStatus == 'closed'){
            tip.style.opacity = '1';
            tip.style.transition = '0.4s';
            tip.style.zIndex = '1';
            tipStatus = 'opened';
        }
        
    }

    function closeTip(){
            let tip = document.querySelector('.tip');
        
            if (tipStatus == 'opened'){
                tip.style.opacity = '0';
                tip.style.transition = '0.4s';
                tip.style.zIndex = '-1';
                tipStatus = 'closed';
            }
            
        }
    let isOpened = false;

    function showMenu(){
        let navbar = document.querySelector('.nav__bar');
        let navBtn = document.querySelector('.nav__button');
        let navBtnDiv1 = document.querySelectorAll('.nav__button__divider')[0];
        let navBtnDiv2 = document.querySelectorAll('.nav__button__divider')[1];
        let navBtnDiv3 = document.querySelectorAll('.nav__button__divider')[2];
        if (isOpened){
            navbar.style.display = 'none';
            navBtn.style.backgroundColor = '#fff';
            navBtn.style.transition = '0.5s';
            navBtn.style.transform = 'rotate(360deg)';
            navBtnDiv1.style.borderColor = 'var(--backgroundColor)';
            navBtnDiv2.style.borderColor = 'var(--backgroundColor)';
            navBtnDiv3.style.borderColor = 'var(--backgroundColor)';
            isOpened = false;
        }else{
            navbar.style.display = 'flex';
            navBtn.style.backgroundColor = 'var(--backgroundColor)';
            navBtnDiv1.style.borderColor = '#fff';
            navBtnDiv2.style.borderColor = '#fff';
            navBtnDiv3.style.borderColor = '#fff';
            navBtn.style.borderColor = '#fff';
            navBtn.style.transform = 'rotate(90deg)';
            navBtn.style.transition = '0.5s';
            isOpened = true;
        }
    }



    let swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        loop: true,
        pagination: false,
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        autoplay: {
            delay: 1500,
        },
        breakpoints:{
            600:{
                slidesPerView: 3,
            },
            900:{
                slidesPerView: 4,
            },
            1200:{
                slidesPerView: 5,
            },
            1370:{
                slidesPerView: 5,
            }
        }
    });



    let eventCount = 0;
    let firstEnter = "";
    let secondEnter = "";
    let changedInput;
    let spanText = document.querySelector('.sort > span');
    document.addEventListener('input', function(event){
        let isFieldsEmpty;
        let eventNulificator;
        for (let i=0;i<fieldArray.length;i++){
            let inputTag = document.querySelector('input[name=' + fieldArray[i] + ']');
            let selectTag = document.querySelector('select[name=' + fieldArray[i] + ']');
            if (i >= 3){
                if (selectTag.value.length < 1){
                    isFieldsEmpty = true;
                }else{
                    isFieldsEmpty = false;
                    break;
                }
            }else{
                if (inputTag.value.length < 1){
                    isFieldsEmpty = true;
                }else{
                    isFieldsEmpty = false;
                    break;
                }
            }
            if (i == fieldArray.length-1 && isFieldsEmpty){
                eventCount = 0;
                eventNulificator = true;
                firstEnter = "";
                secondEnter = "";
            }
        }
        if (!(eventNulificator)){
            if (changedInput == 'book__name' || changedInput == 'keyWords' || changedInput == 'author'){
                let input = document.querySelector('input[name=' + changedInput + ']');
                if (eventCount == 0){
                    firstEnter = input.name;
                }
                if (input.name != firstEnter){
                    secondEnter = input.name;
                }
                eventCount++;     
                disableFields(firstEnter, secondEnter);  
            }else{
                let select = document.querySelector('select[name=' + changedInput + ']');
                if (eventCount == 0){
                    firstEnter = select.name;
                }
                if (select.name != firstEnter){
                    secondEnter = select.name;
                }
                eventCount++;  
                
                localStorage.setItem(select.name, event.target.value);    
    
                disableFields(firstEnter, secondEnter);  
            }
            

        
        }
        
        
    })
    let rubric = document.querySelector('#rubric__id');
    let faculty = document.querySelector('#faculty__id');
    let spec = document.querySelector('#spec__id');
    let edition = document.querySelector('#edition__id');



    function disableFields(field1Id = '', field2Id = '') {
        let inputFields = document.getElementsByTagName("input");
        let selectFields = document.getElementsByTagName("select");

        if (field2Id.length >= 1 && field1Id.length >= 1){

            if (field1Id == 'book__name' || field1Id == 'keyWords' || field1Id == 'author'){
                firstField = document.querySelector('input[name=\'' + field1Id + '\']');
            }else{
                firstField = document.querySelector('select[name=\'' + field1Id + '\']');
            }

            if (field2Id == 'book__name' || field2Id == 'keyWords' || field2Id == 'author'){
                secondField = document.querySelector('input[name=\'' + field2Id + '\']');
            }else{
                secondField = document.querySelector('select[name=\'' + field2Id + '\']');
            }
            for (let i = 0; i < inputFields.length; i++) {
                
                if (inputFields[i].name !== field1Id && inputFields[i].name !== field2Id) {
                    inputFields[i].disabled = true;
                }
            }

            for (let i = 0; i < selectFields.length; i++) {
                
                if (selectFields[i].name !== field1Id && selectFields[i].name !== field2Id) {
                    selectFields[i].disabled = true;
                }
            }
            if (firstField.value.length < 1 || secondField.value.length < 1){
                
                for (let i = 0; i < inputFields.length; i++) { 
                    inputFields[i].disabled = false;
                }

                for (let i = 0; i < selectFields.length; i++) {
                    selectFields[i].disabled = false;
                }
            }
        
        }

      }


    function showLangMenu(){
        let element = document.querySelector('.language__toggle');
        if (element.style.display == 'flex'){
            element.style.display = 'none';
        }else{
            element.style.display = 'flex';
        }
    }

    
    
    let navItem ;
    let wrapper;
    
    
    
    
    let nav;
    let isOpenMenu = false;
    let targetItem;
    let getStyle; 
    let dropdownTop; 
    let dropdownHeight; 
    let borderBottom = 1000; 
    document.addEventListener('mousemove', function(e){
    
        navItem = document.querySelector('.navigation').clientHeight;
        wrapper = document.querySelector('.wrapper').clientHeight;
        let count = navItem + wrapper;
        targetItem = document.querySelector("." + String(e.target.parentElement.classList[1]) + " > .dropdown-menu"); 
        
        if (!(isOpenMenu)){
            nav = document.querySelector("." + String(e.target.parentElement.classList[1]) + " > .dropdown-menu"); 
        }
        if(String(e.target.classList).indexOf('nav__item') >= 0){
            if(!(String(e.target.classList).indexOf('nav__item__0') >= 0)){

                nav.style.top = count + 'px';
                isOpenMenu = true;
                    
                if (isOpenMenu){
                    if (nav.parentElement.classList[1] != e.target.parentElement.classList[1]){
                        nav.style.top = '0px';
                        isOpenMenu = false;
                        nav = document.querySelector("." + String(e.target.parentElement.classList[1]) + " > .dropdown-menu"); 
                        nav.style.top = count + 'px';
                        isOpenMenu = true;
                    }
                    getStyle = window.getComputedStyle(targetItem);
                    
                    dropdownPadding = +getStyle.getPropertyValue('padding').replace('px','');
                    dropdownTop = +getStyle.getPropertyValue('top').replace('px','');
                    dropdownHeight = +getStyle.getPropertyValue('height').replace('px','');
                    dropdownHeight += (dropdownPadding * 2);
                    borderBottom = dropdownTop + dropdownHeight;
                        
                }
            }
        }else if(e.clientY > borderBottom){
            if (isOpenMenu){
                nav.style.top = '0px';
                isOpenMenu = false;
            }
        }
    })
    
    
    