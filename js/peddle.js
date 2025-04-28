$(document).ready(
    function(){
    $('.location-input').addClass('animate__animated animate__slideInRight');


    $(".card").hover(function() {
        $(this).effect("shake", {distance: 5, times: 2}, 300);
    });
});

//Avatar Javascript
function selectAvatar(selected) {
    document.querySelectorAll('.avatar').forEach(avatar => avatar.classList.remove('selected'));
    selected.classList.add('selected');
}
//End of Avatar Javascript