//jshint esversion:6

//SEARCH ENGINE

class Search{
    //1.Describe & Create our object(What)
    constructor(){
        this.resultsDiv = $("#search-overlay__results");
        this.openButton = $(".search-icon");
        this.closeButton= $(".search-close");
        this.searchOverlay = $(".search-overlay");
        this.searchField = $("#search-item");
        this.events();
        this.isOverlayOpen = false;
        this.isSpinnerVisible = false;
        this.previousValue = '';
        this.typingTimer = '' ;
    }
    //2.Events(When)
    events(){
        this.openButton.on('click',this.openOverlay);
        this.closeButton.on('click',this.closeOverlay);
        $(document).on('keydown', this.keyPressDispatcher.bind(this));
        this.searchField.on("keyup", this.typingLogic.bind(this));
    }
    //3. Methods(How)
    typingLogic(){

        if (this.searchField.val() != this.previousValue){
            //condition is to avoid loading screen reset with word navigations  
            clearTimeout(this.typingTimer); //resets timer

            if(this.searchField.val()){
                // to not load loading screen when words are deleted
                if(!this.isSpinnerVisible){ // not reset loading every keypress
                    this.resultsDiv.html('<img style="width:50px" src="https://media2.giphy.com/media/3oEjI6SIIHBdRxXI40/giphy.gif">');
                    this.isSpinnerVisible=true; 
                   }
                   this.typingTimer = setTimeout(this.getResults.bind(this),750);
            
            }
            else{
                this.resultsDiv.html('');
                this.isSpinnerVisible = false;
            }
        }
              this.previousValue = this.searchField.val();
    }

    //!Important '=>' like function but does not enclose 'this' function
    getResults() {
        $.getJSON(conceptData.root_url + '/wp-json/concept/v1/search?term=' + this.searchField.val(), (results) => {
          this.resultsDiv.html(`
            <div>
            <div>
            <h2>General Information</h2>
            ${results.generalInfo.length ? '<ul>' : '<p>No general information matches that search.</p>'}
              ${results.generalInfo.map(item => `<li><a href="${item.permalink}">${item.title}</a> ${item.postType == 'post' ? `by ${item.authorName}` : ''}</li>`).join('')}
            ${results.generalInfo.length ? '</ul>' : ''}
          </div>
              <div>
                <h2>Programs</h2>
                ${results.programs.length ? '<ul>' : `<p>No programs match that search. <a href="${conceptData.root_url}/programs">View all programs</a></p>`}
                  ${results.programs.map(item => `<li><a href="${item.permalink}">${item.title}</a></li>`).join('')}
                ${results.programs.length ? '</ul>' : ''}
    
                <h2>Professors</h2>
                ${results.professors.length ? '<ul>' : `<p>No professors match that search. </p>`}
                ${results.professors.map(item => `
                <li><a href="${item.permalink}">
                ${item.title}</a>
               <img src="${item.image}" alt="">
               </li> 
                `).join('')}
                ${results.professors.length ? '</ul>' : ''}


              </div>
              <div>
                <h2>Campuses</h2>
                ${results.campuses.length ? '<ul>' : `<p>No campuses match that search. <a href="${conceptData.root_url}/campuses">View all campuses</a></p>`}
                  ${results.campuses.map(item => `<li><a href="${item.permalink}">${item.title}</a></li>`).join('')}
                ${results.campuses.length ? '</ul>' : ''}
    
                <h2>Events</h2>
                ${results.events.length ? '' : `<p>No events match that search. <a href="${conceptData.root_url}/events">View all events</a></p>`}
                ${results.events.map(item => `
                <a href = "${item.permalink}">
                <span>${item.month}</span>
                <span>${item.day}</span>
                </a>
                <h5><a href="${item.permalink}">${item.title}</a></h5>
                <p>${item.description}<a href="${item.permalink}">Learn More</a></p>
                `).join('')}

              </div>
            </div>
          `);
          this.isSpinnerVisible = false;
        });
    }
    
    keyPressDispatcher(event){
       if (event.keyCode == 83 && !this.isOverlayOpen && !$("input,textarea").is(':focus')){
           this.openOverlay();
       }
       if (event.keyCode == 27 && this.isOverlayOpen){
        this.closeOverlay();
    }
    }


    openOverlay(){
        $(".search-overlay").addClass("search-overlay--active");
        this.searchField.val('');
        this.searchField.focus();
        this.isOverlayOpen = true;
        return false; // prevent default behavior of link elements
        
    }

    closeOverlay(){
        $(".search-overlay").removeClass("search-overlay--active");
        this.isOverlayOpen = false;
    }

    
  }


var amazingSearch = new Search();

//My Notes

class MyNotes{
  constructor(){
    this.events();
  }
//events
  events(){
    $("#my-notes").on("click",".delete-note",this.deleteNote);
    $("#my-notes").on("click",".edit-note",this.editNote.bind(this));
    $("#my-notes").on("click",".update-note",this.updateNote.bind(this));
    $(".submit-note").on("click",this.createNote.bind(this));
  }
//methods
  editNote(event){
    var thisNote = $(event.target).parents('li');
    if(thisNote.data("state") == "editable"){
      //make readonly
      this.makeNoteReadOnly(thisNote);
    }
    else{
      // make editable
      this.makeNoteEditable(thisNote);
    }
  }

