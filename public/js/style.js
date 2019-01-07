$(document).ready(function(){
    $('.counter').each(function() {
        var $counter = $(this);
        var countTo = $counter.attr('data-count');
        $({countNum: $counter.text()}).animate({countNum: countTo},
        {
            duration: 2000,
            easing:'swing',
            step: function() {
                $counter.text(Math.floor(this.countNum));
            },
            complete: function() {
                $counter.text(this.countNum);
            }
        });
    });

    $('.card').each(function(){
        var card = this.id;
        if(card !== ""){
            var cardID = card.substring(5,card.length);
            var editButton = $('#edit-button-'+cardID);
            var cancelButton = $('#cancel-button-'+cardID);
            var choice = $('#choice-'+cardID);
            var h2 = $('#'+card+' h2');
            var categoryName = h2.text();
            var test = '#'+card+' .form1 form';
            //console.log(test);
            $(editButton).click(function(){
                $(h2).fadeOut(0);
                if(!$('#input-'+cardID).val()){     //dont create input if there is an already one there and just show it.
                    $('<input/>').attr({ type: 'text', name:'category-name' , id:'input-'+cardID }).prop('required',true)
                        .prependTo('#'+card+' .edit-form form').focus().val(categoryName);
                }else{
                    $('#input-'+cardID).fadeIn(500).focus().val(categoryName);
                }
                $(editButton).fadeOut(0);
                // $(choice).css({"opacity":"0","display":"flex"}).animate({"opacity":"1"},500);
                $(choice).stop().css("display", "flex").hide().fadeIn(500);    // a Trick to enable display flex after displayed none
            });

            $(cancelButton).click(function(){
                $('#input-'+cardID).fadeOut(0);
                $(h2).fadeIn(500);
                $(choice).fadeOut(0);
                $(editButton).fadeIn(500);
            });
        }
    });

    $('#add-category-button').click(function(){
        $('.card-new').fadeIn(500);
    });

    $('#cancel-button-0').click(function(){
        $('.card-new').fadeOut(0);
    });

    var postWrapperTopMargin = $('.navbar').outerHeight();
    $('.post-wrapper').transition({'margin-top':postWrapperTopMargin*2},1000);

    var editPostInput =  $('.post-edit input#title.form-control');
    var editPostInputText =  editPostInput.val();
    $(editPostInput).focus().val("").val(editPostInputText);

    $(".nav-button").click(function(){
        //console.log("CLICKED");
        if (!$(this).hasClass('x')){
            $(".nav-button .middle").css({"display":"none"});
            $(".nav-button .top").css({"top":"10px"}).transition({"transform":"rotate(45deg);"},300);
            $(".nav-button .bottom").css({"top":"10px"}).transition({"transform":"rotate(-45deg)"},300);
            //$(".main-nav").css({"flex-direction":"column","height":"auto"});
            // $(".first-half").css({"display":"none"});
            // $(".right-of-nav ul").css({"margin-left":"0"});
            // $(".right-of-nav").fadeIn(2000);
            $(".nav-button").addClass("x");
        }
        else{
            $(".nav-button .middle").css({"display":"block"});
            $(".nav-button .top").css({"top":"0"}).transition({"transform":"rotate(0);"},300);
            $(".nav-button .bottom").css({"top":"20px"}).transition({"transform":"rotate(0)"},300);
            //$(".main-nav").css({"flex-direction":"row","height":"0"});
            // $(".right-of-nav").css({"display":"none"});
            // $(".first-half").fadeIn(1000);
            $(".nav-button").removeClass("x");
        }
    });
    // $(window).resize(function() {
    //     var windowWidth = $(window).innerWidth();
    //     var dropDownMenu = $('li.nav-item.dropdown');
    //     if (windowWidth < 880) {
    //         $(dropDownMenu).removeClass("ml-auto");
    //     }else{
    //         $(dropDownMenu).addClass("ml-auto");
    //     }
    // });

});