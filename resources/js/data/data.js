moment.locale('en');

let post_date = document.querySelectorAll('.date');

for(let i = 0; i< post_date.length; i++)
{
    console.log(post_date[i]);
    let date = post_date[i].innerHTML;
    post_date[i].innerHTML = moment(date).fromNow();

}


