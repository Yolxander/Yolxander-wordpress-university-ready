import $ from 'jquery';

class Like{
    constructor(){
        this.events();
    }

    events(){
        $(".like-box").on("click",  this.ourClickDispatcher.bind(this))
    }

    //methods
    ourClickDispatcher(e){
        //makes the js flexible in case we wanna have more than one like box element in the same page 
        var currentLikeBox = $(e.target).closest(".like-box");
        if(currentLikeBox.attr('data-exists') == 'yes'){
            this.deleteLike(currentLikeBox);
        }else{
            this.createLike(currentLikeBox);
        }
    }

    createLike(currentLikeBox){
        $.ajax({
            beforeSend: (xhr)=>{
                xhr.setRequestHeader('X-WP-Nonce', universityData.nonce)
            },
            //we are using like-route custom rest api
            url:universityData.root_url + '/wp-json/university/v1/manageLike',
            type:'POST',
            //thiss way of sending data its like saying:
            // /university/v1/manageLike?professorId=789
            data:{'professorId': currentLikeBox.data('professor')},
            success:(response)=>{
                currentLikeBox.attr('data-exists', 'yes');
                var likeCount = parseInt(currentLikeBox.find(".like-count").html(), 10);
                likeCount++;
                currentLikeBox.find(".like-count").html(likeCount);
                currentLikeBox.attr("data-like", response);
                console.log(response);
            },
            error:(response)=>{
                console.log(response);
            }
        });
    }

    deleteLike(currentLikeBox){
        $.ajax({
            beforeSend: (xhr)=>{
                xhr.setRequestHeader('X-WP-Nonce', universityData.nonce)
            },
            url:universityData.root_url + '/wp-json/university/v1/manageLike',
            data:{'like': currentLikeBox.attr('data-like')},
            type:'DELETE',
            success:(response)=>{
                currentLikeBox.attr('data-exists', 'no');
                var likeCount = parseInt(currentLikeBox.find(".like-count").html(), 10);
                likeCount--;
                currentLikeBox.find(".like-count").html(likeCount);
                currentLikeBox.attr("data-like", '');
                console.log(response);
            },
            error:(response)=>{
                console.log(response);
            }
        });
    }
}

export default Like;