  makeNoteEditable(thisNote){
    thisNote.find(".edit-note").html('Cancel');
    thisNote.find(".note-title-field, .note-body-field").removeAttr("readonly").addClass("note-active-field");
    thisNote.find(".update-note").addClass("update-note--visible").removeClass("note-active-field");
    thisNote.data("state","editable");
  }

  makeNoteReadOnly(thisNote){
    thisNote.find(".edit-note").html('Edit');
    thisNote.find(".note-title-field, .note-body-field").attr("readonly","readonly").removeClass("note-active-field");
    thisNote.find(".update-note").removeClass("update-note--visible");
    thisNote.data("state","cancel");
  }

  deleteNote(event){
  var thisNote = $(event.target).parents('li');
    $.ajax({
  beforeSend:(xhr) => {
      xhr.setRequestHeader('X-WP-Nonce',conceptData.nonce);
    },
  url: conceptData.root_url + '/wp-json/wp/v2/note/' + thisNote.data('id'),
  type: 'DELETE',
  success: (response) => {
    thisNote.slideUp();
    console.log(response);
    if(response.userNoteCount < 5){
      $(".note-limit-message").removeClass("active");
    }
  },
  error: (response) =>{
    console.log('sorry');
    console.log(response);
  }
});
  }

  updateNote(event){
    var thisNote = $(event.target).parents('li');
      
    var ourUpdatedPost = {
      'title': thisNote.find(".note-title-field").val(),
      'content': thisNote.find(".note-body-field").val()
    };

    $.ajax({
    beforeSend:(xhr) => {
        xhr.setRequestHeader('X-WP-Nonce',conceptData.nonce);
      },
    url: conceptData.root_url + '/wp-json/wp/v2/note/' + thisNote.data('id'),
    type: 'POST',
    data:ourUpdatedPost,
    success: (response) => {
      this.makeNoteReadOnly(thisNote);
      console.log(response);
    },
    error: (response) =>{
      console.log('sorry');
      console.log(response);
    }
  });
    }
    //NONCE CODE - to validate WP users
    createNote(event){
        
      var ourNewPost = {
        'title': $(".new-note-title").val(),
        'content': $(".new-note-body").val(),
        'status': 'publish'
      };
  
      $.ajax({
      beforeSend:(xhr) => {
          xhr.setRequestHeader('X-WP-Nonce',conceptData.nonce);
        },
      url: conceptData.root_url + '/wp-json/wp/v2/note/',
      type: 'POST',
      data: ourNewPost,
      success: (response) => {
        $(".new-note-title",".new-note-body").val("");
        $(`
        <li data-id="${response.id}">
        <!-- esc_attr - use every access on the backend for security purposes -->
        <input class="note-title-field" readonly value="${response.title.raw}"> 
        <span class="edit-note" aria-hidden="true">Edit</span>
        <span class="delete-note" aria-hidden="true">Delete</span>
        <textarea readonly class="note-body-field" cols="30" rows="1">${response.content.raw}</textarea>
        <span class="update-note btn btn--blue btn--small" aria-hidden="true">Save</span>
      </li>
        `).prependTo("#my-notes").hide().slideDown();
        console.log(response);
      },
      error: (response) =>{
        if(response.responseText == "You have reached your note limit."){
          $(".note-limit-message").addClass("active");
        }
        console.log('sorry');
        console.log(response);
      }
    });
      }
}

var mynotes = new MyNotes();

//LIKED POST

class Like{
  constructor(){
    this.events();
  }

  events(){
    $(".like-box").on("click",this.ourClickDispatcher.bind(this));
  }

  //methods

  ourClickDispatcher(e){
    
    var currentLikeBox = $(e.target).closest(".like-box");

    if(currentLikeBox.attr('data-exists') =='yes'){
      this.deleteLike(currentLikeBox);
    }
    else{
      this.createLike(currentLikeBox);
    }
  }

  createLike(currentLikeBox){
    $.ajax({
      beforeSend:(xhr) => {
        xhr.setRequestHeader('X-WP-Nonce',conceptData.nonce);
      },
      url: conceptData.root_url + '/wp-json/concept/v1/manageLike',
      type:'POST',
      data: {'professorId':currentLikeBox.data('professor')}, //data-professor
      success: (response) => {
        currentLikeBox.attr('data-exist','yes');
        var likeCount = parseInt(currentLikeBox.find(".like-count").html(),10); 
        likeCount++;
        currentLikeBox.find(".like-count").html(likeCount);
        currentLikeBox.attr('date-like',response); 
        console.log(response);
      },
      error: (response) => {
        console.log(response);
      }
    });
  }

  deleteLike(currentLikeBox){
    $.ajax({
      //to enable nonce
      beforeSend:(xhr) => {
        xhr.setRequestHeader('X-WP-Nonce',conceptData.nonce);
      },
      //
      url: conceptData.root_url + '/wp-json/concept/v1/manageLike',
      data: {'like':currentLikeBox.attr('date-like')},
      type:'DELETE',
      success: (response) => {
        currentLikeBox.attr('data-exist','no');
        var likeCount = parseInt(currentLikeBox.find(".like-count").html(),10); 
        likeCount--;
        currentLikeBox.find(".like-count").html(likeCount);
        currentLikeBox.attr('date-like',''); 
        console.log(response);
      },
      error: (response) => {
        console.log(response);
      }
    });
  }
}

var like = new Like();