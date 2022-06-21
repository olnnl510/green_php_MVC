(function () {
    const del = document.querySelector('#btnDel');
    del.addEventListener('click', function() {
        if (!confirm("확인(예) 또는 취소(아니오)를 선택해주세요.")) {
            // 취소(아니오) 버튼 클릭 시 이벤트
        } else {
            // location.href = `del?i_board=${btnDel.dataset.i_board}`;
            location.href = `del?i_board=${this.dataset.i_board}`;

        }
    });
})();