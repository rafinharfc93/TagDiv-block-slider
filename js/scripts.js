const td_blocks_omnesweb_slider_1 = (slider) => {

    let container = document.getElementById(slider);
    var item = container.querySelectorAll('.item');
    item[0].classList.add('current');
    let pagination = container.querySelector('.pagination');

    const _interval = () => {
        var current_ref = document.getElementById(slider).querySelector('li.current').getAttribute('ref');
        var next = parseInt(current_ref) + parseInt(1);
        if(next > 3) {
            next = 0;
        }
        var lis = pagination.querySelectorAll('li');
        lis[next].click();
    }
    var interval = setInterval(() => _interval(), 5000); 

    pagination.querySelectorAll('li').forEach((pagination_item, index) => {
        pagination_item.addEventListener('click', async function(e){
            clearInterval(interval);
            var page = this.getAttribute('ref');
            var current = container.querySelector('.current');
            pagination.querySelector('.current').classList.remove('current');  
            this.classList.add('current');                 
            item[page].classList.add('current');
            current.classList.remove('current');  
            interval = setInterval(() => _interval(), 5000); 
        });
    });
    
}