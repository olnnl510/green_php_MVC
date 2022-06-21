(function() {
    const trList = document.querySelectorAll('tbody > tr'); // querySelectorAll : 무조건 배열이 넘어옴
    trList.forEach(item => {
        item.addEventListener('click', e=> {
            location.href = `detail?i_board=${item.dataset.i_board}`;
        });
    });
})();